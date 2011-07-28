<?php

/**
 * This is the model class for table "tbl_mensagem".
 *
 * The followings are the available columns in table 'tbl_mensagem':
 * @property string $chave
 * @property string $link
 * @property string $data_gerado
 */
class Mensagem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Mensagem the static model class
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
		return 'tbl_mensagem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chave, data_gerado', 'required'),
			array('chave, link', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('chave, link, data_gerado', 'safe', 'on'=>'search'),
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
			'chave' => 'Chave',
			'link' => 'Link',
			'data_gerado' => 'Data Gerado',
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

		$criteria->compare('chave',$this->chave,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('data_gerado',$this->data_gerado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}