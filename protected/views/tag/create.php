<?php
/* @var $this TagController */
/* @var $model Tag */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Tag', 'url'=>array('index')),
);
?>

<h1>Create Tag</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>