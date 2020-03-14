<?php

class SiteConfigController extends FInterfaceBase
{

    /**
     * 网站配置
     */
    public function actionIndex()
    {
        $config = [];

        //角色分组配置信息
        $config['roleList'] = $this->_roleGroupList;
        $config['seoTitle'] = $this->_seoTitle;
        $config['seoDesc'] = $this->_seoDescription;
        $config['seoKeywords'] = $this->_seoKeywords;
        $config['config'] = $this->_conf;

        $this->outputOk('', $config);
    }

    /**
     * 所有机构列表
     */
    public function actionGetOrganizationList(){
        $return = [];
        $organizationService = new OrganizationService();
        $organizationList = $organizationService->getAllOrganizationUsers();
        foreach ($organizationList as $item){
            $return[] = [
                'id' => $item->id,
                'organizationName' => $item->organization_name
            ];
        }

        $this->outputOk('', $return);
    }
}