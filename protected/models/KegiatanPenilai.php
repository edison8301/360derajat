<?php

/**
 * This is the model class for table "kegiatan_penilai".
 *
 * The followings are the available columns in table 'kegiatan_penilai':
 * @property integer $id
 * @property integer $id_kegiatan
 * @property integer $id_penilai_peran
 * @property integer $id_pegawai
 */
class KegiatanPenilai extends CActiveRecord
{
	CONST PERAN_SELF  = 1;
	CONST PERAN_SUPERIOR = 2;
	CONST PERAN_PEER = 3;
	CONST PERAN_SUB = 4;
	CONST PERAN_OTHERS = 5;
	CONST PERAN_ALL = 6;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_penilai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kegiatan, id_penilai_peran, id_pegawai, status_penilaian, status_hitung', 'numerical', 'integerOnly'=>true),
			array('jabatan, divisi, departemen, uraian_deskripsi','safe'),
			array('uraian_deskripsi', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kegiatan, id_penilai_peran, id_pegawai, uraian_deskripsi', 'safe', 'on'=>'search'),
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
			"pegawai"=>array(self::BELONGS_TO,'Pegawai','id_pegawai'),
			"penilai_peran"=>array(self::BELONGS_TO,'PenilaiPeran','id_penilai_peran'),
			"kegiatan"=>array(self::BELONGS_TO,'Kegiatan','id_kegiatan'),
			"kegiatanInduk"=>array(self::BELONGS_TO,'KegiatanInduk',array('id_kegiatan_induk'=>'id'),'through'=>'kegiatan'),
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
			'id_penilai_peran' => 'Peran Penilai',
			'id_pegawai' => 'Nama Penilai',
			'divisi'=>'Unit',
			'departemen'=>'Instansi',
			'uraian_deskripsi' => 'Uraian / Deskripsi'
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
		$criteria->compare('id_kegiatan',$this->id_kegiatan);
		$criteria->compare('id_penilai_peran',$this->id_penilai_peran);
		$criteria->compare('id_pegawai',$this->id_pegawai);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanPenilai the static model class
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

	public function findAllKompetensi()
	{
		return KegiatanKompetensi::model()->findAllByAttributes(array('id_kegiatan'=>$this->id_kegiatan));
	}

	public function getPenilaiSelf()
	{
		$model = KegiatanPenilai::model()->findByAttributes(array('id_kegiatan'=>$this->id_kegiatan,'id_penilai_peran'=>1));
		return $model->getRelation('pegawai','nama');

	}

	public function getNamaPenilaiSelf()
	{
		$self = $this->findPenilaiSelf();
		if($self!==null)
			return $self->getRelation('pegawai','nama');
		else
			return null;
	}

	public function getJabatanPenilaiSelf()
	{
		$self = $this->findPenilaiSelf();
		if($self!==null)
			return $self->jabatan;
		else
			return null;
	}

	public function getDivisiPenilaiSelf()
	{
		$self = $this->findPenilaiSelf();
		if($self!==null)
			return $self->divisi;
		else
			return null;
	}

	public function getDepartemenPenilaiSelf()
	{
		$self = $this->findPenilaiSelf();
		if($self!==null)
			return $self->departemen;
		else
			return null;
	}

	public function findPenilaiSelf()
	{
		return KegiatanPenilai::model()->findByAttributes(array('id_kegiatan'=>$this->id_kegiatan,'id_penilai_peran'=>1));
	}


	public function cekSelf($id,$peran)
	{
		$criteria = new CDbCriteria;

		$criteria->condition = ('id_penilai_peran =1 AND id_kegiatan = :kegiatan');		
		$criteria->params = array(':kegiatan' => $id);

		if($peran =1) {
			$model = KegiatanPenilai::model()->find($criteria);
			if($model == null) {
				return true;
			} else {
				return false;
			}		
		} else {
			return true;
		}


	}

	public function countRincian()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('kegiatan_kompetensi');
		$criteria->together = true;
		$criteria->condition = 'kegiatan_kompetensi.id_kegiatan = :id';
		$criteria->params = [':id'=>$this->id_kegiatan];

		return KegiatanKompetensiRincian::model()->count($criteria);
	}

	public function isTerisiSemua()
	{
		if ($this->getStatusPengisian() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getStatusPengisian()
	{
		$jumlah_hasil = $this->countHasil();
		$jumlah_rincian = $this->countRincian();

		if($jumlah_rincian == 0)
			return 3;
		elseif($jumlah_hasil==$jumlah_rincian)
			return 1;
		elseif($jumlah_hasil == 0)
			return 0;
		else
			return 2;
	}

	public function getLabelStatusPengisian()
	{
		$status = $this->getStatusPengisian();
		if($status == 1)
			return '<label class="label label-success">Terisi Semua</label>';

		if($status == 2)
			return '<label class="label label-warning">Terisi Sebagian</label>';

		if($status == 0)
			return '<label class="label label-danger">Belum Terisi</label>';

		if($status == 3)
			return '<label class="label label-info">Kompetensi Masih Kosong</label>';
	}

	public function getTextStatusPengisian()
	{
		$status = $this->getStatusPengisian();
		if($status == 1)
			return "Terisi Semua";

		if($status == 2)
			return "Terisi Sebagian";

		if($status ==0)
			return "Belum Mengisi";
	}

	public function getLabelStatusHitung()
	{
		if ($this->status_hitung == 1)
			return '<label class="label label-success">Dihitung</label>';
		elseif ($this->status_hitung == 0)
			return '<label class="label label-warning">Tidak Dihitung</label>';
		
		return null;
	}

	public function countHasil()
	{
		$criteria = new CDbCriteria;
		$criteria->with = ['kegiatanKompetensiRincian','kegiatanPenilai'];
		$criteria->together = true;
		$criteria->condition = 'id_kegiatan_penilai = :id AND kegiatanKompetensiRincian.id IS NOT NULL';
		$criteria->params = [':id'=>$this->id];

		return KegiatanKompetensiRincianHasil::model()->count($criteria);
	}

	public function getButtonStatusPenilaian()
	{
		if ($this->status_penilaian == 0) {
			return CHtml::link(
				'<i class="glyphicon glyphicon-ok"></i> Kirim Penilaian',
				'#',
				[
					'class'=>'btn btn-danger btn-raised',
					'onclick'=>'
						if (confirm("Yakin akan mengirim Penilaian?")) {
							$("#kirim-penilaian").val(1);
							$("#kegiatan-penilaian").submit();
							return true;
						}
					',
				]);
		} else {
			if (User::isAdmin() || User::isSuperAdmin())
				return CHtml::link('<i class="glyphicon glyphicon-remove"></i> Batalkan Penilaian',['kegiatanPenilai/ubahStatus','id'=>$this->id],['class'=>'btn btn-danger btn-raised','onclick'=>'return confirm("Yakin Akan Mengirim Penilaian?")']);
			else
				return null;
		}
	}

	public function isSelf()
	{
		if ($this->id_penilai_peran == self::PERAN_SELF)
			return true;
		
		return false;
	}

	public function getUraianDeskripsi()
	{
		if ($this->uraian_deskripsi !== null) {
			return $this->uraian_deskripsi;
		} else {
			return 'Kosong';
		}
	}

	public function getLabelStatusPenilaian()
	{
		if ($this->status_penilaian == 0)
			return '<span class="label label-info"> Sedang Proses Penilaian</span>';
		else 
			return '<span class="label label-success"> Nilai Telah Dikirim </span>';
	}

	public function getAlert()
	{
		$status = $this->getStatusPengisian();

		if($status == 1)
			return '<div class="alert alert-success">Penilaian Telah Terisi Semua</div>';

		if($status == 2)
			return '<div class="alert alert-warning">Penilaian Telah Terisi Sebagian</div>';

		if($status == 0)
			return '<div class="alert alert-danger">Penilaian Belum Terisi</div>';

		if($status == 3)
			return '<div class="alert alert-default">Kompetensi Masih Kosong</div>';
	}

}
