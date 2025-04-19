<?php
namespace app\sdkfjf\controller;
use think\Db;
use think\Request;
use clt\Leftnav;

class System extends Common
{
    /**
     * 网站配置
     */
    public function system($sys_id=1)
    {
        $table = db('system');
        if(request()->isPost()) {
            $datas = input('post.');
            unset($datas['file']);
            if($table->where('id',1)->update($datas)!==false) {
                return json(['code' => 1, 'msg' => '站点设置保存成功!', 'url' => url('system/system')]);
            } else {
                return json(['code' => 0, 'msg' =>'站点设置保存失败！']);
            }
        }

        $system = $table->field('id,name,url,title,key,des,bah,copyright,ads,tel,email,logo,open')->find($sys_id);
        $this->assign('system', $system);
        return $this->fetch();
    }



    public function email()
    {
        if(request()->isAjax()) {
            if (!input('param.receive_email', '', 'is_email')) {
                return ['code' =>0, 'msg' => '邮箱格式不正确!'];
            }

            if (!input('param.id_card', '', 'is_idcard')) {
                return ['code' =>0, 'msg' => '身份证格式不正确!'];
            }

            $datas = input('param.', array());
            foreach ($datas as $k=>$v) {
                db('config')->where(['name'=>$k, 'inc_type'=>'smtp'])->update(['value'=>$v]);
            }
            return ['code' =>1, 'msg' => '邮箱设置成功!', 'url' => url('system/email')];
        }

        $info = db('config')->where(['inc_type'=>'smtp'])->column('value', 'name');
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 邮件发送
     */
    public function trySend()
    {
        if (request()->isAjax()) {
            $obj     = new \phpmailer\Email();
            $data    = db('config')->where(['inc_type'=>'smtp'])->column('value', 'name');
            $email   = $data['receive_email'];//收件人邮箱
            $name    = $data['receive_name'];         //收件人姓名
            $title   = $data['receive_title'];
            $content = $data['receive_content'];
            $result = $obj -> send($email, $name, $title, $content);
            if ($result['code'] == 1) {
                return ['code'=>1, 'msg'=>'邮件发送成功！'];
            } else {
                return ['code'=>0, 'msg'=>$result['msg']];
            }

        }
    }

    public function frcw()
    {
        if (request()->isAjax()) {
            $time = input('param.pub_time', '', 'strtotime');
            $list = db('frcw')->where(['pub_time'=>$time])->find();
            $data['pub_time'] = $time;
            $data['price'] = input('param.price');

            if ($list) {
                db('frcw')->where(['pub_time'=>$time])->update(['price'=>input('param.price')]);
            } else {
                $result = db('frcw')->insert($data);
            }
            return ['code'=>1, 'msg'=>'保存成功！', 'url'=>url('frcw')];

        }

        $list = db('frcw')->order('pub_time desc')->limit(12)->select();
        $this->assign('list', $list);
        return view();
    }
	
	public function usdt()
    {
        if (request()->isAjax()) {
            $time = input('param.pub_time', '', 'strtotime');
            $list = db('usdt')->where(['pub_time'=>$time])->find();
            $data['pub_time'] = $time;
            $data['price'] = input('param.price');

            if ($list) {
                db('usdt')->where(['pub_time'=>$time])->update(['price'=>input('param.price')]);
            } else {
                $result = db('usdt')->insert($data);
            }
            return ['code'=>1, 'msg'=>'保存成功！', 'url'=>url('usdt')];

        }   

        $list = db('usdt')->order('pub_time desc')->limit(12)->select();
        $this->assign('list', $list);
        return view();
    }
	
		public function usdth()
    {
        if (request()->isAjax()) {
            $time = input('param.pub_time', '', 'strtotime');
            $list = db('usdth')->where(['pub_time'=>$time])->find();
            $data['pub_time'] = $time;
            $data['price'] = input('param.price');

            if ($list) {
                db('usdth')->where(['pub_time'=>$time])->update(['price'=>input('param.price')]);
            } else {
                $result = db('usdth')->insert($data);
            }
            return ['code'=>1, 'msg'=>'保存成功！', 'url'=>url('usdth')];

        }   

        $list = db('usdth')->order('pub_time desc')->limit(12)->select();
        $this->assign('list', $list);
        return view();
    }
	
		public function usdtl()
    {
        if (request()->isAjax()) {
            $time = input('param.pub_time', '', 'strtotime');
            $list = db('usdtl')->where(['pub_time'=>$time])->find();
            $data['pub_time'] = $time;
            $data['price'] = input('param.price');

            if ($list) {
                db('usdtl')->where(['pub_time'=>$time])->update(['price'=>input('param.price')]);
            } else {
                $result = db('usdtl')->insert($data);
            }
            return ['code'=>1, 'msg'=>'保存成功！', 'url'=>url('usdtl')];

        }   

        $list = db('usdtl')->order('pub_time desc')->limit(12)->select();
        $this->assign('list', $list);
        return view();
    }

    public function fee()
    {
        if(request()->isPost())
        {
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('coin_name')
                 //-> where('title|year','like',"%".$key."%")
                 -> where(['open'=>['gt',1]])
                 -> order('id asc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
				 
				 
			
			foreach ($list['data'] as $k=>$v) {
                $list['data'][$k]['addressall'] = "(1):&nbsp;".$v['address1']."&nbsp;&nbsp;&nbsp;&nbsp;(2):&nbsp;".$v['address2']
				."&nbsp;&nbsp;&nbsp;&nbsp;(3):&nbsp;".$v['address3']
				."&nbsp;&nbsp;&nbsp;&nbsp;(4):&nbsp;".$v['address4']
				."&nbsp;&nbsp;&nbsp;&nbsp;(5):&nbsp;".$v['address5']
				."&nbsp;&nbsp;&nbsp;&nbsp;(6):&nbsp;".$v['address6']
				."&nbsp;&nbsp;&nbsp;&nbsp;(7):&nbsp;".$v['address7']
				."&nbsp;&nbsp;&nbsp;&nbsp;(8):&nbsp;".$v['address8']
				."&nbsp;&nbsp;&nbsp;&nbsp;(9):&nbsp;".$v['address9']
				."&nbsp;&nbsp;&nbsp;&nbsp;(10):&nbsp;".$v['address10'];
				
				if($v['id']==1){
				$list['data'][$k]['eosmemoall'] = "(1):&nbsp;".$v['eosmemo1']."&nbsp;&nbsp;&nbsp;&nbsp;(2):&nbsp;".$v['eosmemo2']
				."&nbsp;&nbsp;&nbsp;&nbsp;(3):&nbsp;".$v['eosmemo3']
				."&nbsp;&nbsp;&nbsp;&nbsp;(4):&nbsp;".$v['eosmemo4']
				."&nbsp;&nbsp;&nbsp;&nbsp;(5):&nbsp;".$v['eosmemo5']
				."&nbsp;&nbsp;&nbsp;&nbsp;(6):&nbsp;".$v['eosmemo6']
				."&nbsp;&nbsp;&nbsp;&nbsp;(7):&nbsp;".$v['eosmemo7']
				."&nbsp;&nbsp;&nbsp;&nbsp;(8):&nbsp;".$v['eosmemo8']
				."&nbsp;&nbsp;&nbsp;&nbsp;(9):&nbsp;".$v['eosmemo9']
				."&nbsp;&nbsp;&nbsp;&nbsp;(10):&nbsp;".$v['eosmemo10'];
				}else{
					$list['data'][$k]['eosmemoall'] = "不需要";
				}
            }
			
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return view();
    }

    public function editFee()
    {
        if (request()->isAjax()) {
            $data['id'] = input('param.id');
            $data['fee'] = input('param.fee');
            $data['address'] = input('param.address');
			
			$data['address1'] = input('param.address1');
			$data['address2'] = input('param.address2');
			$data['address3'] = input('param.address3');
			$data['address4'] = input('param.address4');
			$data['address5'] = input('param.address5');
			$data['address6'] = input('param.address6');
			$data['address7'] = input('param.address7');
			$data['address8'] = input('param.address8');
			$data['address9'] = input('param.address9');
			$data['address10'] = input('param.address10');
			
			
			
			$data['eosmemo1'] = input('param.eosmemo1');
			$data['eosmemo2'] = input('param.eosmemo2');
			$data['eosmemo3'] = input('param.eosmemo3');
			$data['eosmemo4'] = input('param.eosmemo4');
			$data['eosmemo5'] = input('param.eosmemo5');
			$data['eosmemo6'] = input('param.eosmemo6');
			$data['eosmemo7'] = input('param.eosmemo7');
			$data['eosmemo8'] = input('param.eosmemo8');
			$data['eosmemo9'] = input('param.eosmemo9');
			$data['eosmemo10'] = input('param.eosmemo10');
			
			
			
            $result = db('coin_name')->update($data);
            if ($result !== false) {
                return ['code'=>1, 'msg'=>'保存成功', 'url'=>url('fee')];
            } else {
                return ['code'=>0, 'msg'=>'保存失败'];
            }
        }
        $id = input('param.id');
        $list = db('coin_name')->find($id);
        $this->assign('list', $list);
        return view();
    }
}
