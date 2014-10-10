<?php

class CommAction extends Action {
   	public function _initialize(){		 
		$this->webname=C('webname');
		$this->domain=C('domain');
		$this->webtitle=C('webtitle');
		$this->webkey=C('webkey');
		$this->webdesc=C('webdesc');
		$this->icp=C('icp');
		$this->tel=C('tel');
		$this->fax=C('fax');
		$this->email=C('email');
		$this->qq=get_keywords(C('qq'));		
		$this->address=C('address');
		$this->copyright=C('copyright');
		$this->logo=C('logo');
		$this->lianxi=C('lianxi');
		$wapqian=array_keys(C('APP_SUB_DOMAIN_RULES'));		
			preg_match('/[\w][\w-]*\.(?:com\.cn|com|cn|co|net|org|gov|cc|biz|info)(\/|$)/isU', $_SERVER['HTTP_HOST'], $domain);
			$domianhost=rtrim($domain[0], '/');			
		$this->wapurl='http://'.$wapqian[0].'.'.$domianhost.__SELF__;
		$menu=M('cate')->where("menu='1' and pid='0'")->order('sort ASC')->select();		
		foreach($menu as $k=>$v){
			$menu[$k]['url']=U('/'.$v['url']);
			$sub=M('cate')->where(array('pid'=>$v['id']))->select();				
			foreach ($sub as $c=>$b){			
				$sub[$c]['url']=U('/'.$sub[$c]['url']);			
			}	$menu[$k]['sub']=$sub;	
		}	
		
		$this->menu=$menu;
			if(session('uid')!=false){
				$userinfo=M('user')->where(array('id'=>session('uid')))->find();
				$this->uid=$userinfo['id'];
				$this->username=$userinfo['user'];	
			}
		
	}
		public function _empty(){

	echo '当前操作不存在';

	}

}