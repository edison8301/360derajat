<?php

/**
 * This is the model class for table "kegiatan_kompetensi".
 *
 * The followings are the available columns in table 'kegiatan_kompetensi':
 * @property integer $id
 * @property integer $id_kegiatan
 * @property string $uraian
 * @property string $cpro
 * @property string $fpro
 */
class KegiatanKompetensi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_kompetensi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uraian','required','message'=>'{attribute} harus diisi'),
			array('id_kegiatan, cpro, fpro, urutan', 'numerical', 'integerOnly'=>true,'message'=>'{attribute} harus dalam format angka'),
			array('uraian', 'safe'),
			array('cpro, fpro','max10'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kegiatan, uraian, cpro, fpro', 'safe', 'on'=>'search'),
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
			"kegiatan"=>array(self::BELONGS_TO,'Kegiatan','id_kegiatan'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_kegiatan' => 'Kegiatan',
			'uraian' => 'Uraian',
			'cpro' => 'CPRO',
			'fpro' => 'FPRO',
		);
	}

	public function max10()
	{
		if($this->cpro > 10)
		{
			$this->addError('cpro','Nilai tidak boleh lebih dari 10');
		}
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
		$criteria->compare('id_kegiatan',$this->id_kegiatan);
		$criteria->compare('uraian',$this->uraian,true);
		$criteria->compare('cpro',$this->cpro,true);
		$criteria->compare('fpro',$this->fpro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getRelation($relation,$field)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return null;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanKompetensi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findAllRincian()
	{
		return KegiatanKompetensiRincian::model()->findAllByAttributes(array('id_kegiatan_kompetensi'=>$this->id),array('order'=>'urutan ASC'));
	}

	public function countAllRincian()
	{
		return KegiatanKompetensiRincian::model()->countByAttributes(array('id_kegiatan_kompetensi'=>$this->id),array('order'=>'urutan ASC'));
	}

	public function findAllKompetensiKegiatanRincian()
	{
		return KegiatanKompetensiRincian::model()->findAllByAttributes(array('id_kegiatan_kompetensi'=>$this->id),array('order'=>'urutan ASC'));
	}

	public function hasKegiatanKompetensiRincian()
	{
		$jumlah = KegiatanKompetensiRincian::model()->countByAttributes(array('id_kegiatan_kompetensi'=>$this->id));
		if($jumlah>0)
			return true;
		else
			return false;

	}

	protected function beforeDelete()
	{
		foreach($this->findAllRincian() as $data)
		{
			$data->delete();
		}

		return true;
	}

	public function setUrutan()
	{
		$jumlah = KegiatanKompetensi::model()->countByAttributes(['id_kegiatan'=>$this->id_kegiatan]);
		$jumlah++;
		$this->urutan = $jumlah;
	}

	public function getAverageCpByIdPeran($id_peran)
	{
		$criteria = new CDbCriteria;
		$criteria->with = 'kegiatanPenilai';
		$criteria->addCondition('t.id_kegiatan = :id_kegiatan');
		$criteria->params[':id_kegiatan'] = $this->id_kegiatan;

		if (in_array($id_peran, [KegiatanPenilai::PERAN_SELF,KegiatanPenilai::PERAN_SUPERIOR,KegiatanPenilai::PERAN_PEER,KegiatanPenilai::PERAN_SUB])) {
			$criteria->addCondition('kegiatanPenilai.id_penilai_peran = :id_peran');
			$criteria->params[':id_peran'] = $id_peran;
		} elseif ($id_peran == KegiatanPenilai::PERAN_OTHERS) {
			$criteria->addCondition('kegiatanPenilai.id_penilai_peran != :id_peran');
			$criteria->params[':id_peran'] = KegiatanPenilai::PERAN_SELF;
		}

		$criteria->addCondition('t.id_kegiatan_kompetensi = :id_kegiatan_kompetensi');
		$criteria->params[':id_kegiatan_kompetensi'] = $this->id;

		$criteria->select = 'SUM(cp) as sum_cp';

		$data = KegiatanKompetensiRincianHasil::model()->find($criteria)->sum_cp;

		$criteria->group = 'id_kegiatan_penilai';
		if ($id_peran == KegiatanPenilai::PERAN_SELF) {
			return $data/$this->countAllRincian();
		}
		$jumlah = KegiatanKompetensiRincianHasil::model()->count($criteria);
		if ($jumlah == 0 ) {
			return 0;
		}
		return $data/$jumlah;
	}

	public function getAverageCprByIdPeran($id_peran)
	{
		$criteria = new CDbCriteria;
		$criteria->with = 'kegiatanPenilai';
		$criteria->addCondition('t.id_kegiatan = :id_kegiatan');
		$criteria->params[':id_kegiatan'] = $this->id_kegiatan;

		if ($id_peran == KegiatanPenilai::PERAN_SELF && $id_peran == KegiatanPenilai::PERAN_SUPERIOR) {
			$criteria->addCondition('kegiatanPenilai.id_penilai_peran = :id_peran');
			$criteria->params[':id_peran'] = $id_peran;
		} elseif ($id_peran == KegiatanPenilai::PERAN_OTHERS) {
			$criteria->addCondition('kegiatanPenilai.id_penilai_peran != :id_peran');
			$criteria->params[':id_peran'] = KegiatanPenilai::PERAN_SELF;
		}

		$criteria->addCondition('t.id_kegiatan_kompetensi = :id_kegiatan_kompetensi');
		$criteria->params[':id_kegiatan_kompetensi'] = $this->id;

		$criteria->select = 'SUM(cpr) as sum_cpr';

		$data = KegiatanKompetensiRincianHasil::model()->find($criteria)->sum_cpr;

		$criteria->group = 'id_kegiatan_penilai';
		if ($id_peran == KegiatanPenilai::PERAN_SELF) {
			return $data/$this->countAllRincian();
		}
		$jumlah = KegiatanKompetensiRincianHasil::model()->count($criteria);
		if ($jumlah == 0 ) {
			return 0;
		}
		return $data/$jumlah;
	}
}
