<?php 

if (file_exists('../Conf/pcwap.php')) {
header("Content-type: text/html; charset=utf-8");
	echo "你已经安装过了！要重装请删除Conf目录下的pcwap.php";
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>PCWAP管理系统</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../Tpl/Admin/Public/css/bootcss.css">
    <link rel="stylesheet" href="../Tpl/Admin/Public/css/style.css">
	<script src="../Tpl/Admin/Public/js/jquery.min.js"></script>
    <script src="../Tpl/Admin/Public/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="../Tpl/Admin/Public/js/html5shiv.min.js"></script>
        <script src="../Tpl/Admin/Public/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div style="height:50px; float:left; width:100%;"></div>
  <div class="row">
  <div  class="col-md-8 col-md-offset-2">
  <div class="panel panel-info">   
	  <div class="panel-heading">欢迎使用PCWAP程序！程序作者：预感，QQ:476905668，官方网址：www.pcwap.cn</div>
	
	    <div class="panel-body">
		    <div class="alert alert-warning alert-dismissable hidden" id="tishi">
		
			</div>
	<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#home" data-toggle="tab">正在安装...</a></li>
		  
		</ul>

<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane active" id="home">
		  <div class="panel-body">
			<?php
			
	
				
					@header("content-Type: text/html; charset=utf-8");
				
					$host = trim($_POST['DB_HOST']).':'.trim($_POST['DB_PORT']);
					$user = trim($_POST['DB_USER']);
					$pwd = trim($_POST['DB_PWD']);					
					$data_base = trim($_POST['DB_NAME']);
					$conn = mysql_connect($host,$user,$pwd);
					if (!$conn)
						  {
						  die('数据库链接失败： ' . mysql_error());
						  }				
					$db_crac=mysql_query("CREATE DATABASE IF NOT EXISTS $data_base default charset utf8 COLLATE utf8_general_ci;",$conn);
					
					if (!$db_crac){
							die('数据库创建失败.请手动创建数据库'.mysql_error());						
					}
					$db_selected=mysql_select_db($data_base,$conn);
					if(!$db_selected){
						die('数据库创建失败.请手动创建数据库'.mysql_error());		
					}
									 
					$file_name ="pcwap.sql";					  
					$get_sql_data = file_get_contents($file_name);				
					$explode = explode(";",$get_sql_data);
				
					
					$cnt = count($explode);
					
					for($i=0;$i<$cnt ;$i++){
					
						$sql = $explode[$i];
						
						mysql_query('SET NAMES UTF8');
						@$result =mysql_query($sql);
						if($result){						
							echo "成功:".$i."个插入<br>";
						}
						else
						{
							echo @mysql_error();
						}
					}				
					$peizhi="<?php 
							 return array(
							'DB_TYPE'=>"."'".trim($_POST['DB_TYPE'])."'".",  
							'DB_HOST'=>"."'".trim($_POST['DB_HOST'])."'".", 
							'DB_PORT'=>"."'".trim($_POST['DB_PORT'])."'".", 
							'DB_NAME'=>"."'".trim($_POST['DB_NAME'])."'".", 
							'DB_USER'=>"."'".trim($_POST['DB_USER'])."'".", 
							'DB_PWD'=>"."'".trim($_POST['DB_PWD'])."'".", 
							'DB_PREFIX'=>"."'".trim($_POST['DB_PREFIX'])."'".", 
							'webuser'=>"."'".trim($_POST['webuser'])."'".", 
							'webuserpass'=>"."'".trim($_POST['webuserpass'])."'".",				
							);";
				$confpath ='../Conf/pcwap.php';
				$webconfig = @fopen($confpath,w);
				if($webconfig){
				$fwrite=fwrite($webconfig,$peizhi );			
				if($fwrite > 0){
						echo "配置文件创建成功！"."<br />";
						echo "PCWAP程序已成功安装！"."<br />";
						echo "<a href=\"../index.php?s=/Admin\">进入后台</a>";
						@file_get_contents('http://www.pcwap.cn/tongji.php?url='.$_SERVER["HTTP_HOST"]); 						
					}
				}
				else{
					echo "配置文件生成失败，请检查根目录是否可写！";
				}
			
			
			?>
		  </div>
		  
		
		
		
		</div>
			
		</div>
 </div>
 </div>
 </div>
 


  </body>
</html>

