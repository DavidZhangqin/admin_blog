<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<div class="view">

	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('article_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->article_id), array('view', 'id'=>$data->article_id)); ?>
	<br /> -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->article_id)); ?>
	<br />

	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br /> -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('read_count')); ?>:</b>
	<?php echo CHtml::encode($data->read_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php 
		foreach ($data->tags as $value) {
			echo $value->name." ";
		}
	?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_post')); ?>:</b>
	<?php echo $data->is_post == 0 ? CHtml::encode('NOT POST') : CHtml::encode('POST'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:</b>
	<?php echo CHtml::encode($data->add_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />


</div>