<?php
namespace app\index\controller;
use think\Request;

class My extends Common
{
	public function index()
	{
		//FRCW的实时价格
		$cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $price_now = $cur['price'];
        $this->assign('price_now', $price_now);

		//读取当前用户的币
    	$data_coin = $this->getPrice();
		//总收益
		$member = db('member')->where(['id'=>cookie('frcw_uid')])->find();
		$zzc = db('coin_record')
		       ->where(['coin'=>'frcw'])
			   ->where(['inout'=>'in'])
			   ->where('type','NEQ','系统充值')
			   ->where('type','NEQ','转入')
			   ->where('type','not like','%关闭量化%')
               ->where(['phone'=>$member['phone']])
			   ->sum('num');
        $this->assign('data_coin', $data_coin['data_coin']);
		$this->assign('total_price', $zzc);
      //$this->assign('total_price', $data_coin['total_price']);
    	$this->assign('level', $data_coin['level']);
		
		
		$mydatalisti = db('member')->where(['id'=>cookie('frcw_uid')])->find();
		$this->assign('level2', $mydatalisti['level2']);
		$this->assign('level3', $mydatalisti['level3']);
		
		$arrrlevel3 = ["","初级节点","中级节点","高级节点","超级节点"];
		$this->assign('arrrlevel3', $arrrlevel3);
		$this->assign('level3', $mydatalisti['level3']);
		
		
      	//当前用户当前收益
		//$this->todayEarning();
		 $time = strtotime(date('Y-m-d'));
        $jrsy = db('coin_record')
			   ->where(['add_time'=>['egt',$time]])
		       ->where(['coin'=>'frcw'])
			   ->where(['inout'=>'in'])
			   ->where('type','NEQ','系统充值')
			   ->where('type','NEQ','转入')
			   ->where('type','not like','%关闭量化%')
               ->where(['phone'=>$member['phone']])
			   ->sum('num');
		$this->assign('personComain', $jrsy);	   
      	//下级收益
		$this->getTotal();
      
		$nav = input('param.nav', 4);
    	$this->assign('nav', $nav);
		return view();
	}

	public function partner()
	{
        
	     $uid = cookie('frcw_uid');
		$datap = db('member')->where(array('id'=>$uid))->find();
		$datap['zonge']=$datap['lianghuazonge1']+$datap['lianghuazonge2']+$datap['lianghuazonge3'];
		$this->assign('datap',$datap);
		return view();
	}
	
	public function partnerp()
	{
		if (request()->isAjax()) {
            $uid = cookie('frcw_uid');
            $data = $this->getChildrenzt($uid);
            foreach($data as $k => $v){
                $result = db('user_opencoin')
                       -> where(['money'=>['gt',0]])
                       -> where(['member_id'=>$v['id']])
                       -> find();
                if ($result) {
                    $data[$k]['open'] = '<span style="color:#FFDF5F">已開啟</span>';
                } else {
                    $data[$k]['open'] = '未開啟';
                }
            }
			
            return ['code'=>1, 'data'=>$data];
        }
		return view();
	}

    function getChildren($id)
    {
        static $data= [];
        $list = db('member')->where(['parent_id'=>$id])->select();
        foreach($list as $vo) {
            $data[] = $vo;
            $this->getChildren($vo['id']);
        }
        return $data;
    }
	function getChildrenzt($id)
    {
        $list = db('member')->where(['parent_id'=>$id])->select();
        return $list;
    }
	
	
	
	public function smartRabbit()
	{
		$uid = cookie('frcw_uid');
        //当前币的资产
        $coininfo = db('coin')->where('member_id',$uid)->field('frcw,usdt,doge,ltc,btc,eth,eos,bchsv')->find();
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
        // dump($lists);die;
        $this->assign('lists',$lists);


		return view();
	}

	public function bitinfo()
	{
		return view();
	}

	public function generalize()
	{
		
	    $userid = cookie('frcw_uid');
        $drpath = './upload/Scode';
        $imgma = 'codes' . $userid . '.png';
        $urel = './upload/Scode/' . $imgma;

       if (!file_exists($drpath . '/' . $imgma)) {
            //sp_dir_create($drpath);
            vendor("phpqrcode.phpqrcode");
            $phpqrcode = new \QRcode();
            $hurl ="http://".$_SERVER['HTTP_HOST'].'/index/user/register1?id=' . cookie('frcw_uid');
            $size = "7";
            //$size = "10.10";
            $errorLevel = "L";
            $phpqrcode->png($hurl, $drpath . '/' . $imgma, $errorLevel, $size);
            
            //$phpqrcode->scerweima1($hurl,$urel,$hurl);

         
       }
	   
		// $url = 'http://' . $_SERVER['HTTP_HOST'] . '/index/user/register1?id=' . cookie('frcw_uid');
		$url='http://' . $_SERVER['HTTP_HOST'] . '/upload/Scode/' . $imgma;
         $this->assign('url',$url);
		return view();
	}

	public function welfare()
	{
		return view();
	}

	
}