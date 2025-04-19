<?php
namespace app\sdkfjf\controller;

class Infolist extends Common
{

    //互转列表
    public function index(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $lists = db('coin_record')
                 -> where('type','like','转入')->whereOr('type','like','转出')
                 -> order('id desc')
                 -> field('phone,coin,num,id,type,inout,add_time')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            foreach ($lists['data'] as $key => $value) {
                $value['add_time'] = date("Y-m-d H:i:s",$value['add_time']);
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
        return view();
    }

    //添加
    public function congbi(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 1;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,updatetime,status,address,eosmemo,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "congbi");
		
        return view();
    }
	public function congbi0(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 1;
			$map['status'] = 0;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,updatetime,status,address,eosmemo,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "congbi0");
		
        return view("congbi");
    }
	public function congbi1(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 1;
			$map['status'] = 1;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,updatetime,status,address,eosmemo,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "congbi1");
		
        return view("congbi");
    }
	public function congbi2(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 1;
			$map['status'] = 2;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,updatetime,status,address,eosmemo,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "congbi2");
		
        return view("congbi");
    }
	   //添加
    public function congbip(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            //$map['type'] = 1;
            $lists = db('tijiao')
                
                 -> order('id desc') 
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['time']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['type'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['name'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					if($value['type']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address'] = $out_coininfocc['pck_address'];
						
						$transactioncallback = db ('out_transactioncallback')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($transactioncallback){
							$value['address2']=$transactioncallback['from'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		$this->assign('actionname', "congbip");
        return view();
    }

	public function congbip0(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            //$map['type'] = 1;
			$map['status'] = 0;
            $lists = db('tijiao')
                 -> where($map)
                 -> order('id desc') 
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['time']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['type'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['name'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					if($value['type']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address'] = $out_coininfocc['pck_address'];
						
						$transactioncallback = db ('out_transactioncallback')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($transactioncallback){
							$value['address2']=$transactioncallback['from'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		$this->assign('actionname', "congbip0");
        return view("congbip");
    }
	public function congbip1(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            //$map['type'] = 1;
			$map['status'] = 1;
            $lists = db('tijiao')
                 -> where($map)
                 -> order('id desc') 
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['time']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['type'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['name'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					if($value['type']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address'] = $out_coininfocc['pck_address'];
						
						$transactioncallback = db ('out_transactioncallback')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($transactioncallback){
							$value['address2']=$transactioncallback['from'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		$this->assign('actionname', "congbip1");
        return view("congbip");
    }
	public function congbip2(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            //$map['type'] = 1;
			$map['status'] = 2;
            $lists = db('tijiao')
                 -> where($map)
                 -> order('id desc') 
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['time']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['type'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['name'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					if($value['type']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address'] = $out_coininfocc['pck_address'];
						
						$transactioncallback = db ('out_transactioncallback')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($transactioncallback){
							$value['address2']=$transactioncallback['from'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		$this->assign('actionname', "congbip2");
        return view("congbip");
    }
	
	
	
    //编辑
    public function tibi(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 2;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,number2,updatetime,status,address,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['coin'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['member_phone'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					
					if($value['coin']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address2'] = $out_coininfocc['pck_address'];
						
						$out_transfer_token = db ('out_transfer_token')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($out_transfer_token){
							$value['address']=$out_transfer_token['to_address'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "tibi");
		
        return view();
    }
	
	
	public function tibi0(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 2;
			$map['status'] = 0;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,number2,updatetime,status,address,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['coin'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['member_phone'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					
					if($value['coin']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address2'] = $out_coininfocc['pck_address'];
						
						$out_transfer_token = db ('out_transfer_token')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($out_transfer_token){
							$value['address']=$out_transfer_token['to_address'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "tibi0");
		
        return view("tibi");
    }
	
	public function tibi1(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 2;
			$map['status'] = 1;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,number2,updatetime,status,address,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['coin'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['member_phone'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					
					if($value['coin']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address2'] = $out_coininfocc['pck_address'];
						
						$out_transfer_token = db ('out_transfer_token')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($out_transfer_token){
							$value['address']=$out_transfer_token['to_address'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "tibi1");
		
        return view("tibi");
    }
	public function tibi2(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $map['type'] = 2;
			$map['status'] = 2;
            $lists = db('user_tibi')
                 -> where($map)
                 -> order('id desc')
                 -> field('order_sn,member_phone,number,number2,updatetime,status,address,id,coin')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            $status_arr = ['待审核','成功','拒绝','区块转入中'];
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['updatetime']);
                $value['statusnamne'] = $status_arr[$value['status']];
				
				$info = db('coin_name')->where('name',$value['coin'])->field('address,address1,address2,address3,address4,address5,address6,address7,address8,address9,address10,eosmemo1,eosmemo2,eosmemo3,eosmemo4,eosmemo5,eosmemo6,eosmemo7,eosmemo8,eosmemo9,eosmemo10,name')->find();
				if($info){
					$addressarr = [$info['address1'],$info['address2'],$info['address3'],$info['address4'],$info['address5'],$info['address6'],$info['address7'],$info['address8'],$info['address9'],$info['address10']];
					$eosmemoarr = [$info['eosmemo1'],$info['eosmemo2'],$info['eosmemo3'],$info['eosmemo4'],$info['eosmemo5'],$info['eosmemo6'],$info['eosmemo7'],$info['eosmemo8'],$info['eosmemo9'],$info['eosmemo10']];
				
					$cccuserinfo = db('member')->where('phone',$value['member_phone'])->field('id')->find();
					$cccid = substr($cccuserinfo['id'],-1);
					$value['address2'] = "(".$cccid.") ".$addressarr[$cccid];
					$value['eosmemo2'] = "(".$cccid.") ".$eosmemoarr[$cccid];
					
					
					
					if($value['coin']=='eth'){
						$out_coininfocc = db ('out_coininfo')->where(['member_id'=>$cccuserinfo['id'],'coin'=>'eth'])->find();
						$value['address2'] = $out_coininfocc['pck_address'];
						
						$out_transfer_token = db ('out_transfer_token')->where(['oid'=>$value['id'],'coin'=>'eth'])->find();
						
						if($out_transfer_token){
							$value['address']=$out_transfer_token['to_address'];
						}
					}
					
					
				}else{
					$value['address2'] = "";
					$value['eosmemo2'] = "";
				}
				
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		$this->assign('actionname', "tibi2");
		
        return view("tibi");
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//同意
    public function tongyi(){
        $id   = input('param.id');
        $res = db('user_tibi')->where('id',$id)->field('coin,id,type,member_id,number,member_phone,status')->find();
        if($res['status'] != 0){
            return ['code'=>0,'msg'=>'该订单已处理过请勿重复处理'];
        }
        /*
        if($res['type'] ==1){
            $user_coin = db('coin')->where('member_id',$res['member_id'])->find();
            $updatecoin[$res['coin']]  = $user_coin[$res['coin']] + $res['number'];
            db('coin')->where('member_id',$res['member_id'])->update($updatecoin);
            $this->adduserlog($res['member_phone'],$res['coin'],$res['number'],'充币通过','in');
        }
		*/
        db('user_tibi')->where('id',$id)->update(['status'=>1,'updatetime'=>time()]);
        return ['code'=>1,'msg'=>'操作成功'];
    }
	
    //拒绝
    public function reject(){
        $id   = input('param.id');
        $res = db('user_tibi')->where('id',$id)->field('coin,id,type,member_id,number,number2,member_phone,status')->find();
        if($res['status'] != 0){
            return ['code'=>0,'msg'=>'该订单已处理过请勿重复处理'];
        }
        //提币同意
        if($res['type'] ==2){
            $user_coin = db('coin')->where('member_id',$res['member_id'])->find();
            $updatecoin[$res['coin']]  = $user_coin[$res['coin']] + $res['number']+$res['number2'];
            db('coin')->where('member_id',$res['member_id'])->update($updatecoin);
            $this->adduserlog($res['member_phone'],$res['coin'],$res['number']+$res['number2'],'提币决绝','in');
        }
        db('user_tibi')->where('id',$id)->update(['status'=>2,'updatetime'=>time()]);
        return ['code'=>1,'msg'=>'操作成功'];
    }
	 public function czlb(){
        if(request()->isPost())
        {
            $list = [];
			
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
          
            $lists = db('coin_record')
               
				 -> where('phone','like',"%".$key."%")
                 -> order('id desc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
          
            foreach ($lists['data'] as $key => $value) {
                $value['updatetime'] = date("Y-m-d H:i:s",$value['add_time']);
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
        return view();
    }

    
	
	//同意
    public function tongyip(){
        $id   = input('param.id');
        $res = db('tijiao')->where('id',$id)->find();
        if($res['status'] != 0){
            return ['code'=>0,'msg'=>'该订单已处理过请勿重复处理'];
        }
        $uu = db('member')->where('phone',$res['name'])->find();
        $user_coin = db('coin')->where('member_id',$uu['id'])->find();
        $updatecoin[$res['type']]  = $user_coin[$res['type']] + $res['num'];
        db('coin')->where('member_id',$uu['id'])->update($updatecoin);
        $this->adduserlog($res['name'],$res['type'],$res['num'],'充币通过','in');
       
        db('tijiao')->where('id',$id)->update(['status'=>1]);
        return ['code'=>1,'msg'=>'操作成功'];
    }
	
		//拒绝
    public function rejectp(){
        $id   = input('param.id');
        $res = db('tijiao')->where('id',$id)->find();
        if($res['status'] != 0){
            return ['code'=>0,'msg'=>'该订单已处理过请勿重复处理'];
        }
		 $this->adduserlog($res['name'],$res['type'],$res['num'],'提币决绝','in');
        db('tijiao')->where('id',$id)->update(['status'=>2]);
        return ['code'=>1,'msg'=>'操作成功'];
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
