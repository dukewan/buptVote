<?php
/* @var $this VoteController */
/* @var $model Vote */

$this->breadcrumbs=array(
	'Votes'=>array('index'),
	$model->vote_id,
);

$this->menu=array(
	array('label'=>'List Vote', 'url'=>array('index')),
	array('label'=>'Create Vote', 'url'=>array('create')),
	array('label'=>'Update Vote', 'url'=>array('update', 'id'=>$model->vote_id)),
	array('label'=>'Delete Vote', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->vote_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vote', 'url'=>array('admin')),
);
?>

<h1>View Vote #<?php echo $model->vote_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'vote_id',
		'project_id',
		'user_id',
		'vote_time',
	),
)); ?>
