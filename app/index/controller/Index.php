<?php
namespace app\index\controller;


class Index extends Common
{
	
	public function langcn()
    {
    	$_SESSION['langtemsetv']="zh-cn";
    }
	public function langen()
    {
    	$_SESSION['langtemsetv']="en-us";
    }
	
    public function index()
    {
		$op=controller('Openamount');
		$op->lianghuashenghe();
    	// 读取FRCW的相关数据
    	$this->selectDogx();
        //读取当前用户的币
    	$data_coin = $this->getPrice();
        $this->assign('data_coin', $data_coin['data_coin']);
        $this->assign('total_price', $data_coin['total_price']);
    	$this->assign('level', $data_coin['level']);
      
		$mydatalisti = db('member')->where(['id'=>cookie('frcw_uid')])->find();
		$this->assign('level2', $mydatalisti['level2']);
	  
	  
        //FRCW币
        $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $frcw_num = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value('frcw');
        if ($cur) {
            $cur_price = $cur['price'] * $frcw_num;
        } else {
            $cur_price = 0;
        }
        
        $this->assign('frcw_num', $frcw_num);
        $this->assign('cur_price', $cur_price);
		
         if($_SESSION['langtemsetv']=="zh-cn"){
			   $map['type']=1; 
		   }else{
			    $map['type']=1;			
		   }
		$list = db('lunbo')->where($map)->select();
		$this->assign('list',$list);
		
    	$nav = input('param.nav', 1);
    	$this->assign('nav', $nav);
    	$this->assign('type', 1);
    	$this->assign('status', 2);
    	return view();
    }

    public function duihuan()
	{
	   $a=$this->getUsdt('ltc')['ticker']['last'];	
	   var_dump($a);die;
	}

    protected function selectDogx()
    {
		//14
        $list = db('frcw')->order('pub_time desc')->limit(1,7)->select();
        krsort($list);
        foreach($list as $key => $vo){
            $date_str[] = date('m-d', $vo['pub_time']);
            $price[] = $vo['price'];
        }
        $this->assign('date_str', json_encode($date_str));
        $this->assign('price', json_encode($price));



        $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $yes = db('frcw')->order('pub_time desc')->limit(1,1)->select();
        $price_plus = $cur['price'] - $yes[0]['price'];
        $price_rate = ($price_plus / $yes[0]['price']) * 100;

        $this->assign('price_cur', sprintf4($cur['price']));
        $this->assign('price_plus', sprintf4($price_plus));
        $this->assign('price_rate', $price_rate);
    }



    public function lang()
    {
    	header("Content-Type:text/html;charset=utf-8");
    	if (request()->isAjax()) {
			$lang = input('param.lang');
			cookie('think_var', '');
			switch ($lang) {
				case 'cn':
					cookie('think_var', 'zh-cn');
					break;
				case 'en':
					cookie('think_var', 'en-us');
					break;
				default:
					cookie('think_var', 'zh-cn');
			}
		}
    }
	
	
	
	
	
	public function fuli28()
    {
		
		$reg_time = db('member')->where(['id'=>cookie('frcw_uid')])->value('reg_time');
		$reg_time = date("Y-m-d 00:00:00",$reg_time);
		$reg_time = strtotime($reg_time);
		
		if(($reg_time+28*60*60*24) < time()){
			if($_SESSION['langtemsetv']=="zh-cn"){
				$this->assign('signtdayedstr', "仅可领28天！");
				$this->assign('signtdayedstr2', "仅可领28天！");
			}else{
				$this->assign('signtdayedstr', "Only 28 days!");
				$this->assign('signtdayedstr2', "Only 28 days!");
			}
			
			$days_remainingv = 0;
		}else{
			if($_SESSION['langtemsetv']=="zh-cn"){
				$this->assign('signtdayedstr', "今日已签到！");
				$this->assign('signtdayedstr2', "签到");
			}else{
				$this->assign('signtdayedstr', "Signed in today!");
				$this->assign('signtdayedstr2', "Sign in");
			}
			
			$days_remainingv = ceil((($reg_time+28*60*60*24)-time())/60/60/24);
		}
		
		
		

		
		
    	$cset1 = db('config2')->where(['id'=>1])->value('set1');
		$this->assign('cset1', $cset1);
		
		//读取记录
		$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		$record = db('coin_record')->where(['phone'=>$phone, 'coin'=>"frcw", 'type'=>"签到福利"])->order('add_time desc')->select();
		$this->assign('record', $record);
		
		$dtimev = date("Y-m-d 00:00:00",time());
		$dtimevc = strtotime($dtimev)-1;
		
		$signtdayeddata = db('coin_record')->where(['phone'=>$phone, 'coin'=>"frcw", 'type'=>"签到福利", 'add_time'=>['GT',$dtimevc]])->order('add_time desc')->select();
		
		if($signtdayeddata){
			$this->assign('signtdayed', "ed");
			
			$days_remainingv=$days_remainingv-1;
		}else{
			$this->assign('signtdayed', "none");
		}
		
		
		
		if($_SESSION['langtemsetv']=="zh-cn"){
			$this->assign('days_remaining', "（剩余".$days_remainingv."天）");
		}else{
			$this->assign('days_remaining', "（The remaining".$days_remainingv."days）");
		}
		
		
		
    	return view();
    }
	
	
	
	public function fulido28()
    {
		
		$timevc = time();
		
		$reg_time = db('member')->where(['id'=>cookie('frcw_uid')])->value('reg_time');
		$reg_time = date("Y-m-d 00:00:00",$reg_time);
		$reg_time = strtotime($reg_time);
		
		if(($reg_time+28*60*60*24) < $timevc){
			exit("28g");
		}
		
		$cset1 = db('config2')->where(['id'=>1])->value('set1');
		$cset4 = db('config2')->where(['id'=>1])->value('set4');
		
    	$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		
		
		
		$psigninfo = db('pinfosign')->where(['username'=>$phone, 'state'=>"3"])->order('id desc')->select();
		
		if($psigninfo){

		}else{
			exit("psignnone");
		}
		
		
		
		
		
		
		$num=number_format($cset1/28 , 4);
		
		$dtimev = date("Y-m-d 00:00:00",$timevc);
		$dtimevc = strtotime($dtimev)-1;
		
		$signtdayeddata = db('coin_record')->where(['phone'=>$phone, 'coin'=>"frcw", 'type'=>"签到福利", 'add_time'=>['GT',$dtimevc]])->order('add_time desc')->select();
		
		if($signtdayeddata){
			exit("ed");
		}else{
			
			db('coin_record')->insert([
            'phone' => $phone,
            'coin' => 'frcw',
            'num' => $num,
            'type' => '签到福利',
            'inout' => 'in',
            'add_time'=>$timevc
            ]);
			
			
			
			
			$coincsed = db('coin')->where(['member_id'=>cookie('frcw_uid')])->find();
            if ($coincsed) {
                
            } else {
                db('coin')->insert(['member_id'=>cookie('frcw_uid')]);
            }
			
			db('coin')->where(['member_id'=>cookie('frcw_uid')])->setInc('frcw',$num);
			
			
			if($cset4>0){
				$meinfoc = db('member')->where('id',cookie('frcw_uid'))->field('id,parent_id')->find();
				$parentinfoc = db('member')->where('id',$meinfoc['parent_id'])->field('id,phone')->find();
				if($parentinfoc){
					db('coin_record')->insert([
					'phone' => $parentinfoc['phone'],
					'coin' => 'frcw',
					'num' => $cset4,
					'type' => '下级签到返利',
					'inout' => 'in',
					'add_time'=>$timevc
					]);
					
					
					$coincsed2 = db('coin')->where(['member_id'=>$parentinfoc['id']])->find();
					if ($coincsed2) {
						
					} else {
						db('coin')->insert(['member_id'=>$parentinfoc['id']]);
					}
					
					
					db('coin')->where(['member_id'=>$parentinfoc['id']])->setInc('frcw',$cset4);
				}
			}
			
			
			exit("ss");
		}
    }
	
	
	
	
	
	
	public function pinfosign()
    {
		$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		
		$psigninfo = db('pinfosign')->where(['username'=>$phone, 'state'=>"3"])->order('id desc')->select();
		
		if($psigninfo){
			
			
			if($_SESSION['langtemsetv']=="zh-cn"){
				echo "<script>alert('已认证');history.go(-1)</script>";
			}else{
				echo "<script>alert('Certified！');history.go(-1)</script>";
			}
			exit();
			if($_SESSION['langtemsetv']=="zh-cn"){
				$this->assign('psigninfostr', "已认证");
			}else{
				$this->assign('psigninfostr', "Certified！");
			}
				
				
			
		}else{
			$psigninfo1 = db('pinfosign')->where(['username'=>$phone, 'state'=>"1"])->order('id desc')->select();
			
			if($psigninfo1){
				
				if($_SESSION['langtemsetv']=="zh-cn"){
					echo "<script>alert('认证审核中');history.go(-1)</script>";
				}else{
					echo "<script>alert('Certification audit!');history.go(-1)</script>";
				}
				exit();
				
				
				if($_SESSION['langtemsetv']=="zh-cn"){
					$this->assign('psigninfostr', "审核中");
				}else{
					$this->assign('psigninfostr', "In audit！");
				}
			}else{
				
				$psigninfo2 = db('pinfosign')->where(['username'=>$phone, 'state'=>"2"])->order('id desc')->select();
			
				if($psigninfo2){
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->assign('psigninfostr', "认证失败");
					}else{
						$this->assign('psigninfostr', "Authentication failed！");
					}
				}else{
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->assign('psigninfostr', "未认证");
					}else{
						$this->assign('psigninfostr', "Uncertified！");
					}
				}
				
			}
		}
		
		
    	return view();
    }
	
	public function pinfosigndo()
    {
		
    	$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');

		$psigninfo1 = db('pinfosign')->where(['username'=>$phone, 'state'=>"1"])->order('id desc')->select();
		$psigninfo3 = db('pinfosign')->where(['username'=>$phone, 'state'=>"3"])->order('id desc')->select();
		if($psigninfo1){
			exit();
		}
		if($psigninfo3){
			exit();
		}
		
		
		
		
		
		
		
		function mkdirs($dir,$mode=0777){
			if(is_dir($dir)||@mkdir($dir,$mode)){
				return true;
			}
			if(!mkdirs(dirname($dir),$mode)){
				return false;
			}
			return @mkdir($dir,$mode);
		}
		
		
		
		
		$res = array();
		if(empty($_POST["name"])){
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1003";//请输入姓名！
			echo json_encode($res,true);
			exit();
		}
		if(empty($_POST["idcard"])){
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1004";//请输入身份证号！
			echo json_encode($res,true);
			exit();
		}

		if(empty($_FILES["img1"])){
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1006";//请上传身份证正面照片！
			echo json_encode($res,true);
			exit();
		}
		if(empty($_FILES["img2"])){
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1007";//请上传身份证背面照片！
			echo json_encode($res,true);
			exit();
		}
		if(empty($_FILES["img3"])){
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1008";//请上传手持身份证照片！
			echo json_encode($res,true);
			exit();
		}
		
		
		
		
		if ( !empty( $_FILES["img1"] ) ) {
			$filetype = ['image/jpg', 'image/jpeg', 'image/bmp', 'image/png'];
			if(!in_array($_FILES["img1"]["type"], $filetype)){
				exit();
			}
			$tempPath = $_FILES[ 'img1' ][ 'tmp_name' ];
			$photouploadtime= new \DateTime;
			$randname=md5(rand(999,9999)."1_".$phone);
			if ($_FILES["img1"]["type"] == "image/gif"){
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.gif';
			}else{
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.png';
			}
			$dirpath='upload/user/idcard';
			$uploadPath =$dirpath.'/'.$photoname;
			if (!file_exists($dirpath)){
				mkdirs($dirpath);
			}
			$upre=move_uploaded_file( $tempPath, $uploadPath );
			if($upre){
				$imgurlval1=$photoname;
			}
		}
		if ( !empty( $_FILES["img2"] ) ) {
			$filetype = ['image/jpg', 'image/jpeg', 'image/bmp', 'image/png'];
			if(!in_array($_FILES["img2"]["type"], $filetype)){
				exit();
			}
			$tempPath = $_FILES[ 'img2' ][ 'tmp_name' ];
			$photouploadtime= new \DateTime;
			$randname=md5(rand(999,9999)."2_".$phone);
			if ($_FILES["img2"]["type"] == "image/gif"){
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.gif';
			}else{
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.png';
			}
			$dirpath='upload/user/idcard';
			$uploadPath =$dirpath.'/'.$photoname;
			if (!file_exists($dirpath)){
				mkdirs($dirpath);
			}
			$upre=move_uploaded_file( $tempPath, $uploadPath );
			if($upre){
				$imgurlval2=$photoname;
			}
		}
		if ( !empty( $_FILES["img3"] ) ) {
			$filetype = ['image/jpg', 'image/jpeg', 'image/bmp', 'image/png'];
			if(!in_array($_FILES["img3"]["type"], $filetype)){
				exit();
			}
			$tempPath = $_FILES[ 'img3' ][ 'tmp_name' ];
			$photouploadtime= new \DateTime;
			$randname=md5(rand(999,9999)."3_".$phone);
			if ($_FILES["img3"]["type"] == "image/gif"){
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.gif';
			}else{
				$photoname=strtotime($photouploadtime->format('Y-m-d H:i:s')).'_'.$randname.'.png';
			}
			$dirpath='upload/user/idcard';
			$uploadPath =$dirpath.'/'.$photoname;
			if (!file_exists($dirpath)){
				mkdirs($dirpath);
			}
			$upre=move_uploaded_file( $tempPath, $uploadPath );
			if($upre){
				$imgurlval3=$photoname;
			}
		}
		
		
		
		
		
		
		$infosign = array();
		
		$infosign["name"] = $_POST["name"];
		$infosign["idcard"] = $_POST["idcard"];
		$infosign["img1"] = $imgurlval1;
		$infosign["img2"] = $imgurlval2;
		$infosign["img3"] = $imgurlval3;
		
		$dttime = new \DateTime;
		
		$psigninfo_ = db('pinfosign')->where(['username'=>$phone])->order('id desc')->select();
		if($psigninfo_){
			$resu = db('pinfosign')->where([
				'id'=>$psigninfo_[0]['id']
			])->update([
				'username' => $phone,
				'name' => $infosign["name"],
				'idcard' => $infosign["idcard"],
				'img1' => $infosign["img1"],
				'img2' => $infosign["img2"],
				'img3'=> $infosign["img3"],
				'state'=> 1,
				'time'=> $dttime->format('Y-m-d H:i:s')
			]);
		}else{
			$resu = db('pinfosign')->insert([
            'username' => $phone,
            'name' => $infosign["name"],
            'idcard' => $infosign["idcard"],
            'img1' => $infosign["img1"],
            'img2' => $infosign["img2"],
            'img3'=> $infosign["img3"],
			'state'=> 1,
			'time'=> $dttime->format('Y-m-d H:i:s')
            ]);
		}
		
		
		
		if($resu){
			$res["data"]["state"] = "true";
			$res["data"]["msg"] = "1001";//提交成功！
			echo json_encode($res,true);
			exit();
		}else{
			$res["data"]["state"] = "false";
			$res["data"]["msg"] = "1002";//提交失败！
			echo json_encode($res,true);
			exit();
		}
	
		
		
		
    }
}