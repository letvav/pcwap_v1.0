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
        <script src="/Tpl/Admin/Public/js/html5shiv.min.js"></script>
        <script src="/Tpl/Admin/Public/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div class="row">
  <div  class="col-md-8 col-md-offset-2">
  <div class="panel panel-info">   
	  <div class="panel-heading">欢迎使用PCWAP手机PC同步管理网站程序！程序作者：预感，QQ:476905668，官方网址：www.pcwap.cn</div>
	
	    <div class="panel-body">
		    <div class="alert alert-warning alert-dismissable hidden" id="tishi">
		
			</div>
	<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#home" data-toggle="tab">配置数据库</a></li>
		  
		</ul>

<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane active" id="home">
		  <div class="panel-body">
		  <div class="alert alert-danger" role="alert">
				<p>如果是Nginx服务器请确定Pathinfo已开启！</p>
				<?php  
						if ( !(phpversion() >= '5.2') ){
							$dsb='disabled="disabled"';
							echo '<p>PHP版必须大于5.2</p><br />';
						}
						if ( !is_writable('../Conf/') ){
							$dsb='disabled="disabled"';
							echo '<p>Conf目录不可写</p><br />';
						}
						?>						
						
			</div>
		  	 <form class="form-horizontal" action="installed.php" method="post" role="form">
					<div class="form-group">
						<label for="DB_TYPE" class="col-sm-3 control-label">数据库类型(DB_TYPE):</label>
						<div class="col-sm-4">
						  <input type="DB_TYPE" class="form-control" id="DB_TYPE" name="DB_TYPE" value="mysql"  placeholder="mysql">
						</div>
					</div>
					<div class="form-group">
						<label for="DB_HOST" class="col-sm-3 control-label">主机名(DB_HOST):</label>
						<div class="col-sm-4">
						  <input type="DB_HOST" class="form-control" id="DB_HOST" name="DB_HOST" value="localhost" placeholder="127.0.0.1">
						</div>
					</div>
						<div class="form-group">
						<label for="DB_PORT" class="col-sm-3 control-label">端口号(DB_PORT):</label>
						<div class="col-sm-4">
						  <input type="DB_PORT" class="form-control" id="DB_PORT" name="DB_PORT" value="3306" placeholder="3306">
						</div>
					</div>
						<div class="form-group">
						<label for="DB_NAME" class="col-sm-3 control-label">数据库名(DB_NAME):</label>
						<div class="col-sm-4">
						  <input type="DB_NAME" class="form-control" id="DB_NAME" name="DB_NAME" value="pcwap" placeholder="数据库名">
						</div>
					</div>
						<div class="form-group">
						<label for="DB_USER" class="col-sm-3 control-label">数据库用户名(DB_USER):</label>
						<div class="col-sm-4">
						  <input type="DB_USER" class="form-control" id="DB_USER" name="DB_USER" value="root" placeholder="数据库用户名">
						</div>
					</div>
						<div class="form-group">
						<label for="DB_PWD" class="col-sm-3 control-label">数据库密码(DB_PWD):</label>
						<div class="col-sm-4">
						  <input type="DB_PWD" class="form-control" id="DB_PWD" name="DB_PWD" value="123456" placeholder="数据库密码">
						  <input type="hidden"  name="DB_PREFIX" id="DB_PREFIX" value="az_" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="webuser" class="col-sm-3 control-label">后台管理员账号(webuser):</label>
						<div class="col-sm-4">
						  <input type="webuser" class="form-control" id="webuser" name="webuser" value="pcwap"  placeholder="pcwap">
						</div>
					</div>
					<div class="form-group">
						<label for="webuserpass" class="col-sm-3 control-label">后台管理员密码(webuserpass):</label>
						<div class="col-sm-4">
						  <input type="password" class="form-control" id="webuserpass" name="webuserpass" value="pcwap" placeholder="pcwap">
						</div>
					</div>
			 </div>
		   
		   <div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
						  <button type="submit" class="btn btn-default" <?php echo $dsb; ?> id="post">下一步</button>
						
						</div>
			</div>
			
		  </div>
		  
	
		
		
					</form>
		</div>
			
		</div>
		 <div class="panel-footer">声明：请使用IE8以上浏览器进行安装；首次安装默认没有任何数据内容需要进入后台添加相关数据</div>
 </div>
 


  </body>
</html>

