<!doctype html>
<html lang='zh-CN'>
<head>
	<title>创新实践投票</title>
	<script>
	if(navigator.appName == "Microsoft Internet Explorer") 
	{alert("使用非ie浏览器访问才能投票哦~");}
	</script>
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" /> 
	<meta content="telephone=no" name="format-detection" /> 
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/mobile/mobile_index.min.css">
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-40802471-1']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</head>
<body>
	<div id="header">
		<div id="header_bg">
		</div>
	</div>
	<div id="content">
		<div id="login_box_header">
		</div>
		<div id="login_box">
			<div id="input_username" class="login_input">
				<input id="input_name" type="text" placeholder="请输入学号/工号" autocomplete="on">
			</div>
			<div id="input_password" class="login_input">
				<input id="input_psw" type="text" placeholder="请输入身份证号" autocomplete="on">
			</div>
			<div id="login_button">
				<div id="login_btn" data-url="<?php echo Yii::app()->createUrl('site/login');?>">登录</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/zepto.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/mobile_vote.min.js"></script>
</body>
</html>