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
        $criteria->order = 't.id DESC';
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
}