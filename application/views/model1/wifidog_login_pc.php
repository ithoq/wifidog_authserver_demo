<!DOCTYPE HTML>
<html >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
	<title>wifidog认证登录</title>
 
	<!--- CSS --->
	<link rel="stylesheet" href="/images/css/style.css" type="text/css" />
 
 
	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->
 
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="fallback.css" /></noscript>
	<![endif]-->
 
	</head>
 
	<body>
		<div id="container">
          
			<?php echo form_open( "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],array('id'=>'myform')); ?>
		
            
                <input type="hidden" name="gw_address" value="<?php echo empty($gw_address)?'':$gw_address;?>">
                <input type="hidden" name="gw_port" value="<?php echo empty($gw_port)?'':$gw_port;?>">
                <input type="hidden" name="gw_id" value="<?php echo empty($gw_id)?'':$gw_id;?>">
                <input type="hidden" name="url" value="<?php echo empty($url)?'':$url;?>">
                <div class="login">认证登录</div>
				<div class="username-text">用户名：</div>
				<div class="password-text">密码：</div>
				<div class="username-field">
					<input type="text" name="username" value="" />
				</div>
				<div class="password-field">
					<input type="password" name="password" value="" />
				</div>
				
				<input type="submit" name="submit" value="确定" />
			</form>
		</div>
		
	</body>
</html>