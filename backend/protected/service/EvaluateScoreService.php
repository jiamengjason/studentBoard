<?php

class EvaluateScoreService
{

    /**
     * 根据老师id查询评价平均值
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
}