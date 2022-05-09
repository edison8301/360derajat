<?php

class KegiatanController extends Controller
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
				'actions'=>array('create','update','saveBankKompetensi','refreshUrutan','tambahBankKompetensi','exportPdfExecutiveSummary','direcrDelete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','exportExcelIsian','exportExcelIsianBaru','exportExcelIndividual','bankKompetensi',
					'exportPdfIsian','exportPdfIndividual','exportExcelExecutiveSummary'),
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
	public function actionCreate()
	{
		$model=new Kegiatan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kegiatan']))
		{
			$model->attributes=$_POST['Kegiatan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionBankKompetensi($id)
	{
		$this->render('bank_kompetensi',array('id'=>$id));
	}

	public function actionSaveBankKompetensi($id_kegiatan)
	{

			if(!empty($_POST['Kompetensi']))
			{

				foreach($_POST['Kompetensi'] as $key => $value)
				{
					$model = new KegiatanKompetensi;
					$kompetensi = Kompetensi::model()->findByAttributes(array('id'=>$key));

					$model->id_kegiatan = $id_kegiatan;
					$model->uraian = $kompetensi->uraian;
					$model->save();
					
					$rincian = KompetensiRincian::model()->findByAttributes(array('id_kompetensi'=>$key));
					if($rincian !==null)
					{
						foreach (KompetensiRincian::model()->findAllByAttributes(array('id_kompetensi'=>$key)) as $kompetensi_rincian) {
							$model_rincian = new KegiatanKompetensiRincian;
							$model_rincian->id_kegiatan_kompetensi = $model->id;
							$model_rincian->uraian = $kompetensi_rincian->uraian;
							$model_rincian->save();
						}
					}
				}
			}

		Yii::app()->user->setFlash('success','Data Telah Di tambahkan');

		$this->redirect(array('kegiatan/view','id'=>$id_kegiatan,'tab'=>'kompetensi'));
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

		if(isset($_POST['Kegiatan']))
		{
			$model->attributes=$_POST['Kegiatan'];
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

	public function actionDirectDelete($id)
	{
		$model = $this->loadModel($id);
		if ($model->delete()){
			Yii::app()->user->setFlash('success','Kegiatan berhasil dihapus');
			$this->redirect(['kegiatanInduk/view','id'=>$model->id_kegiatan_induk]);
		}
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kegiatan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kegiatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kegiatan']))
			$model->attributes=$_GET['Kegiatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kegiatan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kegiatan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kegiatan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExportExcelIsian($id)
	{
		$model = $this->loadModel($id);
		
		if (!$model->hasKegiatanKompetensi()) {
			Yii::app()->user->setFlash('danger','Tidak dapet export excel karena Kegiatan tidak memiliki Kompetensi');
			$this->redirect(['view','id'=>$model->id]);
		}

		spl_autoload_unregister(array('YiiBase','autoload'));
	
		Yii::import('application.vendors.PHPExcel',true);
	
		spl_autoload_register(array('YiiBase', 'autoload'));


		$setBorderArray = array(
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN
		        )
		    )
		);

		$fillColorArray1 = [
			'fill' => [
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => '8DB4E2')
	        ]
		];

		$fillColorArray2 = [
			'fill' => [
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'C5D9F1')
	        ]
		];

		$fillColorArray3 = [
			'fill' => [
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => '1F497D')
	        ]
		];

		$fillColorArray4 = [
			'fill' => [
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => '538DD5')
	        ]
		];

		$PHPExcel = new PHPExcel();
		
		/*===================================
		=            Hasil Isian            =
		===================================*/

		$PHPExcel->getActiveSheet()->setTitle('Isian');
		
		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setWrapText(true);
		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$PHPExcel->getActiveSheet()->setCellValue('A1', 'RATERS INPUT FOR SPECIFIC TARGET');

		/*$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo ');
        $objDrawing->setDescription('Logo ');
        $objDrawing->setPath('images/360.png');
        $objDrawing->setCoordinates('A14');
        $objDrawing->setResizeProportional(true);
        $objDrawing->setWidth(40);
        $objDrawing->setWorksheet($PHPExcel->getActiveSheet());*/

		$PHPExcel->getActiveSheet()->mergeCells('A1:C1');

		$PHPExcel->getActiveSheet()->mergeCells('A5:A7');
		$PHPExcel->getActiveSheet()->mergeCells('B5:C7');

		$PHPExcel->getActiveSheet()->setCellValue('A2', 'Survey Name');
		$PHPExcel->getActiveSheet()->setCellValue('B2', ':');
		$PHPExcel->getActiveSheet()->setCellValue('C2', $model->kegiatanInduk->nama);

		$PHPExcel->getActiveSheet()->setCellValue('A2', 'Tanggal Survey');
		$PHPExcel->getActiveSheet()->setCellValue('B2', ':');
		$PHPExcel->getActiveSheet()->setCellValue('C2', Helper::getTanggal($model->kegiatanInduk->tanggal_mulai));		

		$PHPExcel->getActiveSheet()->setCellValue('A3', 'Target Job');
		$PHPExcel->getActiveSheet()->setCellValue('B3', ':');
		$PHPExcel->getActiveSheet()->setCellValue('C3', $model->kegiatanInduk->target);

		$PHPExcel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);		
		$PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$row = 5;

		$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
		$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);


		/**
		 * Array di bawah ini digunakan untuk mengambil alamat cell cp_all, cpr, dan cpro
		 * Karena sulit untuk didinamiskan, maka sebuah value dipush ketika salah satu
		 * dari variabel dimunculkan ke dalam array di bawah ini,nantinya akan dipanggil 
		 * di sheet ke Individual Report
		 */
		$arr_cp_all = [];
		$arr_cpr = [];
		$arr_cpro = [];

		$setVariabelChart = true;

		foreach($model->findAllKompetensi() as $kompetensi)
		{
			//START OF HEADER
			//START OF  PENILAIAN -- HEADER
			$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'COMPETENCY');
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'ITEM PERTANYAAN');
			$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'RATER');

			$PHPExcel->getActiveSheet()->mergeCells('A'.($row).':'.'A'.($row+2));
			$PHPExcel->getActiveSheet()->mergeCells('B'.($row).':'.'C'.($row+2));

			$PHPExcel->getActiveSheet()->setCellValue('D'.($row), 'CPRO');
			$PHPExcel->getActiveSheet()->setCellValue('E'.($row), 'FPRO');

			$PHPExcel->getActiveSheet()->mergeCells('D'.($row).':'.'D'.($row+2));
			$PHPExcel->getActiveSheet()->mergeCells('E'.($row).':'.'E'.($row+2));			

			//Tulisan miring judul kompetensi
			$PHPExcel->getActiveSheet()->setCellValue('A'.($row+3),$kompetensi->uraian);
			$PHPExcel->getActiveSheet()->getStyle('A'.($row+3))->getAlignment()->setTextRotation(90);

			$PHPExcel->getActiveSheet()->mergeCells('A'.($row+3).':'.'A'.($row+3+($kompetensi->countAllRincian())));
			$PHPExcel->getActiveSheet()->getStyle('A'.($row+3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//End
		
			$chr=70;
			$i=1;

			$ganjil = true;

			//row yang banyaknya tergantung dengan jumlah penilai, 1 penilai 2 kolom dengan merge
			foreach($model->findAllPenilai() as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr).($row+1), $data->getRelation('penilai_peran','nama'));	
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr).($row+2), 'CP');
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr+1).($row+2), 'CPR');

				$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr))->setWidth(7);	
				$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr+1))->setWidth(7);	

				$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr).($row+1).':'.Helper::getChar($chr+1).($row+1));

				if ($ganjil){
					$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr).($row+2).':'.Helper::getChar($chr+1).($row+2))->applyFromArray($fillColorArray3);
					$ganjil = false;
				} else {
					$ganjil = true;
					$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr).($row+2).':'.Helper::getChar($chr+1).($row+2))->applyFromArray($fillColorArray4);
				}

				$chr += 2;
			
			}
			$chr--;
			$PHPExcel->getActiveSheet()->getStyle('A'.$row.':'.Helper::getChar($chr).($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar(70).($row+1).':'.Helper::getChar($chr).($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar(70).($row+1).':'.Helper::getChar($chr).($row+1))->applyFromArray($fillColorArray2);;
			//END OF row
			
			$PHPExcel->getActiveSheet()->mergeCells('F'.($row).':'.Helper::getChar($chr).($row));

			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':'.Helper::getChar($chr).($row+2))->applyFromArray($setBorderArray);
			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':'.Helper::getChar($chr).($row+2))->getFont()->setBold(true);

			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':F'.$row)->applyFromArray($fillColorArray1);

			//END OF PENILAIAN -- HEADER
			//START OF  EXECUTIVE SUMMARY COMPETENCY -- HEADER
			//chr executive summary competency
			$chr_executive = $chr+3;

			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive))->setWidth(25);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+1))->setWidth(13);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+2))->setWidth(15);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+3))->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+4))->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+5))->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+6))->setWidth(10);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_executive+7))->setWidth(10);

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).$row,'EXECUTIVE SUMMARY COMPETENCY');

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive)).($row+1),'KOMPETENSI');
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).($row+1),"JUMLAH\nITEM");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+2)).($row+1),"RATER\nExc. Self");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+3)).($row+1),"NILAI");

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+3)).($row+2),"CP ALL");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+4)).($row+2),"CPR");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+5)).($row+2),"GAP");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+6)).($row+2),"CPRO");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+7)).($row+2),"GAP O");

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive).$row.':'.Helper::getChar($chr_executive+7).$row); //Merge executive summary competency

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive).($row+1).':'.Helper::getChar($chr_executive).($row+2)); //Merge Kompetensi
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive+1).($row+1).':'.Helper::getChar($chr_executive+1).($row+2)); //Merge Jumlah Item
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive+2).($row+1).':'.Helper::getChar($chr_executive+2).($row+2)); //Merge Rater exc. self

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive+3).($row+1).':'.Helper::getChar($chr_executive+7).($row+1)); //Merge Nilai

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row.':'.Helper::getChar($chr_executive+7).($row+2))->getFont()->setBold(true); //Set Bold
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row.':'.Helper::getChar($chr_executive+7).($row+2))->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row.':'.Helper::getChar($chr_executive+7).($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Header Center
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row.':'.Helper::getChar($chr_executive+7).($row+2))->applyFromArray($fillColorArray2);
			//END OF EXECUTIVE SUMMARY COMPETENCY -- HEADER
			//START OF  KEY BEHAVIOR REPORT -- HEADER
			//chr key behaviour report
			$chr_key = $chr_executive+9;	

			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key))->setWidth(25);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+1))->setWidth(13);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+2))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+3))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+4))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+5))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+6))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+7))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+8))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+9))->setWidth(8);
			$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr_key+10))->setWidth(8);

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_key).$row,"KEY BEHAVIOUR REPORT");

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_key).($row+1),"No. ITEM");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+1)).($row+1),"JML\nRATER ALL");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+2)).($row+1),"NILAI");

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+2)).($row+2),"Self");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+3)).($row+2),"CP Spr");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+4)).($row+2),"Cp Peer");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+5)).($row+2),"Cp Sub");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+6)).($row+2),"Cp All");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+7)).($row+2),"CPR");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+8)).($row+2),"GAP");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+9)).($row+2),"CPRO");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+10)).($row+2),"GAP-O");

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_key).$row.':'.Helper::getChar(($chr_key+10)).$row); //Merge key behaviour report

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_key).($row+1).':'.Helper::getChar($chr_key).($row+2)); //Merge no. item
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_key+1)).($row+1).':'.Helper::getChar(($chr_key+1)).($row+2)); //Merge jml rater all

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_key+2)).($row+1).':'.Helper::getChar(($chr_key+10)).($row+1)); //Merge nilai

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row.':'.Helper::getChar($chr_key+10).($row+2))->getFont()->setBold(true); //Set Bold
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row.':'.Helper::getChar($chr_key+10).($row+2))->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row.':'.Helper::getChar($chr_key+10).($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Header Center
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row.':'.Helper::getChar($chr_key+10).($row+2))->applyFromArray($fillColorArray2);

			//END OF KEY BEHAVIOR REPORT -- HEADER
			//END OF HEADER
			
			//+3 row karena header, untuk isian
			$row += 3;

			$awalRow = $row;

			$jumlah_rincian = 0;

			$total_cp = 0;
			$total_cpr = 0;
			$i = 1;
			$chr = 70;
			/**
			 * START OF  PENILAIAN -- ISI
			 * @var $chr chr untuk penilaian. Dengan default 70 (F)
			 * @var $chr_executive chr untuk executive summary competency
			 * @var $chr_key chr untuk key behaviour report
			 */
			foreach($kompetensi->findAllRincian() as $rincian)
			{
				if ($i>8) {
					$PHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(40);
				}
				$PHPExcel->getActiveSheet()->setCellValue('B'.$row, $i++);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$row, $rincian->uraian);

				$PHPExcel->getActiveSheet()->setCellValue('D'.$row, $kompetensi->cpro);
				$PHPExcel->getActiveSheet()->setCellValue('E'.$row, $kompetensi->fpro);

				$chr_penilaian = $chr;
				foreach($model->findAllPenilai() as $penilai)
				{
					$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian).($row), $rincian->getCpByIdPenilai($penilai->id));
					$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian+1).($row), $rincian->getCprByIdPenilai($penilai->id));

					$total_cp += $rincian->getCpByIdPenilai($penilai->id);
					$total_cpr += $rincian->getCprByIdPenilai($penilai->id);

					$chr_penilaian += 2;
				}

				$chr_penilaian-=1;
				if ($i%2 == 0)
					$PHPExcel->getActiveSheet()->getStyle('B'.$row.':'.Helper::getChar($chr_penilaian).$row)->applyFromArray($fillColorArray2);
				$row++;
			} //ENDFOREACH KOMPETENSI

			//START OF TOTAL JUMLAH
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'JUMLAH TOTAL');
			$PHPExcel->getActiveSheet()->mergeCells('B'.$row.':C'.($row));
			$penilai = $model->countAllPenilai();

			//reset chr_penilaian menjadi 70 untuk isi
			$chr_penilaian = $chr;
			for ($data=0; $data < $penilai ; $data++) { 
				$jumlah_kompetensi = $kompetensi->countAllRincian();
				$awal = $row-$jumlah_kompetensi;
				$akhir = $row;
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian).($row), Helper::sumHelperVertikal($awal,$akhir,$chr_penilaian));
				$chr_penilaian++;
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian).($row), Helper::sumHelperVertikal($awal,$akhir,$chr_penilaian));
				$chr_penilaian++;
			}
			//END OF TOTAL JUMLAH
			//-1 chr_penilaian untuk mengurangi kelebihan
			$chr_penilaian--;

			$PHPExcel->getActiveSheet()->getStyle('B'.$row.':'.Helper::getChar($chr_penilaian).$row)->getFont()->setBold(true); //Set Bold Total
			$PHPExcel->getActiveSheet()->getStyle('B'.$row.':'.Helper::getChar($chr_penilaian).$row)->applyFromArray($fillColorArray1); //Set Color

			$PHPExcel->getActiveSheet()->getStyle('A'.$awalRow.':'.Helper::getChar($chr_penilaian).$row)->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle('B'.$awalRow.':B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Header Center; //Set Border
			$PHPExcel->getActiveSheet()->getStyle('D'.$awalRow.':'.Helper::getChar($chr_penilaian).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Header Center; //Set Border

			//END OF PENILAIAN -- ISI
			/*===========================================================
			=            EXECUTIVE SUMMARY COMPETENCY -- ISI            =
			===========================================================*/

			$row_executive = $awalRow;

			//START OF bag1 -- isi
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).$row_executive, "=A".$awalRow); //ambil dari sel A / nama rincian penilaian
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).$row_executive, $kompetensi->countAllRincian()); //jumlah rincian
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+2)).$row_executive, $model->countAllPenilai(true)); //jumlah penilai exc. self
			//@var $chr=70

			/**
			 * @var $selfHelper adalah sebagai pembantu apakah penilai ada self apa tidak, jika ada tambah 2 agar self tidak dihitung penilaiannya pada field CP ALL
			 * @var $selfHelper2 adalah sebagai pembantu apakah penilai ada self apa tidak, jika ada kurang 1 agar perhitungan SUM tidak melebihi kolom yang diperlukan
			 */
			$selfHelper = 0;
			$selfHelper2 = 0;
			
			if ($model->findSelf() != null){
				$selfHelper = 2;
				$selfHelper2 = 1;
			}

			$PHPExcel->getActiveSheet()->getRowDimension($row_executive)->setRowHeight(40);

			$cp_all = "=(";

			if (($penilai_spr = $model->countAllPenilaiByIdPeran(2))) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_spr.")*".$model->getBobotSpr();
				$cp_all .= Helper::sumHelperHorizontal($chr+$selfHelper,$penilai_spr,$row,true,$append,true);
			}

			if (($penilai_peer = $model->countAllPenilaiByIdPeran(3))) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_peer.")*".$model->getBobotPeer();
				$cp_all .= "+".Helper::sumHelperHorizontal($chr+$selfHelper+($penilai_spr * 2),$penilai_peer,$row,true,$append,true);
			}

			if (($penilai_sub = $model->countAllPenilaiByIdPeran(4))) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_sub.")*".$model->getBobotSub();
				$cp_all .= "+".Helper::sumHelperHorizontal($chr+$selfHelper+($penilai_spr * 2)+($penilai_peer * 2),$penilai_sub,$row,true,$append,true);
			}
			$cp_all .= ")";

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+3)).$row_executive, $cp_all);
			array_push($arr_cp_all, Helper::getChar(($chr_executive+3)).$row_executive);

			$cpr = "=";

			if ($penilai_spr) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_spr.")*".$model->getBobotSpr();
				$cpr .= Helper::sumHelperHorizontal(($chr+1)+$selfHelper,$penilai_spr,$row,true,$append,true);
			}

			if ($penilai_peer) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_peer.")*".$model->getBobotPeer();
				$cpr .= "+".Helper::sumHelperHorizontal(($chr+1)+$selfHelper+($penilai_spr * 2),$penilai_peer,$row,true,$append,true);
			}

			if ($penilai_sub) {
				$append = "/(".Helper::getChar(($chr_executive+1)).$row_executive."*".$penilai_sub.")*".$model->getBobotSub();
				$cpr .= "+".Helper::sumHelperHorizontal(($chr+1)+$selfHelper+($penilai_spr * 2)+($penilai_peer * 2),$penilai_sub,$row,true,$append,true);
			}

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+4)).$row_executive, $cpr);
			array_push($arr_cpr, Helper::getChar(($chr_executive+4)).$row_executive);

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+5)).$row_executive, "=".Helper::getChar(($chr_executive+3)).$row_executive."-".Helper::getChar(($chr_executive+4)).$row_executive);

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+6)).$row_executive, $kompetensi->cpro);
			array_push($arr_cpro, Helper::getChar(($chr_executive+6)).$row_executive);

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+7)).$row_executive, "=".Helper::getChar(($chr_executive+3)).$row_executive."-".Helper::getChar(($chr_executive+6)).$row_executive);
			//END OF bag1 - isi
			//START OF bag 2
			//-- START OF header
			$PHPExcel->getActiveSheet()->getRowDimension(($row_executive+1))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_executive+1), "KATEGORI");

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).($row_executive+1), "KRITERIA");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+1)).($row_executive+1).':'.Helper::getChar(($chr_executive+2)).($row_executive+1));

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+3)).($row_executive+1), "GAP KOMPETENSI");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+3)).($row_executive+1).':'.Helper::getChar(($chr_executive+5)).($row_executive+1));

			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+6)).($row_executive+1), "GAP ORGANISASI");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+6)).($row_executive+1).':'.Helper::getChar(($chr_executive+7)).($row_executive+1));

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).($row_executive+1).':'.Helper::getChar(($chr_executive+7)).($row_executive+1))->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).($row_executive+1).':'.Helper::getChar(($chr_executive+7)).($row_executive+1))->applyFromArray($fillColorArray2);
			
			//-- END OF header
			//-- START OF side header
			$PHPExcel->getActiveSheet()->getRowDimension(($row_executive+2))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_executive+2), "STRENGTH");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).($row_executive+2), "GAP>=1");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+1)).($row_executive+2).':'.Helper::getChar(($chr_executive+2)).($row_executive+2));

			$PHPExcel->getActiveSheet()->getRowDimension(($row_executive+3))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_executive+3), "MEET EXPECTATION");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).($row_executive+3), "1 > GAP > -1");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+1)).($row_executive+3).':'.Helper::getChar(($chr_executive+2)).($row_executive+3));

			$PHPExcel->getActiveSheet()->getRowDimension(($row_executive+4))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_executive+4), "DEVELOPMENTAL AREA");
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+1)).($row_executive+4), "GAP <= -1");
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+1)).($row_executive+4).':'.Helper::getChar(($chr_executive+2)).($row_executive+4));
			//-- END OF side header
			//-- START OF isi gap kompetensi
			$gap = Helper::getChar(($chr_executive+5)).$row_executive;
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+3)).($row_executive+2), '=IF('.$gap.'>=1,"STRENGTH",IF('.$gap.'<=-1,"DEVELOPMENTAL AREA","MEET EXPECTATION"))');
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+3)).($row_executive+2).':'.Helper::getChar(($chr_executive+5)).($row_executive+4));

			$gap = Helper::getChar(($chr_executive+7)).$row_executive;
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_executive+6)).($row_executive+2), '=IF('.$gap.'>=1,"STRENGTH",IF('.$gap.'<=-1,"DEVELOPMENTAL AREA","MEET EXPECTATION"))');
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar(($chr_executive+6)).($row_executive+2).':'.Helper::getChar(($chr_executive+7)).($row_executive+4));
			//-- END OF isi gap kompetensi

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_executive.':'.Helper::getChar(($chr_executive+7)).($row_executive+4))->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_executive.':'.Helper::getChar(($chr_executive+7)).($row_executive+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//END OF bag 2 
			//END OF EXECUTIVE SUMMARY COMPETENCY -- ISI
			//START OF JUMLAH NILAI LAINNYA
			$row_jumlah = $row_executive + 5;
			$PHPExcel->getActiveSheet()->getRowDimension($row_jumlah)->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).$row_jumlah, 'JUMLAH NILAI LAINNYA');
			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_executive).$row_jumlah.':'.Helper::getChar($chr_executive+1).$row_jumlah);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_jumlah)->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_jumlah)->applyFromArray($fillColorArray2);
			
			$PHPExcel->getActiveSheet()->getRowDimension(($row_jumlah+1))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_jumlah+1), 'CP SELF');
			$PHPExcel->getActiveSheet()->getRowDimension(($row_jumlah+2))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_jumlah+2), 'CP SUPERIOR');
			$PHPExcel->getActiveSheet()->getRowDimension(($row_jumlah+3))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_jumlah+3), 'CP PEER');
			$PHPExcel->getActiveSheet()->getRowDimension(($row_jumlah+4))->setRowHeight(40);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive).($row_jumlah+4), 'CP SUB');

			$append = '/'.Helper::getChar(($chr_executive+1)).$row_executive;
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive+1).($row_jumlah+1), $model->getExcelSumSelf($chr,$row,$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive+1).($row_jumlah+2), $model->getExcelSumSuperior($chr,$row,$append));

			$append = '/'.Helper::getChar(($chr_executive+1)).$row_executive.'*('.$model->countAllPenilaiByIdPeran(3).')';
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive+1).($row_jumlah+3), $model->getExcelSumPeer($chr,$row,$append));

			$append = '/'.Helper::getChar(($chr_executive+1)).$row_executive.'*('.$model->countAllPenilaiByIdPeran(4).')';
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_executive+1).($row_jumlah+4), $model->getExcelSumSubOrdinat($chr,$row,$append));

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_jumlah.':'.Helper::getChar($chr_executive+1).($row_jumlah+4))->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_jumlah.':'.Helper::getChar($chr_executive+1).($row_jumlah+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Horizontal
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_executive).$row_jumlah.':'.Helper::getChar($chr_executive+1).($row_jumlah+4))->getFont()->setBold(true); //Set Bold
			//START OF ISI
			//END OF ISI
			
			//END OF JUMLAH NILAI LAINNYA

			$row_key = $awalRow;
			//START OF KEY BEHAVIOUR REPORT -- isi
			/* @var $chr_key = $chr_executive + 7 */
			$row_key = $row_executive;
			$awalRowKey = $row_key;
			if ($setVariabelChart) {
				$worksheetRowKey = $row_key;
				$worksheetChrKey = $chr_key+2;
				$setVariabelChart = false;
			}
			foreach($kompetensi->findAllRincian() as $rincian)
			{
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_key).$row_key, $rincian->uraian);
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+1)).$row_key, $model->countAllPenilai());
				//Self
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+2)).$row_key, $model->getExcelSumSelf($chr,$row_key));
				//Superior
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+3)).$row_key, $model->getExcelSumSuperior($chr,$row_key));
				//Peer
				$append = '/('.Helper::getChar(($chr_key+1)).$row_key.'-'.$selfHelper.')';
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+4)).$row_key, $model->getExcelSumPeer($chr,$row_key,$append));
				//Sub Ordinat
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+5)).$row_key, $model->getExcelSumSubOrdinat($chr,$row_key,$append));
				//All
				$append = '/('.Helper::getChar(($chr_key+1)).$row_key.'-'.$selfHelper2.')'; 

				$cp_all = "=";

				if ($penilai_spr) {
					$append = "/(".$penilai_spr.")*".$model->getBobotSpr();
					$cp_all .= Helper::sumHelperHorizontal($chr+$selfHelper,$penilai_spr,$row_key,true,$append,true);
				}

				if ($penilai_peer) {
					$append = "/(".$penilai_peer.")*".$model->getBobotPeer();
					$cp_all .= "+".Helper::sumHelperHorizontal($chr+$selfHelper+($penilai_spr * 2),$penilai_peer,$row_key,true,$append,true);
				}

				if ($penilai_sub) {
					$append = "/(".$penilai_sub.")*".$model->getBobotSub();
					$cp_all .= "+".Helper::sumHelperHorizontal($chr+$selfHelper+($penilai_spr * 2)+($penilai_peer * 2),$penilai_sub,$row_key,true,$append,true);
				}

				//*$selfHelper2 berisi 1 apabila kegiatan memiliki penilai SELF
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+6)).$row_key, $cp_all);

				$cpr = "=";

				if ($penilai_spr) {
					$append = "/(".$penilai_spr.")*".$model->getBobotSpr();
					$cpr .= Helper::sumHelperHorizontal(($chr + 1)+$selfHelper,$penilai_spr,$row_key,true,$append,true);
				}

				if ($penilai_peer) {
					$append = "/(".$penilai_peer.")*".$model->getBobotPeer();
					$cpr .= "+".Helper::sumHelperHorizontal(($chr + 1)+$selfHelper+($penilai_spr * 2),$penilai_peer,$row_key,true,$append,true);
				}

				if ($penilai_sub) {
					$append = "/(".$penilai_sub.")*".$model->getBobotSub();
					$cpr .= "+".Helper::sumHelperHorizontal(($chr + 1)+$selfHelper+($penilai_spr * 2)+($penilai_peer * 2),$penilai_sub,$row_key,true,$append,true);
				}

				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+7)).$row_key, $cpr);

				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+8)).$row_key, '='.Helper::getChar(($chr_key+6)).$row_key.'-'.Helper::getChar(($chr_key+7)).$row_key);

				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+9)).$row_key, '='.Helper::getChar(($chr-2)).$row_key);
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+10)).$row_key, '='.Helper::getChar(($chr_key+6)).$row_key.'-'.Helper::getChar(($chr_key+9)).$row_key);
				$row_key++;
			} //ENDFOREACH KOMPETENSI
			
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_key).$row_key, 'TOTAL');
			$append = '/'.$kompetensi->countAllRincian();
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+2)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+2),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+3)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+3),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+4)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+4),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+5)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+5),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+6)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+6),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+7)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+7),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+8)).$row_key, '='.Helper::getChar(($chr_key+6)).$row_key.'-'.Helper::getChar(($chr_key+7)).$row_key);
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+9)).$row_key, '='.Helper::sumHelperVertikal($awalRowKey,$row_key,($chr_key+9),$append));
			$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar(($chr_key+10)).$row_key, '='.Helper::getChar(($chr_key+6)).$row_key.'-'.Helper::getChar(($chr_key+9)).$row_key);

			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$awalRowKey.':'.Helper::getChar(($chr_key+10)).$row_key)->applyFromArray($setBorderArray); //Set Border
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$awalRowKey.':'.Helper::getChar(($chr_key+10)).$row_key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Set Horizontal

			$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr_key).$row_key.':'.Helper::getChar(($chr_key+1)).$row_key);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row_key)->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr_key).$row_key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			//END OF KEY BEHAVIOUR REPORT -- isi

			$row = max($row_executive,$row_key,$row,($row_jumlah+2));
			$row += 5;
		}

		/*=====  End of Hasil Isian  ======*/

		/*=========================================
		=            Executive Summary            =
		=========================================*/
		$PHPExcel->createSheet(NULL, "xyz");
		$PHPExcel->setActiveSheetIndex(1);
		$PHPExcel->getActiveSheet()->setTitle('Executive_Summary');

		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setWrapText(true);
		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
		$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);		
		$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);	
		$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
		$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
		$PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

		$row = 2;
		
		$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Current Proficiency VS Proficiency Required');	
		$PHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
		$PHPExcel->getActiveSheet()->mergeCells('A'.$row.':H'.$row);	
		$PHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$row += 1;

		$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'KOMPETENSI');
		$PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'CP');
		$PHPExcel->getActiveSheet()->setCellValue('C'.$row, 'CPR');
		$PHPExcel->getActiveSheet()->setCellValue('D'.$row, 'CPRO');
		$PHPExcel->getActiveSheet()->setCellValue('E'.$row, 'GAP');
		$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'KATEGORI');
		$PHPExcel->getActiveSheet()->setCellValue('G'.$row, 'GAP O');
		$PHPExcel->getActiveSheet()->setCellValue('H'.$row, 'KATEGORI ORGANISASI');

		$PHPExcel->getActiveSheet()->getStyle('A2:'.'H'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$PHPExcel->getActiveSheet()->getStyle('A2:'.'H'.$row)->getFont()->setBold(true);

		$row += 1;

		$PHPExcel->getActiveSheet()->getStyle('A2:'.'H'.$row)->applyFromArray($setBorderArray);				
				
		$i = 0;
		/* @var $row = 4 */
		foreach($model->findAllKompetensi() as $kompetensi)
		{
			$PHPExcel->getActiveSheet()->setCellValue('A'.$row, $kompetensi->uraian);
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, '=Isian!'.$arr_cp_all[$i]);
			$PHPExcel->getActiveSheet()->setCellValue('C'.$row, '=Isian!'.$arr_cpr[$i]);
			$PHPExcel->getActiveSheet()->setCellValue('D'.$row, '=Isian!'.$arr_cpro[$i]);
			$PHPExcel->getActiveSheet()->setCellValue('E'.$row, '=B'.$row.'-C'.$row);
			$PHPExcel->getActiveSheet()->setCellValue('F'.$row, '=IF(E'.$row.'>=1,"STRENGTH",IF(E'.$row.'<=-1,"DEVELOPMENTAL AREA","MEET EXPECTATION"))');
			$PHPExcel->getActiveSheet()->setCellValue('G'.$row, '=B'.$row.'-D'.$row);
			$PHPExcel->getActiveSheet()->setCellValue('H'.$row, '=IF(G'.$row.'>=1,"STRENGTH",IF(G'.$row.'<=-1,"DEVELOPMENTAL AREA","MEET EXPECTATION"))');

			$PHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);

			$row++;
			$i++;
		}
		$row--;
		$PHPExcel->getActiveSheet()->getStyle('B4:H'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$PHPExcel->getActiveSheet()->getStyle('A4:H'.$row)->applyFromArray($setBorderArray);

		$chr = 66; //Nomor karakter untuk huruf "C"
		$dsl = [
			new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$'.Helper::getChar($chr).'$3', NULL, 120),
			new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$'.Helper::getChar(($chr+1)).'$3', NULL, 120),
			new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$'.Helper::getChar(($chr+2)).'$3', NULL, 120),
			new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$'.Helper::getChar(($chr+3)).'$3', NULL, 120),
			new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$'.Helper::getChar(($chr+5)).'$3', NULL, 120),
		];
		$dsv = [
			new PHPExcel_Chart_DataSeriesValues('Number', 'Executive_Summary!$'.Helper::getChar($chr).'$4:$'.Helper::getChar($chr).'$'.$row, NULL, 7),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Executive_Summary!$'.Helper::getChar(($chr+1)).'$4:$'.Helper::getChar(($chr+1)).'$'.$row, NULL, 7),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Executive_Summary!$'.Helper::getChar(($chr+2)).'$4:$'.Helper::getChar(($chr+2)).'$'.$row, NULL, 7),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Executive_Summary!$'.Helper::getChar(($chr+3)).'$4:$'.Helper::getChar(($chr+3)).'$'.$row, NULL, 7),
			new PHPExcel_Chart_DataSeriesValues('Number', 'Executive_Summary!$'.Helper::getChar(($chr+5)).'$4:$'.Helper::getChar(($chr+5)).'$'.$row, NULL, 7),
		];

		$xal=array(
            new PHPExcel_Chart_DataSeriesValues('String', 'Executive_Summary!$A$4:$A$'.$row.',Executive_Summary!$A$6', NULL, 15),
        );

        $ds = new PHPExcel_Chart_DataSeries(
                PHPExcel_Chart_DataSeries::TYPE_LINECHART,
                PHPExcel_Chart_DataSeries::GROUPING_STACKED,
                range(0, count($dsv)-1),
                $dsl,
                $xal,
                $dsv
            );
        $pa = new PHPExcel_Chart_PlotArea(NULL, array($ds));
		$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
		$title = new PHPExcel_Chart_Title('Grafik');

		$chart = new PHPExcel_Chart(
                'chart1',
                $title,
                $legend,
                $pa,
                true,
                0,
                NULL, 
                NULL
            );

		$chart->setTopLeftPosition('A'.($row+3));
		if ($row-4 > 3) {
			$penambah = ($row-4)*2;
			$chart->setBottomRightPosition(Helper::getChar((ord('G')+$penambah)).($row+20));
		} else
			$chart->setBottomRightPosition('J'.($row+20));

		$PHPExcel->getActiveSheet()->addChart($chart);
		
		/*=====  End of Executive Summary  ======*/
		/*=========================================
		=            Individual Report            =
		=========================================*/
		$PHPExcel->createSheet(null);
		$PHPExcel->setActiveSheetIndex(2);
		$PHPExcel->getActiveSheet()->setTitle('Individual_Report');
		
		//Menghapus cache phpexcel untuk grafik agar up-to-date saat file excel dibuka oleh user
		PHPExcel_Calculation::getInstance()->clearCalculationCache();

		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setWrapText(true);
		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
		$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
		$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

		$row = 1;

		foreach($model->findAllKompetensi() as $kompetensi)
		{

			$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'INDIVIDUAL REPORT');
			$PHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->mergeCells('A'.$row.':F'.$row);	
			$PHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$row += 2;
			$awalRowHeader = $row;
			$row_key = $row;
			$awalRowKey = $row;
			$chr = 75;

			$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'NO');
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'ITEM');
			$PHPExcel->getActiveSheet()->setCellValue('D'.$row, 'N');
			$PHPExcel->getActiveSheet()->setCellValue('E'.$row, 'GRAFIK INDIVIDUAL');
			$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'NILAI');

			$PHPExcel->getActiveSheet()->mergeCells('F'.$row.':'.'G'.$row);
			$PHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'C'.$row);

			$PHPExcel->getActiveSheet()->getStyle('A'.$row.':'.'F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$row += 1;

			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, $kompetensi->uraian);
			$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'Gap : ');
			$PHPExcel->getActiveSheet()->setCellValue('G'.$row, 'Gap Organisasi : ');

			$PHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(97);
			
			$PHPExcel->getActiveSheet()->mergeCells('B'.$row.':C'.$row);
			$PHPExcel->getActiveSheet()->mergeCells('B'.($row+1).':C'.($row+4));
			$PHPExcel->getActiveSheet()->mergeCells('E'.($row).':E'.($row+4));

			$PHPExcel->getActiveSheet()->getStyle('F'.$row.':G'.($row+1))->getFont()->setBold(true);

			$PHPExcel->getActiveSheet()->getStyle('F'.$row.':G'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				

			$PHPExcel->getActiveSheet()->getStyle('A'.$awalRowHeader.':'.'G'.$row)->getFont()->setBold(true);

			//START GRAFIK
			$row_total = $worksheetRowKey + $kompetensi->countAllRincian();

			$PHPExcel->getActiveSheet()->setCellValue('F'.($row+1), '=Isian!$'.Helper::getChar(($worksheetChrKey+6)).'$'.$row_total);
			$PHPExcel->getActiveSheet()->setCellValue('G'.($row+1), '=Isian!$'.Helper::getChar(($worksheetChrKey+8)).'$'.$row_total);

			$PHPExcel->getActiveSheet()->getRowDimension($row+2)->setRowHeight(25);
			$PHPExcel->getActiveSheet()->getRowDimension($row+3)->setRowHeight(25);
			$PHPExcel->getActiveSheet()->getRowDimension($row+4)->setRowHeight(25);
			$PHPExcel->getActiveSheet()->getRowDimension($row+5)->setRowHeight(25);

			$dsl = array(
				new PHPExcel_Chart_DataSeriesValues('String', null, null, 120)
			);
			$dsv = array(
				new PHPExcel_Chart_DataSeriesValues('Number', 'Isian!$'.Helper::getChar($worksheetChrKey).'$'.$row_total.':$'.Helper::getChar(($worksheetChrKey+5)).'$'.$row_total.',Isian!$'.Helper::getChar($worksheetChrKey+7).'$'.$row_total, null, 90),
			);
			$xal=array(
	            new PHPExcel_Chart_DataSeriesValues('String', 'Isian!$'.Helper::getChar($worksheetChrKey).'$'.($worksheetRowKey-1).':$'.Helper::getChar(($worksheetChrKey+5)).'$'.($worksheetRowKey-1).',Isian!$'.Helper::getChar($worksheetChrKey+7).'$'.($worksheetRowKey-1), null, 15),
	        );

	        $ds = new PHPExcel_Chart_DataSeries(
	                PHPExcel_Chart_DataSeries::TYPE_BARCHART,
	                PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
	                range(0, count($dsv)-1),
	                $dsl,
	                $xal,
	                $dsv
	            );
	        $ds->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);
	        $pa = new PHPExcel_Chart_PlotArea(null, array($ds));
			$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_LEFT, null, false);

			$chart = new PHPExcel_Chart(
	                'chart1',
	                null,
	                null,
	                $pa,
	                true,
	                0,
	                null, 
	                null,
	                null
	            );

			$chart->setTopLeftPosition('E'.($row));
			$chart->setBottomRightPosition('F'.($row+4));

			$PHPExcel->getActiveSheet()->addChart($chart);
				
			$awalRow = $row+1;
			$row += 5;		

			$i = 1;

			$chartRow = $awalRowKey+2;

			foreach($kompetensi->findAllRincian() as $data)
			{
				$isi = $i - 1;
				$PHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(97);
				$PHPExcel->getActiveSheet()->setCellValue('B'.$row, $i);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$row, $data->uraian);
				$PHPExcel->getActiveSheet()->setCellValue('D'.$row, '');
				$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'Gap : ');
				$PHPExcel->getActiveSheet()->setCellValue('F'.($row+1), '=Isian!$'.Helper::getChar(($worksheetChrKey+6)).'$'.($worksheetRowKey+$isi));
				$PHPExcel->getActiveSheet()->setCellValue('G'.$row, 'Gap Organisasi : ');
				$PHPExcel->getActiveSheet()->setCellValue('G'.($row+1), '=Isian!$'.Helper::getChar(($worksheetChrKey+8)).'$'.($worksheetRowKey+$isi));

				$PHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$PHPExcel->getActiveSheet()->getStyle('F'.$row.':G'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$PHPExcel->getActiveSheet()->getStyle('F'.$row.':G'.($row+1))->getFont()->setBold(true);

				$PHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'B'.($row+5));
				$PHPExcel->getActiveSheet()->mergeCells('C'.$row.':'.'C'.($row+5));
				$PHPExcel->getActiveSheet()->mergeCells('E'.$row.':'.'E'.($row+5));

				$PHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$PHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

				$PHPExcel->getActiveSheet()->getRowDimension($row+2)->setRowHeight(25);
				$PHPExcel->getActiveSheet()->getRowDimension($row+3)->setRowHeight(25);
				$PHPExcel->getActiveSheet()->getRowDimension($row+4)->setRowHeight(25);
				$PHPExcel->getActiveSheet()->getRowDimension($row+5)->setRowHeight(25);
				$row += 6;

				$dsv = array(
					new PHPExcel_Chart_DataSeriesValues('Number', 'Isian!$'.Helper::getChar($worksheetChrKey).'$'.($worksheetRowKey+$isi).':$'.Helper::getChar(($worksheetChrKey+5)).'$'.($worksheetRowKey+$isi).',Isian!$'.Helper::getChar($worksheetChrKey+7).'$'.($worksheetRowKey+$isi), null, 90),
				);
				
		        $ds = new PHPExcel_Chart_DataSeries(
		                PHPExcel_Chart_DataSeries::TYPE_BARCHART,
		                PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
		                range(0, count($dsv)-1),
		                $dsl,
		                $xal,
		                $dsv
		            );
		        $ds->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);
		        $pa = new PHPExcel_Chart_PlotArea(null, array($ds));
				$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_LEFT, null, false);
				
				$chart = new PHPExcel_Chart(
		                'chart1',
		                null,
		                null,
		                $pa,
		                true,
		                0,
		                null, 
		                null,
		                null
		            );

				$chart->setTopLeftPosition('E'.($row-6));
				$chart->setBottomRightPosition('F'.(($row-1)));

				$PHPExcel->getActiveSheet()->addChart($chart);

				$i++;
			}

			$worksheetRowKey += max(15,($kompetensi->countAllRincian()));
			$row--;
			$PHPExcel->getActiveSheet()->mergeCells('A'.$awalRow.':A'.$row);
			$PHPExcel->getActiveSheet()->getStyle('A'.$awalRowHeader.':'.'G'.$row)->applyFromArray($setBorderArray);
			$row += 3;
			
		}

		/*=====  End of Individual Report  ======*/

		/*==================================================
		=            Sheet Uraian dan Deskripsi            =
		==================================================*/

		$PHPExcel->createSheet(null);
		$PHPExcel->setActiveSheetIndex(3);
		$PHPExcel->getActiveSheet()->setTitle('Uraian & Deskripsi');
		$PHPExcel->getActiveSheet()->mergeCells('B1:E1');

		$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
		$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(45);

		$PHPExcel->getActiveSheet()->setCellValue('B1','Deskripsi & Uraian Penilai');
		$PHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

		$PHPExcel->getActiveSheet()->setCellValue('B3','No');
		$PHPExcel->getActiveSheet()->setCellValue('C3','Nama Penilai');
		$PHPExcel->getActiveSheet()->setCellValue('D3','Peran');
		$PHPExcel->getActiveSheet()->setCellValue('E3','Uraian / Deskripsi');

		$PHPExcel->getActiveSheet()->getStyle('B3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$PHPExcel->getActiveSheet()->getStyle('B3:E3')->getFont()->setBold(true);

		$i = 1;
		$row = 4;
		foreach ($model->findAllPenilai() as $penilai) {
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row,$i++);
			$PHPExcel->getActiveSheet()->setCellValue('C'.$row,$penilai->getRelation("pegawai","nama"));
			$PHPExcel->getActiveSheet()->setCellValue('D'.$row,$penilai->getRelation('penilai_peran','nama'));
			$PHPExcel->getActiveSheet()->setCellValue('E'.$row,$penilai->uraian_deskripsi);

			$row++;
		}

		$row--;

		$PHPExcel->getActiveSheet()->getStyle('B3:B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$PHPExcel->getActiveSheet()->getStyle('D3:D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$PHPExcel->getActiveSheet()->getStyle('B3:E'.$row)->applyFromArray($setBorderArray);

		$PHPExcel->createSheet(null);
		$PHPExcel->setActiveSheetIndex(4);
		$PHPExcel->getActiveSheet()->setTitle('Level of Agreement');

		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setWrapText(true);
		$PHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$sheet = $PHPExcel->getActiveSheet();

		$sheet->mergeCells('A1:C1');
		$sheet->setCellValue('A1','Level of Agreement');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$row = 4;

		$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(3);
		$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);

		foreach ($model->findAllKompetensi() as $kompetensi) {
			$row++;
			//START OF HEADER
			//START OF  PENILAIAN -- HEADER
			$PHPExcel->getActiveSheet()->setCellValue('A'.$row, 'COMPETENCY');
			$PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'ITEM PERTANYAAN');
			$PHPExcel->getActiveSheet()->setCellValue('F'.$row, 'NILAI');

			$PHPExcel->getActiveSheet()->mergeCells('A'.($row).':'.'A'.($row+2));
			$PHPExcel->getActiveSheet()->mergeCells('B'.($row).':'.'C'.($row+2));

			$PHPExcel->getActiveSheet()->setCellValue('D'.($row), 'CPRO');
			$PHPExcel->getActiveSheet()->setCellValue('E'.($row), 'FPRO');

			$PHPExcel->getActiveSheet()->mergeCells('D'.($row).':'.'D'.($row+2));
			$PHPExcel->getActiveSheet()->mergeCells('E'.($row).':'.'E'.($row+2));			

			//Tulisan miring judul kompetensi
			$PHPExcel->getActiveSheet()->setCellValue('A'.($row+3),$kompetensi->uraian);
			$PHPExcel->getActiveSheet()->getStyle('A'.($row+3))->getAlignment()->setTextRotation(90);

			$PHPExcel->getActiveSheet()->mergeCells('A'.($row+3).':'.'A'.($row+4+($kompetensi->countAllRincian())));
			$PHPExcel->getActiveSheet()->getStyle('A'.($row+3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//End
		
			$chr=70;
			$i=1;

			$ganjil = true;

			for ($r=1; $r <= 10; $r++) { 
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr).($row+1), $i++);	
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr).($row+2), 'CP');
				$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr+1).($row+2), 'CPR');

				$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr))->setWidth(7);	
				$PHPExcel->getActiveSheet()->getColumnDimension(Helper::getChar($chr+1))->setWidth(7);	

				$PHPExcel->getActiveSheet()->mergeCells(Helper::getChar($chr).($row+1).':'.Helper::getChar($chr+1).($row+1));

				if ($ganjil){
					$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr).($row+2).':'.Helper::getChar($chr+1).($row+2))->applyFromArray($fillColorArray3);
					$ganjil = false;
				} else {
					$ganjil = true;
					$PHPExcel->getActiveSheet()->getStyle(Helper::getChar($chr).($row+2).':'.Helper::getChar($chr+1).($row+2))->applyFromArray($fillColorArray4);
				}

				$chr += 2;
			}
			
			// Merge Field Nilai ke kanan sampai sel Y
			$PHPExcel->getActiveSheet()->mergeCells('F'.($row).':'.Helper::getChar(($chr - 1)).($row));

			// Tambah Header untuk LoA Cp dan CPR
			$sheet->setCellValue(Helper::getChar($chr).$row,'CP');
			$sheet->mergeCells(Helper::getChar($chr).$row.':'.Helper::getChar(($chr + 2)).($row+1));
			$sheet->setCellValue(Helper::getChar($chr).($row + 2),'A');
			$sheet->setCellValue(Helper::getChar(($chr + 1)).($row + 2),'B');
			$sheet->setCellValue(Helper::getChar(($chr + 2)).($row + 2),'Pi');

			$sheet->getStyle(Helper::getChar($chr).($row + 2).':'.Helper::getChar(($chr + 2)).($row + 2))->applyFromArray($fillColorArray3);
			// chr + 3 untuk meneruskan header
			$chr += 3;

			$sheet->setCellValue(Helper::getChar($chr).$row,'CPR');
			$sheet->mergeCells(Helper::getChar($chr).$row.':'.Helper::getChar(($chr + 2)).($row+1));
			$sheet->setCellValue(Helper::getChar($chr).($row + 2),'A');
			$sheet->setCellValue(Helper::getChar(($chr + 1)).($row + 2),'B');
			$sheet->setCellValue(Helper::getChar(($chr + 2)).($row + 2),'Pi');

			$sheet->getStyle(Helper::getChar($chr).($row + 2).':'.Helper::getChar(($chr + 2)).($row + 2))->applyFromArray($fillColorArray4);
			// chr + 2 karena untuk styling tidak perlu + 3 (akan lebih 1)
			$chr += 2;

			// Fill color Header paling atas
			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':'.Helper::getChar($chr).$row)->applyFromArray($fillColorArray1);

			// Alignment Header & fill color header tengah
			$PHPExcel->getActiveSheet()->getStyle('A'.$row.':'.Helper::getChar($chr).($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar(70).($row+1).':'.Helper::getChar($chr).($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$PHPExcel->getActiveSheet()->getStyle(Helper::getChar(70).($row+1).':'.Helper::getChar($chr).($row+1))->applyFromArray($fillColorArray2);;
			// END OF row
			
			// Set border dan bold
			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':'.Helper::getChar($chr).($row+2))->applyFromArray($setBorderArray);
			$PHPExcel->getActiveSheet()->getStyle('A'.($row).':'.Helper::getChar($chr).($row+2))->getFont()->setBold(true);


			// END OF HEADER

			//+3 row karena header, untuk isian
			$row += 3;

			$awalRow = $row;

			$jumlah_rincian = 0;

			$total_cp = 0;
			$total_cpr = 0;
			$i = 1;
			$chr = 70;
			/**
			 * START OF  PENILAIAN -- ISI
			 * @var $chr chr untuk penilaian. Dengan default 70 (F)
			 * @var $chr_executive chr untuk executive summary competency
			 * @var $chr_key chr untuk key behaviour report
			 */
			foreach($kompetensi->findAllRincian() as $rincian) {
				if ($i>8) {
					$PHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(40);
				}
				$PHPExcel->getActiveSheet()->setCellValue('B'.$row, $i++);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$row, $rincian->uraian);

				$PHPExcel->getActiveSheet()->setCellValue('D'.$row, $kompetensi->cpro);
				$PHPExcel->getActiveSheet()->setCellValue('E'.$row, $kompetensi->fpro);

				$chr_penilaian = $chr;

				$sel_cp = [];
				$sel_cpr = [];
				for ($r=1; $r <= 10; $r++) { 
					$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian).($row), $rincian->getJumlahCpByNilai($r));
					array_push($sel_cp, Helper::getChar($chr_penilaian).($row));
					$PHPExcel->getActiveSheet()->setCellValue(Helper::getChar($chr_penilaian+1).($row), $rincian->getJumlahCprByNilai($r));
					array_push($sel_cpr, Helper::getChar(($chr_penilaian + 1)).($row));

					$chr_penilaian += 2;
				}

				// START LoA CP
				$formulaCpA = '=';

				$pertama = true;
				foreach ($sel_cp as $key => $value) {
					if ($pertama) {
						$formulaCpA .= $value.'*('.$value.'-1)';
						$pertama = false;
					} else {
						$formulaCpA .= '+'.$value.'*('.$value.'-1)';
					}
				}

				$sheet->setCellValue(Helper::getChar($chr_penilaian).$row,$formulaCpA);

				$formulaCpB = '=1/';

				$rumus = implode($sel_cp, '+');
				$formulaCpB .= '('.$rumus.')/('.$rumus.'-1)';

				$sheet->setCellValue(Helper::getChar(($chr_penilaian + 1)).$row,$formulaCpB);

				$sheet->setCellValue(Helper::getChar(($chr_penilaian + 2)).$row,'='.Helper::getChar($chr_penilaian).$row.'*'.Helper::getChar(($chr_penilaian + 1)).$row);

				$chr_penilaian += 3;

				// START LoA CPR
				$formulaCprA = '=';

				$pertama = true;
				foreach ($sel_cpr as $key => $value) {
					if ($pertama) {
						$formulaCprA .= $value.'*('.$value.'-1)';
						$pertama = false;
					} else {
						$formulaCprA .= '+'.$value.'*('.$value.'-1)';
					}
				}

				$sheet->setCellValue(Helper::getChar($chr_penilaian).$row,$formulaCprA);

				$formulaCprB = '=1/';

				$rumus = implode($sel_cpr, '+');
				$formulaCprB .= '('.$rumus.')/('.$rumus.'-1)';

				$sheet->setCellValue(Helper::getChar(($chr_penilaian + 1)).$row,$formulaCprB);

				$sheet->setCellValue(Helper::getChar(($chr_penilaian + 2)).$row,'='.Helper::getChar($chr_penilaian).$row.'*'.Helper::getChar(($chr_penilaian + 1)).$row);

				$chr_penilaian += 2;

				if ($i%2 == 0)
					$PHPExcel->getActiveSheet()->getStyle('B'.$row.':'.Helper::getChar($chr_penilaian).$row)->applyFromArray($fillColorArray2);

				$row++;
			} // ENDFOREACH KOMPETENSI

			$sheet->setCellValue('B'.$row,'JUMLAH TOTAL');
			$sheet->mergeCells('B'.$row.':E'.$row);

			$sheet->setCellValue('B'.($row + 1),'pj');
			$sheet->mergeCells('B'.($row + 1).':E'.($row + 1));

			$sheet->getStyle('B'.$row.':B'.($row + 1))->getFont()->setBold(true);
			$sheet->getStyle('B'.$row.':B'.($row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$bobot = $kompetensi->countAllRincian() * $model->countAllPenilai();
			$chr_total = 70; // F
			for ($r=1; $r <= 10; $r++) {
				$sheet->setCellValue(Helper::getChar($chr_total).$row,'=SUM('.Helper::getChar($chr_total).$awalRow.':'.Helper::getChar($chr_total).($row - 1).')');
				$sheet->setCellValue(Helper::getChar($chr_total).($row + 1),'='.Helper::getChar($chr_total).$row.'/'.$bobot);
				$chr_total++;

				$sheet->setCellValue(Helper::getChar($chr_total).$row,'=SUM('.Helper::getChar($chr_total).$awalRow.':'.Helper::getChar($chr_total).($row - 1).')');
				$sheet->setCellValue(Helper::getChar($chr_total).($row + 1),'='.Helper::getChar($chr_total).$row.'/'.$bobot);
				$chr_total++;
			}
			// Start summary LoA Cp & Cpr

			$sheet->mergeCells(Helper::getChar(($chr_total+1)).$row.':'.Helper::getChar(($chr_total+2)).$row);
			$sheet->mergeCells(Helper::getChar(($chr_total+1)).($row + 1).':'.Helper::getChar(($chr_total+2)).($row + 1));
			$sheet->mergeCells(Helper::getChar(($chr_total+1)).($row + 2).':'.Helper::getChar(($chr_total+2)).($row + 2));

			$sheet->mergeCells(Helper::getChar(($chr_total+4)).$row.':'.Helper::getChar(($chr_total+5)).$row);
			$sheet->mergeCells(Helper::getChar(($chr_total+4)).($row + 1).':'.Helper::getChar(($chr_total+5)).($row + 1));
			$sheet->mergeCells(Helper::getChar(($chr_total+4)).($row + 2).':'.Helper::getChar(($chr_total+5)).($row + 2));

			$sheet->getStyle(Helper::getChar($chr_total).$row.':'.Helper::getChar($chr_total).($row + 2))->getFont()->setBold(true);
			$sheet->getStyle(Helper::getChar($chr_total).$row.':'.Helper::getChar($chr_total).($row + 2))->applyFromArray($fillColorArray1);

			$sheet->getStyle(Helper::getChar(($chr_total+3)).$row.':'.Helper::getChar(($chr_total+3)).($row + 2))->getFont()->setBold(true);
			$sheet->getStyle(Helper::getChar(($chr_total+3)).$row.':'.Helper::getChar(($chr_total+3)).($row + 2))->applyFromArray($fillColorArray1);

			// pe
			$pe_cp = '=';
			$pe_cpr = '=';
			$chr_pe = 70;
			for ($r=1; $r <= 10; $r++) { 
				if ($r === 1) {
					$pe_cp .= Helper::getChar(($chr_pe + (2 * ($r - 1)))).($row+1).'*'.Helper::getChar(($chr_pe + (2 * ($r - 1)))).($row+1);
					$pe_cpr .= Helper::getChar((($chr_pe + 1) + (2 * ($r - 1)))).($row+1).'*'.Helper::getChar((($chr_pe + 1) + (2 * ($r - 1)))).($row+1);
				} else {
					$pe_cp .= '+'.Helper::getChar(($chr_pe + (2 * ($r - 1)))).($row+1).'*'.Helper::getChar(($chr_pe + (2 * ($r - 1)))).($row+1);
					$pe_cpr .= '+'.Helper::getChar((($chr_pe + 1) + (2 * ($r - 1)))).($row+1).'*'.Helper::getChar((($chr_pe + 1) + (2 * ($r - 1)))).($row+1);
				}
			}

			$sheet->setCellValue(Helper::getChar($chr_total).$row,'Pe Cp');
			$sheet->setCellValue(Helper::getChar(($chr_total + 1)).$row,$pe_cp);

			$sheet->setCellValue(Helper::getChar(($chr_total + 3)).$row,'Pe Cpr');
			$sheet->setCellValue(Helper::getChar(($chr_total + 4)).$row,$pe_cpr);

			$row++;

			// pi rata2
			$sheet->setCellValue(Helper::getChar($chr_total).$row,'Pi rata2');
			$pi_avg = '=SUM('.Helper::getChar(($chr_total + 2)).$awalRow.':'.Helper::getChar(($chr_total + 2)).($row - 2).') / '.$kompetensi->countAllRincian();
			$sheet->setCellValue(Helper::getChar(($chr_total + 1)).$row,$pi_avg);

			$sheet->setCellValue(Helper::getChar(($chr_total + 3)).$row,'Pi rata2');
			$pi_avg = '=SUM('.Helper::getChar(($chr_total + 5)).$awalRow.':'.Helper::getChar(($chr_total + 5)).($row - 2).') / '.$kompetensi->countAllRincian();
			$sheet->setCellValue(Helper::getChar(($chr_total + 4)).$row,$pi_avg);

			$row++;
			// Set border
			$sheet->getStyle('A'.$awalRow.':'.Helper::getChar($chr_penilaian).($row - 1))->applyFromArray($setBorderArray);

			// kappa
			$sheet->setCellValue(Helper::getChar($chr_total).$row,'Kappa');
			$kappa = '=('.Helper::getChar(($chr_total + 1)).($row - 1).'-'.Helper::getChar(($chr_total + 1)).($row - 2).')/(1-'.Helper::getChar(($chr_total + 1)).($row - 2).')';
			$sheet->setCellValue(Helper::getChar(($chr_total + 1)).$row,$kappa);
			$kappa_cp = Helper::getChar(($chr_total + 1)).$row;

			$sheet->setCellValue(Helper::getChar(($chr_total + 3)).$row,'Kappa');
			$kappa = '=('.Helper::getChar(($chr_total + 4)).($row - 1).'-'.Helper::getChar(($chr_total + 4)).($row - 2).')/(1-'.Helper::getChar(($chr_total + 4)).($row - 2).')';
			$sheet->setCellValue(Helper::getChar(($chr_total + 4)).$row,$kappa);
			$kappa_cpr = Helper::getChar(($chr_total + 4)).$row;

			$row++;

			// Interpretation
			$sheet->setCellValue(Helper::getChar($chr_total).$row,'Interpretation');
			$sheet->getStyle(Helper::getChar($chr_total).$row)->getFont()->setBold(true);
			$sheet->getStyle(Helper::getChar($chr_total).$row)->applyFromArray($fillColorArray3);
			$sheet->mergeCells(Helper::getChar($chr_total).$row.':'.Helper::getChar(($chr_total + 2)).$row);

			$sheet->setCellValue(Helper::getChar(($chr_total + 3)).$row,'Interpretation');
			$sheet->getStyle(Helper::getChar(($chr_total + 3)).$row)->getFont()->setBold(true);
			$sheet->getStyle(Helper::getChar(($chr_total + 3)).$row)->applyFromArray($fillColorArray3);
			$sheet->mergeCells(Helper::getChar(($chr_total + 3)).$row.':'.Helper::getChar(($chr_total + 5)).$row);

			$row++;

			// Nilai dari Interpretation
			$sheet->mergeCells(Helper::getChar($chr_total).$row.':'.Helper::getChar(($chr_total + 2)).$row);
			$sheet->setCellValue(Helper::getChar($chr_total).$row,'=IF('.$kappa_cp.'<0,"Poor Agreement",IF('.$kappa_cp.'<0.20,"Slight Agreement",IF('.$kappa_cp.'<0.40,"Fair Agreement",IF('.$kappa_cp.'<0.60,"Substantial Agreement",IF('.$kappa_cp.'<1.00,"Almost Perfect Agreement")))))');

			$sheet->mergeCells(Helper::getChar(($chr_total + 3)).$row.':'.Helper::getChar(($chr_total + 5)).$row);
			$sheet->setCellValue(Helper::getChar(($chr_total + 3)).$row,'=IF('.$kappa_cpr.'<0,"Poor Agreement",IF('.$kappa_cpr.'<0.20,"Slight Agreement",IF('.$kappa_cpr.'<0.40,"Fair Agreement",IF('.$kappa_cpr.'<0.60,"Substantial Agreement",IF('.$kappa_cpr.'<1.00,"Almost Perfect Agreement")))))');

			$sheet->getStyle('B'.$awalRow.':B'.($row - 3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('D'.$awalRow.':'.Helper::getChar($chr_penilaian).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$sheet->getStyle(Helper::getChar($chr_total).($row - 2).':'.Helper::getChar(($chr_total + 5)).$row)->applyFromArray($setBorderArray);

			$row += $kompetensi->countAllRincian();

		}

		$PHPExcel->setActiveSheetIndex(2);

		$filename = time().'_excel.xlsx';

		$path = Yii::app()->basePath.'/../exports/';
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(true);
		$objWriter->save($path.$filename);	
		$this->redirect(Yii::app()->request->baseUrl.'/exports/'.$filename);
	}

	public function actionExportPdfIsian($id)
   	{
		$model = $this->loadModel($id);

		if (!$model->hasKegiatanKompetensi()) {
			Yii::app()->user->setFlash('danger','Tidak dapat export pdf karena Kegiatan tidak memiliki Kompetensi');
			$this->redirect(['view','id'=>$model->id]);
		}

    	include(Yii::app()->basePath."/vendors/mpdf/mpdf.php");

		$marginLeft = 11;
		$marginRight = 11;
		$marginTop = 15;
		$marginBottom = 10;
		$marginHeader = 10;
		$marginFooter = 5;

		$pdf = new mPDF('UTF-8','A4-L',9,'Arial',$marginLeft,$marginRight,$marginTop,$marginBottom,$marginHeader,$marginFooter);


		$html = $this->renderPartial('_exportPdfIsianHeader',array('model'=>$model),true);
		$pdf->WriteHTML($html);
		
		foreach($model->findAllKompetensi() as $kompetensi)
		{
			$html = $this->renderPartial('_exportPdfIsianRincian',array('model'=>$model,'kompetensi'=>$kompetensi),true);
			$pdf->WriteHTML($html);
			$pdf->AddPage();
		}

		//$pdf->WriteHTML($html);

		$pdf->Output();          
    }  

	public function actionExportPdfIndividual($id)
   	{
		$model = $this->loadModel($id);

		if (!$model->hasKegiatanKompetensi()) {
			Yii::app()->user->setFlash('danger','Tidak dapet export pdf karena Kegiatan tidak memiliki Kompetensi');
			$this->redirect(['view','id'=>$model->id]);
		}

    	include(Yii::app()->basePath."/vendors/mpdf/mpdf.php");

		$marginLeft = 11;
		$marginRight = 11;
		$marginTop = 15;
		$marginBottom = 10;
		$marginHeader = 10;
		$marginFooter = 5;

		$pdf = new mPDF('UTF-8','A4',9,'Arial',$marginLeft,$marginRight,$marginTop,$marginBottom,$marginHeader,$marginFooter);

		$html = $this->renderPartial('pdf_individual',array('model'=>$model),true);
		$pdf->setHTMLHeader('');

		$pdf->WriteHTML($html);

		$pdf->Output();          
    }  

    public function actionExportPdfExecutiveSummary($id)
    {
		$model = $this->loadModel($id);

		if (!$model->hasKegiatanKompetensi()) {
			Yii::app()->user->setFlash('danger','Tidak dapet export pdf karena Kegiatan tidak memiliki Kompetensi');
			$this->redirect(['view','id'=>$model->id]);
		}

    	include(Yii::app()->basePath."/vendors/mpdf/mpdf.php");

		$marginLeft = 11;
		$marginRight = 11;
		$marginTop = 15;
		$marginBottom = 10;
		$marginHeader = 10;
		$marginFooter = 5;

		$pdf = new mPDF('UTF-8','A4-L',9,'Arial',$marginLeft,$marginRight,$marginTop,$marginBottom,$marginHeader,$marginFooter);


		$html = $this->renderPartial('_exportPdfIsianHeader',array('model'=>$model),true);
		$pdf->WriteHTML($html);
		
		foreach($model->findAllKompetensi() as $kompetensi)
		{
			$html = $this->renderPartial('_exportPdfExecutiveSummary',array('model'=>$model,'kompetensi'=>$kompetensi),true);
			$pdf->WriteHTML($html);
			$pdf->AddPage();
		}

		//$pdf->WriteHTML($html);

		$pdf->Output(); 
    }

    public function actionTambahBankKompetensi($id_kegiatan,$id_kompetensi)
    {
    	$model = new KegiatanKompetensi;
		$kompetensi = Kompetensi::model()->findByAttributes(array('id'=>$id_kompetensi));

		$model->id_kegiatan = $id_kegiatan;
		$model->uraian = $kompetensi->getUraianLengkap();
		$model->save();
		
		$rincian = KompetensiRincian::model()->findByAttributes(array('id_kompetensi'=>$id_kompetensi));
		if($rincian !==null)
		{
			foreach (KompetensiRincian::model()->findAllByAttributes(array('id_kompetensi'=>$id_kompetensi)) as $kompetensi_rincian) {
				$model_rincian = new KegiatanKompetensiRincian;
				$model_rincian->id_kegiatan_kompetensi = $model->id;
				$model_rincian->uraian = $kompetensi_rincian->uraian;
				$model_rincian->save();
			}
		}

		Yii::app()->user->setFlash('success','Data Telah Di tambahkan');
		$this->redirect(['kegiatan/view','id'=>$id_kegiatan]);
    }
}
