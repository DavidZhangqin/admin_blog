<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->article_id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->article_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<style type="text/css">
.blog-content {border:1px solid #C9E0ED; padding:10px;}
.push-right {float:right;}
pre {border:1px solid #C9E0ED; padding:10px;}
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
