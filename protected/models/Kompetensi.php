<?php

/**
 * This is the model class for table "kompetensi".
 *
 * The followings are the available columns in table 'kompetensi':
 * @property integer $id
 * @property string $uraian
 */
class Kompetensi extends CActiveRecord
{

	public $referrer;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kompetensi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uraian, level, id_kompetensi_jenis', 'required'),
			array('level','numerical','integerOnly'=>true),
			array('referrer','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uraian, id_kompetensi_jenis', 'safe', 'on'=>'search'),
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
			"kompetensiJenis"=>array(self::BELONGS_TO,'KompetensiJenis','id_kompetensi_jenis'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uraian' => 'Uraian',
			'id_kompetensi_jenis' => 'Jenis Kompetensi'
		);
	}

	public function getRelation($relation,$field)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return null;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uraian',$this->uraian,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('id_kompetensi_jenis',$this->id_kompetensi_jenis);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function modal()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uraian',$this->uraian,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('id_kompetensi_jenis',$this->id_kompetensi_jenis);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>[
				'pageSize'=>5,
				],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kompetensi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findAllKompetensiRincian()
	{
		return KompetensiRincian::model()->findAllByAttributes(array('id_kompetensi'=>$this->id));
	}

	public function getUraianLengkap()
	{
		return $this->getRelation("kompetensiJenis","nama").' Level '.$this->level.' : '.$this->uraian;
	}
}
