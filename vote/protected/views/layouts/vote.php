<!--
  ________  __      __________  _________ __      __ ________  _________ _______
 /  ____  \|  |    |  |  ____ \|___   ___|  |    / //  ____  \|___   ___|  _____|
 | |	\  |  |    |  | |    \ \   | |   |  |   / / | /    \ |    | |   | |
 | |     | |  |    |  | |    | |   | |   |  |  / /  | |    | |    | |   |  \___
 | |____/ /|  |    |  | |____/ /   | |   |  | / /   | |    | |    | |   |   ___\
 | |    \ \|  |    |  |  _____/    | |   |  |/ /    | |    | |    | |   |   ___/
 | |     | |  |    |  | |          | |   |    /     | |    | |    | |   |  /
 | |____/  |  \____/  | |          | |   |   /      | \____/ |    | |   | |_____
 \________/ \________/|_|          |_|   |__/       \________/    |_|   |_______| ver 1.0

-->
<!DOCTYPE html>
<html>
<head>
	<title>创新实践投票</title>
	<script>
	if(parseInt(screen.width) < 900){location.href="/vote/index.php/site/mobile";}
	if(navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0 || navigator.userAgent.indexOf("MSIE 8.0")>0)
	{alert("推荐使用chrome、safari等现代浏览器 或 ie9及以上浏览，以获得最佳浏览体验~");} 
	</script>
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/vote_pack.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/button.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fancybox/source/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/linkBar.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/tipsy.css">
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
	<?php echo $content;?>
    <div id="linkBar">
        <div class="content">
            <div class="logo" data-color="RGB(252, 106, 151)" data-title="<p class='logoTitle'>北邮创新大本营<br/>极客聚集地</p><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qrcode_inov.jpg' class='qrcode'>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/inov.png">
            </div>
            <div class="logo" data-color="rgb(23, 168, 224)" data-title="<p class='logoTitle'>北邮自习室查询<br/>自习室不难找!</p><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qrcode_buptclass.jpg' class='qrcode'>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/buptclass.png">
            </div>
            <div class="logo" data-color="rgb(176, 73, 245)" data-title="<p class='logoTitle'>北邮公众平台<br/>精彩的生活服务</p><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qrcode_buptinfo.jpg' class='qrcode'>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/buptinfo.png">
            </div>
            <div class="logo" data-color="rgb(104, 76, 68)" data-title="<p class='logoTitle'>TA的故事<br/>北邮同学的访谈录</p><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qrcode_theirstory.jpg' class='qrcode'>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/theirstory.png">
            </div>
        </div>
    </div>
	<div id="footer">
		<div class="info">
		邮箱：office-jiaowu@bupt.edu.cn；传真：010-62285134；电话：010-62282711；地址：北京邮电大学教一楼321； 邮编：100876 <br/>
		北京邮电大学创新实践信息平台 &copy;Copyright 2013<br/>
		<span>Designed by <a target="_blank" href="http://www.renren.com/340409132">刘婷</a> Programed by <a target="_blank" href="http://www.renren.com/336110164">贺乙钊</a> <a target="_blank" href="http://www.damcy.com">马跃</a> <a target="_blank" href="http://www.renren.com/277154906">刘学思</a> @<a target="_blank" href="http://page.renren.com/601107959">北邮百度俱乐部</a></span>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/import_pack.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js "></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fancybox/source/jquery.fancybox.pack.js "></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vote.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/jquery.tipsy.js "></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/linkBar.js "></script>
</body>
</html>