<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-plus"></i> Create Category', 'url'=>array('create')),
);
?>

<h1>Categories</h1>

<?php $this->widget('application.components.widgets.tableGenerate', array(
    'settings' => $settings,
    'offset' => $offset,
    'totalCount' => $totalCount,
    'columns' => $columns,
    'datas' => $datas,
)); ?>
