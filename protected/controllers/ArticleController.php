<?php

class ArticleController extends Controller
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
			// 'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','create','update','delete'),
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
		if(!isset(Yii::app()->session['read_'.$id]) || Yii::app()->session['read_'.$id] !== true) {
			$model->read_count += 1;
			$model->save();
			Yii::app()->session['read_'.$id] = true;
		}
		$tags = array();	
		foreach ($model->tags as $key => $value) {
			$tags[] = "<a href='/tag/view/".$value['tag_id']."'>".$value['name']."</a>";
		}
		$model->tags = implode("; ", $tags);
		$model->content = Parsedown::instance()->parse($model->content);
		// $md = new CMarkdown();
		// $model->content = $md->transform($model->content);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	protected function checkTags($postTags) {
		$tags = array();
		if(isset($postTags) && ($tagString = trim($postTags)) !== "") {
			$tagsEx = explode(";", $tagString);
			foreach($tagsEx as $key => $value) {
				if(trim($value) !== "") $tags[] = trim($value);
			}
		}
		return $tags;
	}

	protected function saveTags($model, $tags) {
		$origin_tags = array();
		if(!empty($model->tags)) {
			foreach ($model->tags as $value) {
				$origin_tags[$value->tag_id] = $value->name;
			}
			$diff_tags = array_diff($origin_tags, $tags);
			if(!empty($diff_tags)) {
				foreach ($diff_tags as $key => $value) {
					ArticleTag::model()->deleteAll("tag_id=:tag_id", array(":tag_id"=>$key));
				}
			}
		}
		foreach ($tags as $value) {
			if(!Tag::model()->exists("name=:name", array(":name"=>$value))) {
				$tag = new Tag;
				$tag->name = $value;
				if(!$tag->save()) {
					var_dump($tag->getErrors());
					break;
				}
			} else {
				$tag = Tag::model()->findByAttributes(array("name"=>$value));
				$condition = "article_id=:article_id AND tag_id=:tag_id";
				$param = array(":article_id"=>$model->article_id,":tag_id"=>$tag->tag_id);
				if(ArticleTag::model()->exists($condition, $param)) {
					continue;
				}
			}
			$article_tag = new ArticleTag;
			$article_tag->article_id = $model->article_id;
			$article_tag->tag_id = $tag->tag_id;
			$article_tag->save();
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Article;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
			$tags = $this->checkTags($_POST['Article']['tags']);
			$article = $_POST['Article'];
			unset($article['tags']);
			$article['read_count'] = 0;
			$model->attributes=$article;
			if($model->save()) {
				$this->saveTags($model, $tags);
				$this->redirect(array('view','id'=>$model->article_id));
			}
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

		if(isset($_POST['Article']))
		{
			$tags = $this->checkTags($_POST['Article']['tags']);
			$article = $_POST['Article'];
			unset($article['tags']);
			$model->attributes=$article;
			if($model->save()) {
				$this->saveTags($model, $tags);
				$this->redirect(array('view','id'=>$model->article_id));
			}
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Article;
		if(isset($_REQUEST['displayLength']) && isset($_REQUEST['offset'])) {
			$displayLength = $_REQUEST['displayLength'];
			$offset = $_REQUEST['offset'];
		} else {
			$displayLength = 10;
			$offset = 0;
		}

		$columns = $model->attributeLabels();
		unset($columns['content']);

		$res = $model->getArticleList($offset, $displayLength);
		$datas = array();
		foreach ($res['datas'] as $value) {
			$article = $this->loadModel($value['article_id']);
			$row = array();
			foreach ($columns as $k => $v) {
				switch ($k) {
					case 'title':
						$row[] = '<a href="/article/view/'.$article->article_id.'">'.$article->title.'</a>';
						break;
					case 'is_post':
						$row[] =  $article->is_post == 0 ? '<span class="label label-warning">NOT POST</span>' : '<span class="label label-success">POST</span>';
						break;
					case 'category_id':
						$row[] =  $article->category->name;
						break;
					case 'tags':
						$row[] =  implode(';', $article->getTags());
						break;
					default:
						$row[] = $value[$k];
						break;
				}
			}
			$datas[] = $row;
		}

		$this->render('index',array(
			'settings' => array('displayLength'=>$displayLength,'requestSource'=>Yii::app()->createUrl('article/index')),
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
	 * @return Article the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Article::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Article $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
