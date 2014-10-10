<?php 
class WeixinAction extends Action{
 	public function _initialize(){	
	if($echoStr = htmlspecialchars(addslashes($_GET["echostr"]),ENT_QUOTES)){
				$echoStr = htmlspecialchars(addslashes($_GET["echostr"]),ENT_QUOTES);
				$signature = htmlspecialchars(addslashes($_GET["signature"]),ENT_QUOTES);
				$timestamp = htmlspecialchars(addslashes($_GET["timestamp"]),ENT_QUOTES);
				$nonce = htmlspecialchars(addslashes($_GET["nonce"]),ENT_QUOTES);					
				$token = 'pcwap';
				$tmpArr = array($token, $timestamp, $nonce);
				sort($tmpArr);
				$tmpStr = implode( $tmpArr );
				$tmpStr = sha1( $tmpStr );
				//valid signature , option
				if($tmpStr == $signature){
					echo $echoStr;
					exit;
				}
			}
	}

	//服务号自定义菜单
	public function menu(){
			$appid=M('weixin_appid')->find();
		
			header("Expires:Mon,26Jul199705:00:00GMT");
			header("Pragma:no-cache");
			//设置编码
			header("Content-Type:text/html;charset=utf-8");
			//获取远程文件内容
				$wxurl='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid['appid'].'&secret='.$appid['secret'];
				$chw = curl_init();
				curl_setopt($chw, CURLOPT_URL, $wxurl);
				curl_setopt($chw, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($chw, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($chw, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');				
				curl_setopt($chw, CURLOPT_RETURNTRANSFER, true);
				$tmpInfo = curl_exec($chw);
				if (curl_errno($chw)) {
				echo 'Errno'.curl_error($chw);
				}
				curl_close($chw);			
			$arr=json_decode($tmpInfo,true);	
			
			$post = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$arr['access_token'];	
					
			$data = '{"button":[';
			$class = M('weixin_menu')->where(array('pid'=>0))->limit(3)->order('sorts desc')->select();
			$i = 1;
			foreach($class as $key=>$vo){
				//main menu
				$data .= '{"name":"'.$vo['title'].'",';
				$c = M('weixin_menu')->where(array('pid'=>$vo['id']))->limit(5)->order('sorts desc')->select();
				$count = M('weixin_menu')->where(array('pid'=>$vo['id']))->limit(5)->order('sorts desc')->count();
				//sub menu
				if($c != false){
					$data .= '"sub_button":[';
				}else{
					if ($vo['leixin'] == "1") {
						$data .= '"type":"click","key":"'.$vo['keys'].'"';
					} elseif($vo['leixin'] == "0") {
						$data .= '"type":"view","url":"'.$vo['url'].'"';
					}
				}
				$i = 1;
				foreach($c as $voo){
					if($i == $count){
						if ($voo['leixin'] == "1") {
							$data .= '{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keys'].'"}';
						} elseif($voo['leixin'] == "0") {
							$data .= '{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['url'].'"}';
						}
					}else{
						if ($voo['leixin'] == "1") {
							$data .= '{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keys'].'"},';
						} elseif($voo['leixin'] == "0") {
							$data .= '{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['url'].'"},';
						}
					}
					$i++;
				}
				if($c!=false){
					$data .= ']';
				}
				if($key < 2){
					$data .= '},';
				}elseif($key == 2){
					$data .= '}';
				}
			}
			$data .= ']}';			
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $post);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$tmpInfo = curl_exec($ch);
				if (curl_errno($ch)) {
				echo 'Errno'.curl_error($ch);
				}
				curl_close($ch);
				$menuback = json_decode ($tmpInfo,true);
				$this->success('[返回编号：'.$menuback['errcode'].']'.'返回代码：['.$menuback['errmsg'].']');
				
	}
	
	
	
	
	public function index(){
					
					$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];	
					if (!empty($postStr)){                
					$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
					$fromUsername = trim($postObj->FromUserName);
					$toUsername = trim($postObj->ToUserName);
					$keyword = trim($postObj->Content);
					$image = trim($postObj->PicUrl);
					$Location_X = trim($postObj->Location_X);
					$Location_Y = trim($postObj->Location_Y);
					$Scale = trim($postObj->Scale);
					$Label = trim($postObj->Label);
					$Title = trim($postObj->Title);
					$Description = trim($postObj->Description);
					$Url = trim($postObj->Url);
					if( trim($postObj->Content)){				
					    $Msgtype = "text";					
					}
					if(trim($postObj->PicUrl)){						
						$Msgtype = "image";						
					}
					if(trim($postObj->Recognition)){						
						$Msgtype = "voice";
					}
					if(trim($postObj->ThumbMediaId)){						
						$Msgtype = "video";
					}
					if(trim($postObj->Label)){						
						$Msgtype = "location";						
					}
					if(trim($postObj->Url)){						
						$Msgtype = "link";						
					}					
					$time = trim($postObj->CreateTime);
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
			
							
							
				
//事件推送------------------------------------------------------------------------------------------------
				$ev = trim($postObj->Event);	
					
				if($ev == "subscribe")
				{	
					$event=M('weixin_gz')->where("leixin=1 and star=1")->find();
					if($event){
						$msgType = "text";
						$contentStr = $event['text'];
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}else{						
						$wx=M('weixin_gz')->where("leixin=0 and star=1")->select();
						$newsxml = "<xml><ToUserName><![CDATA[".$fromUsername."]]></ToUserName><FromUserName><![CDATA[".$toUsername."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>".count($wx)."</ArticleCount><Articles>%s</Articles></xml>";
						$itemxml = "";
						foreach ($wx as $key => $value) {
							$itemxml .= "<item>";
							$itemxml .= "<Title><![CDATA[{$value['title']}]]></Title><Description><![CDATA[{$value['title']}]]></Description><PicUrl><![CDATA[".C('domain')."{$value['pic']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url>";
							$itemxml .= "</item>";
						}
						$resultStr = sprintf($newsxml, $itemxml);
						echo $resultStr;					
					}
					
					
				}	
				//菜单点击回复
			
				$menumsgtype = trim($postObj->MsgType);
				$EventKey = trim($postObj->EventKey);
				if($ev=='CLICK'){
						$key=M('weixin_huifu')->where(array('key'=>$EventKey,'star'=>1,'leixin'=>1))->find();
						$tu=M('weixin_huifu')->where(array('key'=>$EventKey,'star'=>1,'leixin'=>0))->select();
						if($key){							
								$msgType = "text";
								$contentStr = $key['text'];
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;
							}elseif($tu){								
								$newsxml = "<xml><ToUserName><![CDATA[".$fromUsername."]]></ToUserName><FromUserName><![CDATA[".$toUsername."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>".count($tu)."</ArticleCount><Articles>%s</Articles></xml>";
								$itemxml = "";
								foreach ($tu as $key => $value) {
									$itemxml .= "<item>";
									$itemxml .= "<Title><![CDATA[{$value['title']}]]></Title><Description><![CDATA[{$value['title']}]]></Description><PicUrl><![CDATA[".C('domain')."{$value['pic']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url>";
									$itemxml .= "</item>";
								}
								$resultStr = sprintf($newsxml, $itemxml);
								echo $resultStr;
							
							}
						
						}
				if($keyword)
					{
						$key=M('weixin_huifu')->where(array('key'=>$keyword,'star'=>1,'leixin'=>1))->find();
						$tu=M('weixin_huifu')->where(array('key'=>$keyword,'star'=>1,'leixin'=>0))->select();
						if($key){							
								$msgType = "text";
								$contentStr = $key['text'];
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;
							}elseif($tu){								
								$newsxml = "<xml><ToUserName><![CDATA[".$fromUsername."]]></ToUserName><FromUserName><![CDATA[".$toUsername."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>".count($tu)."</ArticleCount><Articles>%s</Articles></xml>";
								$itemxml = "";
								foreach ($tu as $key => $value) {
									$itemxml .= "<item>";
									$itemxml .= "<Title><![CDATA[{$value['title']}]]></Title><Description><![CDATA[{$value['title']}]]></Description><PicUrl><![CDATA[".C('domain')."{$value['pic']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url>";
									$itemxml .= "</item>";
								}
								$resultStr = sprintf($newsxml, $itemxml);
								echo $resultStr;
							
							}
						
						}else{
							$event=M('weixin_gz')->where("leixin=1 and star=1")->find();
							if($event){
								$msgType = "text";
								$contentStr = $event['text'];
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;
							}else{						
								$wx=M('weixin_gz')->where("leixin=0 and star=1")->select();
								$newsxml = "<xml><ToUserName><![CDATA[".$fromUsername."]]></ToUserName><FromUserName><![CDATA[".$toUsername."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>".count($wx)."</ArticleCount><Articles>%s</Articles></xml>";
								$itemxml = "";
								foreach ($wx as $key => $value) {
									$itemxml .= "<item>";
									$itemxml .= "<Title><![CDATA[{$value['title']}]]></Title><Description><![CDATA[{$value['title']}]]></Description><PicUrl><![CDATA[".C('domain')."{$value['pic']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url>";
									$itemxml .= "</item>";
								}
								$resultStr = sprintf($newsxml, $itemxml);
								echo $resultStr;					
							}
							
						}
					
                }

        }		
	}
?>