<?php
namespace app\index\controller;

class Wallet extends Common
{
    public function select()
    {
        $list = db('coin_name')->where(['open'=>['gt',0]])->order('open asc')->select();
        $ids = db('member')->where(['id'=>cookie('frcw_uid')])->value('cn_id');
        if ($ids) {
            $ids_arr = explode(',', $ids);
        } else {
            $ids_arr = array();
        }
        $this->assign('ids_arr', $ids_arr);
        $this->assign('list', $list);
    	return view();
    }
	public function select2()
    {
        //eth_now_u_newaddress_chkM();
    }
	
	public function selects()
    {
		$id = input('param.id');
		$coincc = db('coin_name')->where('id',$id)->value('name');
		
		if(!$coincc){
			exit("Error");
		}
		
		$list = db ('out_coininfo')->where(['member_id'=>cookie('frcw_uid'),'coin'=>$coincc])->find();
		
		if(!$coincc){
			exit("Error");
		}else{
			///print_r($list);exit;
		}
		
        $this->assign('list', $list);
    	return view();
    }
	
    public function selectCoin()
    {
        if (request()->isAjax()) {
            $id = input('param.id');
            $ids = db('member')->where(['id'=>cookie('frcw_uid')])->value('cn_id');

            $type = input('param.type');
            if ($type == 2) {
				
                if ($ids) {
                    $str = $ids . ',' . $id;
                } else {
                    $str = $id;
                }
                db('member')->where(['id'=>cookie('frcw_uid')])->setField('cn_id', $str);
                return ['code'=>1, 'msg'=>'添加成功'];
            } else {
                $ids_arr = explode(',', $ids);
                foreach($ids_arr as $k=>$v) {
                    if($id == $v) unset($ids_arr[$k]);
                }
                $str = implode(',', $ids_arr);
                db('member')->where(['id'=>cookie('frcw_uid')])->setField('cn_id', $str);
                return ['code'=>1, 'msg'=>'保存成功'];
            }
        }
    }

	
	private function getdata()
    {
		$usdt_price = db('usdt')->order('pub_time desc')->value('price');
		$res = json_decode(file_get_contents('http://api.zb.cn/data/v1/allTicker'),true);
		$res['usdtusdt']['last'] = $usdt_price;
		return $res;
    }
	
    public function current()
    {
        $id = input('param.id', 0);
        if ($id) {
            //读取钱包信息
            $name = db('coin_name')->where(['id'=>$id])->value('name');
            $num = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value($name);
            $num = $num==0 ? 0.0000 : $num;
			/*
            if ($name == 'usdt') {
                $price = 1;
            } else {
                $str = json_decode(file_get_contents('http://api.zb.cn/data/v1/ticker?market='.$name.'_usdt'),true);
                $price = $str['ticker']['last'];
            }
			*/
			$pricedata_list = $this->getdata();
			$price = $pricedata_list[$name.'usdt']['last'];

            //读取记录
            $phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
            $record = db('coin_record')->where(['phone'=>$phone, 'coin'=>$name])->select();
            $this->assign('record', $record);

			
			
			
			$user_tibi = db('user_tibi')->where(['member_id'=>cookie('frcw_uid'), 'type'=>2, 'coin'=>$name])->select();
            $this->assign('user_tibi', $user_tibi);
			
			$tijiao = db('tijiao')->where(['name'=>$phone, 'type'=>$name])->select();
            $this->assign('tijiao', $tijiao);
			//正在打包，已存入，发送失败
			$status_arr = ['正在打包','已存入','发送失败','正在打包'];
			
			$this->assign('status_arr', $status_arr);
			
			
            $this->assign('name', $name);
            $this->assign('num', $num);
            $this->assign('price', $price);
            $this->assign('id', $id);
        }
    	return view();
    }

	
	
	public function usertibiinfo()
    {
        $id   = input('param.id');
		
		$user_tibi = db('user_tibi')->where(['member_id'=>cookie('frcw_uid'), 'id'=>$id])->find();
		
		if(empty($id)|| !$user_tibi){
			echo "<script>alert('None');history.go(-1)</script>";exit;
		}
		//$user_tibi['coin']='eos';
		
		
		$status_arr = ['正在打包','已存入','发送失败','正在打包'];
		$this->assign('status_arr', $status_arr);
		
		
		
		

        $info = db('coin_name')->where('name',$user_tibi['coin'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
		
		$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
		$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
		
		$addressid = substr(cookie('frcw_uid'),-1);
		$info['address'] = $addressarr[$addressid];
		$info['eosmemo'] = $eosmemoarr[$addressid];
		
		
		if($user_tibi['type']=='eth'){
			$out_coininfocc = db ('out_coininfo')->where(['member_id'=>cookie('frcw_uid'),'coin'=>'eth'])->find();
			$info['address'] = $out_coininfocc['pck_address'];
			
			$out_transfer_token = db ('out_transfer_token')->where(['oid'=>$user_tibi['id'],'coin'=>'eth'])->find();
			
			if($out_transfer_token){
				$user_tibi['address']=$out_transfer_token['to_address'];
			}
		}
		
		
		$this->assign('user_tibi', $user_tibi);
		
		
		$this->assign('info',$info);
		
		
		
		return view();
	}
	public function tijiaoinfo()
    {
		$id   = input('param.id');
        $phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		
		$tijiao = db('tijiao')->where(['name'=>$phone, 'id'=>$id])->find();
		
		if(empty($id)|| !$tijiao){
			echo "<script>alert('None');history.go(-1)</script>";exit;
		}
		
		
		
		$status_arr = ['正在打包','已存入','发送失败','正在打包'];
		$this->assign('status_arr', $status_arr);
		
		
		$info = db('coin_name')->where('name',$tijiao['type'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
		
		$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
		$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
		
		$addressid = substr(cookie('frcw_uid'),-1);
		$info['address'] = $addressarr[$addressid];
		$info['eosmemo'] = $eosmemoarr[$addressid];
		
		
		
		if($tijiao['type']=='eth'){
			$out_coininfocc = db ('out_coininfo')->where(['member_id'=>cookie('frcw_uid'),'coin'=>'eth'])->find();
			$info['address'] = $out_coininfocc['pck_address'];
			
			$transactioncallback = db ('out_transactioncallback')->where(['oid'=>$tijiao['id'],'coin'=>'eth'])->find();
			
			if($transactioncallback){
				$tijiao['dizhi']=$transactioncallback['from'];
			}
		}
		
		
		$this->assign('tijiao', $tijiao);
		$this->assign('info',$info);
		
		return view();
	}
	
	
    public function earnings()
    {
        $uid = cookie('frcw_uid');
        $userinfo = db('member')->where('id',$uid)->field('phone')->find();
        $list = db('coin_record')->where(['coin'=>'frcw'])->where('phone',$userinfo['phone'])->order('id desc')->select();
        $this->assign('list', $list);
        //FRCW的实时价格
        $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $price_now = $cur['price'];
        $this->assign('price_now', $price_now);
        
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
        //读取当前用户的币
        $data_coin = $this->getPrice();
      
      	//当前用户的收入
        // $this->todayEarning();
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
      
	     $this->assign('total_price', $zzc);
        //$this->assign('total_price', $data_coin['total_price']);
        $this->assign('level', $data_coin['level']);
		
		
		
		$mydatalisti = db('member')->where(['id'=>cookie('frcw_uid')])->find();
		$this->assign('level2', $mydatalisti['level2']);
		
		
		
    	return view();
    }
  
    public function out()
    {
		header("location:/index/change/tibi/coinid/".input('param.id').".html");
		
		exit;
        if (request()->isAjax()) {
            //检测钱包地址
            $encrypt = input('param.encrypt');
            $phone = encrypt($encrypt, 'D', '^&*().');
            $member = db('member')->where(['phone'=> $phone])->find();
            if (!$member) {
                return ['code'=>0, 'msg'=>'收款人不存在'];
            }
            $my_phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
            if ($phone == $my_phone) {
                return ['code'=>0, 'msg'=>'钱包地址不能是本人'];
            }
            //检测币数
            $id   = input('param.id');
            $name = db('coin_name')->where(['id'=>$id])->value('name');
            $my_num  = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value($name);

            $fee = db('coin_name')->where(['name'=>$name])->value('fee');
            $out_num = input('param.num',0);
            if (($out_num + $fee) > $my_num) {
                return ['code'=>0, 'msg'=>'余额不足'];
            }
            //检测交易密码
            $trade_pwd = input('param.trade_pwd');
            $where1['phone'] = $my_phone;
            $where1['trade_pwd'] = transfer_pwd($trade_pwd);
            $result = db('member')->where($where1)->find();
            if (!$result) {
                return ['code'=>0, 'msg'=>'交易密码错误'];
            }

            //修改数据
            db('coin')->where(['member_id'=>cookie('frcw_uid')])->setDec($name, ($out_num + $fee));
            $list = db('coin')->where(['member_id'=>$member['id']])->find();
            if ($list) {
                db('coin')->where(['member_id'=>$member['id']])->setInc($name, $out_num);
            } else {
                db('coin')->insert(['member_id'=>$member['id'], $name=>$out_num]);
            }

            $time = time();
            $data1['phone'] = $my_phone;
            $data1['coin']  = $name;
            $data1['num'] = $out_num + $fee;
            $data1['type'] = '转出';
            $data1['inout'] = 'out';
            $data1['add_time'] = $time;
            db('coin_record')->insert($data1);

            $data2['phone'] = $phone;
            $data2['coin']  = $name;
            $data2['num']   = $out_num;
            $data2['type']  = '转入';
            $data2['inout'] = 'in';
            $data2['add_time'] = $time;
            db('coin_record')->insert($data2);

            return ['code'=>1, 'msg'=>'转币成功', 'url'=>url('current',['id'=>$id])];
        }
        $id = input('param.id', 0);
        if ($id) {
            $name = db('coin_name')->where(['id'=>$id])->value('name');
            $num = db('coin')->where(['member_id'=>cookie('frcw_uid')])->value($name);
            $fee = db('coin_name')->where(['name'=>$name])->value('fee');
            $this->assign('fee', $fee);
            $this->assign('name', $name);
            $this->assign('num', $num);
            $this->assign('id', $id);
        }
    	return view();
    }

    public function gathering()
    {
        $id = input('param.id');
        $info = db('coin_name')->where('id',$id)->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
        //$phone = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
        //$str = encrypt($phone, 'E', '^&*().');
        //$this->assign('str', $str);
		
		
		$addressarr = [$info['address1'],
		$info['address2'],
		$info['address3'],
		$info['address4'],
		$info['address5'],
		$info['address6'],
		$info['address7'],
		$info['address8'],
		$info['address9'],
		$info['address10']];
		
		
		$eosmemoarr = [$info['eosmemo1'],
		$info['eosmemo2'],
		$info['eosmemo3'],
		$info['eosmemo4'],
		$info['eosmemo5'],
		$info['eosmemo6'],
		$info['eosmemo7'],
		$info['eosmemo8'],
		$info['eosmemo9'],
		$info['eosmemo10']];
		
		$addressid = rand(0,9);
		
		$info['address'] = $addressarr[$addressid];
		$info['eosmemo'] = $eosmemoarr[$addressid];
		
		
		
		
		
		$this->assign('id',$id);
        $this->assign('name', $info['name']);
		$this->assign('info',$info);
		
		
    	return view();
    }
	
	public function formpost()
	{
		$data=input();
		
		
	    $data['name'] = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
		$data['time'] = time();
		$data['status'] =0;
	    db('tijiao')->insert($data);
        //$this->success('提交成功，等待打包', 'index/index');
		
		echo "<script>alert('提交成功，等待打包');history.go(-1)</script>";
	}

    public function exchange()
    {
        //eth, frcw余额
        $list = db('coin')->where(['member_id'=>cookie('frcw_uid')])->find();
        $this->assign('list', $list);
        //eth, frcw价格
        $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $price_frcw = $cur['price'];
        $this->assign('price_frcw', $price_frcw);

        $price_eth = $this->getUsdt('eth')['ticker']['last'];
        $this->assign('price_eth', $price_eth);


    	return view();
    }
	
	public function exchangep()
    {
		$id=input('id');
		$info = db('coin_name')->where(['id'=>$id])->find();
		$this->assign('info', $info);
		
        // frcw余额
        $list = db('coin')->where(['member_id'=>cookie('frcw_uid')])->find();
        $this->assign('list', $list);
		
		$listp = $list[$info['name']]; 
		 $this->assign('listp', $listp);
        // frcw价格
        $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
        $price_frcw = $cur['price'];
        $this->assign('price_frcw', $price_frcw);
        if($info['name']!='usdt'){
        $price_eth = $this->getUsdt($info['name'])['ticker']['last'];
		}else{
		  $price_eth =  db('usdt')->order('pub_time desc')->limit(1)->find();
		}
        $this->assign('price_eth', $price_eth);


    	return view();
    }

    public function transEth()
    {
        if (request()->isAjax()) {
            $frcw_num = input('param.frcw_num');

            $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
            $price_frcw = $cur['price'];
            $price_eth = $this->getUsdt('eth')['ticker']['last'];

            $eth_num = ($price_frcw * $frcw_num) / $price_eth;
            return ['code'=>1, 'eth_num'=>sprintf4($eth_num)];
        }
    }
	
	public function transEthp()
    {
        if (request()->isAjax()) {
            $frcw_num = input('param.frcw_num');
            $type = input('type');
			
            $cur = db('frcw')->order('pub_time desc')->limit(1)->find();
            $price_frcw = $cur['price'];
            $price_eth = $this->getUsdt($type)['ticker']['last'];

            $eth_num = ($price_eth * $frcw_num) / $price_frcw;
            return ['code'=>1, 'eth_num'=>sprintf4($eth_num)];
        }
    }

	public function frcwTransEthp()
    {
        if (request()->isAjax()) {
            //检测数量
            $frcw_num = input('param.frcw_num');
			$type = input('type');
            $list = db('coin')->where(['member_id'=>cookie('frcw_uid')])->find();
		
            if ($list[$type] < $frcw_num) {
                return ['code'=>0, 'msg'=>'兑换失败,'.$type.'数量不足'];
            }
            //检测密码
            $trade_pwd = input('param.trade_pwd');
            $where1['phone'] = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
            $where1['trade_pwd'] = transfer_pwd($trade_pwd);
            $result = db('member')->where($where1)->find();
            if (!$result) {
                return ['code'=>0, 'msg'=>'交易密码错误'];
            }
            //修改数据
            db('coin')->where(['member_id'=>cookie('frcw_uid')])->setDec($type, $frcw_num);
            db('coin')->where(['member_id'=>cookie('frcw_uid')])->setInc('frcw', input('param.eth_num'));
         
            $time = time();
            $data1['phone'] = $where1['phone'];
            $data1['coin']  =  $type;
            $data1['num'] = $frcw_num;
            $data1['type'] = '兑换';
            $data1['inout'] = 'out';
            $data1['add_time'] = $time;
            db('coin_record')->insert($data1);

            $data2['phone'] = $where1['phone'];
            $data2['coin']  = 'FRCW';
            $data2['num']   = input('param.eth_num');
            $data2['type']  = '兑换';
            $data2['inout'] = 'in';
            $data2['add_time'] = $time;
            db('coin_record')->insert($data2);
			$map['name']=$type;
            $id = db('coin_name')->where($map)->field('id')->find();
            return ['code'=>1, 'msg'=>'兑换成功', 'url'=>url('current',['id'=>$id['id']])];
        }
    }
	
    public function frcwTransEth()
    {
        if (request()->isAjax()) {
            //检测数量
            $frcw_num = input('param.frcw_num');
            $list = db('coin')->where(['member_id'=>cookie('frcw_uid')])->find();
            if ($list['frcw'] < $frcw_num) {
                return ['code'=>0, 'msg'=>'兑换失败, FRCW数量不足'];
            }
            //检测密码
            $trade_pwd = input('param.trade_pwd');
            $where1['phone'] = db('member')->where(['id'=>cookie('frcw_uid')])->value('phone');
            $where1['trade_pwd'] = transfer_pwd($trade_pwd);
            $result = db('member')->where($where1)->find();
            if (!$result) {
                return ['code'=>0, 'msg'=>'交易密码错误'];
            }
            //修改数据
            db('coin')->where(['member_id'=>cookie('frcw_uid')])->setDec('frcw', $frcw_num);
            db('coin')->where(['member_id'=>cookie('frcw_uid')])->setInc('eth', input('param.eth_num'));
            
            $time = time();
            $data1['phone'] = $where1['phone'];
            $data1['coin']  = 'FRCW';
            $data1['num'] = $frcw_num;
            $data1['type'] = '兑换';
            $data1['inout'] = 'out';
            $data1['add_time'] = $time;
            db('coin_record')->insert($data1);

            $data2['phone'] = $where1['phone'];
            $data2['coin']  = 'eth';
            $data2['num']   = input('param.eth_num');
            $data2['type']  = '兑换';
            $data2['inout'] = 'in';
            $data2['add_time'] = $time;
            db('coin_record')->insert($data2);

            return ['code'=>1, 'msg'=>'兑换成功', 'url'=>url('earnings')];
        }
    }
}