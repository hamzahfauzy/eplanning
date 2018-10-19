<?php

namespace emusrenbang\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\TaIndikator;
use emusrenbang\models\TaPaguProgram;
use emusrenbang\models\TaPaguKegiatan;
use emusrenbang\models\TaPaguKegiatanRancanganAwal;
use emusrenbang\models\TaPaguKegiatanRancangan;
use emusrenbang\models\TaPaguKegiatanRancanganAkhir;
use emusrenbang\models\TaPenetapanRenja;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\TaKegiatan;
use common\models\TaKegiatanRancanganAwal;
use common\models\TaKegiatanRancangan;
use common\models\TaKegiatanRancanganAkhir;
use common\models\RefUrusan;
use kartik\mpdf\Pdf;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaBelanjaRincSubRancangan;
use emusrenbang\models\TaBelanjaRincSubRancanganAkhir;
use emusrenbang\models\TaBelanja;
use emusrenbang\models\TaBelanjaRancangan;
use emusrenbang\models\TaBelanjaRancanganAkhir;
use emusrenbang\models\TaBelanjaRinc;
use emusrenbang\models\TaBelanjaRincRancangan;
use emusrenbang\models\TaBelanjaRincRancanganAkhir;
use eperencanaan\models\TaMusrenbang;
use common\models\RefSubUnit;
use emusrenbang\models\TaHasil;
use common\models\TaRpjmdProgramPrioritas;
use common\models\TaRpjmdPrioritasPembangunanDaerah;



class RancanganController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Tahun'=>$tahun,'Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
      if(empty($TaSubUnit)){
      	//return $this->redirect(['ta-sub-unit/index']);
      	echo "<script>alert('Data Pimimpinan dan Visi masih kosong. Silahkan Isi Terlebih dahulu');location='index.php?r=ta-sub-unit/index';</script>";
      	return;

      }
	  $belanja = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $belanjaranwal = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $statusranwal = count($belanjaranwal);
	  $status=count($belanja);
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  if($status == 0){

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  }else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
			
	  }
	  
		return $this->render('rancangan',[
			 'tahun' => $tahun,
			 'subunit' => $TaSubUnit,
			 'dataKegiatan'=>$dataKegiatan,
			 'dataKeteranganKeg' => $dataKeteranganKeg,
			 'status'=>$status,
			 'statusranwal'=>$statusranwal,
		]);
    }
	
//Create By Udamz
	public function actionRka($perubahan = false){
		
    	$unit = Yii::$app->levelcomponent->getUnit();
    	$Tahun = Yii::$app->pengaturan->getTahun();
    	//$tahun = $Tahun + 1;
	  	$tahun = $Tahun;
    	$TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
    	if(empty($TaSubUnit)){
	      	//return $this->redirect(['ta-sub-unit/index']);
	      	echo "<script>alert('Data Pimimpinan dan Visi masih kosong. Silahkan Isi Terlebih dahulu');location='index.php?r=ta-sub-unit/index';</script>";
	      	return;

	      }
    	$hasil = TaHasil::find()->where([ 'Kd_Urusan'=>$unit->Kd_Urusan, 
										'Kd_Bidang'=>$unit->Kd_Bidang, 
										'Kd_Unit'=>$unit->Kd_Unit, 
										'Kd_Sub'=>$unit->Kd_Sub_Unit,
										'Kd_Tahapan'=>"Pra RKA",
                                        'Asal_Data' => 1,
                                    ])->one();
    	$hasil_perubahan = TaHasil::find()->where([ 'Kd_Urusan'=>$unit->Kd_Urusan, 
										'Kd_Bidang'=>$unit->Kd_Bidang, 
										'Kd_Unit'=>$unit->Kd_Unit, 
										'Kd_Sub'=>$unit->Kd_Sub_Unit,
										'Kd_Tahapan'=>"Perubahan Pra RKA",
                                        'Asal_Data' => 1,
                                    ])->one();
    	$belanja = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
    	$status=count($belanja);
    	$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
    	$akhir = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->count();
	  //if($status == 0){
    	$dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  //}else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        //$dataKeteranganKeg = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
			
	  //}
	  
	  if($perubahan){
		$subunit = RefSubUnit::find()
                ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
                ->one();

				$tahapan="Pra RKA Perubahan";
        $TaProgram = TaHasil::findAll([ 'Kd_Urusan'=>$unit->Kd_Urusan, 
										'Kd_Bidang'=>$unit->Kd_Bidang, 
										'Kd_Unit'=>$unit->Kd_Unit, 
										'Kd_Sub'=>$unit->Kd_Sub_Unit,
                                        'Kd_Tahapan' => $tahapan,
                                        'Asal_Data' => 1,
                                    ]);

        return $this->render('rka', [
                'subunit' => $subunit,
				'status'=>$status,
                'TaProgram' => $TaProgram,
                'tahapan' => $tahapan,
                'akhir'=>$akhir,
                'hasil'=>$hasil,
                'hasil_perubahan'=>$hasil_perubahan,
				'perubahan'=>$perubahan
            ]);
	  }else{
	  
		$subunit = RefSubUnit::find()
                ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
                ->one();

		$tahapan="Pra RKA";
        $TaProgram = TaHasil::findAll([ 'Kd_Urusan'=>$unit->Kd_Urusan, 
										'Kd_Bidang'=>$unit->Kd_Bidang, 
										'Kd_Unit'=>$unit->Kd_Unit, 
										'Kd_Sub'=>$unit->Kd_Sub_Unit,
                                        'Kd_Tahapan' => $tahapan,
                                        'Asal_Data' => 1,
                                    ]);

        return $this->render('rka', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
				'status'=>$status,
				'akhir'=>$akhir,
                'tahapan' => $tahapan,
                'hasil'=>$hasil,
                'hasil_perubahan'=>$hasil_perubahan,
				'perubahan'=>$perubahan
            ]);
	  }
    }



	public function actionAkhir($perubahan=false)
    {
      $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      if(empty($TaSubUnit)){
      	//return $this->redirect(['ta-sub-unit/index']);
      	echo "<script>alert('Data Pimimpinan dan Visi masih kosong. Silahkan Isi Terlebih dahulu');location='index.php?r=ta-sub-unit/index';</script>";
      	return;

      }
	  
	  $belanja = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $belanjaakhir = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $status=count($belanja);
	  $statusakhir=count($belanjaakhir);
	  
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  if($statusakhir == 0){

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  }else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub, 'Status'=>0])->all();
			
	  }
	  $kegiatanperubahan = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub, 'Status'=>1])->exists();
		$modelpenetapan = new TaPenetapanRenja();
			return $this->render('akhir',[
				 'tahun' => $tahun,
				 'subunit' => $TaSubUnit,
				 'dataKegiatan'=>$dataKegiatan,
				 'dataKeteranganKeg' => $dataKeteranganKeg,
				 'status'=>$status,
				 'statusakhir'=>$statusakhir,
				 'modelpenetapan'=>$modelpenetapan,
				 'kegiatanperubahan'=>$kegiatanperubahan,
				 'perubahan'=>$perubahan
			]);	
    }
	
	public function actionAwal(){
		
	  $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;



      $TaSubUnit = TaSubUnit::find()->where(['Tahun'=>$tahun,'Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
      
      
      if(empty($TaSubUnit)){
      	//return $this->redirect(['ta-sub-unit/index']);
      	echo "<script>alert('Data Pimimpinan dan Visi masih kosong. Silahkan Isi Terlebih dahulu');location='index.php?r=ta-sub-unit/index';</script>";
      	return;

      }

      //print_r($TaSubUnit);
      //return;
	  
	  $kegiatanranwal = @TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $status=count($kegiatanranwal);
	  $dataKegiatan = @TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  if($status == 0){
        $dataKeteranganKeg = @TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  }else{
        $dataKeteranganKeg = $kegiatanranwal;			
	  }
	  
		return $this->render('awal',[
			 'tahun' => $tahun,
			 'subunit' => $TaSubUnit,
			 'dataKegiatan'=>$dataKegiatan,
			 'dataKeteranganKeg' => $dataKeteranganKeg,
			 'status'=>$status,
		]);
	}
	
	public function actionAwalSelesai(){
		$unit = Yii::$app->levelcomponent->getUnit();
		$TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
		$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
        $dataPaguKeteranganKeg = TaPaguKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		
		foreach($dataKeteranganKeg as $model){
			$kegiatanranwal = new TaKegiatanRancanganAwal();
			$kegiatanranwal->attributes = $model->attributes;
			$kegiatanranwal->save(false);
		}
		
		foreach($dataPaguKeteranganKeg as $model){
			$pagukegiatanranwal = new TaPaguKegiatanRancanganAwal();
			$pagukegiatanranwal->attributes = $model->attributes;
			$pagukegiatanranwal->save(false);
		}
		
		return $this->redirect(["rancangan/awal"]);
	}
	
	public function actionSelesai(){
		$unit = Yii::$app->levelcomponent->getUnit();
		$TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
		$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
        $dataPaguKeteranganKeg = TaPaguKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		$taBelanja = TaBelanja::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		$taBelanjaRinc = TaBelanjaRinc::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		$taBelanjaRincSub = TaBelanjaRincSub::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		
		foreach($taBelanja as $model){
			$models = new TaBelanjaRancangan();
			$models->attributes = $model->attributes;
			$models->save(false);
		}
		
		foreach($taBelanjaRinc as $model){
			$models = new TaBelanjaRincRancangan();
			$models->attributes = $model->attributes;
			$models->save(false);
		}
		
		foreach($taBelanjaRincSub as $model){
			$models = new TaBelanjaRincSubRancangan();
			$models->attributes = $model->attributes;
			$models->save(false);
		}
		
		foreach($dataKeteranganKeg as $model){
			$kegiatanranwal = new TaKegiatanRancangan();
			$kegiatanranwal->attributes = $model->attributes;
			$kegiatanranwal->save(false);
		}
		
		foreach($dataPaguKeteranganKeg as $model){
			$pagukegiatanranwal = new TaPaguKegiatanRancangan();
			$pagukegiatanranwal->attributes = $model->attributes;
			$pagukegiatanranwal->save(false);
		}
		
		return $this->redirect(["rancangan/index"]);
	}
	
	public function actionFinish(){
		$connection = \Yii::$app->db;
		$transaction = $connection->beginTransaction();
		$unit = Yii::$app->levelcomponent->getUnit();
		$modelpenetapan = new TaPenetapanRenja();
		$post= Yii::$app->request->post();
		if($post){
			try {
				if ($post['no_sk']==""||$post['tanggal']==""||$post['keterangan']==""){
					goto lo;
				}
				$modelpenetapan->Tahun = date('Y')+1;
				$modelpenetapan->Kd_Urusan = $post['urusan']; 
				$modelpenetapan->Kd_Bidang = $post['bidang']; 
				$modelpenetapan->Kd_Unit = $post['unit']; 
				$modelpenetapan->Kd_Sub_Unit = $post['sub'];
				$modelpenetapan->No_Sk_Penetapan = $post['no_sk'];
				$modelpenetapan->Jenis = $post['jenis'];
				$modelpenetapan->Tanggal = $post['tanggal'];
				$modelpenetapan->Keterangan = $post['keterangan'];
				
				if($modelpenetapan->save(false)){
					$TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$post['urusan'], 'Kd_Bidang'=>$post['bidang'], 'Kd_Unit'=>$post['unit'], 'Kd_Sub'=>$post['sub']])->one();
					$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
					$dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
					$dataPaguKeteranganKeg = TaPaguKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
					if($post['jenis'] =="Rancangan Awal"){
						foreach($dataKeteranganKeg as $model){
							$kegiatanranwal = new TaKegiatanRancanganAwal();
							$kegiatanranwal->attributes = $model->attributes;
							$kegiatanranwal->save(false);
						}
						
						foreach($dataPaguKeteranganKeg as $model){
							$pagukegiatanranwal = new TaPaguKegiatanRancanganAwal();
							$pagukegiatanranwal->attributes = $model->attributes;
							$pagukegiatanranwal->save(false);
						}
					}else if($post['jenis'] =="Rancangan"){				
						$taBelanja = TaBelanja::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						$taBelanjaRinc = TaBelanjaRinc::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						$taBelanjaRincSub = TaBelanjaRincSub::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						
						foreach($taBelanja as $model){
							$models = new TaBelanjaRancangan();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($taBelanjaRinc as $model){
							$models = new TaBelanjaRincRancangan();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($taBelanjaRincSub as $model){
							$models = new TaBelanjaRincSubRancangan();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($dataKeteranganKeg as $model){
							$kegiatanranwal = new TaKegiatanRancangan();
							$kegiatanranwal->attributes = $model->attributes;
							$kegiatanranwal->save(false);
						}
						
						foreach($dataPaguKeteranganKeg as $model){
							$pagukegiatanranwal = new TaPaguKegiatanRancangan();
							$pagukegiatanranwal->attributes = $model->attributes;
							$pagukegiatanranwal->save(false);
						}
					}else if($post['jenis'] =="Rancangan Akhir"){
						$taBelanja = TaBelanja::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						$taBelanjaRinc = TaBelanjaRinc::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						$taBelanjaRincSub = TaBelanjaRincSub::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
						
						foreach($taBelanja as $model){
							$models = new TaBelanjaRancanganAkhir();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($taBelanjaRinc as $model){
							$models = new TaBelanjaRincRancanganAkhir();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($taBelanjaRincSub as $model){
							$models = new TaBelanjaRincSubRancanganAkhir();
							$models->attributes = $model->attributes;
							$models->save(false);
						}
						
						foreach($dataKeteranganKeg as $model){
							$kegiatanranwal = new TaKegiatanRancanganAkhir();
							$kegiatanranwal->attributes = $model->attributes;
							$kegiatanranwal->save(false);
						}
						
						foreach($dataPaguKeteranganKeg as $model){
							$pagukegiatanranwal = new TaPaguKegiatanRancanganAkhir();
							$pagukegiatanranwal->attributes = $model->attributes;
							$pagukegiatanranwal->save(false);
						}
					}else{
						//if ($model->save()) {
							//$model->id;
							// program
							// main
							$Asal_Data = '1';
							$Tahun = date("Y")+1;
							$Kd_Tahapan = $post['jenis'];
							$Kd_Peraturan = $post['no_sk'];
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                ".$post['urusan'].",
                                ".$post['bidang'].",
                                ".$post['unit'].",
                                ".$post['sub'].",
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                '".$Kd_Tahapan."',
                                '".$Kd_Peraturan."',
                                NOW()
                            FROM Ta_Program
							Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
                          ")->execute();
							  

							// belanja_rinc
							// main
							$Asal_Data = '2';
							//$Tahun = $model->Tahun;
							//$Kd_Tahapan = $model->Kd_Tahapan;
							//$Kd_Peraturan = $model->Kd_Peraturan;
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
								INSERT INTO Ta_Hasil (
									Kd_Urusan,
									Kd_Bidang,
									Kd_Prog,
									Kd_Keg,
									Kd_Unit,
									Kd_Sub,
									ID_Prog,
									Ket_Kegiatan,
									Lokasi,
									Kelompok_Sasaran,
									Status_Kegiatan,
									Pagu_Anggaran,
									Waktu_Pelaksanaan,
									Kd_Sumber,
									Keterangan,
									Pagu_Anggaran_Nt1,
									/*====*/
									Asal_Data,
									Tahun,
									Kd_Tahapan,
									Kd_Peraturan,
									DateCreate
								  )
								SELECT
									".$post['urusan'].",
									".$post['bidang'].",
									Kd_Prog,
									Kd_Keg,
									".$post['unit'].",
									".$post['sub'].",
									ID_Prog,
									Ket_Kegiatan,
									Lokasi,
									Kelompok_Sasaran,
									Status_Kegiatan,
									Pagu_Anggaran,
									Waktu_Pelaksanaan,
									Kd_Sumber,
									Keterangan,
									Pagu_Anggaran_Nt1,
									/*====*/
									".$Asal_Data.",
									".$Tahun.",
									'".$Kd_Tahapan."',
									'".$Kd_Peraturan."',
									NOW()
								FROM Ta_Kegiatan
								Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
							  ")->execute();

							// belanja_rinc
							// main
							$Asal_Data = '3';
							//$Tahun = $model->Tahun;
							//$Kd_Tahapan = $model->Kd_Tahapan;
							//$Kd_Peraturan = $model->Kd_Peraturan;
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
								INSERT INTO Ta_Hasil (
									Kd_Urusan,
									Kd_Bidang,
									Kd_Unit,
									Kd_Sub,
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									Kd_Ap_Pub,
									Kd_Sumber,
									/*====*/
									Asal_Data,
									Tahun,
									Kd_Tahapan,
									Kd_Peraturan,
									DateCreate
								  )
								SELECT
									".$post['urusan'].",
									".$post['bidang'].",
									".$post['unit'].",
									".$post['sub'].",
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									Kd_Ap_Pub,
									Kd_Sumber,
									/*====*/
									".$Asal_Data.",
									".$Tahun.",
									'".$Kd_Tahapan."',
									'".$Kd_Peraturan."',
									NOW()
								FROM Ta_Belanja
								Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
							  ")->execute();

							// belanja_rinc
							// main
							$Asal_Data = '4';
							//$Tahun = $model->Tahun;
							//$Kd_Tahapan = $model->Kd_Tahapan;
							//$Kd_Peraturan = $model->Kd_Peraturan;
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
								INSERT INTO Ta_Hasil (
									Kd_Urusan,
									Kd_Bidang,
									Kd_Unit,
									Kd_Sub,
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									No_Rinc,
									Keterangan,
									Kd_Sumber,
									/*====*/
									Asal_Data,
									Tahun,
									Kd_Tahapan,
									Kd_Peraturan,
									DateCreate
								  )
								SELECT
									".$post['urusan'].",
									".$post['bidang'].",
									".$post['unit'].",
									".$post['sub'].",
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									No_Rinc,
									Keterangan,
									Kd_Sumber,
									/*====*/
									".$Asal_Data.",
									".$Tahun.",
									'".$Kd_Tahapan."',
									'".$Kd_Peraturan."',
									NOW()
								FROM Ta_Belanja_Rinc
								Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
							  ")->execute();

							// belanja_rinc_sub
							// main
							$Asal_Data = '5';
							//$Tahun = $model->Tahun;
							//$Kd_Tahapan = $model->Kd_Tahapan;
							//$Kd_Peraturan = $model->Kd_Peraturan;
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
								INSERT INTO Ta_Hasil (
									Kd_Urusan,
									Kd_Bidang,
									Kd_Unit,
									Kd_Sub,
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									No_Rinc,
									No_ID,
									Sat_1,
									Nilai_1,
									Sat_2,
									Nilai_2,
									Sat_3,
									Nilai_3,
									Satuan123,
									Jml_Satuan,
									Nilai_Rp,
									Total,
									Keterangan,
									Asal_Biaya,
									Uraian_Asal_Biaya,
									Ref_Usulan_Rincian,
									Judul,
									/*====*/
									Asal_Data,
									Tahun,
									Kd_Tahapan,
									Kd_Peraturan,
									DateCreate
								  )
								SELECT
									".$post['urusan'].",
									".$post['bidang'].",
									".$post['unit'].",
									".$post['sub'].",
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Rek_1,
									Kd_Rek_2,
									Kd_Rek_3,
									Kd_Rek_4,
									Kd_Rek_5,
									No_Rinc,
									No_ID,
									Sat_1,
									Nilai_1,
									Sat_2,
									Nilai_2,
									Sat_3,
									Nilai_3,
									Satuan123,
									Jml_Satuan,
									Nilai_Rp,
									Total,
									Keterangan,
									Asal_Biaya,
									Uraian_Asal_Biaya,
									Ref_Usulan_Rincian,
									'Judul',
									/*====*/
									".$Asal_Data.",
									".$Tahun.",
									'".$Kd_Tahapan."',
									'".$Kd_Peraturan."',
									NOW()
								FROM Ta_Belanja_Rinc_Sub
								Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
							  ")->execute();

							// Ta_Indikator
							// main
							$Asal_Data = '6';
							//$Tahun = $model->Tahun;
							//$Kd_Tahapan = $model->Kd_Tahapan;
							//$Kd_Peraturan = $model->Kd_Peraturan;
							// $DateCreate = new Expression('NOW()');
							// copy
							$connection->createCommand("
								INSERT INTO Ta_Hasil (
									Kd_Urusan,
									Kd_Bidang,
									Kd_Unit,
									Kd_Sub,
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Indikator,
									No_ID,
									Tolak_Ukur,
									Target_Angka,
									Target_Uraian,
									/*====*/
									Asal_Data,
									Tahun,
									Kd_Tahapan,
									Kd_Peraturan,
									DateCreate
								  )
								SELECT
									".$post['urusan'].",
									".$post['bidang'].",
									".$post['unit'].",
									".$post['sub'].",
									Kd_Prog,
									ID_Prog,
									Kd_Keg,
									Kd_Indikator,
									No_ID,
									Tolak_Ukur,
									Target_Angka,
									Target_Uraian,
									/*====*/
									".$Asal_Data.",
									".$Tahun.",
									'".$Kd_Tahapan."',
									'".$Kd_Peraturan."',
									NOW()
								FROM Ta_Indikator Where 
								Kd_Urusan = $post[urusan] and 
								Kd_Bidang = $post[bidang] and
								Kd_Unit = $post[unit] and
								Kd_Sub = $post[sub] 
							  ")->execute();
						//}

						//}
						
						if($Kd_Tahapan == "Pra RKA Perubahan"){
							foreach($dataKeteranganKeg as $model){
								$kegiatanranwal = TaKegiatanRancanganAkhir::find()
													->where(["Tahun"=>$Tahun])
													->andWhere(["Kd_Urusan"=>$model->Kd_Urusan])
													->andWhere(["Kd_Bidang"=>$model->Kd_Bidang])
													->andWhere(["Kd_Prog"=>$model->Kd_Prog])
													->andWhere(["Kd_Keg"=>$model->Kd_Keg])
													->andWhere(["Kd_Unit"=>$model->Kd_Unit])
													->andWhere(["Kd_Sub"=>$model->Kd_Sub])
													
													->exists();
								if(!$kegiatanranwal){
									$model_rancangan_akhir = new TaKegiatanRancanganAkhir();
									/*
									echo "<pre>";
									print_r($model);
									return;
									*/
									$model_rancangan_akhir->attributes = $model->attributes;
									$model_rancangan_akhir->Status = 1;
									$model_rancangan_akhir->save(false);
									
								}
							}
						}
					}
				}
				lo:
				$transaction->commit();
						
			} catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
			} catch (\Throwable $e) {
				$transaction->rollBack();
				throw $e;
			}
			return $this->redirect(["rancangan/manajemen-bappeda"]);
		}else{
			return $this->redirect(["rancangan/manajemen-bappeda"]);
		}
	}
	
	public function actionManajemenBappeda(){
		
		$subunit = RefSubUnit::find()
				 ->where(["not",["Nm_Sub_Unit"=>"Export - Import BL"]])
				 ->andwhere(["not",["Nm_Sub_Unit"=>"Bupati dan Wakil Bupati"]])
				 ->andwhere(["not",["Nm_Sub_Unit"=>"Dewan Perwakilan Rakyat Daerah"]])
				 ->all();
		$ranwal = function($Tahun,$Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub){
			$model = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$Tahun ,'Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->count();
			return $model;
		};
		
		$rancangan = function($Tahun,$Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub){
			$model = TaKegiatanRancangan::find()->where(['Tahun'=>$Tahun ,'Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->count();
			return $model;
		};
		
		$akhir = function($Tahun,$Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub){
			$model = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$Tahun ,'Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->count();
			return $model;
		};
		
		$penetapan = function($Tahun,$Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub,$Jenis){
			$model = TaPenetapanRenja::find()->where(['Tahun'=>$Tahun ,'Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub_Unit'=>$Kd_Sub, "Jenis"=>$Jenis])->one();
			return $model;
		};
		return $this->render("manajemen-bappeda",[
													"subunit"=>$subunit,
													"ranwal"=>$ranwal,
													"rancangan"=>$rancangan,
													"akhir"=>$akhir,
													"penetapan"=>$penetapan,
													]);
	}
	
	public function actionLihatRanwal($Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub){

      $Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->one();
	  
	  $kegiatanranwal = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $status=count($kegiatanranwal);
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  if($status == 0){
        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  }else{
        $dataKeteranganKeg = $kegiatanranwal;			
	  }
	  
		return $this->render('awal',[
			 'tahun' => $tahun,
			 'subunit' => $TaSubUnit,
			 'dataKegiatan'=>$dataKegiatan,
			 'dataKeteranganKeg' => $dataKeteranganKeg,
			 'status'=>$status,
		]);
	}
	
	public function actionLihatRancangan($Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub)
    {

      $Tahun = Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun + 1;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->one();
	  
	  $belanja = TaBelanjaRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $belanjaranwal = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $statusranwal = count($belanjaranwal);
	  $status=count($belanja);
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  if($status == 0){

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  }else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
			
	  }
	  
		return $this->render('rancangan',[
			 'tahun' => $tahun,
			 'subunit' => $TaSubUnit,
			 'dataKegiatan'=>$dataKegiatan,
			 'dataKeteranganKeg' => $dataKeteranganKeg,
			 'status'=>1,
			 'statusranwal'=>1,
		]);
    }
	
	public function actionLihatRancanganAkhir($Kd_Urusan,$Kd_Bidang,$Kd_Unit,$Kd_Sub)
    {

      $Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->one();
	  
	  $belanja = TaBelanjaRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $belanjaakhir = TaBelanjaRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $status=count($belanja);
	  $statusakhir=count($belanjaakhir);
	  
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  if($statusakhir == 0){

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  }else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatanRancanganAkhir::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
			
	  }
		$modelpenetapan = new TaPenetapanRenja();
		return $this->render('akhir',[
			 'tahun' => $tahun,
			 'subunit' => $TaSubUnit,
			 'dataKegiatan'=>$dataKegiatan,
			 'dataKeteranganKeg' => $dataKeteranganKeg,
			 'status'=>$status,
			 'statusakhir'=>$statusakhir,
			 'modelpenetapan'=>$modelpenetapan,
		]);
    }
	
      public function actionLihatPraRka($urusan, $bidang, $unit, $sub, $tahapan, $peraturan) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        $TaProgram = TaHasil::findAll(['Kd_Urusan' => $urusan, 
                                        'Kd_Bidang' => $bidang, 
                                        'Kd_Unit' => $unit, 
                                        'Kd_Sub' => $sub, 
                                        'Kd_Tahapan' => $tahapan,
                                        'Kd_Peraturan' => $peraturan,
                                        'Asal_Data' => 1,
                                    ]);

        return $this->render('lihat-pra-rka', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
                'tahapan' => $tahapan,
                'peraturan' => $peraturan,
            ]);
    }
}
