<?php
namespace app\index\controller;

class Market extends Common
{
	public function index()
	{
    	//获取币名
    	$lists = [];
    	$datalist = $this->getdata();
     
    	$list = db('coin_name')->order('id asc')->field('name')->select();
		
		
		
		$value['name']='JPD';
		$listcc = db('frcw')->order('pub_time desc')->field('price,pub_time')->limit(1)->select();
		$listcc1 = db('frcw')->order('price asc')->field('price,pub_time')->limit(1)->select();
		$listcc2 = db('frcw')->order('price desc')->field('price,pub_time')->limit(1)->select();
		$value['last'] = round($listcc[0]['price'],4);
		$rate = round($listcc[0]['price']-($listcc2[0]['price']+$listcc1[0]['price'])/2,2);
		if($rate>=0){
			if ($rate == 0) {
				$value['rate'] = '<button type="button" class="red">+0.00%</button>';
			} else {
				$value['rate'] = '<button type="button" class="red">+'.$rate.'%</button>';
			}
		}else{
			$value['rate'] = '<button type="button" class="green">'.$rate.'%</button>';
		}
		$lists[] = $value;
		
	
		
		foreach ($list as $key => $value) {
		   $name = $value['name'].'usdt';
		   if(isset($datalist[$name])){
		   	   $value['last'] = round($datalist[$name]['last'],4);
              if($name == 'btcusdt')
              {
                 $rate = round(($datalist[$name]['last'] - $datalist[$name]['high'])/$datalist[$name]['high']*100,2);
              }else
              {
                  $rate = round($datalist[$name]['last']-($datalist[$name]['high']+$datalist[$name]['low'])/2,2);
              }
	          
      
               
	           if($rate>=0){
	           		if ($rate == 0) {
	           			$value['rate'] = '<button type="button" class="red">+0.00%</button>';
	           		} else {
	               		$value['rate'] = '<button type="button" class="red">+'.$rate.'%</button>';
	           		}
	            }else{
	               $value['rate'] = '<button type="button" class="green">'.$rate.'%</button>';
	           }
			    if($value['name']!="usdt"){
					$lists[] = $value;
				}
			  
			  
			  
			  $cointimepinfoin_ = db('cointimepinfo')->where(['coin'=>$value['name']])->order('id desc')->find();
			  if($cointimepinfoin_&&$cointimepinfoin_['time']+2<time()){
				  db('cointimepinfo')->insert([
					'coin' => $value['name'],
					'last' => $datalist[$name]['last'],
					'high' => $datalist[$name]['high'],
					'low' => $datalist[$name]['low'],
					'price' => $datalist[$name]['last'],
					'time'=> time()
					]);
			  }
			  
		   }
		   
		   if($value['name']=="usdt"){
				$listcc = db('usdt')->order('pub_time desc')->field('price,pub_time')->limit(1)->select();
				$listcc1 = db('usdt')->order('price asc')->field('price,pub_time')->limit(1)->select();
				$listcc2 = db('usdt')->order('price desc')->field('price,pub_time')->limit(1)->select();
               
				$value['last'] = round($listcc[0]['price'],4);
				$rate = round($listcc[0]['price']-($listcc2[0]['price']+$listcc1[0]['price'])/2,2);
			    if($rate>=0){
					if ($rate == 0) {
						$value['rate'] = '<button type="button" class="red">+0.00%</button>';
					} else {
						$value['rate'] = '<button type="button" class="red">+'.$rate.'%</button>';
					}
				}else{
					$value['rate'] = '<button type="button" class="green">'.$rate.'%</button>';
			    }
				$lists[] = $value;
		   }
		}


		$this->assign('lists',$lists);
		$nav = input('param.nav', 2);
    	$this->assign('nav', $nav);
		return view();
	}
	
  	public function cointimepe()
	{
		$coin = input('param.coin');
		if($coin=='usdt'){
			$list = db('usdt')->order('pub_time desc')->field('price,pub_time')->limit(10)->select();
		}elseif($coin=='JPD'){
			$list = db('frcw')->order('pub_time desc')->field('price,pub_time')->limit(10)->select();
		}else{
			$list = db('cointimepinfo')->where(['coin'=>$coin])->order('id desc')->field('price,time')->limit(10)->select();
			if(!$list){
				echo "<script>alert('Error-none！');history.go(-1)</script>";exit();
			}
		}
    	
		$this->assign('list',$list);
		$this->assign('coin', $coin);
		$nav = input('param.nav', 2);
    	$this->assign('nav', $nav);
		
		$listcc=array($list[0]['price'],$list[1]['price'],$list[2]['price'],$list[3]['price'],$list[4]['price']);
		sort($listcc);
		//print_r($listcc);exit;
		$this->assign('list2',$listcc);
		return view();
	}
  
	//获取中币网的接口
    private function getdata()
    {
		$usdt_price = db('usdt')->order('pub_time desc')->value('price');
		
		$res = json_decode(file_get_contents('http://api.zb.cn/data/v1/allTicker'),true);
		$res['usdtusdt']['last'] = $usdt_price;
		$res['usdtusdt']['high'] =  db('usdth')->order('pub_time desc')->value('price');
		$res['usdtusdt']['low'] =  db('usdtl')->order('pub_time desc')->value('price');
		return $res;
    }
}