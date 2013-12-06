<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $article_id
 * @property string $title
 * @property string $content
 * @property integer $read_count
 * @property integer $category_id
 * @property string $add_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class Article extends BlogCActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('title', 'unique'),
			array('read_count, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>256),
			array('content, add_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, title, content, read_count, category_id, add_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'tags' => array(self::MANY_MANY, 'Tag', '{{article_tag}}(article_id, tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_id' => 'Article',
			'title' => 'Title',
			'content' => 'Content',
			'read_count' => 'Read Count',
			'category_id' => 'Category',
			'tags' => 'Tags',
			'add_time' => 'Add Time',
			'update_time' => 'Update Time',
		);
	}
}