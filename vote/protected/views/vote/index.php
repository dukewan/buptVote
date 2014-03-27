<?php
/* @var $this VoteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Votes',
);

$this->menu=array(
	array('label'=>'Create Vote', 'url'=>array('create')),
	array('label'=>'Manage Vote', 'url'=>array('admin')),
);
?>

<h1>Votes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
