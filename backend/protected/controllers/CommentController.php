<?php
/**
 * 评论
 * Class TeachersController
 */
class CommentController extends FInterfaceBase
{
    /**
     * 评论-点赞和踩
     */
    public function actionDo(){
        $type = $this->_gets->getParam('type');
        $commentId = $this->_gets->getParam('comment_id');
        if (empty($type) || !in_array($type, ['like', 'dislike']) || empty($commentId)){
            $this->outputParamsError();
        }

        $evaService = new EvaluateScoreService();
        $data = $evaService->giveLikeToComment($commentId, $type);
        if (false === $data){
            $this->outputParamsError();
        }

        $this->outputOk('', $data);
    }

}