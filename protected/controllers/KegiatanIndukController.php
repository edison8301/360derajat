<?php

class KegiatanIndukController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','tambahTargetPenilaian','ubahStatus'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//Search Modal
		$pegawai = new Pegawai('search');
		$pegawai->unsetAttributes();  // clear any default values
		if(isset($_GET['Pegawai']))
			$pegawai->attributes=$_GET['Pegawai'];

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'pegawai'=>$pegawai
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KegiatanInduk;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KegiatanInduk']))
		{
			$model->attributes=$_POST['KegiatanInduk'];
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
	public function actionUpdate($id,$id_kegiatan=null)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KegiatanInduk']))
		{
			$model->attributes=$_POST['KegiatanInduk'];
			if($model->save()){
				if (!is_null($id_kegiatan))
					$this->redirect(array('kegiatan/view','id'=>$id_kegiatan));

				$this->redirect(array('view','id'=>$model->id));
			}
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
		$dataProvider=new CActiveDataProvider('KegiatanInduk');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KegiatanInduk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanInduk']))
			$model->attributes=$_GET['KegiatanInduk'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanInduk the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanInduk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanInduk $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-induk-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionTambahTargetPenilaian($id)
	{
		$kegiatanInduk = $this->loadModel($id);
		$kegiatanPenilai = new KegiatanPenilai;
		//Sudah pasti self karena menambah target penilai
		$kegiatanPenilai->id_penilai_peran = KegiatanPenilai::PERAN_SELF;

		/*$pegawai = Pegawai::model()->findByPk($id_pegawai);
		$kegiatanInduk->generateKegiatan(true,$pegawai->id);*/
		if(isset($_POST['KegiatanPenilai']))
		{
			$kegiatanPenilai->attributes=$_POST['KegiatanPenilai'];
			if($kegiatanPenilai->validate()) {
				//Generate Kegiatan lalu masukkan id kegiatan jika model tervalidasi
				$id_kegiatan = $kegiatanInduk->generateKegiatan(true);
				$kegiatanPenilai->id_kegiatan = $id_kegiatan;
				$kegiatanPenilai->save();

				Yii::app()->user->setFlash('success','Target Penilaian Telah Berhasil Ditambahkan!');
				$this->redirect(['kegiatanInduk/view','id'=>$kegiatanInduk->id]);
			}
		}

		$this->render('tambahTarget',array(
			'kegiatanPenilai'=>$kegiatanPenilai,
		));
	}

	public function actionUbahStatus($id)
	{
		$model = $this->loadModel($id);

		if ($model->id_kegiatan_status == 1) {
			$model->id_kegiatan_status = 0;
		} elseif ($model->id_kegiatan_status == 0) {
			$model->id_kegiatan_status = 1;
		}

		$model->save();
		Yii::app()->user->setFlash('success','Status Kegiatan berhasil diubah');
		$this->redirect(['kegiatanInduk/view','id'=>$model->id]);
	}
}
