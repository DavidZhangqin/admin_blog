<?php
/* @var $this TagController */
/* @var $model Tag */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Tag', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-plus"></i> Create Tag', 'url'=>array('create')),
);
?>

<h1>Update Tag <?php echo $model->tag_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>