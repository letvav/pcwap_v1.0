<?php 
class WeixinAction extends CommAction{
	public function index(){
		if($this->ispost()){
			if(M('weixin_gz')->add(I('post.'))){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->wx=M('weixin_gz')->order('sorts')->select();
			$this->keylist=M('weixin_huifu')->order('sorts')->select();
		
			$cate = M('weixin_menu')->order('sorts ASC')->select();
			
			function catetree($cate,$html="　　└",$pid=0,$level=0){	
				$arr=array();
				foreach ($cate as $v){
					if($v['pid']== $pid){
						$v['level'] = $level + 1;
						$v['html'] = str_repeat($html,$level);
						$arr[]=$v;
						$arr = array_merge($arr, catetree($cate,$html,$v['id'],$level+1));
						
					}
				}
				return $arr;
			}
			
			$cate =catetree($cate);
		
			$this->menu=$cate;
			$this->pid=I('id',0,'intval');
			$this->display();
		}
	}
	
	public function keyhf(){
		$this->display();
	}

	
	public function eidt(){
		if($this->ispost()){
			if(M('weixin_gz')->save(I('post.'))){
				$this->success('修改成功',U('/Admin/Weixin/index'));
			}else{
				$this->error('修改失败');
			}
		}else{
		$this->v=M('weixin_gz')->find(I('get.id'));
		$this->display();
		}
	}
	public function del(){
		if(M('weixin_gz')->delete(I('get.id'))){
		
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	public function key(){
		if(M('weixin_huifu')->add(I('post.'))){
			$this->success('添加成功','index');
		}else{
			$this->success('添加失败','index');
		}
	}
	
	public function eidtkey(){
		if($this->ispost()){
			if(M('weixin_huifu')->save(I('post.'))){
				$this->success('修改成功',U('/Admin/Weixin/index'));
			}else{
				$this->error('修改失败内容没有被改变');
			}
		}else{
		$this->v=M('weixin_huifu')->find(I('get.id'));
		$this->display();
		}
	}
	public function delkey(){
		if(M('weixin_huifu')->delete(I('get.id'))){
		
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
	public function setappid(){
		if(M('weixin_appid')->save(I('post.'))){
			$this->success('修改成功');
		}else{
			$this->error('修改失败，内容没有改变');
		}
	}
	public function menu(){
		
		if($this->ispost()){
		if(I('post.pid')==0){
		$con=count(M('weixin_menu')->where('pid=0')->select());
		if($con==3){
			$this->error('最多只能添加3个主菜单');
		}
		}		
		if(M('weixin_menu')->add(I('post.'))){
			$this->success('添加成功',U('/Admin/Weixin/index'));
		}else{
			$this->error('添加失败');
		}
		}else{
		$pid=I('id',0,'intval');
		$this->pid=$pid;
			$this->appid=M('weixin_appid')->find();
		$this->me=M('weixin_menu')->find($pid);
		$this->display();
		}
	}
	public function sortcate(){
		$db = M('weixin_menu');
		foreach ($_POST as $id=>$sorts){
			$db->where(array( 'id'=>$id))->setField('sorts',$sorts);		
	}
	$this->success('排序已改变');
	}
	
	public function xmenu(){
		if($this->ispost()){
			if(M('weixin_menu')->save(I('post.'))){
				$this->success('修改成功',U('/Admin/Weixin/index'));
			}else{
				$this->error('修改失败');
			}
		}else{
		$id=I('id',0,'intval');
		$this->men=M('weixin_menu')->find($id);
		$this->display();
		}
	}
	public function delmenu(){
		if(M('weixin_menu')->delete(I('get.id'))){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
}