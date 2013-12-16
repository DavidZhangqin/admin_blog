<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Article', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-plus"></i> Create Article', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-pencil"></i> Update Article', 'url'=>array('update', 'id'=>$model->article_id)),
	array('label'=>'<i class="icon icon-remove"></i> Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->article_id),'confirm'=>'Are you sure you want to delete this item?')),
);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/prettify/run_prettify.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/common.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/prettify/prettify.js", CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/js/prettify/prettify.css");
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/code.css");

?>
<style type="text/css">
.blog-content {border:1px solid #C9E0ED; padding:10px;}
.push-right {float:right;}
/*pre {border:1px solid #C9E0ED; padding:10px;}*/
/*pre.prettyprint {background: #fefbf3;padding: 9px;border: 1px solid rgba(0,0,0,.2);}*/
</style>

<h1>#<?php echo $model->article_id . " " . $model->title; ?></h1>
<h5>category: <?php echo $model->category->name; ?></h5>
<h5>tags: <?php echo $model->tags; ?></h5>

<div class="blog-content">
<?php echo $model->content; ?>
</div>
<div class="push-right">
	read count: <?php echo $model->read_count; ?>
</div>
