<?php

class TagsAction extends CommAction {
    public function index(){
		if($this->ispost()){
			
			if($_POST['del']==1){
				$i=0;
				while($i<=count($_POST['id'])){
					$arr=M('tags')->delete($_POST['id'][$i]);					
					$i++;
				}
				$this->success('修改成功');
			}
			
			}else{
		$count=M('tags')->count();
		import('Class.Page',LIB_PATH);// 导入分页类		
		$count      = M('info')->count();// 查询满足要求的总记录数
		$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数		
		$Page->url =GROUP_NAME.'/Tags/index/p/';
		$this->page = $Page->show();	
		$this->tags=M('Tags')->order('hits DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
	
		$this->display();
	}
	
	}
}