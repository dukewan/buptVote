	<?php 
		$color=array('green','yellow','red','purple','blue');
		$school=array(
				'信通'=>'tel',
				'计算机'=>'cs',
				'自动化'=>'auto',
				'电子'=>'ele',
				'理学院'=>'math',
				'经管'=>'enc',
				'人文'=>'hum',
				'国际'=>'int',
				'软件'=>'soft',
				'数媒'=>'med',
				'光研'=>'light',
				'七维亦影'=>'seven',
				'团委'=>'tuan',
				'创展服务'=>'sys',
			);
	?>
	<div id="header">
		<div id="top10">
			<div id="top10_left">
				<?php for($i = 0;$i <= 4 && !empty($top10[$i]);++$i) { ?>
				<div class="item">
					<div class="item_no <?php echo $color[$i%5];?>">
						编号：<?php echo $top10[$i]->project_no;?>
					</div>
					<div class="item_ticket <?php echo $color[$i%5];?>">
						票数：<?php if($top10[$i]->project_ticket < 17000 ) echo $top10[$i]->project_ticket; else echo '17000';?>
					</div>
					<div class="item_name" title="<?php echo $top10[$i]->project_name;?>">
						<?php echo Helper::truncate_utf8_string($top10[$i]->project_name,20);?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id="top10_right">
				<?php for($i = 5;$i <= 9 && !empty($top10[$i]);++$i) { ?>
				<div class="item">
					<div class="item_no <?php echo $color[$i%5];?>">
						编号：<?php echo $top10[$i]->project_no;?>
					</div>
					<div class="item_ticket <?php echo $color[$i%5];?>">
						票数：<?php if($top10[$i]->project_ticket < 17000 ) echo $top10[$i]->project_ticket; else echo '17000';?>
					</div>
					<div class="item_name" title="<?php echo $top10[$i]->project_name;?>">
						<?php echo Helper::truncate_utf8_string($top10[$i]->project_name,20);?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="login" data-logged='<?php echo Yii::app()->user->id?1:0;?>'>
			<?php if(!Yii::app()->user->id) : ?>
			<div id="login_form">
				<div id="student_no">
					<input type='text' id="input_name" name="username" placeholder="请输入您的学号/工号">
				</div>
				<div id="identity">
					<input type='text' id="input_psw" name="password" placeholder="请输入您的身份证号">
				</div>
			</div>
			<div id="button_box">
				<button  class='btn btn-large' id="login_btn" data-url="<?php echo Yii::app()->createUrl('site/login');?>">登录</button>
			</div>
			<?php endif ?>
			<?php 
			if(Yii::app()->user->id) :?>
			<div id='user_info' >
				<span class='user_name'><?php echo $user->name; ?> </span><br/>
				您还剩余&nbsp;<span class='left_ticket' id='left_ticket'><?php echo $user->left_ticket; ?></span>&nbsp;票<br/>
				<span id='login_text'>赶紧投票支持你喜欢的项目吧！</span>
			</div>
			<div id='button_box'>
				<?php if($user->user_name == '10211324') : ?>
					<button class='btn btn-large' onclick="redirect('<?php echo Yii::app()->createUrl('site/logout')?>')">注销</button>
					<button class='btn btn-large' onclick="redirect('<?php echo Yii::app()->createUrl('site/chart')?>')">Go</button>
				<?php else :?>
					<button class='btn btn-large' onclick="redirect('<?php echo Yii::app()->createUrl('site/logout')?>')">注销登录</button>
				<?php endif ?>
			</div>
			<?php endif ?>
		</div>
	</div>
	<div id="content" data-voteurl='<?php echo Yii::app()->createUrl('vote/create');?>'>
		<?php if(Yii::app()->user->id): ?>
		<div id="left_ticket_box">
			<div id="left_ticket_box_text"><?php  echo $user->left_ticket; ?></div>
		</div>
		<?php else :?>
		<div id="left_ticket_box" class="bubble" style="display:none;">
			<div id="left_ticket_box_text"></div>
		</div>
		<?php endif ?>
		<div id="search_bar" class="search_bar">
			<div id="school_box">
				<div id="school_all">
					<span class='btn btn-large choose active' data-toggle='button' id="all">全部</span>
				</div>
				<div id="school_left" class="school_left2">
				</div>
				<div id="school_middle">
					<span class='btn btn-large choose' id="tel">信通院</span>
					<span class='btn btn-large choose' id="cs">计算机</span>
					<span class='btn btn-large choose' id="auto">自动化</span>
					<span class='btn btn-large choose' id="ele">电子院</span>
					<span class='btn btn-large choose' id="math">理学院</span>
					<span class='btn btn-large choose' id="hum">人文院</span>
					<span class='btn btn-large choose' id="enc">经管院</span>
				</div>
				<div id="school_right" class="school_right">
				</div>
			</div>
			<div id="search_box">
				<div id="search_input">
					<input type='text' id="search_keyword" placeholder="请输入项目编号">
				</div>
				<div id="search_a">
					<span id="search_go" class='btn btn-large'>搜索</span>
				</div>
			</div>
		</div>
		<div class="row">
		<?php for($i = 0;!empty($projects[$i]);$i=$i+5) { ?>
			<?php for($j = $i;$j < $i+5 && !empty($projects[$j]);++$j) { ?>
			<div id="<?php echo "project_".$projects[$j]->project_no;?>" class="column grid_1 project_box all <?php echo $school[$projects[$j]->project_school];?>">
				<div class="project_logo">
					<?php 
						$src=Yii::app()->request->baseUrl."/images/logo/logo_".$projects[$j]->project_logo.".jpg";
						if(empty($projects[$j]->project_logo))
						{
							$src=Yii::app()->request->baseUrl."/images/logo/logo.png";
						}
						echo "<img src=".$src." alt='".$projects[$j]->project_name."'  title='".$projects[$j]->project_name."' />";
					?>
				</div>
				<div class="project_info" >
					<div class="project_no">
						编号：<?php echo $projects[$j]->project_no;?>
					</div>
					<div class="project_name" title="<?php echo $projects[$j]->project_name;?>">
						名称：<?php echo Helper::truncate_utf8_string($projects[$j]->project_name,23);?>
					</div>
				</div>
				<div class="vote_box">
					<div class="vote_button">
						<?php if(Yii::app()->user->id && $user->checkVoted($projects[$j]->project_id)) :?>
							<button class="btn btn-success disabled" id="btn<?php echo $projects[$j]->project_id;?>" >已投</button>
						<?php else : ?>
							<button class="btn" id="btn<?php echo $projects[$j]->project_id;?>" onclick="vote(<?php echo $projects[$j]->project_id;?>)">投票</button>
						<?php endif ?>
					</div>
					<div class="vote_ticket green" id="ticket<?php echo $projects[$j]->project_id;?>">
						<?php if($projects[$j]->project_ticket < 17000) echo $projects[$j]->project_ticket; else echo '17000';?>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		</div>
	</div>
