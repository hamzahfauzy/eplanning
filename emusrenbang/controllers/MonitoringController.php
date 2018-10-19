<?php

namespace emusrenbang\controllers;
use Yii;
use common\models\RefSubUnit;
use common\models\TaProgram;
use common\models\TaKegiatan;
use emusrenbang\models\TaBelanja;
use common\models\TaSubUnit;
use common\models\RefRek1;
use common\models\RefRek2;
use common\models\RefRek3;
use common\models\RefRek4;
use common\models\RefRek5;
use emusrenbang\models\TaBelanjaRincSub;

use yii\helpers\ArrayHelper;

class MonitoringController extends \yii\web\Controller
{
    public function actionIndex()
    {
    		$skpd = RefSubUnit::find()->where(['!=', 'Nm_Sub_Unit', ''])->all();
        return $this->render('index',[
        	'skpd' => $skpd ,
        ]);
    }

    public function actionGetProgram($key)
    {
    	$var = explode("|", $key);
    	$Kd_Urusan = $var[0];
			$Kd_Bidang = $var[1];
			$Kd_Unit = $var[2];
			$Kd_Sub = $var[3];

			$option = [
									'Kd_Urusan' => $Kd_Urusan,
									'Kd_Bidang' => $Kd_Bidang,
									'Kd_Unit' => $Kd_Unit,
									'Kd_Sub' => $Kd_Sub
								];

  		$data = TaProgram::find()->where($option)->all();
      return $this->renderAjax('get_program',[
      	'data' => $data
      ]);
    }

    public function actionGetKegiatan($key)
    {
    	$var = explode("|", $key);
    	$Kd_Urusan = $var[0];
			$Kd_Bidang = $var[1];
			$Kd_Unit = $var[2];
			$Kd_Sub = $var[3];
			$Kd_Prog = $var[4];

			$option = [
									'Kd_Urusan' => $Kd_Urusan,
									'Kd_Bidang' => $Kd_Bidang,
									'Kd_Unit' => $Kd_Unit,
									'Kd_Sub' => $Kd_Sub,
									'Kd_Prog' => $Kd_Prog,
								];

  		$data = TaKegiatan::find()->where($option)->all();
      return $this->renderAjax('get_kegiatan',[
      	'data' => $data
      ]);
    }

    public function actionGetRincian($key)
    {
    	$var = explode("|", $key);
    	$Kd_Urusan = $var[0];
			$Kd_Bidang = $var[1];
			$Kd_Unit = $var[2];
			$Kd_Sub = $var[3];
			$Kd_Prog = $var[4];
			$Kd_Keg = $var[5];

			$option = [
									'Kd_Urusan' => $Kd_Urusan,
									'Kd_Bidang' => $Kd_Bidang,
									'Kd_Unit' => $Kd_Unit,
									'Kd_Sub' => $Kd_Sub,
									'Kd_Prog' => $Kd_Prog,
								];

  		$data = TaBelanja::find()->where($option)->all();
      return $this->renderAjax('get_rincian',[
      	'data' => $data
      ]);
    }

    //========monitoring verifikasi=========//
    public function actionVerifikasi()
    {
        $skpd = RefSubUnit::find()->where(['!=', 'Nm_Sub_Unit', ''])->all();
        return $this->render('verifikasi',[
          'skpd' => $skpd ,
        ]);
    }

    public function actionGetProgramVerifikasi($key)
    {
      $var = explode("|", $key);
      $Kd_Urusan = $var[0];
      $Kd_Bidang = $var[1];
      $Kd_Unit = $var[2];
      $Kd_Sub = $var[3];

      $option = [
                  'Kd_Urusan' => $Kd_Urusan,
                  'Kd_Bidang' => $Kd_Bidang,
                  'Kd_Unit' => $Kd_Unit,
                  'Kd_Sub' => $Kd_Sub
                ];

      $data = TaProgram::find()->where($option)->all();
      return $this->renderAjax('get_program_verifikasi',[
        'data' => $data
      ]);
    }

    public function actionGetKegiatanVerifikasi($key)
    {
      $var = explode("|", $key);
      $Kd_Urusan = $var[0];
      $Kd_Bidang = $var[1];
      $Kd_Unit = $var[2];
      $Kd_Sub = $var[3];
      $Kd_Prog = $var[4];

      $option = [
                  'Kd_Urusan' => $Kd_Urusan,
                  'Kd_Bidang' => $Kd_Bidang,
                  'Kd_Unit' => $Kd_Unit,
                  'Kd_Sub' => $Kd_Sub,
                  'Kd_Prog' => $Kd_Prog,
                ];

      $data = TaKegiatan::find()->where($option)->all();
      return $this->renderAjax('get_kegiatan_verifikasi',[
        'data' => $data
      ]);
    }

    public function actionModalKeterangan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
      $PosisiKegiatan = [
            'Tahun' => $Tahun, 
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
        ];

      $model=TaKegiatan::findone($PosisiKegiatan);

      return $this->renderAjax('modal_keterangan',[
        'model' => $model,
        'Tahun' => $Tahun, 
        'Kd_Urusan' => $Kd_Urusan, 
        'Kd_Bidang' => $Kd_Bidang,
        'Kd_Unit' => $Kd_Unit,
        'Kd_Sub' => $Kd_Sub,
        'Kd_Prog' => $Kd_Prog,
        'Kd_Keg' => $Kd_Keg,
      ]);
    }

    public function actionKeteranganKegiatanProses($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
      $request = Yii::$app->request;
      $Posisi = [
            'Tahun' => $Tahun, 
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            ];

      $model = TaKegiatan::findone($Posisi);
      //$model-> = ;
      $model->Tanggal_Verifikasi_Bappeda = time();

      if($model->load($request->post())){
        //echo $model->Keterangan;
        //$model->Keterangan_Verifikasi_Bappeda = 'test';
        if($model->save(false)){
          echo "Berhasil Menambah Keterangan";
        }
      }
    }

    //=============monitoring kegiatan==============//
    public function actionKegiatan()
    {

      $RefSubUnit = RefSubUnit::find()->all();
      return $this->render('kegiatan',[
        'RefSubUnit' => $RefSubUnit
      ]);
    }

    public function actionKegiatanVerifikasi($key)
    {
      $var = explode("|", $key);
      $Kd_Urusan = $var[0];
      $Kd_Bidang = $var[1];
      $Kd_Unit = $var[2];
      $Kd_Sub = $var[3];

      $tahun=(date('Y')+1);

      
	  try {
		  $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->one();
	  }catch(\Exception $e){
		  $TaSubUnit = "";
	  }
	  
	  try {
		  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  }catch(\Exception $e){
		  $dataKegiatan = "";
	  }
	  try {
		  $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  }catch(\Exception $e){
		  $dataKeteranganKeg = "";
	  }
	  
      
      return $this->render('kegiatan_verifikasi', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg,
      ]);
    }



    //=============monitoring kegiatan==============//
    public function actionCekBelanja()
    {
      $request = Yii::$app->request;
      $model = new TaBelanja();
      $Data_Rek_1 = RefRek1::findOne(['Kd_Rek_1'=>5]);
      $Data_Rek_2 = RefRek2::findOne(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2]);
      $Data_Rek_3 = ArrayHelper::map(RefRek3::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2])->all(), 
                                      'Kd_Rek_3',
                                      function($model, $defaultValue) {
                                        return $model->Kd_Rek_3.". ".$model->Nm_Rek_3;
                                      }
      );  
      echo 'a';
      die();
      $Data_Rek_4 = [];
      $Data_Rek_5 = [];

      $Kd_Rek_1 = $Data_Rek_1->Kd_Rek_1;
      $Nm_Rek_1 = $Data_Rek_1->Nm_Rek_1;
      $Kd_Rek_2 = $Data_Rek_2->Kd_Rek_2;
      $Nm_Rek_2 = $Data_Rek_2->Nm_Rek_2;

      if($model->load($request->post())){
        // $data = $Kd_Rek_1.$Kd_Rek_2.$model->Kd_Rek_3;
        $Kd_Rek_3 = $model->Kd_Rek_3;
        $data=TaBelanjaRincSub::find()
                ->where(['Kd_Rek_1'=>$Kd_Rek_1, 'Kd_Rek_2'=>$Kd_Rek_2, 'Kd_Rek_3'=>$Kd_Rek_3])
                ->sum('Total');
      }
      else{
        $data = 0;
      }

      $RefSubUnit = RefSubUnit::find()->all();
      return $this->render('cek_belanja',[
        'model' => $model,
        'data' => $data,
        'Data_Rek_1' => $Data_Rek_1,
        'Data_Rek_2' => $Data_Rek_2,
        'Data_Rek_3' => $Data_Rek_3,
        'Data_Rek_4' => $Data_Rek_4,
        'Data_Rek_5' => $Data_Rek_5,
        'Kd_Rek_1' => $Kd_Rek_1,
        'Nm_Rek_1' => $Nm_Rek_1,
        'Kd_Rek_2' => $Kd_Rek_2,
        'Nm_Rek_2' => $Nm_Rek_2,
      ]);
    }

}
