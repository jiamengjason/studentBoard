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
        $config['role_list'] = $this->_roleGroupList;
        $config['seo_title'] = $this->_seoTitle;
        $config['seo_desc'] = $this->_seoDescription;
        $config['seo_keywords'] = $this->_seoKeywords;
//        $config['config'] = $this->_conf;
        $config['grade_list'] = $this->_gradeList;
        $config['score_list'] = $this->_scoreList;
        $config['tags'] = RoleGroupListConfig::getTagsList();
        $config['teacher_course'] = RoleGroupListConfig::getTeacherCourse();
        $config['organization_yewu'] = RoleGroupListConfig::getOrganizationYewu();

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
                'value' => $item->id,
                'label' => $item->organization_name
            ];
        }

        $this->outputOk('', $return);
    }

    /**
     * 【人机交互】获取人机交互随机背景图片地址
     */
    public function actionCaptcha(){
        $commonService = new CommonService();
        $captcha = $commonService->getCaptchaImage();
        echo $captcha;
        exit;
    }
}