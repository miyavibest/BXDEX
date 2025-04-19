<?php
namespace app\sdkfjf\controller;

/**
 * 用户中心
 */
class Ucenter extends Common
{
	protected $user;
	public function _initialize()
	{
		parent::_initialize();
		$this -> user = db('user');
	}

	public function index()
	{
		if(request()->isPost())
        {
            $key  = input('post.key', '', 'trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('member m')
                 -> join('coin n', 'n.member_id=m.id', 'left')
                 -> order('m.id desc')
                 -> where('m.phone','like',"%".$key."%")
                 -> field('m.*,n.frcw,n.usdt,n.doge,n.ltc,n.btc,n.eth,n.eos,n.bchsv,m.parent_id')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
		    $level2_arr = ['','普通用户','vip1','vip2','vip3'];
            $level3_arr = ['无奖励','初级节点','中级节点','高级节点','超级节点'];			
            foreach($list['data'] as $key => $vo){
                $list['data'][$key]['reg_time'] = date('Y-m-d H:i', $vo['reg_time']);
                $list['data'][$key]['frcw'] = $vo['frcw'] ? $vo['frcw'] : '0.0000';
                $list['data'][$key]['usdt'] = $vo['usdt'] ? $vo['usdt'] : '0.0000';
                $list['data'][$key]['doge'] = $vo['doge'] ? $vo['doge'] : '0.0000';
                
                $list['data'][$key]['ltc'] = $vo['ltc'] ? $vo['ltc'] : '0.0000';
                $list['data'][$key]['btc'] = $vo['btc'] ? $vo['btc'] : '0.0000';
                $list['data'][$key]['eth'] = $vo['eth'] ? $vo['eth'] : '0.0000';
                $list['data'][$key]['eos'] = $vo['eos'] ? $vo['eos'] : '0.0000';
                $list['data'][$key]['bchsv'] = $vo['bchsv'] ? $vo['bchsv'] : '0.0000';
				
			     $list['data'][$key]['level22'] = $level2_arr[$vo['level2']];
				 $list['data'][$key]['level33'] = $level3_arr[$vo['level3']];
				 
				$oneinfoc = db('member')->where('id',$list['data'][$key]['parent_id'])->field('id,phone')->find();
				if($oneinfoc){
					$list['data'][$key]['parent_phone'] = $oneinfoc['phone'];
				}else{
					$list['data'][$key]['parent_phone'] = 'None';
				}
				
            }     
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}


	
	public function myteam($id=""){
		
        $list = db('member')->where(['parent_id'=>$id])->select();
        $this->assign('data',$list);
		
         return view();
    }
	
	public function myteamdo($id=""){
        if(request()->isPost())
        {
			$id = input('param.id');
			$me = db('member')->where(['phone'=>$id])->find();
			
			if($me){
				
            
				$list = db('member')->where(['parent_id'=>$me['id']])->select();
				
				
				print_r(json_encode($list,true));
			}else{
				echo "[]";
			}
            
        }
    }
	
	public function index2()
	{
		if(request()->isPost())
        {
            $key  = input('post.key', '', 'trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('member m')
                 -> join('coin n', 'n.member_id=m.id', 'left')
                 -> order('m.id desc')
                 -> where('m.phone','like',"%".$key."%")
                 -> field('m.*,n.frcw,n.usdt,n.doge,n.ltc,n.btc,n.eth,n.eos,n.bchsv,m.parent_id,m.id')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            foreach($list['data'] as $key => $vo){

				$user_opencoinc = db('user_opencoin')->where('member_id',$list['data'][$key]['id'])->field('coin_name,money')->select();
				
				$user_opencoincv = "";
				
				foreach($user_opencoinc as $uokey => $uovo){
					$user_opencoincv=$user_opencoincv."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[".$uovo['coin_name']."启开金额:&nbsp;".$uovo['money']."]";
					
				}
				$list['data'][$key]['user_opencoincv'] = $user_opencoincv;
				
				$oneinfoc = db('member')->where('id',$list['data'][$key]['parent_id'])->field('id,phone')->find();
				if($oneinfoc){
					$list['data'][$key]['parent_phone'] = $oneinfoc['phone'];
				}else{
					$list['data'][$key]['parent_phone'] = 'None';
				}
				
            }     
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}
	
	public function add()
	{
		if (request()->isPost()) {
			$data = input('param.');
			//数据验证
			$user = $this->user->where(['username'=>input('param.username', '', 'trim')])->find();
			if ($user) {
                return ['code'=>0,'msg'=>'该会员名已经存在!'];
            }
            if (strlen(input('param.first_pwd')) < 6) {
                return ['code'=>0,'msg'=>'一级密码长度至少6位!'];
            }
            if (input('param.first_pwd') != input('param.first_pwd_confirm')) {
                return ['code'=>0,'msg'=>'一级密码重复密码不一致!'];
            }
            if (strlen(input('param.second_pwd')) < 6) {
                return ['code'=>0,'msg'=>'二级密码长度至少6位!'];
            }
            if (input('param.second_pwd') != input('param.second_pwd_confirm')) {
                return ['code'=>0,'msg'=>'二级密码重复密码不一致!'];
            }
            if (strlen(input('param.phone')) != 11) {
                return ['code'=>0,'msg'=>'手机号码格式不正确!'];
            }

            $number = $this->user->max('number');
            if ($number) {
            	$data['number'] = $number + 1;
            } else {
            	$data['number'] = 100001;
            }
            $data['parent_id']  = 0;
            $data['reg_time']   = date('Y-m-d');
            $data['first_pwd']  = transfer_md5($data['first_pwd']);
            $data['second_pwd'] = transfer_md5($data['second_pwd']);


            if ($this->user->insert($data)) {
            	return ['code'=>1,'msg'=>'添加成功!','url'=>url('index')];
            } else {
            	return ['code'=>0,'msg'=>'添加失败!'];
            }
		}
		return view();
	}

	public function edit()
	{
		if (request()->isPost()) {
            $data   = input('post.');
            //数据验证
            $map['id']=$data['id'];
            if (input('param.first_pwd', false)) {
	            if (strlen(input('param.first_pwd')) != 6) {
	                return ['code'=>0,'msg'=>'交易密码长度至少6位!'];
	            }
	            if (input('param.first_pwd') != input('param.first_pwd_confirm')) {
	                return ['code'=>0,'msg'=>'交易密码重复密码不一致!'];
	            }
	            $do['trade_pwd']  = transfer_pwd($data['first_pwd']);
				unset($data['first_pwd_confirm']);
            } else {
            	unset($data['trade_pwd']);
            }
          
            //修改数据
            $result = db("member")->where($map)->update($do);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }

		$id   = input('param.id',0);
		$user = db("member")->find($id);
		//var_dump($user);die;
        $this->assign('user',$user);
		return view();
	}

    public function charge()
    {
        if (request()->isPost()) {
            $coin = input('param.coin');
            if (strpos($coin, '.') !== false) {
                return $return = ['code'=>0,'msg'=>'金币数量必须是整数!'];
            }
            $data['id'] = input('param.id');
            $data['coin'] = intval($coin);
            //修改数据
            $result = $this->user->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }
        $id   = input('param.id',0);
        $info = $this->user->field('id,coin,username')->find($id);
        $this->assign('info',$info);
        return view();
    }

	public function del()
    {
        $id   = input('param.id', 0);
        $res  = db('member') -> delete($id);
		
        if ($res) {
			$result =['code'=>1,'msg'=>'删除成功！','url'=>url('index')];
        } else {
			$result =['code'=>0,'msg'=>'删除失败！','url'=>url('index')];      
        }
		
		 return $result;
    }

    public function status()
    {
        $id   = input('param.id');
        $open = db('member') -> where(array('id'=>$id))->value('open');
        if ($open==1) {
            $data['open'] = 0;
            db('member')->where(array('id'=>$id))->setField($data);
        } else {
            $data['open'] = 1;
            db('member')->where(array('id'=>$id))->setField($data);
        }
        $result['status'] = 1;
        
        return $result;
    }

    //明细
    public function mingxi($id=""){
        if(request()->isPost())
        {
            $id = input('param.id');
            $info = db('member')->where('id',$id)->field('phone')->find();
            $list = [];
            $map['phone'] = $info['phone'];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $lists = db('coin_record')
                 -> where($map)
                 -> order('id desc')
                 -> field('phone,coin,num,type,inout,add_time,id')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            foreach ($lists['data'] as $key => $value) {
                $value['add_time'] = date("Y-m-d H:i:s",$value['add_time']);
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
        $this->assign('uid',$id);
         return view();
    }

    //查看资产
    public function chongzhi($id=""){
        //获取币种列表
        $list = db('coin_name')->where('open','gt',0)->field('name')->order('id desc')->select();
        $this->assign('list',$list);
        $this->assign('uid',$id);
        return view();
    }


    public function openchongzhi(){
        if (request()->isPost()) {
            $data = input('param.');
            //数据验证
            $price = 0;
            if(!$data['coinname']){
                return ['code'=>0,'msg'=>'请选择币种!'];
            }
            //获取用户信息
            $userinfo = db('member')->where('id',$data['uid'])->field('phone')->find();
            if(!$userinfo){
                return ['code'=>0,'msg'=>'用户信息获取失败!'];
            }
            $usercoin = db('coin')->where('member_id',$data['uid'])->find();
            if($usercoin){
                $price = $usercoin[$data['coinname']];
            }
            if(!$data['type']){
                return ['code'=>0,'msg'=>'请选择操作类型!'];
            }
            if($data['number']<0){
                return ['code'=>0,'msg'=>'数量不能小于0!'];
            }
            if($data['type'] == 2 && $data['number']>$price){
                return ['code'=>0,'msg'=>'扣除账户不足!'];
            }
            if($data['type'] == 1){
                if(!$usercoin){
                    $updatecpin[$data['coinname']] = $data['number'];
                    $updatecpin['member_id'] = $data['uid'];
                    db('coin')->insert($updatecpin);
                }else{
                    $updatecpin[$data['coinname']] = $price+$data['number'];
                    db('coin')->where('member_id',$data['uid'])->update($updatecpin);
                }
                $this->adduserlog($userinfo['phone'],$data['coinname'],$data['number'],'系统充值','in');
            }

            if($data['type'] == 2){
                $updatecpin[$data['coinname']] = $price-$data['number'];
                db('coin')->where('member_id',$data['uid'])->update($updatecpin);
                $this->adduserlog($userinfo['phone'],$data['coinname'],$data['number'],'系统扣除','out');
            }
            return ['code'=>1,'msg'=>'操作成功!','url'=>url('index')];
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function pinfosign1()
	{
		if(request()->isPost())
        {
			$key  = input('post.key', '', 'trim');
			
			
			
			$map['username']=array('like',"%".$key."%");
			$map['state']=1;
			
			
            
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('pinfosign')->where($map)
			->order('time asc')
			-> field('id,username,name,idcard,img1,img2,img3,state,time')
			 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
			 -> toArray();
			 
			 
			foreach($list['data'] as $key => $vo){
				$list['data'][$key]['img1'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img1'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img1'].'" style="width:600px;" />';
				$list['data'][$key]['img2'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img2'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img2'].'" style="width:600px;" />';
				$list['data'][$key]['img3'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img3'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img3'].'" style="width:600px;" />';
            } 
			 
			 
			 
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}
	
	public function pinfosign2()
	{
		if(request()->isPost())
        {
			$key  = input('post.key', '', 'trim');
			
			
			
			$map['username']=array('like',"%".$key."%");
			$map['state']=2;
			
			
            
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('pinfosign')->where($map)
			->order('time asc')
			-> field('id,username,name,idcard,img1,img2,img3,state,time')
			 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
			 -> toArray();
			 
			 
			foreach($list['data'] as $key => $vo){
				$list['data'][$key]['img1'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img1'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img1'].'" style="width:600px;" />';
				$list['data'][$key]['img2'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img2'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img2'].'" style="width:600px;" />';
				$list['data'][$key]['img3'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img3'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img3'].'" style="width:600px;" />';
            }   
			 
			 
			 
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}
	
	public function pinfosign3()
	{
		if(request()->isPost())
        {
			$key  = input('post.key', '', 'trim');
			
			
			
			$map['username']=array('like',"%".$key."%");
			$map['state']=3;
			
			
            
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('pinfosign')->where($map)
			->order('time asc')
			-> field('id,username,name,idcard,img1,img2,img3,state,time')
			 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
			 -> toArray();
			 
			 
			 foreach($list['data'] as $key => $vo){
				$list['data'][$key]['img1'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img1'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img1'].'" style="width:600px;" />';
				$list['data'][$key]['img2'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img2'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img2'].'" style="width:600px;" />';
				$list['data'][$key]['img3'] = '<a href="/upload/user/idcard/'.$list['data'][$key]['img3'].'" target="_blank">查看大图</a><br><img src="/upload/user/idcard/'.$list['data'][$key]['img3'].'" style="width:600px;" />';
            }    
			 
			 
			 
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}
	
	
	public function pinfosign1_2()
    {
		if (request()->isPost()) {
				
			$id   = input('param.id');
			$state = db('pinfosign') -> where(array('id'=>$id))->value('state');
			if ($state==2) {
				
			} else {
				$data['state'] = 2;
				db('pinfosign')->where(array('id'=>$id))->setField($data);
			}
            $phone = db('pinfosign')->where(array('id'=>$id))->field('username')->find();
			$uid = db('member')->where(array('phone'=>$phone['username']))->field('id')->find();
			$this->top_del($uid['id']);
			return ['code'=>1,'msg'=>'驳回成功！','url'=>url('pinfosign1')];
		}
	}
	
	public function pinfosign1_3()
    {	
		if (request()->isPost()) {
			$id   = input('param.id');
			$state = db('pinfosign') -> where(array('id'=>$id))->value('state');
			if ($state==3) {
				
			} else {
				$data['state'] = 3;
				db('pinfosign')->where(array('id'=>$id))->setField($data);
			}
			$result['status'] = 1;
			$phone = db('pinfosign')->where(array('id'=>$id))->field('username')->find();
			$uid = db('member')->where(array('phone'=>$phone['username']))->field('id')->find();
			$this->top_ad($uid['id']);
			return ['code'=>1,'msg'=>'通过成功！','url'=>url('pinfosign1')];
		}
	}
	
	public function top_ad($uid)
	{
		$par = db('member')->where(array('id'=>$uid))->field('parent_id')->find();
		if($par['parent_id']){
		db('member')->where(array('id'=>$par['parent_id']))->setInc('smnum');	
	    $this->top_ad($par['parent_id']);
		}else{
			return;
		}
	}
	
	public function top_del($uid)
	{
		$par = db('member')->where(array('id'=>$uid))->field('parent_id')->find();
		if($par['parent_id']){
		db('member')->where(array('id'=>$par['parent_id']))->setDec('smnum');	
	    $this->top_del($par['parent_id']);
		}else{
			return;
		}
	}
	
	
	

}