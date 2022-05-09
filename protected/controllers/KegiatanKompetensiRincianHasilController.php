<?php

class KegiatanKompetensiRincianHasilController extends Controller
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
				'actions'=>array('create','update','exportIsianExcel','exportIndividual'),
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
	public function actionCreate($id_penilai,$id_kegiatan)	
		{			
			foreach(KegiatanKompetensi::model()->findAllByAttributes(array('id_kegiatan'=>$id_kegiatan)) as $kegiatan_kompetensi) {
				foreach(KegiatanKompetensiRincian::model()->findAllByAttributes(array('id_kegiatan_kompetensi'=>$kegiatan_kompetensi->id)) as $kompetensi_rincian) {
					
					$model = new KegiatanKompetensiRincianHasil;

					$data = $_POST[$kompetensi_rincian->id];
					$model->id_kegiatan_penilai = $id_penilai;
					$model->id_kegiatan_kompetensi_rincian = $kompetensi_rincian->id;
					$model->hasil = $data;
						$model->save();
				}
			}

			Yii::app()->user->setFlash('success','Penilaian Berhasil !');
			$this->redirect(array('kegiatanPenilai/penilaian','id_penilai'=>$id_penilai,'id_kegiatan'=>$id_kegiatan));			
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

		if(isset($_POST['KegiatanKompetensiRincianHasil']))
		{
			$model->attributes=$_POST['KegiatanKompetensiRincianHasil'];
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


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KegiatanKompetensiRincianHasil('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanKompetensiRincianHasil']))
			$model->attributes=$_GET['KegiatanKompetensiRincianHasil'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionExportIsianExcel($id_kompetensi)
	{
		
			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$PHPExcel = new PHPExcel();
			
			$PHPExcel->getActiveSheet()->setCellValue('A1', 'RATERS INPUT FOR SPECIFIC TARGET');

			$PHPExcel->getActiveSheet()->mergeCells('A5:A7');
			$PHPExcel->getActiveSheet()->mergeCells('B5:C7');

			$PHPExcel->getActiveSheet()->setCellValue('A2', 'Survey Name');
			$PHPExcel->getActiveSheet()->setCellValue('B2', ':');
			$PHPExcel->getActiveSheet()->setCellValue('C2', 'PT ABC');

			$PHPExcel->getActiveSheet()->setCellValue('A2', 'Tanggal Survey');
			$PHPExcel->getActiveSheet()->setCellValue('B2', ':');
			$PHPExcel->getActiveSheet()->setCellValue('C2', '10 Mei 20xx');		

			//==========

			$PHPExcel->getActiveSheet()->setCellValue('A3', 'Target Name');
			$PHPExcel->getActiveSheet()->setCellValue('B3', ':');
			$PHPExcel->getActiveSheet()->setCellValue('C3', 'VILA VILA');

			$PHPExcel->getActiveSheet()->setCellValue('A3', 'Target Job');
			$PHPExcel->getActiveSheet()->setCellValue('B3', ':');
			$PHPExcel->getActiveSheet()->setCellValue('C3', 'Manager');

			$PHPExcel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);		

		
			$PHPExcel->getActiveSheet()->setCellValue('A5', 'COMPETENCY');
			$PHPExcel->getActiveSheet()->setCellValue('B5', 'ITEM PERTANYAAN');
			$PHPExcel->getActiveSheet()->setCellValue('D5', 'RATER');

			$chr=68;
			$i=1;
			foreach(PenilaiPeran::model()->findALl() as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue(chr($chr).'6', $data->nama);	
				$PHPExcel->getActiveSheet()->mergeCells(chr($chr).'6:'.chr($chr+1).'6');
				$PHPExcel->getActiveSheet()->getStyle('D4:'.chr($chr+1).'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$chr = $chr+2;

				$PHPExcel->getActiveSheet()->setCellValue(chr($chr-2).'7', 'CP');
				$PHPExcel->getActiveSheet()->setCellValue(chr($chr-1).'7', 'CPR');	
				$i++;
			}
			$PHPExcel->getActiveSheet()->mergeCells('D5:'.chr($chr).'5');

			
			$PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			
			$PHPExcel->getActiveSheet()->getStyle('A5:'.chr($chr+1).'7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$PHPExcel->getActiveSheet()->getStyle('A5:'.chr($chr+1).'7')->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle('A5:'.chr($chr+1).'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    
			$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
			$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
			$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);		
			$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);

			$i = 1;
			$kolom = 8;

			foreach(KegiatanKompetensiRincian::model()->findAllByAttributes(array('id_kegiatan_kompetensi'=>$id_kompetensi)) as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $i);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$kolom, $data->uraian);


				$PHPExcel->getActiveSheet()->getStyle('A'.$kolom.':'.chr($chr+1).$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$kolom++;
				$i++;
			}
	
			$filename = time().'_excel.xlsx';

			$path = Yii::app()->basePath.'/../exports/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			$objWriter->save($path.$filename);	
			$this->redirect(Yii::app()->request->baseUrl.'/exports/'.$filename);
	}

	public function actionExportIndividual($id_kompetensi)
	{
		
			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$PHPExcel = new PHPExcel();
			
			$PHPExcel->getActiveSheet()->setCellValue('A1', 'INDIVIDUAL REPORT');	

			$PHPExcel->getActiveSheet()->mergeCells('A1:F1');		
			$PHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
			$PHPExcel->getActiveSheet()->setCellValue('A4', 'NO');
			$PHPExcel->getActiveSheet()->setCellValue('B4', 'ITEM');
			$PHPExcel->getActiveSheet()->setCellValue('D4', 'N');
			$PHPExcel->getActiveSheet()->setCellValue('E4', 'GRAFIK INDIVIDUAL');
			$PHPExcel->getActiveSheet()->setCellValue('F4', 'NILAI');

			$PHPExcel->getActiveSheet()->mergeCells('B4:C4');
			
			$PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			
			$PHPExcel->getActiveSheet()->getStyle('A4:F4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$PHPExcel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    
			$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
			$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);		
			$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
			$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);

			$i = 1;
			$kolom = 6;
			$kompetensi = KegiatanKompetensi::model()->findByAttributes(array('id'=>$id_kompetensi));

			$PHPExcel->getActiveSheet()->setCellValue('B5', $kompetensi->uraian);
			$PHPExcel->getActiveSheet()->mergeCells('B5:C5');

			foreach(KegiatanKompetensiRincian::model()->findAllByAttributes(array('id_kegiatan_kompetensi'=>$id_kompetensi)) as $data)
			{	
				$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom, $i);								
				$PHPExcel->getActiveSheet()->setCellValue('C'.$kolom, $data->uraian);				
				$PHPExcel->getActiveSheet()->setCellValue('D'.$kolom, '');
				$PHPExcel->getActiveSheet()->getStyle('A5:F'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$kolom++;
				$i++;
			}
	
			$filename = time().'_excel.xlsx';

			$path = Yii::app()->basePath.'/../exports/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			$objWriter->save($path.$filename);	
			$this->redirect(Yii::app()->request->baseUrl.'/exports/'.$filename);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanKompetensiRincianHasil the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanKompetensiRincianHasil::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanKompetensiRincianHasil $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-kompetensi-rincian-hasil-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
