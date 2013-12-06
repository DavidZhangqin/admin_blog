<?php

/**
 * This is the model class for table "{{article_tag}}".
 *
 * The followings are the available columns in table '{{article_tag}}':
 * @property integer $article_tag_id
 * @property integer $article_id
 * @property integer $tag_id
 * @property string $add_time
 * @property string $update_time
 */
class ArticleTag extends BlogCActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleTag the static model class
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
		return '{{article_tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, tag_id', 'numerical', 'integerOnly'=>true),
			array('add_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_tag_id, article_id, tag_id, add_time, update_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_tag_id' => 'Article Tag',
			'article_id' => 'Article',
			'tag_id' => 'Tag',
			'add_time' => 'Add Time',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('article_tag_id',$this->article_tag_id);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}