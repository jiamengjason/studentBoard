<?php
/**
 * 课外活动
 */
class ActivesController extends XAdminiBase
{
    protected $group_list;
    
    /**
     * 活动列表
     */
    public function actionIndex ()
    {
        parent::_acl();

        //查询家长列表
        $usersService = new UsersService();
        $result = $usersService->adminGetUsersPageList(RoleGroupListConfig::$parentRoleId);

        $gradeList = CommonEnums::getGradeIdList();

        $this->render('parent_index', array ('datalist' => $result['list'] , 'pagebar' => $result['pages'], 'gradeList'=>$gradeList));
    }

    /**
     * 家长编辑
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdate ($id){
        parent::_acl(); 
        $model = parent::_dataLoad(new Users(), $id);
        
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            
            if ($model->save()) {
                AdminLogger::_create(array ('catalog' => 'update' , 'intro' => '更新家长资料:' . $model->user_name ));
                $this->redirect(array ('index'));
            }
        }
        $model->gradeIdList = CommonEnums::getGradeIdList();

        $this->render('parent_update', array ('model' => $model ));
    }

    /**
     * 批量操作
     *
     */
    public function actionBatch (){
        if (XUtils::method() == 'GET') {
            $command = trim($_GET['command']);
            $ids = intval($_GET['id']);
        } elseif (XUtils::method() == 'POST') {
            $command = trim($_POST['command']);
            $ids = $this->_gets->getPost('id');
            is_array($ids) && $ids = implode(',', $ids);
        } else {
            XUtils::message('errorBack', '只支持POST,GET数据');
        }
        empty($ids) && XUtils::message('error', '未选择记录');

        switch ($command) {
            case 'delete':
                parent::_acl('admin_delete');
                AdminLogger::_create(array ('catalog' => 'delete' , 'intro' => '删除家长,ID:' . $ids ));
                parent::_delete(new Users(), $ids, array('index'));
                break;
            default:
                throw new CHttpException(404, '错误的操作类型:' . $command);
                break;
        }
    }
}
