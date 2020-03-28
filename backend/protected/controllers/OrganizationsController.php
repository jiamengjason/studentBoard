<?php

class OrganizationsController extends FSessionInterfaceBase
{

    /**
     * 【个人中心】【机构】发布活动
     */
    public function actionPublish()
    {
        $active = [];
        if (empty($this->_gets->getParam('title_img'))){
            $this->outputParamsError('请上传活动图片');
        }
        if (empty($this->_gets->getParam('title'))){
            $this->outputParamsError('请填写活动标题');
        }
        if (empty($this->_gets->getParam('start_time'))){
            $this->outputParamsError('请填写活动开始时间');
        }
        if (empty($this->_gets->getParam('end_time'))){
            $this->outputParamsError('请填写活动结束时间');
        }
        if (empty($this->_gets->getParam('desc'))){
            $this->outputParamsError('请填写活动简介');
        }
        if (empty($this->_gets->getParam('addr'))){
            $this->outputParamsError('请填写活动地址');
        }
        $active['title_img'] = $this->_gets->getParam('title_img');
        $active['title'] = $this->_gets->getParam('title');
        $active['start_time'] = $this->_gets->getParam('start_time');
        $active['end_time'] = $this->_gets->getParam('end_time');
        $active['desc'] = $this->_gets->getParam('desc');
        $active['addr'] = $this->_gets->getParam('addr');

        //查询用户信息
        $organizationService = new OrganizationService();
        $bool = $organizationService->publishActive($this->userInfo, $active);

        if (true === $bool){
            $this->outputOk();
        }else {
            $this->outputError($bool);
        }
    }


    /**
     * 【个人中心】【机构】活动列表
     */
    public function actionIndex()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['pageSize'] = $this->_gets->getParam('pageSize');
        $params['user_id'] = $this->userId;

        //查询用户信息
        $activeService = new ActiveService();
        $rs = $activeService->getActiveListByParams($params);

        $this->outputOk('', $rs);
    }

    /**
     * 【个人中心】【学生-家长】参加的活动列表
     */
    public function actionMyActive()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['pageSize'] = $this->_gets->getParam('pageSize');
        $params['user_id'] = $this->userId;

        //查询用户信息
        $activeService = new ActiveService();
        $rs = $activeService->getMyActiveList($params);

        $this->outputOk('', $rs);
    }
}