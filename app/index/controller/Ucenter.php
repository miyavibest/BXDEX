<?php
namespace app\index\controller;

class Ucenter extends Common
{
	public function security()
	{
		$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		
		$psigninfo = db('pinfosign')->where(['username'=>$phone, 'state'=>"3"])->order('id desc')->select();
		
		if($psigninfo){
			
			if($_SESSION['langtemsetv']=="zh-cn"){
				$this->assign('psigninfostr', "已认证");
			}else{
				$this->assign('psigninfostr', "Certified");
			}
		}else{
			$psigninfo1 = db('pinfosign')->where(['username'=>$phone, 'state'=>"1"])->order('id desc')->select();
			
			if($psigninfo1){
				
				if($_SESSION['langtemsetv']=="zh-cn"){
					$this->assign('psigninfostr', "审核中");
				}else{
					$this->assign('psigninfostr', "In audit");
				}
			}else{
				
				$psigninfo2 = db('pinfosign')->where(['username'=>$phone, 'state'=>"2"])->order('id desc')->select();
			
				if($psigninfo2){
					
					
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->assign('psigninfostr', "认证失败");
					}else{
						$this->assign('psigninfostr', "Authentication failed");
					}
				}else{
					
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->assign('psigninfostr', "未认证");
					}else{
						$this->assign('psigninfostr', "Uncertified");
					}
				}
				
			}
		}
		
		
		
		return view();
	}

	public function setPassword()
	{
		return view();
	}

	public function tradepwd()
	{
		return view();
	}

	public function setup()
	{
		$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		$this -> assign('phone', $phone);
		return view();
	}

	public function lang()
	{
		return view();
	}

	public function feedback()
	{
		if (request()->isAjax()) {
			$data['content'] = input('param.content');
			$data['thumb'] = input('param.thumb');
			$data['pub_time'] = time();
			$data['member_id'] = cookie('frcw_uid');
			$result = db('suggest')->insert($data);
			if ($result) {
				return ['code'=>1 , 'msg'=> '提交成功!', 'url'=>url('my/index')];
			} else {
				return ['code'=>0, 'msg'=> '提交失敗'];
			}
		}
		return view();
	}

	public function feedbackList()
	{
		$member_id = cookie('frcw_uid');
		$data = db('suggest')->where(['member_id'=>$member_id])->select();
		$this->assign('data', $data);
		return view();
	}

	public function feedbackInfo()
	{
		$id = input('param.id');
		$data = db('suggest')->find($id);
		$this->assign('data', $data);
		return view();
	}

	public function announcement()
	{
		$data = db('advert')->where(['open'=>1])->order('id desc')->select();
		$this->assign('data', $data);
		return view();
	}

	public function announcementInfo()
	{
		$id = input('param.id');
		$data = db('advert')->find($id);
		$this->assign('data', $data);
		return view();
	}

	public function about()
	{
		return view();
	}

	public function server()
	{
		return view();
	}

	public function agreement()
	{
		return view();
	}

	public function checkPwd()
	{
		if (request()->isAjax()) {
			$str1 = input('param.str1/d');
			$str2 = input('param.str2/d');
			$num1 = strlen($str1);
			$num2 = strlen($str2);
			if ($num1 != 6 || $num2 != 6) {
				return ['code'=>0, 'msg'=>'密碼格式錯誤', 'url'=>url('tradepwd')];
			}
			if ($str1 !== $str2) {
				return ['code'=>1, 'msg'=>'兩次密碼不壹致', 'url'=>url('tradepwd')];
			}
			$data['trade_pwd'] = transfer_pwd($str2);
			$data['id'] = cookie('frcw_uid');
			$result = db('member')->update($data);
			if ($result !== false) {
				return ['code'=>1, 'msg'=>'密碼修改成功', 'url'=>url('my/index')];
			} else {
				return ['code'=>0, 'msg'=>'密碼修改失敗', 'url'=>url('tradepwd')];
			}
		}
	}

	public function checkTradepwd()
	{
		if (request()->isAjax()) {
			$trade_pwd = input('param.trade_pwd');
			$trade_pwd = transfer_pwd($trade_pwd);
			$old_pwd = db('member')->where(['id'=>cookie('frcw_uid')])->value('trade_pwd');
			$phone   = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
			$encrypt = encrypt($phone, 'E', '^&*().');
			if ($trade_pwd == $old_pwd) {
				return ['code'=>1, 'msg'=>'密碼正確', 'encrypt'=>$encrypt];
			} else {
				return ['code'=>0, 'msg'=>'密碼錯誤', 'url'=>url('security')];
			}
		}
	}

	public function checkEncrypt()
	{
		if (request()->isAjax()) {
			$encrypt = input('param.encrypt');
			$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
			if (encrypt($encrypt, 'D', '^&*().') == $phone) {
				return ['code'=>1, 'msg'=>'私鑰正確', 'url'=>url('tradepwd')];
			} else {
				return ['code'=>0, 'msg'=>'私鑰錯誤'];
			}
		}
	}

	public function logout()
	{
		if (request()->isAjax()) {
			$type = input('param.type');
			if ($type == 'logout') {
				cookie('frcw_uid', null);
				return ['code'=>1, 'msg'=>'退出成功', 'url'=>url('index/index')];
			} else {
				return ['code'=>0, 'msg'=>'退出失敗'];
			}
		}
	}
}