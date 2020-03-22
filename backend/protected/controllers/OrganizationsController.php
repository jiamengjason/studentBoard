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

}