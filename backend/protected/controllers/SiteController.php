<?php
/**
 * 首页控制器
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class SiteController extends FInterfaceBase
{
    /**
     * 首页
     */
    public function actionIndex ()
    {
        //机构
        $organizationService = new OrganizationService();
        $organizationList = $organizationService->getOrganizationListByParams([
            'page' => 1,
            'page_size' => 4,
            'is_command' => 1
        ]);
        $organizationList = $organizationList['list'];

        //教师
        $teacherService = new TeachersService();
        $teacherList = $teacherService->getTeachersListByParams([
            'page' => 1,
            'page_size' => 4,
            'is_command' => 1
        ]);
        $teacherList = $teacherList['list'];
        //查询明星评价
        $evaluateScoreService = new EvaluateScoreService();
        foreach ($teacherList as $key=>$item){
            $params['evaluated_uid'] = $item['user_id'];
            $comment = $evaluateScoreService->getStartCommentList($params);
            $teacherList[$key]['comment'] = $comment ? $comment['comment'] : '';
        }

        //活动
        $activeService = new ActiveService();
        $activeList = $activeService->getActiveListByParams([
            'page' => 1,
            'page_size' => 2,
            'is_command' => 1
        ]);
        $activeList = $activeList['list'];

        //返回数据
        $data = [
            'organization_list' => $organizationList,
            'teacher_list' => $teacherList,
            'active_list' => $activeList
        ];
        $this->outputOk('', $data);
    }

    /**
     * 搜索页面
     */
    public function actionSearch(){
        $params['role_id'] = $this->_gets->getParam('role_id');
        $params['name'] = $this->_gets->getParam('name');
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['page'] = $this->_gets->getParam('page');
        $params['teacher_course'] = $this->_gets->getParam('teacher_course');
        $params['organization_yewu'] = $this->_gets->getParam('organization_yewu');

        $userService = new UsersService();
        $data = $userService->searchByParams($params);

        $this->outputOk('', $data);
    }
}