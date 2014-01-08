<?php

class TagController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','index','create','update','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		if(isset($_REQUEST['displayLength']) && isset($_REQUEST['offset'])) {
			$displayLength = $_REQUEST['displayLength'];
			$offset = $_REQUEST['offset'];
		} else {
			$displayLength = $model->articleCount;
			$offset = 0;
		}

		$columns = array('article_id'=>'Id','title'=>'Title','read_count'=>'Read Count','category_id'=>'Category','tags'=>'Tags','is_post'=>'Is Post');

		$datas = array();
		foreach ($model->articles as $key => $value) {
			$row = array();
			foreach ($columns as $k => $v) {
				switch ($k) {
					case 'article_id':
						$row[] = $value->article_id;
						break;
					case 'title':
						$row[] = '<a href="/article/view/'.$value->article_id.'">'.$value->title.'</a>';
						break;
					case 'read_count':
						$row[] = $value->read_count;
						break;
					case 'is_post':
						$row[] =  $value->is_post == 0 ? '<span class="label label-warning">NOT POST</span>' : '<span class="label label-success">POST</span>';
						break;
					case 'category_id':
						$row[] =  $value->category->name;
						break;
					case 'tags':
						$row[] =  implode(';', $value->getTags());
						break;
				}
			}
			$datas[] = $row;
		}

		$this->render('view',array(
			'settings' => array('displayLength'=>$displayLength,'requestSource'=>Yii::app()->createUrl('tag/view/'.$id)),
			'offset' => $offset,
			'totalCount' => $model->articleCount,
			'columns' => $columns,
			'datas' => $datas,
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tag;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tag']))
		{
			$model->attributes=$_POST['Tag'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tag']))
		{
			$model->attributes=$_POST['Tag'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isAjaxRequest){
			$model = $this->loadModel($id);
			if($model->articleCount > 0) {
				$this->jsonRes("Delete the article first!", 1);
			} else {
				$model->delete();
				$this->jsonRes("Delete success");
			}
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Tag;
		if(isset($_REQUEST['displayLength']) && isset($_REQUEST['offset'])) {
			$displayLength = $_REQUEST['displayLength'];
			$offset = $_REQUEST['offset'];
		} else {
			$displayLength = 10;
			$offset = 0;
		}

		$columns = $model->attributeLabels();

		$res = $model->getTagList($offset, $displayLength);
		$datas = array();
		foreach ($res['datas'] as $value) {
			$tag = $this->loadModel($value['tag_id']);
			$row = array();
			foreach ($columns as $k => $v) {
				switch ($k) {
					case 'name':
						$row[] = '<a href="/tag/view/'.$tag->tag_id.'">'.$tag->name.'</a>';
						break;
					case 'article_count':
						$row[] =  $tag->articleCount;
						break;
					default:
						$row[] = $value[$k];
						break;
				}
			}
			$datas[] = $row;
		}

		$this->render('index',array(
			'settings' => array('displayLength'=>$displayLength,'requestSource'=>Yii::app()->createUrl('tag/index')),
			'offset' => $offset,
			'totalCount' => $res['totalCount'],
			'columns' => $columns,
			'datas' => $datas,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tag the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tag::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tag $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tag-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
