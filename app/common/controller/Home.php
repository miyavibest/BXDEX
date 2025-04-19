<?php
namespace app\common\controller;
use think\Controller;
use think\Lang;
use think\Env;

class Home extends Controller
{
	public function _initialize()
	{
		parent::_initialize();
		Lang::setAllowLangList(['zh-cn','en-us']);
		// config('default_lang', 'en-us');
		// $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en-us';
		$_GET['lang'] = 'en-us';
		
		
		if(!isset($_SESSION)){
			session_start();
		}
		//$_SESSION['langtemsetv']="en-us";
		if(empty($_SESSION['langtemsetv']) || ($_SESSION['langtemsetv']!="zh-cn" && $_SESSION['langtemsetv']!="en-us")){
			$_SESSION['langtemsetv']="zh-cn";
		}else{
			if($_SESSION['langtemsetv']=="en-us"){
				$lang = Lang::range('en-us');//设定当前语言
				Lang::load(APP_PATH.DS.'index'.DS.'lang'.DS.$lang.EXT,$lang);//加载当前语言包
			}else{
				$_SESSION['langtemsetv']="zh-cn";
			}
		}
	}

	/*public function rewords()
	{

	}*/

	protected function getPrice()
    {
        $list = db('member')->where(['id'=>cookie('frcw_uid')])->find();
        $data_coin = db('coin_name')->where(['open'=>['neq',1],'id'=>['in',$list['cn_id']]])->select();
        // dump($data_coin);
        $total_price = 0;
        foreach($data_coin as $key => $vo){
            if ($vo['name'] == 'usdt') {
                $data_coin[$key]['num'] = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value($vo['name']);
                $data_coin[$key]['price'] = 1;
                $total_price += $data_coin[$key]['num'] * 1;
                continue;
            }
            $data_coin[$key]['num'] = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value($vo['name']);
            $data_coin[$key]['price'] = $this->getUsdt($vo['name'])['ticker']['last'];
            $total_price += $data_coin[$key]['num'] * $data_coin[$key]['price'];
        }
        

        $frcw_num = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value('frcw');
        $frcw_price = db('frcw')->max('price');
		
		$curccccc = db('frcw')->order('pub_time desc')->limit(1)->find();
        if ($curccccc) {
            $frcw_price = $curccccc['price'];
        }
		
		
		
		
        $total_price += $frcw_num * $frcw_price;

		//print_r($frcw_num * $frcw_price );exit;
		
        $level = 0;
        if ($total_price < 100) {
            $level = 1;
        } else if ($total_price < 2000) {
            $level = 2;
        } else {
            $level = 3;
        }

        return ['data_coin'=>$data_coin, 'total_price'=>$total_price, 'level'=>$level];
    }

    protected function getUsdt($str)
    {
     
      if($str == 'usdt')
      {
         $usdt = db('usdt')->order('pub_time desc')->find();
         $arr['ticker']['last'] = $usdt['price'];
         return $arr;
      }
      return json_decode(file_get_contents('http://api.zb.cn/data/v1/ticker?market='.$str.'_usdt'),true);
    }
  
    public function todayEarning()
    {
        $member = db('member')->where(['id'=>cookie('frcw_uid')])->find();
        $time = strtotime(date('Y-m-d'));
        $list = db('coin_record')
		    
             -> where(['add_time'=>['egt',$time]])
             -> where(['phone'=>$member['phone']])
             -> select();
             $plux = $minus = $personComain = 0;
        foreach($list as $key => $vo){
	       if($vo['type']!='系统充值' && strpos($vo['type'],'关闭量化')===false){
            if ($vo['coin'] == 'usdt') {
                $list[$key]['price'] = 1;
                if ($vo['inout'] == 'in') {
                    $plux += $vo['num'] * 1;
                } else if ($vo['inout'] == 'out') {
                    $minus += $vo['num'] * 1;
                }
                continue;
            }
            if ($vo['coin'] == 'FRCW' || $vo['coin'] == 'frcw') {
                $frcw = db('frcw')->order('pub_time desc')->find();
                $list[$key]['price'] = $frcw['price'];
                if ($vo['inout'] == 'in') {
                    $plux += $vo['num'] * $frcw['price'];
                } else if ($vo['inout'] == 'out') {
                    $minus += $vo['num'] * $frcw['price'];
                }
                continue;
            }
          //echo $vo['coin'];
            $list[$key]['price'] =  $this->getUsdt($vo['coin'])['ticker']['last'];
            if ($vo['inout'] == 'in') {
                $plux += $vo['num'] * $list[$key]['price'];
            } else if ($vo['inout'] == 'out') {
                $minus += $vo['num'] * $list[$key]['price'];
            }
			}
            //$personComain = $plux-$minus;
			
        }
		$personComain = $plux;
		//var_dump($personComain);die;
        $this->assign('personComain', sprintf4($personComain));
    }
  	
  	public function getTotal()
    {
        $phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
        $id = db('member')->where(['phone'=>$phone])->value('id');
        $data = [];
        $data = $this->getChildrens($id);
        $num = 0;
        foreach ($data as $key => $vo) {
           // $num += $this->totalEarning($vo['phone']);
		    $num += $this->totalEarningp($vo['phone']);
        }
        $this->assign('total_num',$num);
    }

    function getChildrens($id)
    {
        static $data= [];
        $list = db('member')->where(['parent_id'=>$id])->field('id,parent_id,phone')->select();
        foreach($list as $vo) {
            $data[] = $vo;
            $this->getChildrens($vo['id']);
            if (count($data) > 100) {
                break;
            }
        }
        return $data;
    }

    public function totalEarningp($phone)
	{
		$list = db('coin_record')
		       ->where(['coin'=>'frcw'])
			   ->where(['inout'=>'in'])
			   ->where('type','NEQ','系统充值')
			   ->where('type','NEQ','转入')
			   ->where('type','not like','%关闭量化%')
               ->where(['phone'=>$phone])
			   ->sum('num');
		return $list;	   
	}

    public function totalEarning($phone)
    {
        $list = db('coin_record')
             -> where(['phone'=>$phone])
             -> select();
             $plux =$minus = 0;
        foreach($list as $key => $vo){
            if ($vo['coin'] == 'usdt') {
                $list[$key]['price'] = 1;
                if ($vo['inout'] == 'in') {
                    $plux += $vo['num'] * 1;
                } else if ($vo['inout'] == 'out') {
                    $minus += $vo['num'] * 1;
                }
                continue;
            }
            if ($vo['coin'] == 'FRCW' || $vo['coin'] == 'frcw') {
                $frcw = db('frcw')->order('pub_time desc')->find();
                $list[$key]['price'] = $frcw['price'];
                if ($vo['inout'] == 'in') {
                    $plux += $vo['num'] * $frcw['price'];
                } else if ($vo['inout'] == 'out') {
                    $minus += $vo['num'] * $frcw['price'];
                }
                continue;
            }
            $list[$key]['price'] = $this->getUsdt($vo['coin'])['ticker']['last'];
            if ($vo['inout'] == 'in') {
                $plux += $vo['num'] * $list[$key]['price'];
            } else if ($vo['inout'] == 'out') {
                $minus += $vo['num'] * $list[$key]['price'];
            }

            $personComain = $plux-$minus;
            return $personComain;

        }
    }
  	
}