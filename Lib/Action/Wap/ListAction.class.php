<?php
class ListAction extends CommAction {
    public function index(){	
			
		
			$url=htmlspecialchars(addslashes(I('get.url')),ENT_QUOTES);
			
			if(inject_check($id)){
				$this->error('非法操作');
			}			
									
			$tem=M('cate')->where(array('url'=>$url))->find();
			
			if($tem['outurl']){
				Header("HTTP/1.1 301 Moved Permanently");
				Header("Location: ". $tem['outurl']);
			}
			$id=$tem['id'];
			
			if($tem['pid']=='0'){
				
				$daohan='<a href="'.U('/'.$tem['url']).'" >'.$tem['catename'].'</a>';				
			}else{
				$Upcate=M('cate')->find($tem['pid']);
				$daohan='<a href="'.U('/'.$Upcate['url']).'" >'.$Upcate['catename'].'</a> > <a href="'.U('/'.$tem['url']).'" >'.$tem['catename'].'</a>';
				
			}
		
			import("Class.Page",LIB_PATH);			
			
			
				
				$cids=M('cate')->where("pid=$tem[id]")->getField('id',true);
				if($cids){
				$allid=implode(',',$cids).','.$id;
				}else{
					$allid=$id;
				}
				
			
			$count=M('info')->where("cid IN ($allid)")->where(array('isshow'=>1))->order('id desc')->count();
		
			$Page= new Page($count,$tem['catepage']);				
			$list=M('info')->where(array('isshow'=>1))->where("cid IN ($allid)")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();	
			foreach($list as $ke=>$cname){							
				$ccate=M('cate')->find($cname['cid']);				
				$list[$ke]['catename']=$ccate['catename'];		
				$list[$ke]['cateurl']=U('/'.$ccate['url']);	
				$list[$ke]['url']=U('/'.$cname['id']);	
				$tags=M('tags')->where(array('pid'=>$cname['id']))->field('tags')->select();			
				foreach($tags as $v){					
					$list[$ke]['tag'].="<a href=".U('/tag/'.$v['url']).">".$v['tags']."</a>";
				}
				$list[$ke]['diy']=M('diy')->where(array('pid'=>$cname['id']))->select();
				
			}	
			$Page->rollPage = 1;
			$Page->setConfig('theme',"<li>%upPage% </li><li>%downPage%</li>");			
			$Page->url =$url;					
			$show= $Page->show();			
			$this->assign('page',$show);		
			
			
				$catesub=M('cate')->where("pid=$tem[id]")->order('sort DESC')->select();				
			if(empty($catesub)){			
				$catesub=M('cate')->where(array('catetype'=>$tem['catetype'],'pid'=>0))->order('sort DESC')->select();
			}	
				foreach ($catesub as $key=>$dd){
					$catesub[$key]['url']=U('/'.$dd['url']);
				}
			$this->daohan=$daohan;
			$this->catesub=$catesub;		
			$this->list=$list;		
			$this->title=$tem['catename'];		
			$this->p=$_GET['p'];		
			$this->seotitle=$tem['catetitle'];		
			$this->key=$tem['catekey'];		
			$this->desc=$tem['catedesc'];		
			$this->catelogo=$tem['catelogo'];	
			$this->url=U('/'.$tem['url']);
			$this->cate=$tem;
			unset($list);
			if(!isset($tem['catetemp'])){
				$this->display(':'.$tem['catetemp']);				
			}
			if($tem['catetype']=='2'){
				$this->display(':pic_list');
			}			
			if($tem['catetype']=='1'){
				$this->display(':text_list');
			}
			if($tem['catetype']=='3'){
				$this->display(':page');
			}
			
	}		

}