<?php

namespace emusrenbang\controllers;
use Yii;
use common\models\RefSubUnit;
use common\models\TaProgramProv;
use common\models\TaKegiatanProv;
use emusrenbang\models\TaBelanja;
use common\models\TaSubUnit;

class MonitoringProvController extends \yii\web\Controller
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

  		$data = TaProgramProv::find()->where($option)->all();
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

  		$data = TaKegiatanProv::find()->where($option)->all();
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

      $data = TaProgramProv::find()->where($option)->all();
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

      $data = TaKegiatanProv::find()->where($option)->all();
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

      $model=TaKegiatanProv::findone($PosisiKegiatan);

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

      $model = TaKegiatanProv::findone($Posisi);
      $model->Verifikasi_Bappeda = 1;
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

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->one();
      
      $dataKegiatan = TaProgramProv::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      $dataKeteranganKeg = TaKegiatanProv::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      
      return $this->render('kegiatan_verifikasi', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg,
      ]);
    }
}
