<!DOCTYPE html>
<html>
<head>
	<title>创新实践投票</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vote/error.css">
    <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-40802471-1']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	  function redirect (url) {location.href=url;}
	</script>
</head>
<body>
	<div class="error" onclick="redirect('<?php echo Yii::app()->createUrl('/');?>')">
	</div>
</body>
</html>