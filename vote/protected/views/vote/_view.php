<?php
/* @var $this VoteController */
/* @var $data Vote */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->vote_id), array('view', 'id'=>$data->vote_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_time')); ?>:</b>
	<?php echo CHtml::encode($data->vote_time); ?>
	<br />


</div>