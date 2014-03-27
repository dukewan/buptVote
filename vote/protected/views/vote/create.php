<?php
/* @var $this VoteController */
/* @var $model Vote */

$this->breadcrumbs=array(
	'Votes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Vote', 'url'=>array('index')),
	array('label'=>'Manage Vote', 'url'=>array('admin')),
);
?>

<h1>Create Vote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>