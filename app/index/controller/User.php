<?php
namespace app\index\controller;
use app\common\controller\Home;
use app\index\model\Sms;
class User extends Home
{
    public function _initialize()
    {
        parent::_initialize();
    }
	
	
	public function langcn()
    {
    	$_SESSION['langtemsetv']="zh-cn";
    }
	public function langen()
    {
    	$_SESSION['langtemsetv']="en-us";
    }
	
	
	
    public function logins()
    {
        if (request()->isAjax()) {
            $phone = input('param.phone', '', 'trim');
            $verify = input('param.verify/d');
            //验证短信验证码
            $mobile_code = db('mobile_code')->where(['account'=>$phone, 'event'=>'login'])->find();
            // if (!$mobile_code || $mobile_code['code']!=$verify) {
            //     return ['code'=>0, 'msg'=> '短信驗證碼錯誤'];
            // }
            // if ($mobile_code['expire_time'] < time()) {
            //     return ['code'=>0 , 'msg'=> '驗證碼已經過期,請重新獲取驗證碼!'];
            // }
            
            $id = db('member')->where(['phone'=>$phone])->value('id');
            cookie(['prefix' => 'frcw_']);
            cookie('uid', $id);
            return ['code'=>1, 'msg'=>'登錄成功', 'url'=>url('index/index/index')];
        
        }
    	return view();
    }

    public function register1()
    {
    	return view();
    }

    public function register2()
    {
    	if (request()->isAjax()) {
    		$phone = input('param.phone', '', 'trim');
    		$verify = input('param.verify/d');
			
			
			
			$result1 = db('member')->where(['phone'=>$phone])->find();
            if ($result1) {
				return ['code'=>0, 'msg'=> '該手機號已被註冊過了'];
			}
			
			
			
    		//验证短信验证码
    		$mobile_code = db('mobile_code')->where(['account'=>$phone, 'event'=>'register'])->find();
    		if (!$mobile_code || $mobile_code['code']!=$verify) {
    			return ['code'=>0, 'msg'=> '短信驗證碼錯誤'];
    		}
    		if ($mobile_code['expire_time'] < time()) {
            	return ['code'=>0 , 'msg'=> '驗證碼已經過期,請重新獲取驗證碼!'];
        	}
        	//验证交易密码
        	$trade_pwd = input('param.trade_pwd/d', '', 'trim');

        	$data['phone'] = $phone;
        	$data['trade_pwd'] = transfer_pwd($trade_pwd);
        	$data['ip'] = get_real_ip();
        	$data['reg_time'] = time();   
            $data['parent_id'] = input('param.parent_id', 0);     	
			/* //$d['z1']=1;
			//$d['z2']=1;
			$d['z3']=1;
			$id=db('ceshi')->insertGetId($d); */
		
        	$id = db('member')->insertGetId($data);
        	if ($id) {
				//$map['id']= $data['parent_id'];
				//db('member')->where($map)->setInc('tj_num');
				
				$encrypt = encrypt($phone, 'E', '^&*().');
				db('coin')->insert(['member_id'=>$id]);
        		//return ['code'=>1, 'msg'=> '註冊成功(注册送平台币，签到领取福利，可领28天)', 'url'=>'https://cw.pub/pouc'];
				return ['code'=>1, 'msg'=> '註冊成功(注册送平台币，签到领取福利，可领28天)', 'encrypt'=>$encrypt];
        	} else {
        		return ['code'=>0, 'msg'=> '註冊失敗'];
        	}
    	}
        $parent_id = input('param.id', 0);
        $this->assign('parent_id', $parent_id);
    	return view();
    }

    public function createVerify()
    {
        $config = [
			'length'   => 4,
			'useImgBg' => false,
			'fontSize' => 60,
			'codeSet'  => '0123456789',
            'useCurve' => false,
      	];
      $verify = new \think\captcha\Captcha($config);
      return $verify -> entry();
  	}

    public function checkVerify($code)
    {
        if (request()->isAjax()) {
            $code = input('param.code');
            if (captcha_check($code)) {
                return ['code'=>1, 'msg'=> '驗證碼正確'];
            } else {
                return ['code'=>0, 'msg'=> '驗證碼錯誤'];
            }
        }
    }

 	public function sendMobile()
 	{   header("Content-Type:text/html;charset=utf-8");
         $data = [
            'accessKeyId' => '',                 //your appid
             'accessKeySecret' => '',         //your app_secret
            'signName'    => '',                    //your 签名
             'templateCode' =>  '',         //your 模板编号
            'templatePara' =>  ''          //your 模板中的变量
         ];
        $sms = new Sms($data);     
  
        if (request()->isAjax()) {
            $phone = input('param.phone', '', 'trim');
            $type = input('param.type', '');
            $result1 = db('member')->where(['phone'=>$phone])->find();
            if ($type == 'login') {
                if (!$result1) {
                    return ['code'=>0, 'msg'=> '該賬號還沒有註冊, 請先註冊'];
                }
                $event = 'login';
            } else {
                if ($result1) {
                    return ['code'=>0, 'msg'=> '該手機號已被註冊過了'];
                }
                $event = 'register';
            }


            $number = 999999;
            $count = db('mobile_code')->where(['account'=>$phone,'event'=>$event])->value('count');
            if (empty($count)) {
                $count = 0;
            }
          	$arr = [
                'account'     => $phone ,
                'count'       => $count + 1 ,
                'send_time'   => time() ,
                'expire_time' => time() + 120 ,
                'code'        => $number ,
                'event'       => $event,
            ];
			if (empty($count)) {
                    db('mobile_code')->insert($arr);
                } else {
                    db('mobile_code')->where(['account'=>$phone,'event'=>$event])->update($arr);
                }
            $status = $sms->send_verify($phone, $number);


            
            if (1) {
                 return ['code'=>1, 'msg'=> '短信發送成功'];
            } else {
                return ['code'=>0, 'msg'=> '短信發送失敗'];
            }
        }
 	}
}