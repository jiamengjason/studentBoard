<?php

class EvaluateScoreService
{

    /**
     * 根据uid查询评价平均值
     * @param $userId
     * @return string
     */
    public function findAvgScoreByUid($userId){
        $avgScore = '0.0';
        if (empty($userId)){
            return $avgScore;
        }

        //查询用户评价平均分
        $sql = "select evaluated_uid,avg(score) as score from sb_evaluate_score where evaluated_uid=".$userId. ' group by evaluated_uid';
        $evaluateScoreModel = new EvaluateScore();
        $data = $evaluateScoreModel->findBySql($sql);
        if ($data){
            $avgScore = round($data['score'], 1).'';
        }

        return $avgScore;
    }

    /**
     * 根据老师id查询相似的老师评价平均值
     * @param $userId
     * @param $avgScore
     * @param $limit
     * @return array
     */
    public function findSimilarTeacherByUid($userId, $avgScore, $limit=10){
        $teacherList = [];

        //查询用户评价平均分
        $sql = 'select * from ('.
            'select evaluated_uid,round(avg(score),1) as score from sb_evaluate_score where evaluated_uid !='.$userId.
            ' and evaluated_role_id = '.RoleGroupListConfig::$teacherRoleId.' group by evaluated_uid having score <= '.$avgScore.' limit '.$limit.
            ') as tmp order by tmp.score desc,tmp.evaluated_uid desc';
        $evaluateScoreModel = new EvaluateScore();
        $data = $evaluateScoreModel->findAllBySql($sql);
        if (!empty($data)){
            foreach ($data as $item){
                $teacherList[] = [
                    'teacher_id' => $item['evaluated_uid'],
                    'score' => $item['score']
                ];
            }
            //批量查询老师信息
            $where = 'id in ('.implode(',', array_column($teacherList, 'teacher_id')).')';
            $userService = new UsersService();
            $userList = $userService->getAllUsersByCondition($where, 'id,role_id,user_name,head_img');
            if (!empty($userList)){
                $userMap = [];
                foreach ($userList as $userItem){
                    $userMap[$userItem['id']] = $userItem;
                }
                foreach ($teacherList as $key=>$item){
                    $teacherList[$key]['role_id'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['role_id'] : '';
                    $teacherList[$key]['user_name'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['user_name'] : '';
                    $teacherList[$key]['head_img'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['head_img'] : '';
                }
            }
        }

        return $teacherList;
    }

    /**
     * 根据机构id查询名师团队
     * @param $userId
     * @param $limit
     * @return array
     */
    public function findTeacherListOfOrganizationByOid($userId, $limit=10){
        $teacherList = [];

        //查询机构下的老师按照评分排序
        $sql = 'select * from (
select 
	ANY_VALUE(e.evaluated_uid) evaluated_uid, ANY_VALUE(u.user_name) user_name, ANY_VALUE(head_img) head_img, round(avg(score),1) as score, count(e.id) enum
from sb_users u 
left join sb_evaluate_score e on u.id = e.evaluated_uid
where u.parent_id = '.$userId.'
group by e.evaluated_uid having score > 0 limit '.$limit.'
) as tmp
order by tmp.score desc,tmp.enum desc,tmp.evaluated_uid desc
';
        $evaluateScoreModel = new EvaluateScore();
        $data = $evaluateScoreModel->findAllBySql($sql);
        if (!empty($data)){
            foreach ($data as $item){
                $teacherList[] = [
                    'teacher_id' => $item['evaluated_uid'],
                    'score' => $item['score']
                ];
            }
            //批量查询老师信息
            $where = 'id in ('.implode(',', array_column($teacherList, 'teacher_id')).')';
            $userService = new UsersService();
            $userList = $userService->getAllUsersByCondition($where, 'id,role_id,user_name,head_img');
            if (!empty($userList)){
                $userMap = [];
                foreach ($userList as $userItem){
                    $userMap[$userItem['id']] = $userItem;
                }
                foreach ($teacherList as $key=>$item){
                    $teacherList[$key]['role_id'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['role_id'] : '';
                    $teacherList[$key]['user_name'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['user_name'] : '';
                    $teacherList[$key]['head_img'] = isset($userMap[$item['teacher_id']]) ? $userMap[$item['teacher_id']]['head_img'] : '';
                }
            }
        }

        return $teacherList;
    }

    /**
     * 获取全部评论
     * @param $params
     * @return array
     */
    public function findEvaluateScoreListById($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];

        $evaluateScoreModel = new EvaluateScore();
        $criteria = new CDbCriteria();
        $criteria->select = 't.id,t.evaluated_uid,t.user_id,t.score,t.give_like,t.give_dislike,t.comment,t.create_time';
        $criteria->order = 't.create_time desc,t.give_like desc';
        $criteria->condition = 't.evaluated_uid = ' . $params['teacherId'];
        $criteria->with = array ('users');
        $count = $evaluateScoreModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $pageSize;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $evaluateScoreModel->findAll($criteria);

        $data = [];
        foreach ($list as $item){
            $data[] = [
                'comment_id' => $item['id'],
                'user_id' => $item['user_id'],
                'user_name' => $item->users()->user_name,
                'head_img' => $item->users()->head_img,
                'score' => $item['score'],
                'give_like' => $item['give_like'],
                'give_dislike' => $item['give_dislike'],
                'create_time' => $item['create_time'],
                'comment' => $item['comment'],
            ];
        }

        return ['list'=>$data, 'total_num'=>$count, 'page_count'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'page_size'=>$pages->getPageSize()];
    }

    /**
     * 家长/学生提交评价
     * @param $params
     * @return bool
     */
    public function comment($params){
        if (empty($params)){
            return false;
        }

        $commentModel = new EvaluateScore();
        $commentModel->setAttributes($params);
        return $commentModel->save();
    }
}