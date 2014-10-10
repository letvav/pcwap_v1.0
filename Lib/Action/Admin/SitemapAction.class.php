<?php

class SitemapAction extends CommAction {
	
	public function index(){
		
		$info=M('info')->field('id,infoname,pic,istop')->order('id desc')->select();
		$cate=M('cate')->field('id,catename,catelogo,url')->order('id desc')->select();		
		$tags=M('tags')->field('id,tags,url')->order('id desc')->select();		
		$sitemap='<?xml  version="1.0" encoding="utf-8"?><urlset  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"  >';
		$sitemap.='<url><loc>'.C('domain').'</loc><changefreq>daily</changefreq><priority>1.0</priority></url>';
			foreach($cate as $c){
				
				$sitemap.='<url>';
				$sitemap.='<loc>'.C('domain').U('/'.$c['url']).'</loc>';
				if($in['pic']){
					$sitemap.='<image:image><image:loc>'.C('domain').$c['pic'].'</image:loc></image:image>';
				}
				$sitemap.='<changefreq>daily</changefreq>';				
				$sitemap.='<priority>0.9</priority>';				
				$sitemap.='</url>';
			}
				
			foreach($info as $in){
				
				$sitemap.='<url>';
				$sitemap.='<loc>'.C('domain').U('/'.$in['id']).'</loc>';
				if($in['pic']){
					$sitemap.='<image:image><image:loc>'.C('domain').$in['pic'].'</image:loc></image:image>';
				}
				$sitemap.='<changefreq>daily</changefreq>';
				if($in['istop']){
				$sitemap.='<priority>0.8</priority>';
				}else{
					$sitemap.='<priority>0.5</priority>';	
				}
				$sitemap.='</url>';
			}
			foreach($tags as $tag){
				
				$sitemap.='<url>';
				$sitemap.='<loc>'.C('domain').U('/tag/'.$tag['url']).'</loc>';
				
				$sitemap.='<changefreq>daily</changefreq>';				
					$sitemap.='<priority>0.5</priority>';				
				$sitemap.='</url>';
			}
			
			
		
		$sitemap.='</urlset>';
		$confpath =APP_PATH.'sitemap.xml';
		$webconfig = @fopen($confpath,w);
		if($webconfig){
			$fwrite=fwrite($webconfig,$sitemap);
			
			echo 'sitemap生成成功：<a href="'.$confpath.'">'.$confpath.'</a>';
			
		}else{
			$this->error('网站根目录没有写入权限！');
		}
	}
	
		
}