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
	<div id="vote_header">
		<div id="vote_header_info">
			<div id="vote_header_username" data-logged="<?php if(isset($user)) echo '1'; else echo '0';?>">
				<?php if(isset($user)) echo $user->name; ?>，您还剩余&nbsp;<span id="left_ticket" class="red_text"><?php if(isset($user)) echo $user->left_ticket; ?></span>&nbsp;票
			</div>
			<?php echo CHtml::link('<div id="vote_header_logout">注销</div>',$this->createUrl('site/logout',array('type'=>2)));?>
		</div>
		<div id="vote_header_bar">
		</div>
	</div>
	<div id="vote_content" data-voteurl='<?php echo $this->createUrl('vote/create');?>'>
		<div id="vote_search">
			<div id="search_input">
				<input id='search_inp' type="text" placeholder="请输入项目编号"  />
			</div>
			<div id="search_btn" data-searchurl='<?php echo $this->createUrl('site/mobilesearch');?>'>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mobile/search_icon.png">
			</div>
		</div>
		<div id="project_content">
			<?php 
			$color=array('blue','purple','green','yellow','red');
			foreach ($project as $key => $value) :?>
			<div class="vote_box">
				<div class="column vote_box_project">
					<div class="column project_no <?php echo $color[$key%5];?>_text">编号：<?php echo $value->project_no;?></div>
					<div class="column project_ticket <?php echo $color[$key%5];?>_text">
						<span id="ticket<?php echo $value->project_id?>"><?php echo $value->project_ticket?></span>
						票
					</div>
					<div class="column project_name "><?php echo $value->project_name?> </div>
				</div>
				<div id="btn<?php echo $value->project_id?>" class="column vote_btn white_text <?php echo $color[$key%5];?>_background" onclick="vote(<?php echo $value->project_id?>)">投票</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/zepto.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/mobile_vote.min.js"></script>
</body>
</html>