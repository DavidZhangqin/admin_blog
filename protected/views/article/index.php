<?php
/* @var $this ArticleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Articles',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-plus"></i> Create Article', 'url'=>array('create')),
);
?>
<style>
.pagination>ul>li>a{line-height: 34px;}
</style>

<h1>Articles</h1>

<br>
<?php $this->widget('application.components.widgets.tableGenerate', array(
    'settings' => $settings,
    'offset' => $offset,
    'totalCount' => $totalCount,
    'columns' => $columns,
    'datas' => $datas,
)); ?>