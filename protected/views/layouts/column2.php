<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
  	<div class="span3">
  		<div class="sidebar-nav">
          
  		  <?php $this->widget('zii.widgets.CMenu', array(
    			'encodeLabel'=>false,
    			'items'=>array(
    				array('label'=>'<i class="icon icon-home"></i>  Blog <span class="label label-info pull-right">BETA</span>', 'url'=>'http://blog.com','itemOptions'=>array('class'=>'')),
            array('label'=>'<i class="icon icon-envelope"></i> Disqus <span class="badge badge-success pull-right">12</span>', 'url'=>'#'),
    				array('label'=>'<i class="icon icon-search"></i> About this theme <span class="label label-important pull-right">HOT</span>', 'url'=>'http://www.webapplicationthemes.com/abound-yii-framework-theme/'),
    				// Include the operations menu
    				array('label'=>'OPERATIONS','items'=>$this->menu),
    			),
  			));?>
  		</div>
  		
    </div><!--/span-->
  <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
      'links'=>$this->breadcrumbs,
			'htmlOptions'=>array('class'=>'breadcrumb')
    )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>