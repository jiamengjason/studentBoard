<?php

class QaService
{

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

        return $data;
    }

    /**
     * 【留学圈】提问问题
     * @param $params
     * @return bool
     */
    public function addQa($params){
        $qaModel = new Qa();
        $qaModel->setAttributes($params);
        return $qaModel->save();
    }

    /**
     * 【留学圈】回答问题
     * @param $params
     * @return bool
     */
    public function addAns($params){
        $qaModel = new QaAns();
        $qaModel->setAttributes($params);
        return $qaModel->save();
    }
}