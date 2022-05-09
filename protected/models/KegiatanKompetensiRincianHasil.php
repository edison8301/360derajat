<?php

/**
 * This is the model class for table "kegiatan_kompetensi_rincian_hasil".
 *
 * The followings are the available columns in table 'kegiatan_kompetensi_rincian_hasil':
 * @property integer $id
 * @property integer $id_kegiatan_kompetensi_rincian
 * @property integer $id_kegiatan_penilai
 * @property string $hasil
 */
class KegiatanKompetensiRincianHasil extends CActiveRecord
{
	public $sum_cpr;
	public $sum_cp;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_kompetensi_rincian_hasil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kegiatan, id_kegiatan_kompetensi, id_kegiatan_kompetensi_rincian, id_kegiatan_penilai, cp, cpr', 'numerical', 'integerOnly'=>true),
			['sum_cp, sum_cpr','safe'],
			array('cp, cpr', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kegiatan_kompetensi_rincian, id_kegiatan_penilai, hasil', 'safe', 'on'=>'search'),
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
			'kegiatanPenilai'=>array(self::BELONGS_TO,'KegiatanPenilai','id_kegiatan_penilai'),
			'kegiatanKompetensiRincian'=>[self::BELONGS_TO,'KegiatanKompetensiRincian','id_kegiatan_kompetensi_rincian']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_kegiatan_kompetensi_rincian' => 'Id Kegiatan Kompetensi Rincian',
			'id_kegiatan_penilai' => 'Kegiatan Penilai',
			'cpr' => 'CPR',
			'fpr' => 'FPR',
		);
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
		$criteria->compare('id_kegiatan_kompetensi_rincian',$this->id_kegiatan_kompetensi_rincian);
		$criteria->compare('id_kegiatan_penilai',$this->id_kegiatan_penilai);
		$criteria->compare('hasil',$this->hasil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanKompetensiRincianHasil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getRelation($relation,$field)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return null;
	}
}
