<?php

class ActiveService
{
    /**
     * 查询活动列表
     * @param $params
     * @return array
     */
    public function getActiveListByParams($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];

        $activeModel = new Active();
        $criteria = new CDbCriteria();
        $criteria->order = 't.end_time DESC';
        $criteria->with = array ('users');
        if (!empty($params)){
            $condition = '1 ';
            foreach ($params as $field=>$v){
                if (empty($v)){
                    continue;
                }
                if ($field == 'user_id'){//查询机构下的活动列表
                    $condition .= ' and user_id = ' . $v . ' and status_is = 1';
                }elseif($field == 'title'){//根据活动名称模糊搜索
                    $condition .= ' and title like \'%' . trim($v) . '%\'';
                }elseif($field == 'type' && $v == 1){//活动预告
                    $condition .= ' and start_time >\'' . date('Y-m-d H:i:s').'\'';
                }elseif($field == 'type' && $v == 2){//活动进行中
                    $condition .= ' and start_time <\'' . date('Y-m-d H:i:s').'\' and end_time >\'' . date('Y-m-d H:i:s').'\'';
                }elseif($field == 'type' && $v == 3){//已结束
                    $condition .= ' and end_time <\'' . date('Y-m-d H:i:s').'\'';
                }elseif ($field == 'is_command'){
                    $condition .= ' and t.is_command = ' . $v;
                }
            }
            $criteria->condition = $condition;
        }
        $count = $activeModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $pageSize;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $activeModel->findAll($criteria);

        $data = [];
        $time = time();
        foreach ($list as $item){
            $organizationInfo = $item->users->getAttributes();
            $data[] = [
                'organization_id' => $item['user_id'],
                'organization_name' => $organizationInfo['organization_name'],
                'active_id' => $item['id'],
                'title' => $item['title'],
                'title_img' => $item['title_img'],
                'desc' => $item['desc'],
                'addr' => $item['addr'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                'is_command' => $item['is_command'],
                //活动是否开始：1进行中 2未开始 3已过期
                'status' => strtotime($item['start_time']) > $time ? 2 : (strtotime($item['end_time']) > $time ? 1 : 3)
            ];
        }

        return [
            'list'=>$data,
            'total_num' => $count,
            'page_count'=>$pages->getPageCount(),
            'page'=>$pages->getCurrentPage() + 1,
            'page_size'=>$pages->getPageSize(),
            'page_bar'=>$pages
        ];
    }

    /**
     * 【个人中心】【学生-家长】参加的活动列表
     * @param $params
     * @return array
     */
    public function getMyActiveList($params){
        $userId = $params['user_id'];
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];

        $activeUserModel = new ActiveUser();
        $criteria = new CDbCriteria();
        $criteria->order = 'end_time DESC';
        $criteria->condition = 't.user_id = ' . $userId;
        $criteria->with = array ('active');
        $count = $activeUserModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $pageSize;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $activeUserModel->findAll($criteria);

        $data = [];
        $time = time();
        foreach ($list as $item){
            $data[] = [
                'title' => $item->active()->title,
                'title_img' => $item->active()->title_img,
                'desc' => $item->active()->desc,
                'addr' => $item->active()->addr,
                'start_time' => $item->active()->start_time,
                'end_time' => $item->active()->end_time,
                'attend_time' => $item->create_time,
                'status' => $this->getActiveStatus($item->active()->start_time, $item->active()->end_time)
            ];
        }

        return ['list'=>$data, 'page_count'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'page_size'=>$pages->getPageSize()];
    }

    /**
     * 活动是否开始：1进行中 2未开始 3已过期
     * @param $activeStartTime
     * @param $activeEndTime
     * @return int
     */
    private function getActiveStatus($activeStartTime, $activeEndTime){
        $time = time();
        $status = strtotime($activeStartTime) > $time ? 2 : (strtotime($activeEndTime) > $time ? 1 : 3);
        return $status;
    }

    /**
     * 【课外活动】活动详情
     * @param $id
     * @param bool $userId
     * @return array|bool
     */
    public function getActiveInfoById($id, $userId=false){
        $activeModel = new Active();
        $criteria = new CDbCriteria();
        $criteria->condition = 't.id = ' . $id;
        $criteria->with = array ('users');
        $activeInfo = $activeModel->findAll($criteria);
        if (!isset($activeInfo[0]) || empty($activeInfo[0]->getAttributes())){
            return false;
        }

        $organizationInfo = $activeInfo[0]->users->getAttributes();
        $data = [];
        $data['is_attend'] = 0;
        if ($userId){
            $activeUserInfo = ActiveUser::model()->findByAttributes(['active_id' => $id, 'user_id' => $userId]);
            if (!empty($activeUserInfo) && !empty($activeUserInfo->getAttributes())){
                $data['is_attend'] = 1;
            }
        }
        $data['organization_name'] = $organizationInfo['organization_name'];
        $data['organization_id'] = $organizationInfo['id'];
        $data['organization_yewu'] = $organizationInfo['organization_yewu'];
        $activeInfo = $activeInfo[0]->getAttributes();
        $data['active_id'] = $activeInfo['id'];
        $data['title_img'] = $activeInfo['title_img'];
        $data['title'] = $activeInfo['title'];
        $data['desc'] = $activeInfo['desc'];
        $data['addr'] = $activeInfo['addr'];
        $data['start_time'] = $activeInfo['start_time'];
        $data['end_time'] = $activeInfo['end_time'];
        //活动是否开始：1进行中 2未开始 3已过期
        $data['status'] = $this->getActiveStatus($activeInfo['start_time'], $activeInfo['end_time']);
        //报名人数
        $data['attend_users'] = $this->countAttendUsersByActiveId($activeInfo['id']);

        return $data;
    }

    /**
     * 【课外活动】活动详情页面-报名活动
     * @param $params
     * @return bool
     */
    public function attendActive($params){
        $activeUserModel = new ActiveUser();
        $activeUserModel->setAttributes($params);
        return $activeUserModel->save();
    }

    /**
     * 判断用户是否已经报名了当前活动
     * @param $userId
     * @param $activeId
     * @return CActiveRecord
     */
    public function isUserAttendActive($userId, $activeId){
        return ActiveUser::model()->findByAttributes(['user_id'=>$userId, 'active_id'=>$activeId]);
    }

    /**
     * 统计活动下有多少人报名
     * @param $activeId
     * @return string
     */
    public function countAttendUsersByActiveId($activeId){
        return ActiveUser::model()->countByAttributes(['active_id'=>$activeId]);
    }
}