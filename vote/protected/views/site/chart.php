<!DOCTYPE html>
<html>
<head>
	<title>创新实践投票</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/chart.min.css">
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
<div id="container">
	<div id="left">
	</div>
	<div id="right">
		<div id='url' data-url="<?php echo Yii::app()->createUrl('project/top10');?>"></div>
		<canvas id="myChart" width="990" height="560"></canvas>
		<div class="row">
			<div class="column grid_1" id='label_name_1'>
			</div>
			<div class="column grid_1" id='label_name_2'>
			</div>
			<div class="column grid_1" id='label_name_3'>
			</div>
			<div class="column grid_1" id='label_name_4'>
			</div>
			<div class="column grid_1" id='label_name_5'>
			</div>
			<div class="column grid_1" id='label_name_6'>
			</div>
			<div class="column grid_1" id='label_name_7'>
			</div>
			<div class="column grid_1" id='label_name_8'>
			</div>
			<div class="column grid_1" id='label_name_9'>
			</div>
			<div class="column grid_1" id='label_name_10'>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.latest.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/mychart.js"></script>
</body>
</html>