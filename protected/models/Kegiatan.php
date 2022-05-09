<?php

/**
 * This is the model class for table "kegiatan".
 *
 * The followings are the available columns in table 'kegiatan':
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property string $keterangan
 * @property integer $id_kegiatan_status
 */
class Kegiatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kegiatan_status, id_kegiatan_induk', 'numerical', 'integerOnly'=>true),
			array('kode, nama, target', 'length', 'max'=>255),
			array('tanggal_mulai, tanggal_selesai, keterangan, urutan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode, nama, tanggal_mulai, tanggal_selesai, keterangan, id_kegiatan_status', 'safe', 'on'=>'search'),
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
			"kegiatan_status"=>[self::BELONGS_TO,'KegiatanStatus','id_kegiatan_status'],
			"kegiatan_penilai"=>[self::HAS_MANY,'KegiatanPenilai','id_kegiatan'],
			"kegiatanKompetensis"=>[self::HAS_MANY,'KegiatanKompetensi','id_kegiatan'],
			"kegiatanInduk"=>[self::BELONGS_TO,'KegiatanInduk','id_kegiatan_induk'],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode' => 'Kode Kegiatan',
			'nama' => 'Nama Kegiatan',
			'target' => 'Target Job',
			'tanggal_mulai' => 'Tanggal Mulai',
			'tanggal_selesai' => 'Tanggal Selesai',
			'keterangan' => 'Keterangan',
			'id_kegiatan_status' => 'Status Kegiatan',
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

		$criteria->order = 'tanggal_mulai DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kegiatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getRelation($relation,$field,$null = null)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return $null;
	}

	public function findAllKompetensi()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'urutan ASC';
		return KegiatanKompetensi::model()->findAllByAttributes(array('id_kegiatan'=>$this->id),$criteria);
	}

	public function countAllKompetensi()
	{
		return KegiatanKompetensi::model()->countByAttributes(array('id_kegiatan'=>$this->id));
	}

	public function findSelf()
	{
		return KegiatanPenilai::model()->findByAttributes(array('id_kegiatan'=>$this->id,'id_penilai_peran'=>1));
	}

	public function getSelfNama()
	{
		$self = $this->findSelf();
		if($self!==null)
		{
			return $self->getRelation('pegawai','nama');
		} else {
			return null;
		}
	}

	public function getSelfJabatan()
	{
		$self = $this->findSelf();
		if($self!==null)
		{
			return $self->jabatan;
		} else {
			return null;
		}
	}

	public function getSelfDivisi()
	{
		$self = $this->findSelf();
	
		if($self!==null)
		{
			return $self->divisi;
		} else {
			return null;
		}
	}

	public function getSelfDepartemen()
	{
		$self = $this->findSelf();
	
		if($self!==null)
		{
			return $self->departemen;
		} else {
			return null;
		}
	}

	public function findAllPenilai($status_hitung=1)
	{
		if ($status_hitung === 0)
			return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id),array('order'=>'id_penilai_peran'));

		return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id,'status_hitung'=>1,'status_penilaian' => 1),array('order'=>'id_penilai_peran'));
	}

	public function hasPenilaiSelf()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('id_penilai_peran = 1');
		$criteria->addCondition('id_kegiatan = :id_kegiatan');
		$criteria->addCondition('status_hitung = 1');
		$criteria->params[':id_kegiatan'] = $this->id;

		return KegiatanPenilai::model()->count($criteria);
	}

	public function hasPenilaiSuperior()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('id_penilai_peran = 2');
		$criteria->addCondition('id_kegiatan = :id_kegiatan');
		$criteria->addCondition('status_hitung = 1');
		$criteria->params[':id_kegiatan'] = $this->id;

		return KegiatanPenilai::model()->count($criteria);
	}

	public function hasPenilaiPeer()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('id_penilai_peran = 3');
		$criteria->addCondition('id_kegiatan = :id_kegiatan');
		$criteria->addCondition('status_hitung = 1');
		$criteria->params[':id_kegiatan'] = $this->id;

		return KegiatanPenilai::model()->count($criteria);
	}

	public function hasPenilaiSubOrdinat()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('id_penilai_peran = 4');
		$criteria->addCondition('id_kegiatan = :id_kegiatan');
		$criteria->addCondition('status_hitung = 1');
		$criteria->params[':id_kegiatan'] = $this->id;

		return KegiatanPenilai::model()->count($criteria);
	}

	public function countAllPenilai($excSelf=false)
	{
		$model = KegiatanPenilai::model()->countByAttributes(array('id_kegiatan'=>$this->id,'status_hitung'=>1,'status_penilaian'=>1),array('order'=>'id_penilai_peran'));
		if ($excSelf  && $this->hasPenilaiSelf())
			$model -= 1;
		return $model;
	}

	public function findAllPenilaiPeran($id_peran)
	{
		return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id,'id_penilai_peran'=>$id_peran,'status_hitung'=>1),array('order'=>'id_penilai_peran'));
	}

	public function findAllPenilaiByIdPeran($id_peran)
	{
		return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id,'id_penilai_peran'=>$id_peran,'status_hitung'=>1),array('order'=>'id_penilai_peran'));
	}

	public function countAllPenilaiByIdPeran($id_peran)
	{
		return KegiatanPenilai::model()->countByAttributes(array('id_kegiatan'=>$this->id,'id_penilai_peran'=>$id_peran,'status_hitung'=>1),array('order'=>'id_penilai_peran'));
	}

	public function findAllPenilaiOther()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_penilai_peran != 1 and id_penilai_peran != 2';
		return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id),$criteria);
	}

	public function findAllExcSelf()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'id_penilai_peran';
		$criteria->condition = 'id_penilai_peran != 1';

		return KegiatanPenilai::model()->findAllByAttributes(array('id_kegiatan'=>$this->id),$criteria);
	}

	public function countExcSelf()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'id_penilai_peran';
		$criteria->condition = 'id_penilai_peran != 1';

		return KegiatanPenilai::model()->countByAttributes(array('id_kegiatan'=>$this->id),$criteria);
	}

	public function countPenilai()
	{
		return KegiatanPenilai::model()->countByAttributes(array('id_kegiatan'=>$this->id));	
	}

	public static function getDataKegiatanPerBulan()
	{
		$dataChartBulan = '';

		for($i=1;$i<=12;$i++)
		{
   			$criteria = new CDbCriteria;
    
    		$bulan = $i;

    		if($i<=10) $bulan = '0'.$i;
   			$awal = date('Y').'-'.$bulan.'-01';
    		$akhir = date('Y').'-'.$bulan.'-31';  		
    
		    $criteria->condition = 'tanggal_mulai >= :awal AND tanggal_mulai <= :akhir';
		    $criteria->params = array(':awal'=>$awal,':akhir'=>$akhir);

		    $nama_bulan = '';
		    if($i==1) $nama_bulan = 'Jan';
		    if($i==2) $nama_bulan = 'Feb';
		    if($i==3) $nama_bulan = 'Mar';
		    if($i==4) $nama_bulan = 'Apr';
		    if($i==5) $nama_bulan = 'Mei';
		    if($i==6) $nama_bulan = 'Jun';
		    if($i==7) $nama_bulan = 'Jul';
		    if($i==8) $nama_bulan = 'Aug';
		    if($i==9) $nama_bulan = 'Sep';
		    if($i==10) $nama_bulan = 'Oct';
		    if($i==11) $nama_bulan = 'Nov';
		    if($i==12) $nama_bulan = 'Des';

		    $jumlah_kegiatan = Kegiatan::model()->count($criteria);

   			$dataChartBulan .= '{"label":"'.$nama_bulan.'","value":"'.$jumlah_kegiatan.'"},';
		}
		return $dataChartBulan;
	}

	public function findKegiatanAktif()
	{
		$criteria = new CDbCriteria;
		$tanggal_sekarang = date('Y-m-d');
		$criteria->addCondition('tanggal_mulai >= :tanggal_sekarang AND tanggal_selesai <= :tanggal_sekarang OR id_kegiatan_status = 1'); //id_kegiatan satatus =1 (aktif)
		$criteria->params = array(':tanggal_sekarang'=>$tanggal_sekarang);
		return Kegiatan::model()->findAll($criteria);

	}


	protected function beforeDelete()
	{
		foreach($this->findAllKompetensi() as $data)
		{
			$data->delete();
		}

		return true;
	}

	public function countKompetensiRincian()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('kegiatan_kompetensi');
		$criteria->together = true;
		$criteria->condition = 'kegiatan_kompetensi.id_kegiatan = :id';
		$criteria->params = [':id'=>$this->id];

		return KegiatanKompetensiRincian::model()->count($criteria);
	}

	public function countKompetensiRincianHasilByIdKegiatanPenilai($id_kegiatan_penilai)
	{
		$criteria = new CDbCriteria;

		$criteria->condition = 'id_kegiatan_penilai = :id';
		$criteria->params = [':id'=>$id_kegiatan_penilai];

		return KegiatanKompetensiRincianHasil::model()->count($criteria);
	}

	public function getStatusPengisianByIdPegawai($id_pegawai)
	{
		return $this->countKompetensiRincian();
		//return "OK";
	}

	public function getLabelKegiatanStatus()
	{
		if($this->kegiatanInduk->id_kegiatan_status==1)
			$output = '<span class="label label-success">Aktif</span>';
		else
			$output = '<span class="label label-danger">Tidak Aktif</span>';

		return $output;
	}

	public function getCpAverageByIdPeran($id_peran)
	{
		$jumlah = 0;
		foreach ($this->findAllPenilaiByIdPeran($id_peran) as $data) {
			foreach (KegiatanKompetensiRincianHasil::model()->findAllByAttributes([
					'id_kompetensi'=>$this->id,
					'id_kompetensi_penilai'
				]) as $key => $value) {
				
			}
		}
		return $jumlah;
	}


	public function getExcelSumSelf($chr,$row,$append=null)
	{
		if ($this->hasPenilaiSelf())
			return Helper::sumHelperHorizontal($chr,1,$row,null,$append);
		else
			return null;
	}

	public function getExcelSumSuperior($chr,$row,$append=null)
	{
		if (!$this->hasPenilaiSuperior())
			return null;

		$selfHelper = $this->countAllPenilaiByIdPeran(1) * 2;
		$penilaiSuperior = $this->countAllPenilaiByIdPeran(2);

		$append = '/'.$this->countAllPenilaiByIdPeran(2);

		return Helper::sumHelperHorizontal($chr+$selfHelper,$penilaiSuperior,$row,null,$append);
	}

	public function getExcelSumPeer($chr,$row,$append=null)
	{
		if (!$this->hasPenilaiPeer())
			return null;

		$tambah = 0;
		$tambah += $this->countAllPenilaiByIdPeran(1)*2;
		$tambah += $this->countAllPenilaiByIdPeran(2)*2;

		$kurang = 0;
		$kurang += $this->countAllPenilaiByIdPeran(1);
		$kurang += $this->countAllPenilaiByIdPeran(2);
		$kurang += $this->countAllPenilaiByIdPeran(4);
		
		$append = '/'.$this->countAllPenilaiByIdPeran(3);

		return Helper::sumHelperHorizontal($chr+$tambah,$this->countAllPenilai()-$kurang,$row,true,$append);
	}

	public function getExcelSumSubOrdinat($chr,$row,$append=null)
	{
		if (!$this->hasPenilaiSubOrdinat())
			return null;

		$tambah = 0;
		$tambah += $this->countAllPenilaiByIdPeran(1)*2;
		$tambah += $this->countAllPenilaiByIdPeran(2)*2;
		$tambah += $this->countAllPenilaiByIdPeran(3)*2;

		$kurang = 0;
		$kurang += $this->countAllPenilaiByIdPeran(1);
		$kurang += $this->countAllPenilaiByIdPeran(2);
		$kurang += $this->countAllPenilaiByIdPeran(3);

		$append = '/'.$this->countAllPenilaiByIdPeran(4);

		return Helper::sumHelperHorizontal($chr+$tambah,$this->countAllPenilai()-$kurang,$row,true,$append);
	}

	public function hasKegiatanKompetensi()
	{
		$kompetensi = count($this->findAllKompetensi());

		if ($kompetensi == 0)
			return false;
		
		return true;
	}

	public function getBobotSpr()
	{
		return $this->getRelation("kegiatanInduk","bobot_spr",0).'%';
	}

	public function getBobotPeer()
	{
		return $this->getRelation("kegiatanInduk","bobot_peer",0).'%';
	}

	public function getBobotSub()
	{
		return $this->getRelation("kegiatanInduk","bobot_sub",0).'%';
	}

}