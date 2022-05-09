<?php

class KegiatanPenilaiController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','penilaian','directDelete','ubahStatus','ubahStatusHitung'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model = new KegiatanPenilai;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$criteria = new CDbCriteria;

		$criteria->condition = ('id_penilai_peran =1 AND id_kegiatan = :kegiatan');		
		$criteria->params = array(':kegiatan' => $id);

		if(isset($_POST['KegiatanPenilai']))
		{
			$model->attributes=$_POST['KegiatanPenilai'];
			$peran = $_POST['KegiatanPenilai']['id_penilai_peran'];
			$model->id_kegiatan = $id;

			if($peran ==1)
			{
				$kegiatanPenilai = KegiatanPenilai::model()->find($criteria);
				if($kegiatanPenilai == null){
					if($model->save()) {
						$this->redirect(array('kegiatan/view','id'=>$id,'tab'=>'penilai'));			
					}
				}
				else
				{
					Yii::app()->user->setFlash('danger','Penilai Self sudah ada !');
				}
			}

			else
			{
				if($model->save()){
					$this->redirect(array('kegiatan/view','id'=>$id,'tab'=>'penilai'));			
				}	
			}
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

		if(isset($_POST['KegiatanPenilai']))
		{
			$model->attributes=$_POST['KegiatanPenilai'];
			if($model->save())
				$this->redirect(array('kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'penilai'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionPenilaian($id,$id_kegiatan)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['KompetensiRincianCp']) OR isset($_POST['KompetensiRincianCpr']) OR isset($_POST['uraian_deskripsi'])) {
			if (isset($_POST['KompetensiRincianCp'])) {
				foreach($_POST['KompetensiRincianCp'] as $key => $value) {
					$hasil = KegiatanKompetensiRincianHasil::model()->findByAttributes(array(
						'id_kegiatan_kompetensi_rincian'=>$key,
						'id_kegiatan_penilai'=>$id
					));

					if($hasil === null) {
						$hasil = new KegiatanKompetensiRincianHasil;
						$hasil->id_kegiatan_kompetensi_rincian = $key;
						$hasil->id_kegiatan_penilai = $id;
					}

					$hasil->cp = $value;
					$hasil->save();
				}
			}

			if (isset($_POST['KompetensiRincianCpr'])) {
				foreach($_POST['KompetensiRincianCpr'] as $key => $value) {
					$hasil = KegiatanKompetensiRincianHasil::model()->findByAttributes(array(
						'id_kegiatan_kompetensi_rincian'=>$key,
						'id_kegiatan_penilai'=>$id
					));

					if($hasil === null) {
						$hasil = new KegiatanKompetensiRincianHasil;
						$hasil->id_kegiatan_kompetensi_rincian = $key;
						$hasil->id_kegiatan_penilai = $id;
					}

					$hasil->cpr = $value;
					$hasil->save();
				}
			}


			if (isset($_POST['uraian_deskripsi'])) {
				$model->uraian_deskripsi = $_POST['uraian_deskripsi'];
				$model->save();
			}

			Yii::app()->user->setFlash('success','Data berhasil disimpan');

			/*
			if (isset($_POST['kirim_penilaian'])) {
				if($_POST['kirim_penilaian']) {
					$this->redirect(array('ubahStatus','id'=>$model->id));
				}
			}
			*/

			if(User::isAdmin()) 
				$this->redirect(array('kegiatan/view','id'=>$id_kegiatan,'tab'=>'penilai'));

			if(User::isPegawai()) 
				$this->redirect(array('kegiatanPenilai/penilaian','id'=>$model->id,'id_kegiatan'=>$id_kegiatan));
			
		}

		$this->render('penilaian',array(
			'model'=>$model,
			'id'=>$id,
			'id_kegiatan' => $id_kegiatan
		));
	}


	public function actionDirectDelete($id)
	{
		$model = $this->loadModel($id);
		if ($model->isSelf()) {
			Yii::app()->user->setFlash('danger','Tidak dapat menghapus penilai Self, Silahkan hapus kegiatan atau Sunting jika ingin mengganti target penilaian');
			$this->redirect(array('kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'penilai'));
		}
		if($model->delete())
			$this->redirect(array('kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'penilai'));
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KegiatanPenilai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanPenilai']))
			$model->attributes=$_GET['KegiatanPenilai'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanPenilai the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanPenilai::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanPenilai $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-penilai-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUbahStatus($id,$fromKegiatan = false)
	{
		$model = $this->loadModel($id);

		if (!$model->isTerisiSemua()) {
			Yii::app()->user->setFlash('warning','Silahkan lengkapi nilai terlebih dahulu untuk mengirimkan nilai');

			if ($fromKegiatan)
				$this->redirect(['kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'penilai']);
			else
				$this->redirect(['kegiatanPenilai/penilaian','id'=>$model->id,'id_kegiatan'=>$model->id_kegiatan]);
		}

		if ($model->status_penilaian == 1)
			$model->status_penilaian = 0;
		else
			$model->status_penilaian = 1;

		if ($model->save()) {
			Yii::app()->user->setFlash('success','Status Penilaian berhasil diubah !');
			if ($fromKegiatan)
				$this->redirect(['kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'penilai']);
			else
				$this->redirect(['kegiatanPenilai/penilaian','id'=>$model->id,'id_kegiatan'=>$model->id_kegiatan]);
		}

	}

	public function actionUbahStatusHitung($id)
	{
		$model = $this->loadModel($id);

		if ($model->status_hitung == 1)
			$model->status_hitung = 0;
		else
			$model->status_hitung = 1;

		if ($model->save()) {
			Yii::app()->user->setFlash('success','Status Hitung berhasil diubah !');
			$this->redirect(Yii::app()->request->urlReferrer.'&tab=penilai');
		}

	}
}
