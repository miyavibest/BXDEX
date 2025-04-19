<?php
namespace app\index\controller;
use app\common\controller\Home;

class Common extends Home
{
	public function _initialize()
	{
		parent::_initialize();
		//网址状态
		$website_status = db('system')->where(['id'=>1])->value('open');
		if ($website_status == 1) {
			header("Location: 403.html");
        }
        //登录状态
        if (!cookie('frcw_uid')) {
            $this->redirect('index/User/logins');
        }

    	$user = db('member')->find(cookie('frcw_id'));
    	if (!$user || $user['open']==0) {
    		cookie('frcw_id', null);
    		$this->redirect('index/User/logins');
    	}
	}

    public function upload()
    {
        // 获取上传文件表单字段名
        $fileKey = array_keys(request()->file());
        // 获取表单上传文件
        $file = request()->file($fileKey['0']);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $result['code'] = 1;
            $result['info'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $result['url'] = '/uploads/'. $path;
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] =0;
            $result['info'] = '图片上传失败!';
            $result['url'] = '';
            return $result;
        }
    }
	
	public function view()
    {
        
    }
}