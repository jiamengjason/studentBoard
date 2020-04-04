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
            $data[] = [
                'active_id' => $item['id'],
                'title' => $item['title'],
                'title_img' => $item['title_img'],
                'desc' => $item['desc'],
                'addr' => $item['addr'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                //活动是否开始：1进行中 2未开始 3已过期
                'status' => strtotime($item['start_time']) > $time ? 2 : (strtotime($item['end_time']) > $time ? 1 : 3)
            ];
        }

        return ['list'=>$data, 'page_count'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'page_size'=>$pages->getPageSize()];
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
                //活动是否开始：1进行中 2未开始 3已过期
                'status' => strtotime($item->active()->start_time) > $time ? 2 : (strtotime($item->active()->end_time) > $time ? 1 : 3)
            ];
        }

        return ['list'=>$data, 'page_count'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'page_size'=>$pages->getPageSize()];
    }


    /**
     * 【课外活动】活动详情
     * @param $id
     * @param bool $userId
     * @return array|bool
     */
    public function getActiveInfoById($id, $userId=false){
        $activeInfo = Active::model()->findByPk($id);
        if (empty($activeInfo) || empty($activeInfo->getAttributes())){
            return false;
        }

        $data = $activeInfo->getAttributes();
        if ($userId){
            $attributes = [
                'active_id' => $id,
                'user_id' => $userId
            ];
            $activeUserInfo = ActiveUser::model()->findByAttributes($attributes);
            if (!empty($activeUserInfo) && !empty($activeUserInfo->getAttributes())){
                $data['is_attend'] = 1;
            }else {
                $data['is_attend'] = 0;
            }
        }

        return $data;
    }
}