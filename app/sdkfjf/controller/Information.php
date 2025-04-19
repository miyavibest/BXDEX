<?php
namespace app\sdkfjf\controller;

/**
 * 资讯管理
 */
class Information extends Common
{
	protected $information;
	public function _initialize()
	{
		parent::_initialize();
		$this -> information = db('information');
	}

	public function index()
	{
		if(request()->isPost())
        {
            $key  = input('post.key', '', 'trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('information')
                 // -> where('title|year','like',"%".$key."%")
                 -> order('id desc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}
	
		public function lunbo()
	{
		if(request()->isPost())
        {
            $key  = input('post.key', '', 'trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('lunbo')
                 // -> where('title|year','like',"%".$key."%")
                 -> order('id desc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray(); 
				foreach($list['data'] as $k=>$v){
					$list['data'][$k]['timea'] = date('Y-m-d H:i:s',$v['time']);
				}		
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }

		return view();
	}

	public function add()
	{
		if (request()->isAjax()) {
			$data['title_ch'] = input('param.title_ch');
			$data['title_en'] = input('param.title_en');
			$data['pub_time'] = input('param.pub_time');
			$data['thumb']    = input('param.thumb');
			$data['content_ch'] = input('param.content_ch');
			$data['content_en'] = input('param.content_en');
			if ($this->information->insert($data)) {
                return ['code'=>1,'msg'=>'添加成功!','url'=>url('information/index')];
            } else {
                return ['code'=>0,'msg'=>'添加失败!'];
            }
		}
		return view();
	}
	
	
	public function lunbo_add()
	{
		if (request()->isAjax()) {
			$data['url'] = input('param.url');
			$data['img'] = input('param.img');
			$data['type'] = input('param.type');
			if($data['type']!=1 && $data['type']!=2){
				return ['code'=>0,'msg'=>'添加失败!'];
			}
			$data['open'] = 1;
			$data['time'] = time();
			if (db('lunbo')->insert($data)) {
                return ['code'=>1,'msg'=>'添加成功!','url'=>url('information/lunbo')];
            } else {
                return ['code'=>0,'msg'=>'添加失败!'];
            }
		}
		return view();
	}
	
	public function lunbo_edit()
	{
		if (request()->isAjax()) {
            $data['url'] = input('param.url');
			$data['img'] = input('param.img');
			$data['type'] = input('param.type');
			if($data['type']!=1 && $data['type']!=2){
				return ['code'=>0,'msg'=>'添加失败!'];
			}
			$data['open'] = 1;
			$data['time'] = time();
			$map['id']=input('param.id');
            $result = db('lunbo')->where($map)->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('information/lunbo')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }

		$list = db('lunbo')->find(input('param.id'));
		$this->assign('list', $list);
		return view();
	}

	public function edit()
	{
		if (request()->isAjax()) {
            $data = input('post.');
            unset($data['file']);
            $result = $this->information->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('information/index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }

		$list = $this->information->find(input('param.id'));
		$this->assign('list', $list);
		return view();
	}
	
	public function lunbo_del()
    {
        $id   = input('param.id', 0);
        $res  = db('lunbo') -> delete($id);
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功！'];
        } else {
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }


	public function del()
    {
        $id   = input('param.id', 0);
        $res  = $this->information -> delete($id);
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功！'];
        } else {
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }

}