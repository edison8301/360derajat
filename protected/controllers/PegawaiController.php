<?php

class PegawaiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array(
                'ext.starship.RestfullYii.filters.ERestFilter + 
				REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','REST.GET','REST.PUT','REST.POST','REST.DELETE'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','changePassword','setPassword','kegiatan','generateToken'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actions()
	{
        return array(
            'REST.'=>'ext.starship.RestfullYii.actions.ERestActionProvider',
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),			
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pegawai;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pegawai']))
		{
			$model->attributes=$_POST['Pegawai'];
			$model->password = CPasswordHelper::hashPassword($model->password);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pegawai']))
		{
			$model->attributes=$_POST['Pegawai'];
			$model->password = CPasswordHelper::hashPassword($model->password);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('kegiatan','kegiatanInduk');
		$criteria->together = true;

		$params = array();

		$criteria->addCondition('kegiatanInduk.tanggal_mulai <= :tanggal AND kegiatanInduk.tanggal_selesai >= :tanggal AND kegiatanInduk.id_kegiatan_status = 1');

		date_default_timezone_set('Asia/Jakarta');
		$params[':tanggal'] = date('Y-m-d');

		$criteria->addCondition('id_pegawai = :id_pegawai');
		$params[':id_pegawai'] = User::getIdPegawai();

		$criteria->params = $params;

		$criteria->order = 'kegiatanInduk.tanggal_mulai DESC';

		$dataProvider=new CActiveDataProvider('KegiatanPenilai',array(
			'criteria'=>$criteria,
			'pagination'=>array(
      			'pageSize'=>10,
    		),
		));

		$model = Pegawai::model()->findByPk(User::getIdPegawai());
			
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model' => $model,
		));
	}

	public function actionKegiatan($id_kegiatan)
	{
		$kegiatan = Kegiatan::model()->findByPk($id_kegiatan);

		if(isset($_POST['KompetensiRincian']))
		{
			foreach($_POST['KompetensiRincian'] as $key => $value)
			{
				$hasil = KegiatanKompetensiRincianHasil::model()->findByAttributes(array(
							'id_kegiatan_kompetensi_rincian'=>$key,
							'id_kegiatan_penilai'=>Pegawai::getIdByUserId()
				));

				if($hasil===null)
				{
					$hasil = new KegiatanKompetensiRincianHasil;
					$hasil->id_kegiatan_kompetensi_rincian = $key;
					$hasil->id_kegiatan_penilai = Pegawai::getIdByUserId();

				}

				$hasil->hasil = $value;
				$hasil->save();
			}

			Yii::app()->user->setFlash('succees','Data berhasil disimpan');
			$this->redirect(array('pegawai/index'));
		}

		$this->render('kegiatan',array(
			'kegiatan'=>$kegiatan
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pegawai']))
			$model->attributes=$_GET['Pegawai'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pegawai the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pegawai::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function actionSetPassword($id)
	{

		$SetPasswordForm = new SetPasswordForm;

		$model = $this->loadModel($id);

		if(isset($_POST['SetPasswordForm']))
		{
			$SetPasswordForm->attributes = $_POST['SetPasswordForm'];

			if($SetPasswordForm->validate())
			{
				$model->password = CPasswordHelper::hashPassword($SetPasswordForm->password_baru);
				$model->save();
				Yii::app()->user->setFlash('success','Password berhasil diperbarui');
				$this->redirect(array('pegawai/setPassword','id'=>$id));
			}
		}

		$this->render('setPassword',array(
			'model'=>$model,
			'SetPasswordForm'=>$SetPasswordForm
		));
	}


	public function actionChangePassword()
	{
		$model = Pegawai::model()->findByAttributes(array('username'=>Yii::app()->user->id));

		$GantiPasswordForm = new GantiPasswordForm;

		if(isset($_POST['GantiPasswordForm']))
		{
			$GantiPasswordForm->attributes = $_POST['GantiPasswordForm'];

			if($GantiPasswordForm->validate())
			{
				$model->password = CPasswordHelper::hashPassword($GantiPasswordForm->password_baru);
				$model->save();
				Yii::app()->user->setFlash('success','Password berhasil diperbarui');
				$this->redirect(array('user/changePassword'));
			}
		}

		$this->render('changePassword',array(
			'model'=>$model,
			'GantiPasswordForm'=>$GantiPasswordForm
		));
	}	


	/**
	 * Performs the AJAX validation.
	 * @param Pegawai $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pegawai-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateToken($id,$fromProfil=false)
	{
		$model = $this->loadModel($id);

		$model->token = Pegawai::setToken();

		if ($model->save()) {
			Yii::app()->user->setFlash('success','Token berhasil dibuat');
			if ($fromProfil) 
				$this->redirect(array('site/profil'));
			else
				$this->redirect(array('pegawai/view','id'=>$model->id));
		}
	}
}
