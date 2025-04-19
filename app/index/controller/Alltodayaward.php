<?php
namespace app\index\controller;
use app\common\controller\Home;
use think\Request;

class Alltodayaward extends Home
{
    


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
		return $res;
    }
	
	public function test2(){
		$data_list = $this->getdata();
		$frcw_price = db('frcw')->order('pub_time desc')->value('price');
		
		$totle = 0;//frcw产生的总量
		
		$name = 'eth'.'usdt';
		$numm = 1;
		$rate = '0.3';
		
		
		if(isset($data_list[$name])){
			$price = $data_list[$name]['last'];
		}else{
			$price = $frcw_price;
		}
		$totle_number = $numm*$rate/100;//对应币每日产生的利息数量
		$dagx_number = $totle_number*$price/$frcw_price;//换算的到frcw的数量
		$totle+=$dagx_number;
		
		
		
		echo "ETH数量:1  ;  ETH价格:".$price."  ;  frcw价格:".$frcw_price."  ;  分红比例:".$rate."<br><br>";
		
		echo "1 * ".$rate." / 100 * ".$price." / ".$frcw_price." = ".$totle."<br><br>";
		echo "1ETH * 分红比例 / 100 * ETH价格 / frcw价格 = ".$totle."<br><br>";
	}
	
    //每日收益
    public function todayaward(){
		
		
		
		$allulist = db('member')->field('id')->select();
		
		foreach ($allulist as $key => $uvaluei) {
		
			$uid = $uvaluei['id'];
			//获取用户信息
			$userinfo = db('member')->where('id',$uid)->field('trade_pwd,phone,parent_id')->find();
			//获取用户开启资产信息
			$list = db('user_opencoin')->where('member_id',$uid)->where('money','gt',0)->field('coin_name,money')->select();
			//判断时间
			//$check = db('coin_record')->where('phone',$userinfo['phone'])->where('add_time','today')->count('id');
			
			
			$dtimev = date("Y-m-d 00:00:00",time());
			$dtimevc = strtotime($dtimev);
		
			$wmap = array();
			$wmap['add_time'] = ["egt",$dtimevc];
			$wmap['type'] = "每日收益";
			$check = db('coin_record')->where('phone',$userinfo['phone'])->where($wmap)->count('id');
			
			if($check){
				//continue;
			}
			if(!$list){
				continue;
			}
			$data_list = $this->getdata();
			$frcw_price = db('frcw')->order('pub_time desc')->value('price');
			
			
			
			$cset5 = db('config2')->where(['id'=>1])->value('set5');
			$cset6 = db('config2')->where(['id'=>1])->value('set6');
			$cset7 = db('config2')->where(['id'=>1])->value('set7');
			
			
			//$rate = db('admin_config')->where('name','web_today_rate')->value('value');//每日利息
			$rate = 0;
			$user_infoc_l2 = db('member')->where('id',$uid)->field('id,level2,phone')->find();
			if($user_infoc_l2['level2']>1){
				$rate = $cset5;
			}
			if($user_infoc_l2['level2']>2){
				$rate = $cset6;
			}
			if($user_infoc_l2['level2']>3){
				$rate = $cset7;
			}
			
			
			
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
			   $this->adduserlog($userinfo['phone'],'frcw',$totle,'每日收益','in');
			   $this->leaderaward($userinfo['parent_id'],$totle);
		   }
		   
		   
		   
		}
		
		echo "SUCCESS";
    }

     private function leaderaward($uid,$totle,$i=0){
        $vip1= db('admin_config')->where('name','web_award_shidai')->value('value');
        $vip1_arr = explode(',', $vip1);
        $oneinfo = db('member')->where('id',$uid)->field('id,parent_id,level2,phone,tj_num')->find();
		$config = db("config2")->where('id',1)->field('set11,set12,set13')->find();
        if(!$oneinfo){
            return "";
        }
        $rate = 0;		
		//1代
		if($i==0){
		    //如果等级大于等于 vip1 并且 直推人数大于等于1人 可以获得奖励
		    if($oneinfo['level2'] >= 2 && $oneinfo['tj_num']>=1){
                $rate = $config['set11'];
            }
		}
        //2-10代
        if($i>=1 && $i<=9){
		    //如果等级大于等于 vip1 并且 直推人数大于等于当前代数 可以获得奖励
            if($oneinfo['level2'] >= 2 && $oneinfo['tj_num']>=($i+1)){
                $rate = $config['set12'];;
            }
        }
        //11-15代
        if($i>=10 && $i<=14){
		    //如果等级大于等于 vip2 并且 直推人数大于等于10 可以获得奖励
            if($oneinfo['level2'] >= 3 && $oneinfo['tj_num']>=10){
                $rate = $config['set13'];;
            }
          
        }
        //15-20代
		 if($i>=15 && $i<=19){
		    //如果等级大于等于 vip3 并且 直推人数大于等于10 可以获得奖励
            if($oneinfo['level2'] == 4 && $oneinfo['tj_num']>=10){
                $rate = $config['set13'];;
            }
        }
        $money = $totle*$rate/100;
        if($money>0){
		  $note = '链接'.($i+1).'收益';
           db('coin')->where('member_id',$oneinfo['id'])->setInc('frcw',$money);
           $this->adduserlog($oneinfo['phone'],'frcw',$money,$note,'in');
        }
        $this->leaderaward($oneinfo['parent_id'],$totle,++$i);
    }
	

    private function leaderaward_bak($uid,$totle,$i=0){
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

}