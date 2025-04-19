<?php
namespace app\index\controller;

class Information extends Common
{
	public function index()
	{
		$info = db('information')->order('id desc')->select();
		$this->assign('info', $info);

		$nav = input('param.nav', 3);
    	$this->assign('nav', $nav);
		return view();
	}

	public function newsInfo()
	{
		$id = input('param.id');
		if ($id) {
			$list = db('information')->find($id);
			$this->assign('list', $list);
		}
		return view();
	}
}