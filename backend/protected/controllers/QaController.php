<?php
/**
 * 留学圈
 */

class QaController extends FInterfaceBase
{
    /**
     * 【留学圈】全部问题
     */
    public function actionList() {
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['page'] = $this->_gets->getParam('page');
        $qaService = new QaService();
        $data = $qaService->getQaList($params);
        $this->outputOk('', $data);
    }

    /**
     * 【留学圈】热门问题
     */
    public function actionHot() {
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['page'] = $this->_gets->getParam('page');
        $params['status_is'] = 2;   //热门问题
        $qaService = new QaService();
        $data = $qaService->getQaList($params);
        $this->outputOk('', $data);
    }

    /**
     * 【留学圈】回答问题的点赞和踩
     */
    public function actionDo(){
        $type = $this->_gets->getParam('type');
        $answer_id = $this->_gets->getParam('answer_id');
        if (empty($type) || !in_array($type, ['like', 'dislike']) || empty($answer_id)){
            $this->outputParamsError();
        }

        $qaService = new QaService();
        $data = $qaService->giveLikeToComment($answer_id, $type);
        if (false === $data){
            $this->outputParamsError();
        }

        $this->outputOk('', $data);
    }
}
