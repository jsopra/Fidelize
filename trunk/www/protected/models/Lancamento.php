<?php

/**
 * This is the model class for table "tbl_lancamento".
 *
 * The followings are the available columns in table 'tbl_lancamento':
 * @property string $id
 * @property string $vencimento
 * @property double $valor
 * @property string $cta_credor
 * @property string $cta_devedor
 */
class Lancamento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Lancamento the static model class
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
		return 'tbl_lancamento';
	}
	
	protected function beforeSave(){
		list($ano,$mes,$dia) = explode('/',$this->vencimento);
		
		$this->vencimento = $ano . '-' . $mes . '-' . $dia;
		return true;
	}
	
	protected function afterFind(){
		
		list($ano,$mes,$dia) = explode('-',$this->vencimento);
		
		$this->vencimento = $dia . '/' . $mes . '/' . $ano;

		return true;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vencimento, valor, descricao', 'required'),
			array('valor', 'numerical'),
			array('cta_credor, cta_devedor', 'length', 'max'=>20),
			array('descricao', 'length', 'max'=>1000),
			array('vencimento', 'type', 'type'=>'date' ,'dateFormat'=>'dd/MM/yyyy'),
			array('id, vencimento, valor, cta_credor, cta_devedor, descricao', 'safe', 'on'=>'search'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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
			'id' => 'ID',
			'vencimento' => 'Vencimento',
			'valor' => 'Valor',
			'cta_credor' => 'Cta Credor',
			'cta_devedor' => 'Cta Devedor',
			'descricao' => 'Descrição',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('vencimento',$this->vencimento);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('cta_credor',$this->cta_credor,true);
		$criteria->compare('cta_devedor',$this->cta_devedor,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
