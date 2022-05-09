<?php

/**
 * This is the model class for table "kegiatan_induk".
 *
 * The followings are the available columns in table 'kegiatan_induk':
 * @property integer $id
 * @property integer $kode
 * @property string $nama
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property string $keterangan
 * @property integer $id_kegiatan_status
 */
class KegiatanInduk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_induk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode, nama, tanggal_mulai, tanggal_selesai, bobot_self, bobot_spr, bobot_peer, bobot_sub', 'required'),
			array('id_kegiatan_status', 'numerical', 'integerOnly'=>true),
			array('nama, kode, keterangan, target', 'length', 'max'=>255),
			array('bobot_self, bobot_spr, bobot_peer, bobot_sub','numerical','integerOnly'=>true,'min'=>1,'max'=>100),
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
			"kegiatan"=>[self::HAS_MANY,'Kegiatan','id_kegiatan'],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode' => 'Kode',
			'nama' => 'Nama',
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
		$criteria->compare('kode',$this->kode);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tanggal_mulai',$this->tanggal_mulai,true);
		$criteria->compare('tanggal_selesai',$this->tanggal_selesai,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('id_kegiatan_status',$this->id_kegiatan_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanInduk the static model class
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

	public function getLabelKegiatanStatus()
	{
		if($this->id_kegiatan_status==1)
			$output = '<span class="label label-success">Aktif</span>';
		else
			$output = '<span class="label label-danger">Tidak Aktif</span>';

		return $output;
	}

	public function findAllKegiatan()
	{
		return Kegiatan::model()->findAllByAttributes(['id_kegiatan_induk'=>$this->id]);
	}

	public function generateKegiatan($getIdKegiatan = false)
	{
		$kegiatan = new Kegiatan;
		$kegiatan->id_kegiatan_induk = $this->id;
		$kegiatan->save();
		
		if ($getIdKegiatan)
			return $kegiatan->id;

		return true;
	}

	public function getButtonStatusKegiatan()
	{
		if ($this->id_kegiatan_status == 1) {
			$label = '<i class="fa fa-times"></i> Non-Aktifkan Kegiatan';
			$url = ['KegiatanInduk/ubahStatus','id'=>$this->id];
			$context = 'danger';
		} elseif ($this->id_kegiatan_status == 0) {
			$label = '<i class="fa fa-check"></i> Aktifkan Kegiatan';
			$url = ['KegiatanInduk/ubahStatus','id'=>$this->id];
			$context = 'success';
		}
		return CHtml::link($label,$url,['class'=>'btn btn-'.$context.' btn-raised','onclick'=>'return confirm("Yakin akan merubah status?")']);
	}
}
