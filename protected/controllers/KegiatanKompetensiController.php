<?php

class KegiatanKompetensiController extends Controller
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
				'actions'=>array('create','update','directDelete','refreshUrutan'),
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

	public function actionRefreshUrutan()

	{
		$i=1;
		foreach (KegiatanKompetensi::model()->findAll() as $data) {
			$model = KegiatanKompetensi::model()->findByAttributes(array('id'=>$data->id));
			$model->urutan = $i;
			$model->update();
			$i++;
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id_kegiatan)
	{
		$model = new KegiatanKompetensi;

		$model->id_kegiatan = $id_kegiatan;

		$model->setUrutan();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KegiatanKompetensi']))
		{

			$criteria = new CDbCriteria;				

			$model->attributes=$_POST['KegiatanKompetensi'];
			
			if($model->save())
			{
				Yii::app()->user->setFlash('success','Data berhasil disimpan');
				$this->redirect(array('kegiatan/view','id'=>$id_kegiatan,'tab'=>'kompetensi'));
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

		if(isset($_POST['KegiatanKompetensi']))
		{
			$model->attributes=$_POST['KegiatanKompetensi'];
			if($model->save())
				$this->redirect(array('kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'kompetensi'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDirectDelete($id)
	{
		$model = $this->loadModel($id);
		
		$id_kegiatan = $model->id_kegiatan;

		if($model->hasKegiatanKompetensiRincian())
		{
			foreach ($model->findAllKompetensiKegiatanRincian() as $rincian) {
				$rincian->delete();
			}
			$model->delete();
			Yii::app()->user->setFlash('success','Data Kompetensi dan Rincian Berhasil dihapus');
			$this->redirect(['kegiatan/view','id'=>$id_kegiatan]);
		}

		if($model->delete())
		{
			Yii::app()->user->setFlash('success','Data berhasil dihapus');
			$this->redirect(array('kegiatan/view','id'=>$model->id_kegiatan,'tab'=>'kompetensi'));
		}
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
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KegiatanKompetensi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanKompetensi']))
			$model->attributes=$_GET['KegiatanKompetensi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanKompetensi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanKompetensi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanKompetensi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-kompetensi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
