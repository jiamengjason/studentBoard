<?php
/**
 * 教师管理
 */
class TeacherController extends XAdminiBase
{
    protected $group_list;
    
    /**
     * 教师
     */
    public function actionIndex ()
    {
        parent::_acl();

        //查询教师列表
        $usersService = new UsersService();
        $result = $usersService->adminGetUsersPageList(RoleGroupListConfig::$teacherRoleId);

        //查询对应机构信息
        $organizationList = [];
        $parentIds = array_column($result['list'], 'parent_id');
        if (!empty($parentIds)){
            $where = 'id in ('.implode(',', $parentIds).')';
            $select = 'id,organization_name';
            $organizationList = $usersService->getAllUsersByCondition($where, $select);
            $organizationList = array_column($organizationList, 'organization_name', 'id');
        }

        $this->render('teacher_index', array ('datalist' => $result['list'] , 'pagebar' => $result['pages'], 'organizationList' => $organizationList));
    }

    /**
     * 教师录入
     *
     */
    public function actionCreate ()
    {
        parent::_acl(); 
        $model = new Users('create');
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->setAttribute('role_id', RoleGroupListConfig::$teacherRoleId);
            $model->setAttribute('password', md5($_POST['Users']['password']));
            $model->setAttribute('create_time', CommonEnums::getNowDateTime());
            $id = $model->save();
            if ($id) {
                AdminLogger::_create(array ('catalog' => 'create' , 'intro' => '录入教师:' . $model->user_name));
                $this->redirect(array ('index'));
            }
        }
        //获取机构列表
        $organizationService = new OrganizationService();
        $model->organizationList = $organizationService->getAllOrganizationUsers();

        $this->render('teacher_create', array ('model' => $model ));
    }

    /**
     * 教师编辑
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdate ($id){
        parent::_acl(); 
        $model = parent::_dataLoad(new Users(), $id);
        
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            
            if ($model->save()) {
                AdminLogger::_create(array ('catalog' => 'update' , 'intro' => '更新教师资料:' . $model->user_name ));
                $this->redirect(array ('index'));
            }
        }
        //获取教师列表
        $organizationService = new OrganizationService();
        $model->organizationList = $organizationService->getAllOrganizationUsers();

        $this->render('teacher_update', array ('model' => $model ));
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
                AdminLogger::_create(array ('catalog' => 'delete' , 'intro' => '删除教师,ID:' . $ids ));
                parent::_delete(new Users(), $ids, array('index'));
                break;
            default:
                throw new CHttpException(404, '错误的操作类型:' . $command);
                break;
        }
    }
}
