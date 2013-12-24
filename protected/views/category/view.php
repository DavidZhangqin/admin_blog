<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categories'=>array('index'),
    $model->name,
);

$this->menu=array(
    array('label'=>'<i class="icon icon-list"></i> List Category', 'url'=>array('index')),
    array('label'=>'<i class="icon icon-plus"></i> Create Category', 'url'=>array('create')),
    array('label'=>'<i class="icon icon-pencil"></i> Update Category', 'url'=>array('update', 'id'=>$model->category_id)),
    array('label'=>'<i class="icon icon-remove"></i> Delete Category', 'url'=>'#', 'linkOptions'=>array('onclick'=>"del(".$model->category_id.", '/category/delete')")),
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
