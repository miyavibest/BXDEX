<?php
namespace app\index\controller;
use app\common\controller\Home;
use think\Request;

class Openamount extends Home
{
    //开启量化页面
    public function index(){
        $uid = cookie('frcw_uid');
        //当前币的资产
        $coininfo = db('coin')->where('member_id',$uid)->field('frcw,usdt,doge,ltc,btc,eth,eos,bchsv,JPD')->find();
        //获取货币
        $coinlist = db('coin_name')->where('open','gt',0)->field('id,name,logo')->order('id desc')->select();
        //获取开启资产
        $openlist = db('user_opencoin')->where('member_id',$uid)->field('coin_name,coin_id,money')->select();
        $lists = [];
        foreach ($coinlist as $key => $value) {
            $value['open'] = 0;
            $value['openmoney'] = 0;
            foreach ($openlist as $k => $v) {
                if($v['coin_id'] == $value['id'] && $v['money']>0){
                    $value['open'] = 1;
                    $value['openmoney'] = $v['money'];
                }
            }
            $value['able_money'] = $coininfo[$value['name']];
            $lists[] = $value;
        }
        $this->assign('coinlist',$lists);
        //每日收益
        $this->todayaward();
		
		
		
        return view();
    }
	
	
	public function getopenview_infoptxt(){
		$request=Request::instance();
			if($request->post()){
			$uid = cookie('frcw_uid');
			$data = $request->post();
			//获取当前已开启的数量
			$openinfo = db('user_opencoin')->where('member_id',$uid)->where('coin_id',$data['coinid'])->field('money,id,coin_name,update_time')->find();
			if(!$openinfo){
				
				if($_SESSION['langtemsetv']=="zh-cn"){
					$this->error('您开启量化尚未满28天，需要扣除手续费10%，确认转出？');
				}else{
					$this->error('You have not started quantification for 28 days, and need to deduct 10% of the handling fee to confirm the transfer?');
				}
			}else{
				if((time()-$openinfo['update_time'])>0 && (time()-$openinfo['update_time'])/60/60/24 > 28){
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->error('转出手续费1%，确认转出？');
					}else{
						$this->error('Transfer fee 1%, confirm transfer?');
					}
				}else{
					if($_SESSION['langtemsetv']=="zh-cn"){
						$this->error('您开启量化尚未满28天，需要扣除手续费10%，确认转出？');
					}else{
						$this->error('You have not started quantification for 28 days, and need to deduct 10% of the handling fee to confirm the transfer?');
					}
				}
			}
		}
	}
	 public function test1(){
		$uid = cookie('frcw_uid');
		$userinfo = db('member')->where('id',$uid)->field('trade_pwd,phone,parent_id')->find();
		
		$dtimev = date("Y-m-d 00:00:00",time());
		$dtimevc = strtotime($dtimev);
		
		$wmap = array();
		$wmap['add_time'] = ["egt",$dtimevc];
		$wmap['type'] = "签到福利";
		$check = db('coin_record')->where('phone',$userinfo['phone'])->where($wmap)->count('id');
		if($check){
			echo "1";
		}else{
			echo "2";
		}
	 }
	
	
    //开启操作
    public function openmoney(){
        $request=Request::instance();
        if($request->post()){
            $uid = cookie('frcw_uid');
			
			
			
			$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
			$psigninfo = db('pinfosign')->where(['username'=>$phone, 'state'=>"3"])->order('id desc')->select();
		
			if($psigninfo){

			}else{
				$this->error('psignnone');
			}
			
            $data = $request->post();
            if($data['number']<=0){
                $this->error('开启数量不能小于0');
            }
            $user_info = db('member')->where('id',$uid)->field('trade_pwd,phone,iso,parent_id')->find();
            $bypass = transfer_pwd($data['bypass']);
            if($bypass != $user_info['trade_pwd']){
                $this->error('交易密码错误');
            }
            //获取当前货币信息
            $coininfo = db('coin_name')->where('id',$data['coinid'])->field('name')->find();
            //获取用户当前余额
            $usercoin = db('coin')->where('member_id',$uid)->find();
            $usercoinf_money = $usercoin[$coininfo['name']];
            if($data['number']>$usercoinf_money){
                $this->error('当前账户不足');
            }
			
			
			$mmnumber = 0;
			$price = 0;
			$data_list = $this->getdata();
			$frcw_price = db('frcw')->order('pub_time desc')->value('price');
			
			$name = $coininfo['name'].'usdt';
			if(isset($data_list[$name])){
				$price = $data_list[$name]['last'];
			}else{
				$price = $frcw_price;
			}
			
			$mmnumber = $data['number']*$price;
			if($mmnumber<100){
                $this->error('需要最低转入价值100美金虚拟币');
            }
			
			$update_usercoin[$coininfo['name']]  = $usercoinf_money-$data['number'];
			
            db('coin')->where('member_id',$uid)->update($update_usercoin);
			if($coininfo['name']=='eths'){
			//获取钱包地址
			$map['member_id'] = $uid;
			$map['coin'] = $coininfo['name'] ;
			$coininfop = db('out_coininfo')->where($map)->find();
			//请求接口
			$lianghua['hash'] = '0';
		    $lianghua['uid'] = $uid;
			$lianghua['coin'] = $coininfo['name'];
			$lianghua['sjnum'] = $data['number'];
			$lianghua['dsnum'] = $data['number'];
			$lianghua['type'] = 1;
            $lianghua['dizhi'] = $coininfop['pck_address'];		
            $lianghua['time'] = time() ;
		    $lianghua['status'] = 0;
            db('lianghua')->insert($lianghua);
			}else{
            $order['coin_name'] = $coininfo['name'];
            $order['coin_id'] = $data['coinid'];
            $order['money'] = $data['number'];
            $order['member_id'] = $uid;
            $order['update_time'] = time();
            $this->adduseropendata($order);
            $this->adduserlog($user_info['phone'],$coininfo['name'],$data['number'],'开启量化','out');
            $this->upleve($data['number']);
			
			
			$zc = $this->cx_zc($uid);
			
			$leve_c2 = 1;
			if(($mmnumber+$zc)>=100){
				$leve_c2 = 2;
			}
			if(($mmnumber+$zc)>=1000){
				$leve_c2 = 3;
			}
			if(($mmnumber+$zc)>=10000){
				$leve_c2 = 4;
			}
			
			
			$user_infoc_l2 = db('member')->where('id',$uid)->field('id,level2,phone')->find();
			if($leve_c2>$user_infoc_l2['level2']){
				db('member')->where('id',$uid)->update(['level2'=>$leve_c2]);
			}
			if($user_info['iso']==0 && $user_info['parent_id']){
				db('member')->where('id',$user_info['parent_id'])->setInc('tj_num');
				db('member')->where('id',$uid)->update(['iso'=>1]);
			}
			$this->auto_top($uid,$mmnumber);
			}
            $this->success('开启成功');
        }
    }


    public function lianghuashenghe()
	{
	
		   $data_list = $this->getdata();
		   $frcw_price = db('frcw')->order('pub_time desc')->value('price');
           $uid = cookie('frcw_uid');
		   $map['uid'] = $uid;
		   $map['status'] = 0;
		   $info= db('lianghua')->where($map)->select();
		   foreach($info as $k=>$v){
			   $user_info = db('member')->where('id',$uid)->field('phone,level2,iso,parent_id')->find();
		       $wallet_info = db('coin')->where('member_id',$uid)->find();
			   $res = eth_get_tx_infoM($v['hash']);
			   //量化转入
			   if($v['type']==1){
				//成功
				if($res == 1)
				{
					$coin = db('coin_name')->where('name',$v['coin'])->find();
				    $order['coin_name'] = $v['coin'];
					$order['coin_id'] = $coin['id'];
					$order['money'] = $v['num'];
					$order['member_id'] = $uid;
					$order['update_time'] = time();
					$this->adduseropendata($order);
					$this->adduserlog($user_info['phone'],$v['coin'],$v['sjnum'],'开启量化','out');
					$this->upleve($v['sjnum']);
					$name = $v['coin'].'usdt';
					if(isset($data_list[$name])){
						$price = $data_list[$name]['last'];
					}else{
						$price = $frcw_price;
					}
					$zc = $this->cx_zc($uid);
					$mmnumber =$v['sjnum']*$price;
					$leve_c2 = 1;
					if(($mmnumber+$zc)>=100){
						$leve_c2 = 2;
					}
					if(($mmnumber+$zc)>=1000){
						$leve_c2 = 3;
					}
					if(($mmnumber+$zc)>=10000){
						$leve_c2 = 4;
					}
									
					$user_infoc_l2 = db('member')->where('id',$uid)->field('id,level2,phone')->find();
					if($leve_c2>$user_infoc_l2['level2']){
						db('member')->where('id',$uid)->update(['level2'=>$leve_c2]);
					}
					if($user_info['iso']==0 && $user_info['parent_id']){
						db('member')->where('id',$user_info['parent_id'])->setInc('tj_num');
						db('member')->where('id',$uid)->update(['iso'=>1]);
					}
					$this->auto_top($uid,$mmnumber);
					//更改状态
					$da['ptime']=time();
					$da['status']=1;
					db('lianghua')->where('id',$v['id'])->update($da);
				}
				if($res == -1 || $res ==2)
				{
					db('coin')->where('member_id',$uid)->setInc($v['coin'],$v['sjnum']);
					//更改状态
					$da['ptime']=time();
					$da['status']=2;
					db('lianghua')->where('id',$v['id'])->update($da);
				}        
			   }
			   //量化转出
			   if($v['type']==2){
				//成功
				if($res == 1)
				{
					$name = $v['coin'].'usdt';
					if(isset($data_list[$name])){
						$price = $data_list[$name]['last'];
					}else{
						$price = $frcw_price;
					}
					$mmnumber = $v['sjnum']*$price;
					$zc  = $this->cx_zc($uid);
					$leve_c2 = 4;
					if($zc<6000){
						$leve_c2 = 3;
					}
					if($zc<600){
						$leve_c2 = 2;
					}
					if($zc<60){
						$leve_c2 = 1;
					}
					if($user_info['level2']>=$leve_c2){
					db('member')->where('id',$uid)->update(['level2'=>$leve_c2]);
					}
					$this->auto_down($uid,$mmnumber);
					//增加资产
					$update_usercoin[$v['coin']] = $wallet_info[$v['coin']]+$v['dsnum'];
					db('coin')->where('member_id',$uid)->update($update_usercoin);
					$charge=$v['sjnum']-$v['dsnum'];
					$this->adduserlog($user_info['phone'],$v['coin'],$v['sjnum'],'关闭量化-'.$charge,'in');
					//更改状态
					$da['ptime']=time();
					$da['status']=1;
					db('lianghua')->where('id',$v['id'])->update($da);
				}   
				if($res == -1 || $res ==2)
				{
					db('user_opencoin')->where('id',$v['oid'])->setInc('money',$v['sjnum']);
					//更改状态
					$da['ptime']=time();
					$da['status']=2;
					db('lianghua')->where('id',$v['id'])->update($da);
				}   
				   
			   }
		   }
	}

    //退出量化
    public function closemoney(){
        $request=Request::instance();
        if($request->post()){
            $uid = cookie('frcw_uid');
            $data = $request->post();
            if($data['number']<=0){
                $this->error('关闭数量不能小于0');
            }
            $user_info = db('member')->where('id',$uid)->field('trade_pwd,phone,level2')->find();
            $bypass = transfer_pwd($data['bypass']);
            if($bypass != $user_info['trade_pwd']){
                $this->error('交易密码错误');
            }
			
			$chargeb100 = 10;
			
            //获取当前已开启的数量
            $openinfo = db('user_opencoin')->where('member_id',$uid)->where('coin_id',$data['coinid'])->field('money,id,coin_name,update_time')->find();
            if(!$openinfo){
                $openmoney = 0;
            }else{
                $openmoney = $openinfo['money'];
				if((time()-$openinfo['update_time'])>0 && (time()-$openinfo['update_time'])/60/60/24 > 28){
					$chargeb100 = 1;
				}
            }
            if($data['number']>$openmoney){
                $this->error('当前最多只能提取'.$openmoney);
            }
			
			db('user_opencoin')->where('id',$openinfo['id'])->setDec('money',$data['number']);	
			
			//获取钱包地址
			$map['member_id'] = $uid;
			$map['coin'] = $openinfo['coin_name'] ;
			$coininfo = db('out_coininfo')->where($map)->find();
			//请求接口
			$lianghua['hash'] = '1';
            //获取用户资产信息
            $wallet_info = db('coin')->where('member_id',$uid)->find();
            $charge = $data['number']*$chargeb100/100;//应扣除手续费
          
            $number = $data['number']-$charge;//实际获得数量
			//量化转出 入 转出审核库
			
				
            $mmnumber = 0;
            $price = 0;
            $data_list = $this->getdata();
            $frcw_price = db('frcw')->order('pub_time desc')->value('price');	
            $name = $openinfo['coin_name'].'usdt';
            if(isset($data_list[$name])){
              $price = $data_list[$name]['last'];
            }else{
              $price = $frcw_price;
            }
            $mmnumber = $data['number']*$price;
            $zc  =$this->cx_zc($uid);
            $leve_c2 = 4;
            if($zc<6000){
              $leve_c2 = 3;
            }
            if($zc<600){
              $leve_c2 = 2;
            }
            if($zc<60){
              $leve_c2 = 1;
            }
            if($user_info['level2']>=$leve_c2){
              db('member')->where('id',$uid)->update(['level2'=>$leve_c2]);
            }
            $this->auto_down($uid,$mmnumber);
            //增加资产
          
            $update_usercoin[$openinfo['coin_name']] = $wallet_info[$openinfo['coin_name']]+$number;
            db('coin')->where('member_id',$uid)->update($update_usercoin);
            $this->adduserlog($user_info['phone'],$openinfo['coin_name'],$number,'关闭量化','in');
            $this->upleve(-$data['number']); 
		
			/**/
            $this->success('关闭成功');
        }
    }
     
	public function cx_zc($uid)
	{
		$list = db('user_opencoin')->where('member_id',$uid)->select();
		$data_list = $this->getdata();
		$frcw_price = db('frcw')->order('pub_time desc')->value('price');
		$zzc = 0;
		foreach($list as $k=>$v){
			if($v['coin_name']!='frcw'){
			 $name = $v['coin_name'].'usdt';
			 $dj = $data_list[$name]['last']; 
			}else{
			 $dj = $frcw_price;	
			}
			$zzc+=$dj*$v['money'];
		}
		return $zzc;
	}  
	 
	public function auto_down($uid,$money,$i=1)
	{
		//个人信息
		$oneinfo = db('member')->where('id',$uid)->field('id,parent_id')->find();
		if($oneinfo['parent_id']){
		 if($i==1){
		 db('member')->where('id',$oneinfo['parent_id'])->setDec('lianghuazonge1',$money);
		}
      //2-10代
        if($i>1 && $i<=10){
		 db('member')->where('id',$oneinfo['parent_id'])->setDec('lianghuazonge2',$money);
        }
        //11代
        if($i>10){
		 db('member')->where('id',$oneinfo['parent_id'])->setDec('lianghuazonge3',$money);
        }
	    //推荐人减团队业绩
		 db('member')->where('id',$oneinfo['parent_id'])->setDec('tdyj',$money);
		$data['level3']=4;
		$map4['parent_id']=$oneinfo['parent_id'];
		$map4['level3']=3;
		// 推荐人 没有3个高级奖励 等级就变更为高级奖励
		$num4 = db('member')->where($map4)->count();
		if($num4<3){
		 $data['level3']=3;
		}
		$map2['parent_id']=$oneinfo['parent_id'];
		$map2['level3']=2;
		// 推荐人 没有3个中级奖励 等级就变更为中级奖励
		$num2 = db('member')->where($map2)->count();
		if($num4<3){
		 $data['level3']=2;
		}
		$map['parent_id']=$oneinfo['parent_id'];
		$map['level3']=1;
		// 推荐人 没有3个初级奖励 等级就变更为初级奖励
		$num = db('member')->where($map)->count();
		if($num<3){
		 $data['level3']=1;
		}
		// 团队业绩不足15W 无节点奖励
		$info=db('member')->where('id',$oneinfo['parent_id'])->find();
		if($info['tdyj']<150000){
		 $data['level3']=0;
		}
		db('member')->where('id',$oneinfo['parent_id'])->update($data);
		$this->auto_down($oneinfo['parent_id'],$money,++$i);
		}else{
			return;
		}
	}
    
	
	public function auto_top($uid,$money,$i=1)
	{
		//个人信息
		$oneinfo = db('member')->where('id',$uid)->field('id,parent_id,tdyj')->find();
		if($oneinfo['parent_id']){
		if($i==1){
		 db('member')->where('id',$oneinfo['parent_id'])->setInc('lianghuazonge1',$money);
		}
        //2-10代
        if($i>1 && $i<=10){
		 db('member')->where('id',$oneinfo['parent_id'])->setInc('lianghuazonge2',$money);
        }
        //11代
        if($i>10){
		 db('member')->where('id',$oneinfo['parent_id'])->setInc('lianghuazonge3',$money);
        }
        $ptdyj=db('member')->where('id',$oneinfo['parent_id'])->field('tdyj,level3')->find();
		//推荐人加团队业绩
		db('member')->where('id',$oneinfo['parent_id'])->setInc('tdyj',$money);
		//再根据团队业绩给予奖励
		$pinfo = db('member')->where('id',$oneinfo['parent_id'])->field('tdyj,tj_num')->find();
		//如果团队业绩大于150000
		 $data['level3']=0; 
		if($pinfo['tdyj']>=150000 && $pinfo['tj_num']>=10){
		 $data['level3']=1;
		}
		//判断直推人数中的级别人数
		$map1['parent_id']=$oneinfo['parent_id'];
		$map1['level3']=1;
		//推荐人 有3个初级奖励 等级就变更为中级奖励
		$num1 = db('member')->where($map1)->count();
		if($num1>=3 && $pinfo['tj_num']>=10){
		 $data['level3']=2;
		}
		$map2['parent_id']=$oneinfo['parent_id'];
		$map2['level3']=2;
		//推荐人 有3个中级奖励 等级就变更为高级奖励
		$num2 = db('member')->where($map2)->count();
		if($num2>=3 && $pinfo['tj_num']>=10){
		 $data['level3']=3;
		}
		$map4['parent_id']=$oneinfo['parent_id'];
		$map4['level3']=3;
		//推荐人 有3个高级奖励 等级就变更为特级奖励
		$num4 = db('member')->where($map4)->count();
		if($num4>=3){
		 $data['level3']=4;
		}
		db('member')->where('id',$oneinfo['parent_id'])->update($data);
		$pinfo = db('member')->where('id',$oneinfo['parent_id'])->field('level3,parent_id,phone')->find();
		$config = db('config2')->where('id',1)->field('set14,set15,set16,set17')->find();
		//推荐人团队奖励等级
		 $bl=0;
		if($pinfo['level3']==4){
		 $bl=$config['set17'];
		}elseif($pinfo['level3']==3){
		 $bl=$config['set16'];
		}elseif($pinfo['level3']==2){
		 $bl=$config['set15'];
		}elseif($pinfo['level3']==1){
		 $bl=$config['set14'];
		}
		$moneyp = $money;
		//FRCW价格单价
	    $frcw = db('frcw')->order('pub_time desc')->find();
		if($ptdyj['tdyj']<150000){
			$moneyp = $money+$ptdyj['tdyj']-150000;
		}
		if($ptdyj['level3']==0){
		    $moneyp = $money+$ptdyj['tdyj']-150000;	
		}
		$jiangli = ($moneyp*$bl)/(100*$frcw['price']);
		if($jiangli>0){
			//$note='团队奖励';
			$note='节点奖励';
			db('coin')->where('member_id',$oneinfo['parent_id'])->setInc('frcw',$jiangli);
			$this->adduserlog($pinfo['phone'],'frcw',$jiangli,$note,'in');
		}
		$this->auto_top($oneinfo['parent_id'],$money,++$i);
		}else{
			//上级不存在   结束
			return;
		}
	}
	
    //给用户添加数据
    private function adduseropendata($data){
        $info = db('user_opencoin')->where('coin_id',$data['coin_id'])->where('member_id',$data['member_id'])->field('id')->find();
        if($info){
            db('user_opencoin')->where('id',$info['id'])->setInc('money',$data['money']);
        }else{
            db('user_opencoin')->insert($data);
        }
    }


    private function adduserlog($phone,$coin,$num,$type,$inout){
        db('coin_record')->insert([
            'phone' => $phone,
            'coin' => $coin,
            'num' => $num,
            'type' => $type,
            'inout' => $inout,
            'add_time'=>time()
            ]);
    }

    private function getdata()
    {
		$usdt_price = db('usdt')->order('pub_time desc')->value('price');
		$res = json_decode(file_get_contents('http://api.zb.cn/data/v1/allTicker'),true);
		$res['usdtusdt']['last'] = $usdt_price;
      	$jpd_price = db('frcw')->order('pub_time desc')->value('price');
		$res['JPDusdt']['last'] = $jpd_price;
		return $res;
    }

    //每日收益
    public function todayaward(){
		$times = date('Y-m-d');
        $types = "每日收益-$times";
        $uid = cookie('frcw_uid');
        //获取用户信息
        $userinfo = db('member')->where('id',$uid)->field('trade_pwd,phone,parent_id')->find();
        //获取用户开启资产信息
        $list = db('user_opencoin')->where('member_id',$uid)->where('money','gt',0)->field('coin_name,money')->select();
        //判断时间
        $check = db('coin_record')->where('phone',$userinfo['phone'])->where(['type'=>$types])->count('id');
      
        //$check = db('coin_record')->where('phone',$userinfo['phone'])->where('add_time','today')->count('id');
        
        if($check){
            return "";
        }
        if(!$list){
            return "";
        }
        $data_list = $this->getdata();
        $frcw_price = db('frcw')->order('pub_time desc')->value('price');
        $rate = db('admin_config')->where('name','web_today_rate')->value('value');//每日利息
        $totle = 0;//frcw产生的总量
        foreach ($list as $key => $value) {
            $name = $value['coin_name'].'usdt';
            if(isset($data_list[$name])){
                $price = $data_list[$name]['last'];
            }else{
                $price = $frcw_price;
            }
            $totle_number = $value['money']*$rate/100;//对应币每日产生的利息数量
            $dagx_number = $totle_number*$price/$frcw_price;//换算的到frcw的数量
            $totle+=$dagx_number;
        }
       if($totle>0){
           
         
           db('coin')->where('member_id',$uid)->setInc('frcw',$totle);
           $this->adduserlog($userinfo['phone'],'frcw',$totle, $types,'in');
           $this->leaderaward($userinfo['parent_id'],$totle);
       }
    }


    private function leaderaward($uid,$totle,$i=0){
        $vip1= db('admin_config')->where('name','web_award_shidai')->value('value');
        $vip1_arr = explode(',', $vip1);
        $oneinfo = db('member')->where('id',$uid)->field('id,parent_id,level,phone')->find();
        if(!$oneinfo){
            return "";
        }
        $rate = 0;
        //1-10代
        if($i<=9){
            if($oneinfo['level'] == 1){
                $rate = $vip1_arr[$i];
            }
            $note = '领导奖励';
        }
        //11-15代
        if($i>9 && $i<15){
            if($oneinfo['level'] == 2){
                $rate = db('admin_config')->where('name','web_award_guanli')->value('value');
            }
            $note = '管理奖励';
        }
        //15代以上
        if($i>=15){
            if($oneinfo['level'] == 3){
                $rate = db('admin_config')->where('name','web_award_jiedian')->value('value');
            }
            $note = '节点奖励';
        }
        $money = $totle*$rate/100;
        if($money>0){
           db('coin')->where('member_id',$oneinfo['id'])->setInc('frcw',$money);
           $this->adduserlog($oneinfo['phone'],'frcw',$money,$note,'in');
        }
        $this->leaderaward($oneinfo['parent_id'],$totle,++$i);
    }


    //开启和关闭记录
    public function openlist(){
        $uid = cookie('frcw_uid');
        //获取用户信息
        $userinfo = db('member')->where('id',$uid)->field('trade_pwd,phone')->find();
        //获取用户开启资产信息
        $lists  = [];
        $coinlist = db('coin_name')->where('open','gt',0)->field('id,name,logo')->order('id desc')->select();

        $list = db('coin_record')->where('phone',$userinfo['phone'])->where('type','like','%量化%')->field('coin,num,inout,add_time')->select();
        foreach ($list as $key => $value) {
            $value['logo'] = "";
            foreach ($coinlist as $k => $v) {
                if($value['coin'] == $v['name']){
                    $value['logo'] = $v['logo'];
                }
            }
            $lists[] = $value;
        }
		$map['uid']=$uid;
		$map['status']=0;
		$listp= db('lianghua')->where($map)->order('id desc')->field('type,coin,sjnum,time,status')->select();
		$listsp  = [];
		foreach ($listp as $key => $value) {
			   $value['logo'] = "";
            foreach ($coinlist as $k => $v) {
                if($value['coin'] == $v['name']){
                    $value['logo'] = $v['logo'];
                }
            }
            $listsp[] = $value;
		}
        $this->assign('list',$lists);
		$this->assign('listp',$listsp);
        return view();
    }

    //用户升级
    private function upleve($totle){
        $uid = cookie('frcw_uid');
        $money = db('user_opencoin')->where('member_id',$uid)->sum('money');
        $number =$money+$totle;
        $uplevel = db('admin_config')->where('name','wen_level_award')->value('value');
        $uplevel_arr = explode(',', $uplevel);
        $level = 0;
        if($number>=$uplevel_arr[0]){
            $level = 1;
        }
        if($number>=$uplevel_arr[1]){
            $level = 2;
        }
        if($number>=$uplevel_arr[2]){
            $level = 3;
        }
        db('member')->where('id',$uid)->update(['level'=>$level]);
    }



}