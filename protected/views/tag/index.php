<?php
/* @var $this TagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tags',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-plus"></i> Create Tag', 'url'=>array('create')),
);
?>

<h1>Tags</h1>
<?php $this->widget('application.components.widgets.tableGenerate', array(
    'settings' => $settings,
    'offset' => $offset,
    'totalCount' => $totalCount,
    'columns' => $columns,
    'datas' => $datas,
)); ?>
