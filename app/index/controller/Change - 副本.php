<?php
namespace app\index\controller;
use app\common\controller\Home;
use think\Request;

class Change extends Home
{
    //钱包地址
    public function index(){
		echo "<script>alert('暂未开放 ！');history.go(-1)</script>";exit();
        $uid = cookie('frcw_uid');
        //当前币的资产
        $userinfo = $list = [];
        $userinfo = db('coin')->where('member_id',$uid)->find();
        if(!$userinfo){
            db('coin')->insert(['member_id'=>$uid]);
            $userinfo = db('coin')->where('member_id',$uid)->find();
        }
        $coinlist = db('coin_name')->where('open','gt',0)->where('name','neq','frcw')->field('id,name,logo')->select();
        foreach ($coinlist as $key => $value) {
            $value['money'] = $userinfo[$value['name']];
            $address = $value['name'].'_address';
            if(isset($userinfo[$address])){
                 $value['address'] = $userinfo[$address];
             }else{
                $value['address'] = "";
             }
            $list[] = $value;
        }
        $this->assign('list',$list);
        return view();
    }

    //添加地址
    public function addwetall(){
        $uid = cookie('frcw_uid');
        $request=Request::instance();
        if($request->post()){
            $data = $request->post();
            if(!$data['address']){
                $this->error('请输入地址');
            }
            if(strlen($data['address'])>220){
                $this->error('地址输入有误');
            }
            $coin = db('coin_name')->where('id',$data['coinid'])->value('name');
            $update[$coin.'_address'] = $data['address'];
            db('coin')->where('member_id',$uid)->update($update);
            $this->success('设置成功',url('change/index'));
        }
        $coinid = input('param.coinid');
        $info = db('coin')->where('member_id',$uid)->find();
        $coinname = db('coin_name')->where('id',$coinid)->value('name');
        $string = $coinname.'_address';
        $address = $info[$string];
        $this->assign('address',$address);
        $this->assign('coinname',$coinname);
        $this->assign('coinid',$coinid);
        return view();
    }

    //充币
    public function chongbi(){
        $uid = cookie('frcw_uid');
        $request=Request::instance();
        if($request->post()){
            $data = $request->post();
            $userinfo = db('member')->where('id',$uid)->field('id,phone,trade_pwd')->find();
            $coininfo = db('coin_name')->where('id',$data['coinid'])->field('name,address')->find();
            if($data['num']<=0){
                $this->error('充币数量不能小于0');
            }
            $bypass = transfer_pwd($data['bypass']);
            if($bypass != $userinfo['trade_pwd']){
                $this->error('交易密码错误');
            }
            $order['member_id'] = $userinfo['id'];
            $order['member_phone'] = $userinfo['phone'];
            $order['number'] = $data['num'];
            $order['updatetime'] = time();
            $order['address'] = $coininfo['address'];
            $order['coin'] = $coininfo['name'];
            $order['order_sn'] =$this->getorder().rand(10000,999999);
            db('user_tibi')->insert($order);
            $this->success('操作成功');
        }
        $coinid = input('param.coinid');
        $info = db('coin')->where('member_id',$uid)->find();
        $coinname = db('coin_name')->where('id',$coinid)->field('name,address')->find();
        $money = $info[$coinname['name']];
        $this->assign('coinname',$coinname['name']);
        $this->assign('address',$coinname['address']);
        $this->assign('money',$money);
        $this->assign('coinid',$coinid);
        return view();
    }

    private function getorder(){
        return db('user_tibi')->order('id desc')->value('id');
    }

    //提币
    public function tibi(){
        $uid = cookie('frcw_uid');
        $request=Request::instance();
        if($request->post()){
            $data = $request->post();
            $userinfo = db('member')->where('id',$uid)->field('id,phone,trade_pwd')->find();
            $info = db('coin')->where('member_id',$uid)->find();
            $coininfo = db('coin_name')->where('id',$data['coinid'])->field('name,address')->find();
            if($data['num']<=0){
                $this->error('充币数量不能小于0');
            }
            $bypass = transfer_pwd($data['bypass']);
            if($bypass != $userinfo['trade_pwd']){
                $this->error('交易密码错误');
            }
            $money = $info[$coininfo['name']];
            if($data['num']>$money){
                $this->error('账户余额不足');
            }
            $string = $coininfo['name'].'_address';
            $address = $info[$string];
            if(!$address){
                $this->error('请先添加收币地址');
            }
            $order['member_id'] = $userinfo['id'];
            $order['member_phone'] = $userinfo['phone'];
            $order['number'] = $data['num'];
            $order['updatetime'] = time();
            $order['address'] = $address;
            $order['type'] = 2;
            $order['coin'] = $coininfo['name'];
            $order['order_sn'] =$this->getorder().rand(10000,999999);
            db('user_tibi')->insert($order);
            $update[$coininfo['name']] = $money-$data['num'];
            db('coin')->where('member_id',$uid)->update($update);
            $this->adduserlog($userinfo['phone'],$coininfo['name'],$data['num'],'提币','out');
            $this->success('操作成功');
        }
        $coinid = input('param.coinid');
        $info = db('coin')->where('member_id',$uid)->find();
        $coinname = db('coin_name')->where('id',$coinid)->field('name')->find();
        $money = $info[$coinname['name']];
        $string = $coinname['name'].'_address';
        $address = $info[$string];
        $this->assign('coinname',$coinname['name']);
        $this->assign('address',$address);
        $this->assign('money',$money);
        $this->assign('coinid',$coinid);
		
		
		
		if(!$address){
			$this->assign('addressn',"1");
		}else{
			$this->assign('addressn',"2");
		}
		
		
        return view();
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


}