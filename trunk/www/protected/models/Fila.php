<?php

/**
 * This is the model class for table "tbl_fila".
 *
 * The followings are the available columns in table 'tbl_fila':
 * @property string $Chave
 * @property string $Classe
 * @property string $Parametros
 * @property string $data_solic
 */
class Fila extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Fila the static model class
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
		return 'tbl_fila';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Chave, Classe, Parametros, data_solic', 'required'),
			array('Classe, Parametros', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Chave, Classe, Parametros, data_solic', 'safe', 'on'=>'search'),
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
			'Chave' => 'Chave',
			'Classe' => 'Classe',
			'Parametros' => 'Parametros',
			'data_solic' => 'Data Solic',
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

		$criteria->compare('Chave',$this->Chave,true);
		$criteria->compare('Classe',$this->Classe,true);
		$criteria->compare('Parametros',$this->Parametros,true);
		$criteria->compare('data_solic',$this->data_solic,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
