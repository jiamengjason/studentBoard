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
	ANY_VALUE(e.evaluated_uid) evaluated_uid, ANY_VALUE(u.user_name) user_name, ANY_VALUE(head_img) head_img, round(avg(score),1) as score, count(e.id) e_num
from sb_users u 
left join sb_evaluate_score e on u.id = e.evaluated_uid
where u.parent_id = '.$userId.'
group by e.evaluated_uid having score > 0 limit '.$limit.'
) as tmp
order by tmp.score desc,tmp.e_num desc,tmp.evaluated_uid desc
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
        $criteria->condition = 't.evaluated_uid = ' . $params['evaluated_uid'];
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
                'role_id' => $item->users()->role_id,
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

    /**
     * 查询机构列表
     * @param $params
     * @return array
     */
    public function getCommentListByParams($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;
        $userId = $params['user_id'];

        $where = 'e.user_id = '.$userId;
        $limitSql = 'limit '.$limit.','.$pageSize;

        $sqlCount = 'select count(e.id) c from sb_evaluate_score e where '.$where;
        $sql = 'select e.*,u.parent_id,u.role_id,u.user_name,u.head_img,u.organization_name,u.organization_desc,u.organization_yewu,u.organization_email
from sb_evaluate_score e
left join sb_users u on e.evaluated_uid = u.id
where '.$where.' order by e.create_time desc '.$limitSql;

        $dbHandel = Yii::app()->db;
        $commentList = $dbHandel->createCommand($sql)->queryAll();
        $countRs = $dbHandel->createCommand($sqlCount)->queryAll();
        $totalNum = 0;
        if (isset($countRs[0]['c'])){
            $totalNum = ceil($countRs[0]['c'] / $pageSize);
            $data['total_num'] = intval($countRs[0]['c']);
        }
        //获取老师对应的机构
        $orgIds = [];
        $organizationList = [];
        foreach ($commentList as $item){
            if ($item['parent_id'] && $item['role_id'] == RoleGroupListConfig::$teacherRoleId){
                $orgIds[] = $item['parent_id'];
            }
        }
        if (!empty($orgIds)){
            $orgIds = array_unique($orgIds);
            $usersService = new UsersService();
            $organizationList = $usersService->getOrganizationInfoByIds($orgIds);
            foreach ($organizationList as $item){
                $tmp[] = $item->getAttributes();
            }
            $organizationList = array_column($tmp, null, 'id');
        }

        //返回数据
        $rs = [];
        foreach ($commentList as $item){
            $tmp = [
                'evaluated_uid' => $item[''],
                'user_id' => $item['user_id'],
                'score' => $item['score'],
                'role_id' => $item['role_id'],
                'is_recommend' => $item['is_recommend'],
                'tags' => $item['tags'],
                'comment' => $item['comment'],
                'give_like' => $item['give_like'],
                'give_dislike' => $item['give_dislike'],
                'comment_time' => $item['create_time'],
                'head_img' => $item['head_img'],
            ];
            //评价的机构
            if ($item['role_id'] == RoleGroupListConfig::$organizationRoleId){
                $tmp['organization_name'] = $item['organization_name'];
                $tmp['organization_desc'] = $item['organization_desc'];
                $tmp['organization_yewu'] = $item['organization_yewu'];
                $tmp['organization_email'] = $item['organization_email'];
            }else {
                //评价的老师
                $tmp['teacher_name'] = $item['user_name'];
                if (isset($organizationList[$item['parent_id']])){
                    $tmp['organization_name'] = $organizationList[$item['parent_id']]['organization_name'];
                }
            }

            $rs[] = $tmp;
        }

        $data['page_count'] = intval($totalNum);
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $rs;
        return $data;
    }
}