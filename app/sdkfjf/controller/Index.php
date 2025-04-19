<?php
namespace app\sdkfjf\controller;
use think\Controller;
use think\Db;
use think\Input;

class Index extends Common
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index()
    {
        //导航
        $authRule = cache('authRule');
        if(!$authRule){
            $authRule = db('auth_rule')->where('menustatus=1')->order('sort')->select();
            cache('authRule', $authRule, 3600);
       }
        //声明数组
        $menus = array();
        foreach ($authRule as $key=>$val){
            $authRule[$key]['href'] = url($val['href']);
            if($val['pid']==0){
                if(session('aid')!=1){
                    if(in_array($val['id'],$this->adminRules)){
                        $menus[] = $val;
                    }
                }else{
                    $menus[] = $val;
                }
            }
        }
        foreach ($menus as $k=>$v){
            foreach ($authRule as $kk=>$vv){
                if($v['id']==$vv['pid']){
                    if(session('aid')!=1) {
                        if (in_array($vv['id'], $this->adminRules)) {
                            $menus[$k]['children'][] = $vv;
                        }
                    }else{
                        $menus[$k]['children'][] = $vv;
                    }
                }
            }
        }
        $this->assign('menus', $menus);
        return $this->fetch();
    }
    public function main(){
        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'http_host'       => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => get_real_ip(),
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'], //运行环境
            // 'server_time'     => date('Y-m-d H:i:s'),
            'server_time'     => time(),
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize'),//上传附件限制
            'max_execution_time' => ini_get('max_execution_time'),//执行时间限制
            'php_sapi_name'   => php_sapi_name(),
            'http_user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        $this->assign('config', $config);
        return $this->fetch();
    }
    public function getServerTime()
    {
        if (request()->isAjax()) {
            return ['code'=>1, 'time'=>date('Y-m-d H:i:s')];
        }
    }

    public function navbar()
    {
        return $this->fetch();
    }

    public function nav()
    {
        return $this->fetch();
    }

    /**
     * 清除缓存
     */
    public function clear()
    {
        if (request()->isAjax()) {
            $R = RUNTIME_PATH;
            if (_rmdir($R)) {
                $result['info'] = '清除缓存成功!';
                $result['code'] = 1;
            } else {
                $result['info'] = '清除缓存失败!';
                $result['code'] = 0;
            }
            $result['url'] = url('sdkfjf/index/index');
            return $result;
        }

    }



    //退出登陆
    public function logout()
    {
        session('aid', null);
        session('username', null);
        $this->redirect('login/index');
    }
}
