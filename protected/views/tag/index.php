<?php
/* @var $this TagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tags',
);

$this->menu=array(
	array('label'=>'Create Tag', 'url'=>array('create')),
);
?>

<h1>Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
