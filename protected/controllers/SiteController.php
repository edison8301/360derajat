<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	public $layout='//layouts/main';
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionBackup()
	{
		Helper::backupDb(Yii::getPathOfAlias('webroot.protected.data.backup').'/backup-'.date('d-F-Y').'.sql');
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));

		if(User::isAdmin() || User::isSuperAdmin())
		{
			$criteria = new CDbCriteria;
			$tanggal_sekarang = date('Y-m-d');
			//id_kegiatan_status =1 (aktif)
			$criteria->with = ['kegiatanInduk'];
			$criteria->together = true;
			$criteria->addCondition('kegiatanInduk.tanggal_mulai <= :tanggal_sekarang AND kegiatanInduk.tanggal_selesai >= :tanggal_sekarang AND kegiatanInduk.id_kegiatan_status = 1');
			$criteria->params = array(':tanggal_sekarang'=>$tanggal_sekarang);

			$dataProvider=new CActiveDataProvider('Kegiatan',array(
				'criteria'=>$criteria,
				'pagination'=>array(
	      		  'pageSize'=>10,
	    		),
			));

			$this->render('index',array(
				'dataProvider'=>$dataProvider,				
			));
		}

		if(User::isPegawai())
		{
			$this->redirect(array('pegawai/index'));
		}
				
		 
	}

	public function actionLaporan()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));
				
		$this->render('laporan');
		 
	}

	public function actionPerawatan()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'waktu_dibuat IS NULL';

		foreach(Barang::model()->findAll($criteria) as $data)
		{
			$data->waktu_dibuat = date('Y-m-d H:i:s');
			$data->save();
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = '//layouts/login';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionDetailKelompok($id)
	{
		$model=new Barang;

		$dataProvider=new CActiveDataProvider('Barang');
		$this->render('detail_kategori',array(
			'dataProvider'=>$model,
			'id'=>$id,
		));

	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin($token=null)
	{
		$this->layout = '//layouts/login';
		
		$model=new LoginForm;

		if ($token != null) {
			if($model->loginByToken($token))
			{
				Yii::app()->user->setFlash('success','Berhasil Login Menggunakan Token!');
				$this->redirect(array('pegawai/index'));
			} else {
				Yii::app()->user->setFlash('danger','Token tidak sesuai, silahkan login menggunakan username dan password');
				$this->redirect(array('site/login'));
			}
		} else {
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
				{
					Yii::app()->user->setFlash('success','Login berhasil');
					$this->redirect(array('site/index'));
				}
			}
			// display the login form
			$this->render('login',array('model'=>$model));
		}
	}

	public function actionProfil()
	{
		if (User::isPegawai()) {
			$model = Pegawai::model()->findByAttributes(['username'=>Yii::app()->user->id]);
			$this->render('profil',array(
				'model'=>$model,
			));
		} else
			$this->redirect('site/index');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionDev()
	{
		$lorem = ['as','asd','123','123'];

		print implode('+', $lorem);
	}
}