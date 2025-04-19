<?php
namespace app\sdkfjf\controller;

class Config extends Common
{
    public function index(){
        if(request()->isPost())
        {
            $list = [];
            $key  = input('post.key','','trim');
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $lists = db('admin_config')
                 -> order('id desc')
                 -> field('name,title,value,id,status,update_time')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            foreach ($lists['data'] as $key => $value) {
                $value['update_time'] = date("Y-m-d H:i:s",$value['update_time']);
                $list[] = $value;
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'count'=>$lists['total'],'rel'=>1];
        }
		
		
		$cset1 = db('config2')->where(['id'=>1])->value('set1');
		$this->assign('cset1', $cset1);
		$cset4 = db('config2')->where(['id'=>1])->value('set4');
		$this->assign('cset4', $cset4);
		
		$cset5 = db('config2')->where(['id'=>1])->value('set5');
		$this->assign('cset5', $cset5);
		$cset6 = db('config2')->where(['id'=>1])->value('set6');
		$this->assign('cset6', $cset6);
		$cset7 = db('config2')->where(['id'=>1])->value('set7');
		$this->assign('cset7', $cset7);
		
		
		
		
		
		
		$cset11 = db('config2')->where(['id'=>1])->value('set11');
		$this->assign('cset11', $cset11);
		$cset12 = db('config2')->where(['id'=>1])->value('set12');
		$this->assign('cset12', $cset12);
		$cset13 = db('config2')->where(['id'=>1])->value('set13');
		$this->assign('cset13', $cset13);
		$cset14 = db('config2')->where(['id'=>1])->value('set14');
		$this->assign('cset14', $cset14);
		$cset15 = db('config2')->where(['id'=>1])->value('set15');
		$this->assign('cset15', $cset15);
		$cset16 = db('config2')->where(['id'=>1])->value('set16');
		$this->assign('cset16', $cset16);
		$cset17 = db('config2')->where(['id'=>1])->value('set17');
		$this->assign('cset17', $cset17);
		$cset18 = db('config2')->where(['id'=>1])->value('set18');
		$this->assign('cset18', $cset18);
		
		$cset21 = db('config2')->where(['id'=>1])->value('set21');
		$this->assign('cset21', $cset21);
		
		
        return view();
    }

	
	
	
	public function cset1(){
	
		if (request()->isPost()) {
            $data   = input('post.');
            $result = db('config2')->where(['id'=>1])->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('sdkfjf/Config/index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }
	}
	
    //添加
    public function add(){
        if (request()->isPost()) {
            $data['name'] = input('param.name', '');
            $data['title'] = input('param.title', '');
            $data['value'] = input('param.value');
            $data['status'] = input('param.status');
            $data['update_time'] = time();
            $data['create_time'] = time();
            //添加
            if (db('admin_config')->insert($data)) {
                return ['code'=>1,'msg'=>'添加成功!','url'=>url('admin/Config/index')];
            } else {
                return ['code'=>0,'msg'=>'添加失败!'];
            }
        }
        return view();
    }

    //编辑
    public function edit(){
        if (request()->isPost()) {
            $data   = input('post.');
            $result = db('admin_config')->update($data);
            if($result!==false){
                return $return = ['code'=>1,'msg'=>'修改成功!','url'=>url('admin/Config/index')];
            }else{
                return $return = ['code'=>0,'msg'=>'修改失败!'];
            }
        }
        $id   = input('param.id');
        $data = db('admin_config')->find($id);
        $this->assign('data',$data);
        return view();
    }

    //更改状态
    public function del(){
        $id   = input('param.id');
        $res = db('admin_config')->where('id',$id)->delete();
        if ($res) {
            return ['code'=>1,'msg'=>'删除成功！'];
        } else {
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }

}
