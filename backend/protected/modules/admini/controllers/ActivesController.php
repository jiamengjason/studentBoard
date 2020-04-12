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

        $activesService = new ActiveService();
        $result = $activesService->getActiveListByParams([]);

        $this->render('actives_index', array ('datalist' => $result['list'] , 'pagebar' => $result['page_bar']));
    }

    /**
     * 活动编辑
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdate ($id){
        parent::_acl(); 
        $model = parent::_dataLoad(new Active(), $id);
        
        if (isset($_POST['Active'])) {
            $model->attributes = $_POST['Active'];
            
            if ($model->save()) {
                $this->redirect(array ('index'));
            }
        }

        $this->render('actives_update', array ('model' => $model ));
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
                AdminLogger::_create(array ('catalog' => 'delete' , 'intro' => '删除活动,ID:' . $ids ));
                parent::_delete(new Active(), $ids, array('index'));
                break;
            default:
                throw new CHttpException(404, '错误的操作类型:' . $command);
                break;
        }
    }
}
