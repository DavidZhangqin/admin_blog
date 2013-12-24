<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256, 'class'=>"span3")); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>20, 'cols'=>50, 'class'=>"span5")); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',Category::Model()->getCategoryOptions(),array('class'=>"span3")); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php if($model->isNewRecord){ ?>
			<input class="span3" size="60" name="Article[tags]" id="article_tags" type="text" >
		<?php } else {
			$tmp_tags = array();
			foreach ($model->tags as $key => $value) {
				$tmp_tags[] = $value['name'];
			}
			$tags = implode("; ", $tmp_tags);
		?>
			<input class="span3" size="60" name="Article[tags]" id="article_tags" type="text" value="<?php echo $tags; ?>">
		<?php } ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_post'); ?>
		<?php echo $form->radioButtonList($model,'is_post', array('1'=>'POST','0'=>'NOT POST'),
			array('template'=>'{input}{label}','labelOptions'=>array('style'=>'display:inline-block'))); ?>
		<?php echo $form->error($model,'is_post'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->