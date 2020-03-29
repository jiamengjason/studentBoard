<?php

class ActiveService
{
    /**
     * 查询机构下的活动列表
     * @param $params
     * @return array
     */
    public function getActiveListByParams($params){
        $userId = $params['user_id'];
        $pageSize = !isset($params['pageSize']) ? CommonEnums::$pageSizeOfAdmin : $params['pageSize'];

        $activeModel = new Active();
        $criteria = new CDbCriteria();
        $criteria->order = 't.end_time DESC';
        $criteria->condition = 'user_id = ' . $userId. ' and status_is = 1';
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

        return ['list'=>$data, 'pageCount'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'pageSize'=>$pages->getPageSize()];
    }

    /**
     * 【个人中心】【学生-家长】参加的活动列表
     * @param $params
     * @return array
     */
    public function getMyActiveList($params){
        $userId = $params['user_id'];
        $pageSize = !isset($params['pageSize']) ? CommonEnums::$pageSizeOfAdmin : $params['pageSize'];

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

        return ['list'=>$data, 'pageCount'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'pageSize'=>$pages->getPageSize()];
    }
}