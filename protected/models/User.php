<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role_id
 */
class User extends CActiveRecord
{
	CONST ROLE_ADMIN = 1;
	CONST ROLE_SUPER_ADMIN = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'unique', 'message'=>'{attribute} \'{value}\' Telah digunakan!'),
			array('username, role_id,', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, role_id', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'role_id' => 'Role',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role_id',$this->role_id);

		if (User::isAdmin()) {
			$criteria->addCondition('role_id != :role');
			$criteria->params[':role'] = User::ROLE_SUPER_ADMIN;
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function isSuperAdmin()
	{
		if (Yii::app()->user->fromTable == 'user') {
			$model = User::model()->findByAttributes(array('username'=>Yii::app()->user->id));
			if (!is_null($model)) {
				if ($model->role_id == self::ROLE_SUPER_ADMIN) {
					return true;
				}

				return false;
			}
		}

		return false;
	}

	public static function isAdmin()
	{
		if (Yii::app()->user->fromTable == 'user') {
			$model = User::model()->findByAttributes(array('username'=>Yii::app()->user->id));
			if (!is_null($model)) {
				if ($model->role_id == self::ROLE_ADMIN) {
					return true;
				}

				return false;
			}
		}

		return false;
	}

	public static function isPegawai()
	{
		if (Yii::app()->user->fromTable == 'pegawai') {
			$model = Pegawai::model()->findByAttributes(array('username'=>Yii::app()->user->id));
			if ($model!==null)
				return true;
		}

		return false;
	}	

	public static function getIdPegawai()
	{
		$model = Pegawai::model()->findByAttributes(array('username'=>Yii::app()->user->id));
		return $model->id;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getRandomString($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd >= $range);
		return $min + $rnd;
	}

	public static function setToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[self::getRandomString(0, $max)];
		}

		return $token;
	}

	public static function getRoleList()
	{
		return [
			self::ROLE_ADMIN => 'Admin',
			self::ROLE_SUPER_ADMIN => 'Super Admin',
		];
	}

	public function getNamaRole()
	{
		if ($this->role_id == self::ROLE_ADMIN) 
			return 'Admin';
		elseif ($this->role_id == self::ROLE_SUPER_ADMIN) 
			return 'Super Admin';

		return 'Tidak ditemukan';
	}

}