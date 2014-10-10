<?php

class ShowAction extends CommAction {
	
	public function index(){
		$id=htmlspecialchars(addslashes(I('get.id')),ENT_QUOTES);
		if(inject_check($id)){
			$this->error('非法数据');
		}
	
		$info=M('info')->find($id);	
		if(empty($info)){
				header('HTTP/1.1 404 Not Found'); 
				header('status: 404 Not Found');
				Header("Location: ".C('domain'));
			}
			
	$cid=$info['cid'];
	
		
			$tags=M('tags')->where(array('pid'=>$id))->field('tags,url')->select();			
				foreach($tags as $v){					
					$tag.="<a href=".U('/tag/'.$v['url']).">".$v['tags']."</a>";
				}
		$this->tag=$tag;	
		$diy=M('diy')->where(array('pid'=>$id))->select();		
		$this->diylist=$diy;	
		
		$incate=M('cate')->where(array('id'=>$cid))->find();
		
		if($incate['pid']=="0"){
			$daohan='<a href="'.U('/'.$incate['url']).'">'.$incate['catename'].'</a>';
		}else{			
			$fucate=M('cate')->where(array('pid'=>$incate['pid']))->find();
			
			$daohan='<a href="'.U('/'.$fucate['url']).'">'.$fucate['catename'].'</a> > <a href="'.U('/'.$incate['url']).'">'.$incate['catename'].'</a>';
		
		}
	
		
		M('info')->where(array('id'=>$id))->setInc('hits',1);
		$cate=M('cate')->find($info['cid']);
		$this->book=M('book')->where(array('infoid'=>$id))->where('status=1')->order('id desc')->select();
		$prevs=M('info')->where("cid={$cid} and id < {$id}")->limit(1)->field('id,name')->order("id desc")->select();

		if(empty($prevs)){
			$prev['name']="没有了";
					$prev['url']=U('/'.$id);
		}else{
		$prev['name']=$prevs[0]['name'];
				$prev['url']=U('/'.$prevs[0]['id']);
		}
		
		$nexts=M('info')->where("cid={$cid} and id > {$id}")->order('id asc')->field('id,name')->limit(1)->select();
		if(empty($nexts)){
		$next['url']=U('/'.$id);
		$next['name']="没有了";
		}else{		
		$next['url']=U('/'.$nexts[0]['id']);
		$next['name']=$nexts[0]['name'];
		}	
		$this->prev=$prev;
		$this->next=$next;
		$this->daohan=$daohan;	
		$this->title=$info['name'];	
		$this->seotitle=$info['title'];	
		$this->infoid=$id;	
		$this->key=$info['key'];	
		$this->desc=$info['desc'];	
		$this->content=$info['content'];	
		$this->istop=$info['istop'];	
		$this->cid=$info['cid'];	
		$this->isrec=$info['isrec'];	
		$this->isrev=$info['isrev'];	
		$this->ispic=$info['ispic'];	
		$this->pic=$info['pic'];	
		$this->hits=$info['hits'];	
		$this->revs=$info['revs'];	
		$this->author=$info['author'];	
		$this->time=$info['time'];	
		$this->price=$info['price'];	
		$this->pcs=$info['pcs'];	
		$this->cateurl=U('/'.$cate['url']);	
		$this->catename=$cate['catename'];	
		if($info['temp']){
		$this->display(':'.$info['temp']);
		}else{
		$this->display(':show');
		}
		
	}


}