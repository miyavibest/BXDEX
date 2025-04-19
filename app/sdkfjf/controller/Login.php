<?php
namespace app\sdkfjf\controller;
use think\Controller;
use app\sdkfjf\model\Admin;

class Login extends Controller
{
    private $cache_model,$system;

    public function _initialize()
    {
        if (session('aid')) {
            $this->redirect('index/index');
        }
    }

    /**
     * 登录
     */
    public function index()
    {
        if(request()->isPost()) {
            $admin = new Admin();
            $data = input('post.');
            if(!$this->check($data['captcha'])){
                return json(array('code' => 0, 'msg' => '验证码错误'));
            }
            $num = $admin->login($data);
            if($num == 1){
                return json(['code' => 1, 'msg' => '登录成功!', 'url' => url('index/index')]);
            }else {
                return json(array('code' => 0, 'msg' => '用户名或者密码错误，重新输入!'));
            }
        }

        /*dump(config('lang_list'));
        die;*/
        return $this->fetch();
    }

    /**
     * 创建验证码
     */
    public function createVerify()
    {
        $config = [
          'length'   => 4,
          'useImgBg' => false,
          'fontSize' => 40,
      ];
      $verify = new \think\captcha\Captcha($config);
      return $verify -> entry();
  }

    /**
     * 验证验证码
     */
    public function check($code)
    {
     return captcha_check($code);
 }
}