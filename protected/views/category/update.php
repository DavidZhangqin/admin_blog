<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Category', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-plus"></i> Create Category', 'url'=>array('create')),
    array('label'=>'<i class="icon icon-remove"></i> Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->category_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Update Category <?php echo $model->category_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>