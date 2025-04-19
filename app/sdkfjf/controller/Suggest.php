<?php
namespace app\sdkfjf\controller;

/**
 * 用户反馈
 */
class Suggest extends Common
{
	protected $suggest;
	public function _initialize()
	{
		parent::_initialize();
		$this -> suggest = db('suggest');
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
            $list = db('suggest s')
                 -> join('member m', 'm.id=s.member_id')
                 // -> where('title|year','like',"%".$key."%")
                 -> order('s.id desc')
                 -> field('m.phone,s.*')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
		
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
		return view();
	}

	/**
	 * 修改
	 */
	public function edit()
	{
		if (request()->isPost()) {
            $data['id'] = input('param.id/d');
            $data['suggest'] = input('param.suggest');
            $data['status'] = 1;
            $data['reply_time'] = time();

            $result = $this->suggest->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'回复成功!','url'=>url('suggest/index')];
            }else{
                return $return = ['code'=>0,'msg'=>'回复失败!'];
            }
        }


		$id = input('param.id');
        $data = db('suggest s')
                 -> join('member m', 'm.id=s.member_id')
                 -> field('m.phone,s.*')
                 -> where(['s.id'=>$id])
                 -> find();

        $this->assign('data',$data);
		return view();
	}

	/**
     * 删除
     */
    public function del()
    {
        $id   = input('param.id', 0);
        $res  = $this->suggest -> delete($id);
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功！'];
        } else {
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }

}