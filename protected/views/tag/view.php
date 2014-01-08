<?php
/* @var $this TagController */
/* @var $model Tag */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Tag', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-plus"></i> Create Tag', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-pencil"></i> Update Tag', 'url'=>array('update', 'id'=>$model->tag_id)),
	array('label'=>'<i class="icon icon-remove"></i> Delete Tag', 'url'=>'#', 'linkOptions'=>array('onclick'=>"del(".$model->tag_id.", '/tag/delete')")),
);
?>

<h1><?php echo $model->name; ?></h1>
<br>
<h4>Articles:</h4>
<?php $this->widget('application.components.widgets.tableGenerate', array(
    'settings' => $settings,
    'offset' => $offset,
    'totalCount' => $totalCount,
    'columns' => $columns,
    'datas' => $datas,
)); ?>
