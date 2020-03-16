<?php

class UploadFileController extends FInterfaceBase
{

    /**
     * 网站配置
     */
    public function actionIndex()
    {
        if (XUtils::method() != 'POST'){
            $this->outputError('请求错误');
        }

        $file = XUpload::upload($_FILES['file']);
        if (!is_array($file)){
            $this->outputError('上传文件错误');
        }

        //保存上传文件的记录
        $model = new Upload();
        $model->user_id = 0;
        $model->file_name = $file['pathname'];
        $model->thumb_name = $file['paththumbname'];
        $model->real_name = $file['name'];
        $model->file_ext = $file['extension'];
        $model->file_mime = $file['type'];
        $model->file_size = $file['size'];
        $model->save_path = $file['savepath'];
        $model->hash = $file['hash'];
        $model->save_name = $file['savename'];
        $model->create_time = time();
        if ( !$model->save() ) {
            @unlink( $file['pathname'] );
            $this->outputError('文件上传错误');
        }

        $fileInfo = [
            'doc_path'=>$file['savepath'],
            'file_path'=>$file['pathname'],
            'file_ext' =>$file['extension'],
            'file_name'=>$file['savename'],
            'file_size'=>$file['size']
        ];

        $this->outputOk('', $fileInfo);
    }
}