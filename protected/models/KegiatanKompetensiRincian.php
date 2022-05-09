<?php

/**
 * This is the model class for table "kegiatan_kompetensi_rincian".
 *
 * The followings are the available columns in table 'kegiatan_kompetensi_rincian':
 * @property integer $id
 * @property integer $id_kegiatan_kompetensi
 * @property string $uraian
 * @property string $cpro
 * @property string $fpro
 */
class KegiatanKompetensiRincian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_kompetensi_rincian';
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
			array('id_kegiatan, id_kegiatan_kompetensi, cpro, fpro, urutan', 'numerical', 'integerOnly'=>true),
			array('uraian', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kegiatan_kompetensi, uraian, cpro, fpro', 'safe', 'on'=>'search'),
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
			"kegiatan_kompetensi"=>array(self::BELONGS_TO,'KegiatanKompetensi','id_kegiatan_kompetensi'),
			"kegiatanKompetensi"=>array(self::BELONGS_TO,'KegiatanKompetensi','id_kegiatan_kompetensi'),
			"kegiatan"=>array(self::BELONGS_TO,'KegiatanKompetensi','id_kegiatan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_kegiatan_kompetensi' => 'Kompetensi Kegiatan',
			'uraian' => 'Uraian',
			'cpro' => 'CPRO',
			'fpro' => 'FPRO',
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
		$criteria->compare('id_kegiatan_kompetensi',$this->id_kegiatan_kompetensi);
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
	 * @return KegiatanKompetensiRincian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCpByIdPenilai($id_penilai)
	{
		$criteria = new CDbCriteria;
		$criteria->with = ['kegiatanPenilai'];
		//$criteria->addCondition('kegiatanPenilai.status_penilaian = 1');
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id_kegiatan_kompetensi_rincian');
		$criteria->addCondition('id_kegiatan_penilai = :id_penilai');
		$params = [];
		$params[':id_kegiatan_kompetensi_rincian'] = $this->id;
		$params[':id_penilai'] = $id_penilai;
		$criteria->params = $params;

		/*$critaria->params[':id_kegiatan_kompetensi_rincian'] = $this->id;
		$criteria->params[':id_penilai'] = $id_penilai;*/
		
		$model = KegiatanKompetensiRincianHasil::model()->find($criteria);

		if($model !== null) {
			return $model->cp;
		}

		return null;
	}

	public function getFpro($id_kegiatan_kompetensi_rincian)
	{
		$model = KegiatanKompetensiRincian::model()->findByAttributes(array(
			'id'=>$id_kegiatan_kompetensi_rincian,			
		));

		if(!is_null($model))
		{
			return $model->fpro;
		}

		return null;
	}

	public function getCprByIdPenilai($id_penilai)
	{
		$criteria = new CDbCriteria;
		$criteria->with = ['kegiatanPenilai'];
		// $criteria->addCondition('kegiatanPenilai.status_penilaian = 1');
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id_kegiatan_kompetensi_rincian');
		$criteria->addCondition('id_kegiatan_penilai = :id_penilai');
		$params = [];
		$params[':id_kegiatan_kompetensi_rincian'] = $this->id;
		$params[':id_penilai'] = $id_penilai;
		$criteria->params = $params;
		/*$critaria->params[':id_kegiatan_kompetensi_rincian'] = $this->id;
		$criteria->params[':id_penilai'] = $id_penilai;*/
		
		$model = KegiatanKompetensiRincianHasil::model()->find($criteria);

		$hasil = null;

		if($model!==null)
		{
			$hasil = $model->cpr;
		}

		return $hasil;
	}

	public function getCprByIdPenilaiSelf($id_penilai=null)
	{
		$kegiatan_penilai = KegiatanPenilai::model()->findByAttributes(array('id_penilai_peran'=>1));
		if($kegiatan_penilai !==null)
			$id_penilai = $kegiatan_penilai;
			

		$model = KegiatanKompetensiRincianHasil::model()->findByAttributes(array(
			'id_kegiatan_kompetensi_rincian'=>$this->id,
			'id_kegiatan_penilai'=>$kegiatan_penilai->id,
		));

		$hasil = null;

		if($model!==null)
		{
			$hasil = $model->cpr;
		}

		return $hasil;
	}

	public function getCp($id_peran=KegiatanPenilai::PERAN_OTHERS)
	{
		$criteria = new CDbCriteria;
		$criteria->with = 'kegiatanPenilai';
		$criteria->together = true;
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id');
		$criteria->params[':id'] = $this->id;

		if (in_array($id_peran, [KegiatanPenilai::PERAN_SELF,KegiatanPenilai::PERAN_SUPERIOR,KegiatanPenilai::PERAN_PEER,KegiatanPenilai::PERAN_SUB,KegiatanPenilai::PERAN_OTHERS])) {
			if ($id_peran != KegiatanPenilai::PERAN_OTHERS) {
				$criteria->addCondition('kegiatanPenilai.id_penilai_peran = :id_peran');
				$criteria->params[':id_peran'] = $id_peran;
			} else {
				$criteria->addCondition('kegiatanPenilai.id_penilai_peran != :id_peran');
				$criteria->params[':id_peran'] = KegiatanPenilai::PERAN_SELF;
			}
		}

		$criteria->select = 'SUM(cp) as sum_cp';

		$hasil = 0;
		$rincianHasil = KegiatanKompetensiRincianHasil::model()->find($criteria);
		if ($rincianHasil != null)
			$hasil = $rincianHasil->sum_cp;

		$jumlahData = KegiatanKompetensiRincianHasil::model()->count($criteria);
		
		if ($jumlahData == 0) 
			return '0'; 
		else
			return $hasil/$jumlahData;
	}

	public function getCpr($id_peran=KegiatanPenilai::PERAN_OTHERS)
	{
		$criteria = new CDbCriteria;
		$criteria->with = 'kegiatanPenilai';
		$criteria->together = true;
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id');
		$criteria->params[':id'] = $this->id;

		if (in_array($id_peran, [KegiatanPenilai::PERAN_SELF,KegiatanPenilai::PERAN_SUPERIOR,KegiatanPenilai::PERAN_OTHERS])) {
			if ($id_peran != KegiatanPenilai::PERAN_OTHERS) {
				$criteria->addCondition('kegiatanPenilai.id_penilai_peran = :id_peran');
				$criteria->params[':id_peran'] = $id_peran;
			} else {
				$criteria->addCondition('kegiatanPenilai.id_penilai_peran != :id_peran');
				$criteria->params[':id_peran'] = KegiatanPenilai::PERAN_SELF;
			}
		}
		
		$criteria->select = 'SUM(cpr) as sum_cpr';

		$hasil = 0;
		$rincianHasil = KegiatanKompetensiRincianHasil::model()->find($criteria);
		if ($rincianHasil !== null) {
            $hasil = $rincianHasil->sum_cpr;
        }


		$jumlahData = KegiatanKompetensiRincianHasil::model()->count($criteria);
		
		if ($jumlahData == 0) 
			return '0'; 
		else
			return $hasil/$jumlahData;
	}

	public function getCpro($id_kegiatan_kompetensi_rincian)
	{
		$model = KegiatanKompetensiRincian::model()->findByAttributes(array(
			'id'=>$id_kegiatan_kompetensi_rincian,			
		));

		$hasil = null;

		if($model!==null)
		{
			$hasil = $model->cpro;
		}

		return $hasil;
	}

	public function setUrutan()
	{
		$jumlah = KegiatanKompetensiRincian::model()->countByAttributes(['id_kegiatan_kompetensi'=>$this->id_kegiatan_kompetensi]);

		$this->urutan = $jumlah;
	}

	// Mengambil jumlah penilai berdasarkan nilai cp yang diberikan dengan kondisi status hitung penilai adalah 1
	public function getJumlahCpByNilai($nilai)
	{
		$criteria = new CDbCriteria;
		$criteria->with = ['kegiatanPenilai'];
		$criteria->addCondition('kegiatanPenilai.status_hitung = 1');
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id');
		$criteria->addCondition('cp = :nilai');
		$criteria->params = [':id'=>$this->id,':nilai'=>$nilai];

		return KegiatanKompetensiRincianHasil::model()->count($criteria);
	}

	// Mengambil jumlah penilai berdasarkan nilai cpr yang diberikan dengan kondisi status hitung penilai adalah 1
	public function getJumlahCprByNilai($nilai)
	{
		$criteria = new CDbCriteria;
		$criteria->with = ['kegiatanPenilai'];
		$criteria->addCondition('kegiatanPenilai.status_hitung = 1');
		$criteria->addCondition('id_kegiatan_kompetensi_rincian = :id');
		$criteria->addCondition('cpr = :nilai');
		$criteria->params = [':id'=>$this->id,':nilai'=>$nilai];

		return KegiatanKompetensiRincianHasil::model()->count($criteria);
	}

}
