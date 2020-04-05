<?php

class ActiveController extends FInterfaceBase
{

    /**
     * 【课外活动】
     */
    public function actionIndex()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['title'] = $this->_gets->getParam('title');
        $params['type'] = $this->_gets->getParam('type');   //0默认1预告2进行中3已结束

        $activeService = new ActiveService();
        $data = $activeService->getActiveListByParams($params);

        $this->outputOk('', $data);
    }

    /**
     * 【课外活动】活动详情
     */
    public function actionDetail()
    {
        $id = $this->_gets->getParam('active_id');
        $userId = $this->_gets->getParam('userId');
        $token = $this->_gets->getParam('token');
        $loginUserId = false;

        //验证token是否失效
        if (!empty($userId) && !empty($token)){
            $tokenService = new TokenService();
            if (true == $tokenService->tokenIsEffective($userId, $token)){
                $loginUserId = $userId;
            }
        }

        //活动详情
        $activeService = new ActiveService();
        $data = $activeService->getActiveInfoById($id, $loginUserId);

        $this->outputOk('', $data);
    }
}