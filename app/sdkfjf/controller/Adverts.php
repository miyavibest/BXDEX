<?php
namespace app\sdkfjf\controller;

/**
 * 公告管理
 */
class Adverts extends Common
{
	protected $advert;
	public function _initialize()
	{
		parent::_initialize();
		$this -> advert = db('advert');
	}

    /**
     * 列表
     */
	public function index()
	{
		if(request()->isPost())
        {
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = $this -> advert
                 // -> where('title|year','like',"%".$key."%")
                 -> order('id desc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}

	/**
	 * 添加
	 */
    public function add()
    {
        if (request()->isPost()) {
            $data['title_ch'] = input('param.title_ch', '');
            $data['title_en'] = input('param.title_en', '');
            $data['pub_time'] = input('param.pub_time');
            $data['open'] = input('param.open');
            $data['description'] = input('param.description', '');
            $data['content_ch'] = input('param.content_ch');
            $data['content_en'] = input('param.content_en');
            //添加
            if (db('advert')->insert($data)) {
                return ['code'=>1,'msg'=>'添加成功!','url'=>url('admin/Advert/index')];
            } else {
                return ['code'=>0,'msg'=>'添加失败!'];
            }
        }
        return view();
    }

	/**
	 * 修改
	 */
	public function edit()
	{
		if (request()->isPost()) {
            $data   = input('post.');
            $result = $this->advert->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('admin/Advert/index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }
		$id   = input('param.id');
		$data = $this->advert->find($id);
        $this->assign('data',$data);
		return view();
	}

	/**
     * 删除
     */
    public function del()
    {
        $id   = input('param.id', 0);
        $res  = $this->advert -> delete($id);
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功！'];
        } else {
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }
 

    /**
     * 修改状态
     */
    public function status()
    {
        $id   = input('param.id');
        $open = $this-> advert -> where(array('id'=>$id))->value('open');
        if ($open==1) {
            $data['open'] = 0;
            $this->advert->where(array('id'=>$id))->setField($data);
        } else {
            $data['open'] = 1;
            $this->advert->where(array('id'=>$id))->setField($data);
        }
        $result['status'] = 1;
        
        return $result;
    }

   


}