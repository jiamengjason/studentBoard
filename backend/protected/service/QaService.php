<?php

class QaService
{

    /**
     * 问题列表
     * @param $params
     * @return array
     */
    public function getQaList($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;
        //limit
        $limitSql = ' limit '.$limit.','.$pageSize;
        $andWhere = isset($params['status_is']) ? ' and sb_qa.status_is = '.$params['status_is'] : '';

        $sql = 'select sb_qa.id as question_id,sb_qa.user_id ask_user_id,sb_qa.question,sb_qa.status_is,sb_qa.create_time,tmp.answer_id,tmp.ans,tmp.user_id ans_user_id,tmp.give_like,tmp.give_dislike,diff from (
		select 
		ANY_VALUE(id) as answer_id,ANY_VALUE(ans) ans,ANY_VALUE(user_id) user_id,question_id, ANY_VALUE(give_like) give_like, ANY_VALUE(give_dislike) give_dislike,
		max(give_like - give_dislike) as diff 
		from sb_qa_ans group by question_id '.$limitSql.'
) as tmp
right join sb_qa on sb_qa.id = tmp.question_id
where 1 '.$andWhere.$limitSql;
        $sqlCount = 'select count(id) c from sb_qa where 1 '.$andWhere;

        $dbHandel = Yii::app()->db;
        $qaList = $dbHandel->createCommand($sql)->queryAll();
        $countRs = $dbHandel->createCommand($sqlCount)->queryAll();

        $totalNum = 0;
        if (isset($countRs[0]['c'])){
            $totalNum = ceil($countRs[0]['c'] / $pageSize);
            $data['total_num'] = intval($countRs[0]['c']);
        }
        $list = [];
        foreach ($qaList as $item){
            $tmp = ['answer'=>[]];
            $tmp['question'] = [
                "question_id" => $item['question_id'],
                "ask_user_id" => $item['ask_user_id'],
                "question" => $item['question'],
                "status_is" => $item['status_is'],
                "create_time" => $item['create_time'],
            ];
            if (!empty($item['answer_id'])){
                $tmp['answer'] = [
                    "answer_id" => $item['answer_id'],
                    "ans" => $item['ans'],
                    "ans_user_id" => $item['ans_user_id'],
                    "give_like" => $item['give_like'],
                    "give_dislike" => $item['give_dislike'],
                    "diff" => $item['diff'],
                ];
            }
            $list[] = $tmp;
        }

        $data['page_count'] = intval($totalNum);
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $list;
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

    /**
     * 问题-点赞和踩
     * @param $answer_id
     * @param $type
     * @return bool
     */
    public function giveLikeToComment($answer_id, $type){
        $ansInfo = QaAns::model()->findByPk($answer_id);
        if (empty($ansInfo) || empty($ansInfo->getAttributes())){
            return false;
        }
        $params = [];
        if ($type == 'like'){
            $params['give_like'] = $ansInfo->getAttribute('give_like') + 1;
        }else {
            $params['give_dislike'] = $ansInfo->getAttribute('give_dislike') + 1;
        }
        return QaAns::model()->updateByPk($answer_id, $params);
    }

    /**
     * 问题详情
     * @param $question_id
     * @return bool
     */
    public function questionInfo($question_id){
        $qaModel = new Qa();
        $criteria = new CDbCriteria();
        $criteria->condition = 't.id = ' . $question_id;
        $criteria->with = array ('users');
        $qaInfo = $qaModel->find($criteria);


        if (empty($qaInfo) || empty($qaInfo->getAttributes())){
            return false;
        }

        $data = $qaInfo->getAttributes() + $qaInfo->users()->getAttributes();
        foreach ($data as $key=>$v){
            if ($key == 'id'){
                $data['question_id'] = $v;
            }elseif ($key == 'user_id'){
                $data['ask_user_id'] = $v;
                unset($data[$key]);
            }
            if ($v === null){
                unset($data[$key]);
            }
        }
        return $data;
    }

    /**
     * 问题详情
     * @param $params
     * @return bool
     */
    public function infoAnsList($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;
        //limit
        $limitSql = ' limit '.$limit.','.$pageSize;
        $andWhere = ' and a.question_id = '.$params['question_id'];

        $sql = 'select ANY_VALUE(a.id) as answer_id,ANY_VALUE(a.ans) ans, ANY_VALUE(a.user_id) ans_user_id,ANY_VALUE(a.question_id) question_id,
 ANY_VALUE(a.give_like) give_like, ANY_VALUE(a.give_dislike) give_dislike, max(give_like - give_dislike) as diff ,u.user_name,u.head_img
from sb_qa_ans a
left join sb_users u on a.user_id=u.id
 where 1 '.$andWhere.'
group by question_id,user_id '.$limitSql;
        $sqlCount = 'select count(id) c
from sb_qa_ans a
where 1 '.$andWhere.'
group by question_id,user_id';

        $dbHandel = Yii::app()->db;
        $ansList = $dbHandel->createCommand($sql)->queryAll();
        $countRs = $dbHandel->createCommand($sqlCount)->queryAll();

        $totalNum = 0;
        if (isset($countRs[0]['c'])){
            $totalNum = ceil($countRs[0]['c'] / $pageSize);
            $data['total_num'] = intval($countRs[0]['c']);
        }

        $data['page_count'] = intval($totalNum);
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $ansList;
        return $data;
    }
}