<?php

namespace emusrenbang\controllers;
use Yii;
// use common\models\TaPaguSubUnit;
use common\models\TaSubUnit;
// use common\models\TaProgram;
// use common\models\TaPaguProgram;
// use common\models\TaKegiatan;
// use emusrenbang\models\TaPaguKegiatan;
use common\models\RefProgram;
use common\models\RefKegiatan;
use common\models\RefIndikator;
use common\models\Satuan;
use yii\helpers\ArrayHelper;
// use emusrenbang\models\TaIndikator;
// use emusrenbang\models\TaBelanja;
use common\models\RefRek1;
use common\models\RefRek2;
use common\models\RefRek3;
use common\models\RefRek4;
use common\models\RefRek5;
use common\models\RefApPub;
use common\models\RefSumberDana;
// use emusrenbang\models\TaBelanjaRinc;
// use emusrenbang\models\TaBelanjaRincSub;
use common\models\RefStandardSatuan;

//========prov========//
use common\models\TaProgram;
use common\models\TaProgramProv;
use common\models\search\TaProgramProvSearch;
use common\models\TaKegiatanProv;
use common\models\search\TaKegiatanProvSearch;
use emusrenbang\models\TaIndikatorProv;
use emusrenbang\models\TaBelanjaProv;
use emusrenbang\models\TaBelanjaRincProv;
use emusrenbang\models\TaBelanjaRincSubProv;
use emusrenbang\models\TaKegiatanSkpdProv;

use common\models\RefUrusanProv;
use common\models\RefBidangProv;
use common\models\RefUnitProv;
use common\models\RefSubUnitProv;
use common\models\RefSubUnit;

use yii\helpers\Json;

class PraRkaProvController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionTambahKamus($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        $Posisi_ref = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Prog' => $Kd_Prog,
        ];

        $model = new RefKegiatan();

        $max_kd=RefKegiatan::find()
                ->where($Posisi_ref)
                ->max('Kd_Keg');
        $Kd_Keg = $max_kd + 1;

        //$model2 = new TaPaguKegiatan();
        return $this->renderajax('tambah_kamus', [
                'model' => $model,
                'Kd_Keg' => $Kd_Keg, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang,
                'Kd_Prog' => $Kd_Prog,
        ]);
    }

    public function actionTambahKamusProses()
    {
      $request = Yii::$app->request;
      $model = new RefKegiatan();
      if($model->load($request->post())){
        if($model->save(false))
          echo "Tambah Kamus Berhasil";
      }

    }

    //====================//
    public function actionBelanjaRincSub($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            ];
        $data = TaBelanjaRincProv::findOne($PosisiKegiatan);

        $data_belanja=TaBelanjaRincSubProv::find()
                ->where($PosisiKegiatan)
                ->all();

        return $this->render('belanja_rinc_sub', [
                'data' => $data,
                'data_belanja' => $data_belanja,
        ]);
    }

    public function actionTambahRincianObyek($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            ];

        $model = new TaBelanjaRincSubProv();

        $max_id=TaBelanjaRincSubProv::find()
                ->where($PosisiKegiatan)
                ->max('No_ID');
        $No_ID = $max_id + 1;


        $Ref_Usulan_Rincian = 4;
        $Standard_Satuan=ArrayHelper::map(RefStandardSatuan::find()->orderby('Uraian')->all(),'Uraian','Uraian');

        return $this->renderajax('tambah_rincian_obyek', [
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'Kd_Keg' => $Kd_Keg, 
                'Kd_Rek_1' => $Kd_Rek_1,
                'Kd_Rek_2' => $Kd_Rek_2,
                'Kd_Rek_3' => $Kd_Rek_3,
                'Kd_Rek_4' => $Kd_Rek_4,
                'Kd_Rek_5' => $Kd_Rek_5,
                'model' => $model,
                'No_Rinc' => $No_Rinc,
                'No_ID' => $No_ID,
                'Standard_Satuan' => $Standard_Satuan,
                'Ref_Usulan_Rincian' => $Ref_Usulan_Rincian,
        ]);
    }

    public function actionTambahRincianObyekProses()
    {
      $request = Yii::$app->request;
      $model = new TaBelanjaRincSubProv();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Tambah Rincian Obyek Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    public function actionHapusRincianObyek($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc, $No_ID)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            'No_ID' => $No_ID,
            ];
      $model = TaBelanjaRincSubProv::findOne($Posisi);
      
      if ($model->delete()) {
        return "Hapus Berhasil";
      }
    }

    public function actionUbahRincianObyek($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc, $No_ID)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            'No_ID' => $No_ID,
            ];
      $model = TaBelanjaRincSubProv::findOne($Posisi);
      $No_ID = $model->No_ID;
      $Ref_Usulan_Rincian = $model->Ref_Usulan_Rincian;
      $Standard_Satuan=ArrayHelper::map(RefStandardSatuan::find()->orderby('Uraian')->all(),'Uraian','Uraian');

      return $this->renderajax('tambah_rincian_obyek', [
              'Tahun' => $Tahun, 
              'Kd_Urusan' => $Kd_Urusan, 
              'Kd_Bidang' => $Kd_Bidang, 
              'Kd_Unit' => $Kd_Unit, 
              'Kd_Sub' => $Kd_Sub, 
              'Kd_Prog' => $Kd_Prog,
              'Kd_Keg' => $Kd_Keg, 
              'Kd_Rek_1' => $Kd_Rek_1,
              'Kd_Rek_2' => $Kd_Rek_2,
              'Kd_Rek_3' => $Kd_Rek_3,
              'Kd_Rek_4' => $Kd_Rek_4,
              'Kd_Rek_5' => $Kd_Rek_5,
              'model' => $model,
              'No_Rinc' => $No_Rinc,
              'No_ID' => $No_ID,
              'Standard_Satuan' => $Standard_Satuan,
              'Ref_Usulan_Rincian' => $Ref_Usulan_Rincian,
              'ubah' => 1,
      ]);
    }

    public function actionUbahRincianObyekProses($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc, $No_ID)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            'No_ID' => $No_ID,
            ];
      $model = TaBelanjaRincSubProv::findOne($Posisi);
      $request = Yii::$app->request;
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Ubah Rincian Obyek Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }


    //=====================//
    public function actionBelanjaRinc($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            ];
        $data = TaBelanjaProv::findOne($PosisiKegiatan);

        $data_belanja = TaBelanjaRincProv::find()->where($PosisiKegiatan)->all();

        return $this->render('belanja_rinc', [
                'data' => $data,
                'data_belanja' => $data_belanja,
                //'data_belanja' => $data_belanja,
        ]);
    }

    public function actionTambahRincianSub($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            ];

        $model = new TaBelanjaRincProv();

        $max_id=TaBelanjaRincProv::find()
                ->where($PosisiKegiatan)
                ->max('No_Rinc');
        $No_Rinc = $max_id + 1;

        return $this->renderajax('tambah_rincian_sub', [
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'Kd_Keg' => $Kd_Keg, 
                'Kd_Rek_1' => $Kd_Rek_1,
                'Kd_Rek_2' => $Kd_Rek_2,
                'Kd_Rek_3' => $Kd_Rek_3,
                'Kd_Rek_4' => $Kd_Rek_4,
                'Kd_Rek_5' => $Kd_Rek_5,
                'model' => $model,
                'No_Rinc' => $No_Rinc,
        ]);
    }

    public function actionTambahRincianSubProses()
    {
      $request = Yii::$app->request;
      $model = new TaBelanjaRincProv();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Masukkan Rincian Sub Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    public function actionHapusRincianSub($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            ];
      $model = TaBelanjaRincProv::findOne($Posisi);
      
      if ($model->delete()) {
        return "Hapus Berhasil";
      }
    }

    public function actionUbahRincianSub($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            ];
      $model = TaBelanjaRincProv::findOne($Posisi);
      
      return $this->renderajax('tambah_rincian_sub', [
              'Tahun' => $Tahun, 
              'Kd_Urusan' => $Kd_Urusan, 
              'Kd_Bidang' => $Kd_Bidang, 
              'Kd_Unit' => $Kd_Unit, 
              'Kd_Sub' => $Kd_Sub, 
              'Kd_Prog' => $Kd_Prog,
              'Kd_Keg' => $Kd_Keg, 
              'Kd_Rek_1' => $Kd_Rek_1,
              'Kd_Rek_2' => $Kd_Rek_2,
              'Kd_Rek_3' => $Kd_Rek_3,
              'Kd_Rek_4' => $Kd_Rek_4,
              'Kd_Rek_5' => $Kd_Rek_5,
              'No_Rinc' => $No_Rinc,
              'model' => $model,
              'ubah' => 1,
      ]);
    }

    public function actionUbahRincianSubProses($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5, $No_Rinc)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5,
            'No_Rinc' => $No_Rinc,
            ];
      $model = TaBelanjaRincProv::findOne($Posisi);
      $request = Yii::$app->request;
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Ubah Rincian Sub Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    //====================//

    public function actionBelanja($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            ];
        $data = TaKegiatanProv::findOne($PosisiKegiatan);

        $data_belanja = TaBelanjaProv::find()->where($PosisiKegiatan)->all();
        $xJum=TaBelanjaRincProv::find()->where($PosisiKegiatan)->count();
        return $this->render('belanja', [
                'data' => $data,
                'data_belanja' => $data_belanja,
				'xJum'=>$xJum,
        ]);
    }

    public function actionTambahRincian($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            ];

        $model = new TaBelanjaProv();

        $Data_Rek_1 = RefRek1::findOne(['Kd_Rek_1'=>5]);
        $Data_Rek_2 = RefRek2::findOne(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2]);
        $Data_Rek_3 = ArrayHelper::map(RefRek3::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2])->all(), 'Kd_Rek_3','Nm_Rek_3');
        $Data_Rek_4 = [];
        $Data_Rek_5 = [];


        $Kd_Rek_1 = $Data_Rek_1->Kd_Rek_1;
        $Nm_Rek_1 = $Data_Rek_1->Nm_Rek_1;
        $Kd_Rek_2 = $Data_Rek_2->Kd_Rek_2;
        $Nm_Rek_2 = $Data_Rek_2->Nm_Rek_2;
        //$model->addRule(['Nm_Rek_1'], 'string', ['max' => 128]);

        $RefApPub = ArrayHelper::map(RefApPub::find()->all(), 'Kd_Ap_Pub', 'Nm_Ap_Pub');
        $RefSumberDana = ArrayHelper::map(RefSumberDana::find()->all(), 'Kd_Sumber', 'Nm_Sumber');
        $model->Kd_Ap_Pub = 2;
        $PosisiKegiatan = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            ];
        $data = TaKegiatanProv::findOne($PosisiKegiatan);

        $model->Kd_Sumber=$data->Kd_Sumber;
        return $this->renderajax('tambah_rincian', [
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'Kd_Keg' => $Kd_Keg, 
                'model' => $model, 
                'Kd_Rek_1' => $Kd_Rek_1,
                'Nm_Rek_1' => $Nm_Rek_1, 
                'Kd_Rek_2' => $Kd_Rek_2,
                'Nm_Rek_2' => $Nm_Rek_2, 
                'Data_Rek_2' => $Data_Rek_2,
                'Data_Rek_3' => $Data_Rek_3,
                'Data_Rek_4' => $Data_Rek_4,
                'Data_Rek_5' => $Data_Rek_5,
                'RefApPub' => $RefApPub,
                'RefSumberDana' => $RefSumberDana,
        ]);
    }

    public function actionTambahRincianProses()
    {
      $request = Yii::$app->request;
      $model = new TaBelanjaProv();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Masukkan Rincian Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    public function actionHapusRincian($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5
            ];
      $model = TaBelanjaProv::findOne($Posisi);
      
      if ($model->delete()) {
        return "Hapus Berhasil";
      }
    }

    public function actionUbahRincian($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5
            ];

        $model = TaBelanjaProv::findOne($Posisi);

        $Data_Rek_1 = RefRek1::findOne(['Kd_Rek_1'=>5]);
        $Data_Rek_2 = RefRek2::findOne(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2]);
        $Data_Rek_3 = ArrayHelper::map(RefRek3::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2])->all(), 'Kd_Rek_3','Nm_Rek_3');
        $Data_Rek_4 = ArrayHelper::map(RefRek4::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2, 'Kd_Rek_3'=>$Kd_Rek_3])->all(), 'Kd_Rek_4','Nm_Rek_4');
        $Data_Rek_5 = ArrayHelper::map(RefRek5::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2, 'Kd_Rek_3'=>$Kd_Rek_3, 'Kd_Rek_4'=>$Kd_Rek_4])->all(), 'Kd_Rek_5','Nm_Rek_5');


        $Kd_Rek_1 = $Data_Rek_1->Kd_Rek_1;
        $Nm_Rek_1 = $Data_Rek_1->Nm_Rek_1;
        $Kd_Rek_2 = $Data_Rek_2->Kd_Rek_2;
        $Nm_Rek_2 = $Data_Rek_2->Nm_Rek_2;
        //$model->addRule(['Nm_Rek_1'], 'string', ['max' => 128]);


        $RefApPub = ArrayHelper::map(RefApPub::find()->all(), 'Kd_Ap_Pub', 'Nm_Ap_Pub');
        $RefSumberDana = ArrayHelper::map(RefSumberDana::find()->all(), 'Kd_Sumber', 'Nm_Sumber');

        return $this->renderajax('tambah_rincian', [
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'Kd_Keg' => $Kd_Keg, 
                'model' => $model, 
                'Kd_Rek_1' => $Kd_Rek_1,
                'Nm_Rek_1' => $Nm_Rek_1, 
                'Kd_Rek_2' => $Kd_Rek_2,
                'Nm_Rek_2' => $Nm_Rek_2, 
                'Data_Rek_2' => $Data_Rek_2,
                'Data_Rek_3' => $Data_Rek_3,
                'Data_Rek_4' => $Data_Rek_4,
                'Data_Rek_5' => $Data_Rek_5,
                'RefApPub' => $RefApPub,
                'RefSumberDana' => $RefSumberDana,
                'Kd_Rek_3' => $Kd_Rek_3,
                'Kd_Rek_4' => $Kd_Rek_4,
                'Kd_Rek_5' => $Kd_Rek_5,
                'ubah' => 1,
        ]);
    }

    public function actionUbahRincianProses($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
      $request = Yii::$app->request;
      $Posisi = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            'Kd_Rek_1' => $Kd_Rek_1,
            'Kd_Rek_2' => $Kd_Rek_2,
            'Kd_Rek_3' => $Kd_Rek_3,
            'Kd_Rek_4' => $Kd_Rek_4,
            'Kd_Rek_5' => $Kd_Rek_5
            ];

      $model = TaBelanja::findOne($Posisi);
      //$model = new TaBelanja();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model->save(false);
              
              echo "Ubah Rincian Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    //======================//

    public function actionKegiatan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        $PosisiKegiatan = [
            'Tahun' => $Tahun, 
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            ];

        $searchModel = new TaKegiatanProvSearch();
        $dataProvider = $searchModel->searchKegiatan($PosisiKegiatan);
        $modelUnit = TaProgramProv::findOne($PosisiKegiatan);

        $jlh_pagu_terpakai = TaBelanjaRincSubProv::find()
                            ->where($PosisiKegiatan)
                            ->sum('Total');

        return $this->render('kegiatan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data' => $modelUnit,
                    'jlh_pagu_terpakai' => $jlh_pagu_terpakai,
        ]);
    }

    public function actionTambahKegiatan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        $PosisiKegiatan = [
            'Tahun' => $Tahun, 
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
        ];

        $Posisi_ref = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Prog' => $Kd_Prog,
        ];

        $model = new TaKegiatanProv();

        $max_id=TaKegiatanProv::find()
                ->where($PosisiKegiatan)
                ->max('ID_Prog');
        $ID_Prog = $max_id + 1;

        $max_kd=TaKegiatanProv::find()
                ->where($PosisiKegiatan)
                ->max('Kd_Keg');
        $Kd_Keg = $max_kd + 1;

        //============//
        $indikator=RefIndikator::find()
                      ->where(['In', 'Kd_Indikator', [2,3,4,7]])
                      ->all();

        //============//
        //$satuan=satuan::find()->all();
        $satuan =  ArrayHelper::map(Satuan::find()->all(),'id','satuan');

        //============//
        $sumber_dana = ArrayHelper::map(RefSumberdana::find()->all(), 'Kd_Sumber', 'Nm_Sumber');

        //============//
        //$ref_kegiatan =  ArrayHelper::map(RefKegiatan::find()->where($Posisi_ref)->all(),'Ket_Kegiatan','Ket_Kegiatan');
        $ref_kegiatan = [];
        $dat_kegiatan = RefKegiatan::find()->where($Posisi_ref)->all();
        foreach ($dat_kegiatan as $key => $value) {
          $ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan] = $value->Ket_Kegiatan;
        }

        // $model_prov = new TaKegiatanSkpdProv();
        $RefUrusanProv =  ArrayHelper::map(RefUrusanProv::find()->all(),'Kd_Urusan','Nm_Urusan');
        $RefBidangProv =  [];
        $RefUnitProv =  [];
        $RefSubUnitProv =  [];


        //$model2 = new TaPaguKegiatan();
        return $this->renderajax('tambah-kegiatan', [
                'model' => $model,
                'ID_Prog' => $ID_Prog, 
                'Kd_Keg' => $Kd_Keg, 
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'indikator' => $indikator,
                'satuan' => $satuan,
                'sumber_dana' => $sumber_dana,
                'ref_kegiatan' => $ref_kegiatan,
                // 'model_prov' => $model_prov,
                'RefUrusanProv' => $RefUrusanProv,
                'RefBidangProv' => $RefBidangProv,
                'RefUnitProv' => $RefUnitProv,
                'RefSubUnitProv' => $RefSubUnitProv,
                //'models' => $model2,
        ]);
    }

    public function actionTambahKegiatanProses()
    {
      $request = Yii::$app->request;
      $model = new TaKegiatanProv();
      //$model_prov = new TaKegiatanSkpdProv();

      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $waktu_pelaksanaan_nilai = $request->post('waktu_pelaksanaan_nilai');
              $waktu_pelaksanaan_satuan = $request->post('waktu_pelaksanaan_satuan');
              $model->Waktu_Pelaksanaan = $waktu_pelaksanaan_nilai." ".$waktu_pelaksanaan_satuan;
              $model->Status = 0;
              $dat_kegiatan = explode("|", $model->Ket_Kegiatan);
              $model->Kd_Keg = $dat_kegiatan[0];
              $model->Ket_Kegiatan = $dat_kegiatan[1];
              $model->save(false);

              // $model_pagu = new TaPaguKegiatan();
              // $model_pagu->Tahun=date('Y');
              // $model_pagu->Kd_Keg=$model->Kd_Keg;
              // $model_pagu->Kd_Urusan=$model->Kd_Urusan;
              // $model_pagu->Kd_Bidang=$model->Kd_Bidang;
              // $model_pagu->Kd_Unit=$model->Kd_Unit;
              // $model_pagu->Kd_Sub=$model->Kd_Sub;
              // $model_pagu->Kd_Prog=$model->Kd_Prog;
              // $model_pagu->pagu=$model->Pagu_Anggaran;

              // $model_pagu->save(false);

              $tolak_ukur = $request->post('tolak_ukur');
              $target = $request->post('target');
              $target_satuan = $request->post('target_satuan');

              // $max_indi=TaIndikator::find()
              //           ->where([
              //               'Kd_Urusan' => $model->Kd_Urusan, 
              //               'Kd_Bidang' => $model->Kd_Bidang,
              //               'Kd_Unit' => $model->Kd_Unit,
              //               'Kd_Sub' => $model->Kd_Sub,
              //               'Kd_Prog' => $model->Kd_Prog,
              //               'Kd_Keg' => $model->Kd_Keg,
              //             ])
              //           ->max('Kd_Indikator');
              // $Kd_Indikator = $max_indi + 1;

              foreach ($tolak_ukur as $key => $toluk) {
                $model_indikator = new TaIndikatorProv();

                $model_indikator->Tahun = $model->Tahun;
                $model_indikator->Kd_Urusan = $model->Kd_Urusan;
                $model_indikator->Kd_Bidang = $model->Kd_Bidang;
                $model_indikator->Kd_Unit = $model->Kd_Unit;
                $model_indikator->Kd_Sub = $model->Kd_Sub;
                $model_indikator->Kd_Prog = $model->Kd_Prog;
                $model_indikator->ID_Prog = $model->ID_Prog;
                $model_indikator->Kd_Keg = $model->Kd_Keg;
                $model_indikator->Kd_Indikator = $key;
                $model_indikator->No_ID = 0;
                $model_indikator->Tolak_Ukur= $toluk;
                $model_indikator->Target_Angka=str_replace('.', '', $target[$key]);
                $model_indikator->Target_Uraian=str_replace('.', '', $target_satuan[$key]);

                $model_indikator->save(false);
                //$Kd_Indikator++;
              }

              //pilih skpd prov//
              // if($model_prov->load($request->post())){
              //   $model_prov->Tahun = $model->Tahun;
              //   $model_prov->Kd_Urusan = $model->Kd_Urusan;
              //   $model_prov->Kd_Bidang = $model->Kd_Bidang;
              //   $model_prov->Kd_Unit = $model->Kd_Unit;
              //   $model_prov->Kd_Sub = $model->Kd_Sub;
              //   $model_prov->Kd_Prog = $model->Kd_Prog;
              //   $model_prov->Kd_Keg = $model->Kd_Keg;
              //   $model_prov->save(false);
              // }

              echo "Masukkan Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    public function actionUbahKegiatan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
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

        $Posisi_ref = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Prog' => $Kd_Prog,
        ];

        $model = TaKegiatanProv::findOne($PosisiKegiatan);

        // $max_id=TaKegiatan::find()
        //         ->where($PosisiKegiatan)
        //         ->max('ID_Prog');
        // $ID_Prog = $max_id + 1;

        // $max_kd=TaKegiatan::find()
        //         ->where($PosisiKegiatan)
        //         ->max('Kd_Keg');
        // $Kd_Keg = $max_kd + 1;

        //============//
        // $indikator=RefIndikator::find()
        //               ->where(['In', 'Kd_Indikator', [2,3,4,7]])
        //               ->all();

       // $indikator_data=$model->getIndikator()->all();
        $indikator=RefIndikator::find()
                    ->where(['In', 'Kd_Indikator', [2,3,4,7]])
                    ->all();
        //============//
        //$satuan=satuan::find()->all();
        $satuan =  ArrayHelper::map(Satuan::find()->all(),'id','satuan');

        //============//
        $sumber_dana = ArrayHelper::map(RefSumberdana::find()->all(), 'Kd_Sumber', 'Nm_Sumber');

        //============//
        //$ref_kegiatan =  ArrayHelper::map(RefKegiatan::find()->where($Posisi_ref)->all(),'Ket_Kegiatan','Ket_Kegiatan');
        $ref_kegiatan = [];
        $dat_kegiatan = RefKegiatan::find()->where($Posisi_ref)->all();
        foreach ($dat_kegiatan as $key => $value) {
          $ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan] = $value->Ket_Kegiatan;
        }

        if (isset($model->Waktu_Pelaksanaan)) {
          $waktu = explode(" ", $model->Waktu_Pelaksanaan);
          $waktu_pelaksanaan_nilai = $waktu[0];
          $waktu_pelaksanaan_satuan = $waktu[1];
        }
        else{
          $waktu_pelaksanaan_nilai = '';
          $waktu_pelaksanaan_satuan = '';
        }
        $a = $model->Kd_Keg;
        $b = $model->Ket_Kegiatan;
        $model->Ket_Kegiatan = $a."|".$b;

        $model_indikator = TaIndikatorProv::findall($PosisiKegiatan);
        foreach ($model_indikator as $key => $indi) {
          $Kd_Indikator = $indi->Kd_Indikator;

          $Tolak_Ukur[$Kd_Indikator]=$indi->Tolak_Ukur;
          $Target_Angka[$Kd_Indikator]=$indi->Target_Angka;
          $Target_Uraian[$Kd_Indikator]=$indi->Target_Uraian;
        }

        if (!isset($Tolak_Ukur)) {
          $Tolak_Ukur=[];
          $Target_Angka=[];
          $Target_Uraian=[];
        }
		$RefUrusanProv =  ArrayHelper::map(RefUrusanProv::find()->all(),'Kd_Urusan','Nm_Urusan');
        $RefBidangProv =  [];
        $RefUnitProv =  [];
        $RefSubUnitProv =  [];
        

        //$model2 = new TaPaguKegiatan();
        return $this->renderajax('tambah-kegiatan', [
                'model' => $model,
                // 'ID_Prog' => $ID_Prog, 
                // 'Kd_Keg' => $Kd_Keg, 
                'Tahun' => $Tahun, 
                'Kd_Urusan' => $Kd_Urusan, 
                'Kd_Bidang' => $Kd_Bidang, 
                'Kd_Unit' => $Kd_Unit, 
                'Kd_Sub' => $Kd_Sub, 
                'Kd_Prog' => $Kd_Prog,
                'Kd_Keg' => $Kd_Keg,
                'indikator' => $indikator,
                'satuan' => $satuan,
                'sumber_dana' => $sumber_dana,
                'ref_kegiatan' => $ref_kegiatan,
                'waktu_pelaksanaan_nilai' => $waktu_pelaksanaan_nilai,
                'waktu_pelaksanaan_satuan' => $waktu_pelaksanaan_satuan,
                'ubah' => 1,
                'Tolak_Ukur' => $Tolak_Ukur,
                'Target_Angka' => $Target_Angka,
                'Target_Uraian' => $Target_Uraian,
				'RefUrusanProv' => $RefUrusanProv,
                'RefBidangProv' => $RefBidangProv,
                'RefUnitProv' => $RefUnitProv,
                'RefSubUnitProv' => $RefSubUnitProv,
                //'models' => $model2,
        ]);
    }

    public function actionUbahKegiatanProses($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
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

      if($model->load($request->post())){
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $waktu_pelaksanaan_nilai = $request->post('waktu_pelaksanaan_nilai');
              $waktu_pelaksanaan_satuan = $request->post('waktu_pelaksanaan_satuan');
              $model->Waktu_Pelaksanaan = $waktu_pelaksanaan_nilai." ".$waktu_pelaksanaan_satuan;
              $model->Status = 0;
              $model->save(false);

              $model_pagu = TaPaguKegiatan::findOne($Posisi);
              $model_pagu->pagu=$model->Pagu_Anggaran;
              $model_pagu->save(false);

              $tolak_ukur = $request->post('tolak_ukur');
              $target = $request->post('target');
              $target_satuan = $request->post('target_satuan');
              
              TaIndikatorProv::deleteAll($Posisi);
              foreach ($tolak_ukur as $key => $toluk) {
                $model_indikator = new TaIndikator();

                $model_indikator->Tahun = $model->Tahun;
                $model_indikator->Kd_Urusan = $model->Kd_Urusan;
                $model_indikator->Kd_Bidang = $model->Kd_Bidang;
                $model_indikator->Kd_Unit = $model->Kd_Unit;
                $model_indikator->Kd_Sub = $model->Kd_Sub;
                $model_indikator->Kd_Prog = $model->Kd_Prog;
                $model_indikator->ID_Prog = $model->ID_Prog;
                $model_indikator->Kd_Keg = $model->Kd_Keg;
                $model_indikator->Kd_Indikator = $key;
                $model_indikator->No_ID = 0;
                $model_indikator->Tolak_Ukur=$nilai = str_replace('.', '', $toluk);
                $model_indikator->Target_Angka=str_replace('.', '', $target[$key]);
                $model_indikator->Target_Uraian=str_replace('.', '', $target_satuan[$key]);

                $model_indikator->save(false);
                //$Kd_Indikator++;
              }

              echo "Ubah Kegiatan Berhasil";
              $transaction->commit();
          } catch (\Exception $e) {
              $transaction->rollBack();
              throw $e;
          } catch (\Throwable $e) {
              $transaction->rollBack();
              throw $e;
          }
      }
    }

    public function actionViewKegiatan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        return $this->render('view-kegiatan');
    }

    public function actionHapusKegiatan($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
      $Posisi = [
            'Tahun' => $Tahun, 
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
            'Kd_Unit' => $Kd_Unit,
            'Kd_Sub' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
            'Kd_Keg' => $Kd_Keg,
            ];
      $model = TaKegiatanProv::findOne($Posisi);
      //$model2 = TaPaguKegiatan::findOne($Posisi);
      //$model3 = TaIndikator::findOne($Posisi);
      
      if ($model->delete()) {
        TaIndikatorProv::deleteAll($Posisi);
        //Output Query
        //DELETE FROM `tbl_user` WHERE status = 'active' AND age > 20
        return "Hapus Berhasil";
      }
    }

    //===========================//
    public function actionProgram()
    {

        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

        $searchModel = new TaProgramProvSearch();
        $dataProvider = $searchModel->searchProgram2(Yii::$app->request->queryParams);
        $modelUnit = TaSubUnit::find()->where($PosisiUnit)->all();
        $data = TaSubUnit::findone($PosisiUnit);

        $tabelanjanrincsub = TaBelanjaRincSubProv::find()
                          ->where($PosisiUnit)
                          ->sum('Total');

        $modelLevel = $PosisiUnit;

        $program = TaProgram::find()->where($PosisiUnit)->all(); //memang tanpa prov karena ambil program prov
        foreach ($program as $copy) {
          $isi = [
            'Tahun' => $copy->Tahun,
            'Kd_Urusan' => $copy->Kd_Urusan,
            'Kd_Bidang' => $copy->Kd_Bidang,
            'Kd_Unit' => $copy->Kd_Unit,
            'Kd_Sub' => $copy->Kd_Sub,
            'Kd_Prog' => $copy->Kd_Prog,
          ];

          $exists = TaProgramProv::find()->where($isi)->exists();
          if(!$exists) {
            $new_prog = new TaProgramProv();
            $new_prog->Tahun = $copy->Tahun;
            $new_prog->Kd_Urusan = $copy->Kd_Urusan;
            $new_prog->Kd_Bidang = $copy->Kd_Bidang;
            $new_prog->Kd_Unit = $copy->Kd_Unit;
            $new_prog->Kd_Sub = $copy->Kd_Sub;
            $new_prog->Kd_Prog = $copy->Kd_Prog;
            $new_prog->Ket_Prog = $copy->Ket_Prog;
            $new_prog->save(false);
            //echo "a ";
          } else {
            //kalau ada
            //echo 'b ';
          }

        }

        return $this->render('program', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'modelLevel' => $modelLevel,
                    'modelUnit' => $modelUnit,
                    'data' => $data,
                    'tabelanjanrincsub' => $tabelanjanrincsub,
        ]);
    }

    public function actionPaguProgram()
    {

        $unitskpd = Yii::$app->levelcomponent->getUnit();
        $data = TaPaguSubUnit::find()
                        ->where([
                            'Tahun' => date("Y"),
                            'Kd_Urusan' => $unitskpd->Kd_Urusan,
                            'Kd_Bidang' => $unitskpd->Kd_Bidang,
                            'Kd_Unit' => $unitskpd->Kd_Unit, 
                            'Kd_Sub' => $unitskpd->Kd_Sub_Unit,    
                            ])
                        ->all();

        return $this->render('pagu-program', [
            'data' => $data,
        ]);
    }

    public function actionHasil()
    {
      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $tahun=(date('Y')+1);

      $data = TaSubUnit::findone($PosisiUnit);

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgramProv::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
		 $xUnit=RefSubUnit::find()->where($PosisiUnit)->one();
      return $this->render('hasil',[
            'dataKegiatan'=>$dataKegiatan,
            'subunit'=>$TaSubUnit,
			'xUnit'=>$xUnit,
      ]);
    }

    public function actionHasilRekapPilih()
    {
      $RefSubUnit = RefSubUnit::find()->all();
      return $this->render('hasil_rekap_pilih',[
          'RefSubUnit' => $RefSubUnit,

      ]);
    }

    public function actionHasilRekap($skpd, $v=null)
    {
      $dat = explode("|", $skpd);
      $Kd_Urusan = $dat[0];
      $Kd_Bidang = $dat[1];
      $Kd_Unit = $dat[2];
      $Kd_Sub = $dat[3];

      $PosisiUnit=[
        'Kd_Urusan' => $Kd_Urusan,
        'Kd_Bidang' => $Kd_Bidang,
        'Kd_Unit' => $Kd_Unit,
        'Kd_Sub' => $Kd_Sub,
      ];

      $data = TaSubUnit::findone($PosisiUnit);

      $TaSubUnit = TaSubUnit::find()->where($PosisiUnit)->one();

      $dataKegiatan = TaProgramProv::find()->where($PosisiUnit)->all();
       $xUnit=RefSubUnit::find()->where($PosisiUnit)->one();
      return $this->render('hasil_rekap',[
            'dataKegiatan'=>$dataKegiatan,
            'subunit'=>$TaSubUnit,
            'v' => $v,
			'xUnit'=>$xUnit,
      ]);
    }


    //============kirim ke provinsi===================//
    public function actionKirimData()
    {
      $data = [
        'info' => [
          'nama_provinsi' => 'Sumatera Utara',
          'nama_kab' => 'Asahan',
          'Kd_Prov' => '12',
          'Kd_Kab' => '9',
        ],
        'data' => [
          'Ta_Program_Prov' => [
          ],
          'Ta_Kegiatan_Prov' => [
          ],
          'Ta_Belanja_Prov' => [
          ],
          'Ta_Belanja_Rinc_Prov' => [
          ],
          'Ta_Belanja_Rinc_Sub_Prov' => [
          ],
        ]
      ];

      //$data['data']['Ta_Program_Prov'][1]= ['nama'=>'padli'];
      $ta_program = TaProgramProv::find()->all();
      $urut=0;
      foreach ($ta_program as $program) {
        $data['data']['Ta_Program_Prov'][$urut]= [
                                      'Tahun' => $program->Tahun,
                                      'Kd_Urusan' => $program->Kd_Urusan,
                                      'Kd_Bidang' => $program->Kd_Bidang,
                                      'Kd_Unit' => $program->Kd_Unit,
                                      'Kd_Sub' => $program->Kd_Sub,
                                      'Kd_Prog' => $program->Kd_Prog,
                                      'ID_Prog' => $program->ID_Prog,
                                      'Ket_Prog' => $program->Ket_Prog,
                                      'Urusan' => $program->urusan->Nm_Urusan,
                                      'Bidang' => $program->bidang->Nm_Bidang,
                                      'Unit' => $program->refUnit->Nm_Unit,
                                      'Sub Unit' => $program->refSubUnit->Nm_Sub_Unit,
                                    ];
        $urut++;
      }

      $ta_kegiatan = TaKegiatanProv::find()->where(['=', 'Verifikasi_Bappeda', 1])->all();
      $urut=0;
      foreach ($ta_kegiatan as $kegiatan) {
        $data['data']['Ta_Kegiatan_Prov'][$urut]= [
                                      'Tahun' => $kegiatan->Tahun,
                                      'Kd_Urusan' => $kegiatan->Kd_Urusan,
                                      'Kd_Bidang' => $kegiatan->Kd_Bidang,
                                      'Kd_Prog' => $kegiatan->Kd_Prog,
                                      'Kd_Keg' => $kegiatan->Kd_Keg,
                                      'Kd_Unit' => $kegiatan->Kd_Unit,
                                      'Kd_Sub' => $kegiatan->Kd_Sub,
                                      'ID_Prog' => $kegiatan->ID_Prog,
                                      'Ket_Kegiatan' => $kegiatan->Ket_Kegiatan,
                                      'Lokasi' => $kegiatan->Lokasi,
                                      'Kelompok_Sasaran' => $kegiatan->Kelompok_Sasaran,
                                      'Status_Kegiatan' => $kegiatan->Status_Kegiatan,
                                      'Pagu_Anggaran' => $kegiatan->Pagu_Anggaran,
                                      'Waktu_Pelaksanaan' => $kegiatan->Waktu_Pelaksanaan,
                                      'Kd_Sumber' => $kegiatan->Kd_Sumber,
                                      'Status' => $kegiatan->Status,
                                      'Keterangan' => $kegiatan->Keterangan,
                                      'Pagu_Anggaran_Nt1' => $kegiatan->Pagu_Anggaran_Nt1,
                                      'Verifikasi_Bappeda' => $kegiatan->Verifikasi_Bappeda,
                                      'Tanggal_Verifikasi_Bappeda' => $kegiatan->Tanggal_Verifikasi_Bappeda,
                                      'Keterangan_Verifikasi_Bappeda' => $kegiatan->Keterangan_Verifikasi_Bappeda,
                                      'Kd_Urusan_Prov' => $kegiatan->Kd_Urusan_Prov,
                                      'Kd_Bidang_Prov' => $kegiatan->Kd_Bidang_Prov,
                                      'Kd_Unit_Prov' => $kegiatan->Kd_Unit_Prov,
                                      'Kd_Sub_Prov' => $kegiatan->Kd_Sub_Prov,
                                      'Urusan' => $kegiatan->urusan->Nm_Urusan,
                                      'Bidang' => $kegiatan->bidang->Nm_Bidang,
                                      'Unit' => $kegiatan->unit->Nm_Unit,
                                      'Sub_Unit' => $kegiatan->sub->Nm_Sub_Unit,
                                      'Program' => $kegiatan->program->Ket_Program,
                                    ];
        $urut++;
      }

      $ta_belanja = TaBelanjaProv::find()->all();
      $urut=0;
      foreach ($ta_belanja as $belanja) {
        if($belanja->kegiatan->Verifikasi_Bappeda != 1){
          continue;
        }

        $data['data']['Ta_Belanja_Prov'][$urut]= [
                                      'Tahun' => $belanja->Tahun,
                                      'Kd_Urusan' => $belanja->Kd_Urusan,
                                      'Kd_Bidang' => $belanja->Kd_Bidang,
                                      'Kd_Unit' => $belanja->Kd_Unit,
                                      'Kd_Sub' => $belanja->Kd_Sub,
                                      'Kd_Prog' => $belanja->Kd_Prog,
                                      'ID_Prog' => $belanja->ID_Prog,
                                      'Kd_Keg' => $belanja->Kd_Keg,
                                      'Kd_Rek_1' => $belanja->Kd_Rek_1,
                                      'Kd_Rek_2' => $belanja->Kd_Rek_2,
                                      'Kd_Rek_3' => $belanja->Kd_Rek_3,
                                      'Kd_Rek_4' => $belanja->Kd_Rek_4,
                                      'Kd_Rek_5' => $belanja->Kd_Rek_5,
                                      'Kd_Ap_Pub' => $belanja->Kd_Ap_Pub,
                                      'Kd_Sumber' => $belanja->Kd_Sumber,
                                      'Urusan' => $belanja->urusan->Nm_Urusan,
                                      'Bidang' => $belanja->bidang->Nm_Bidang,
                                      'Unit' => $belanja->unit->Nm_Unit,
                                      'Sub_Unit' => $belanja->sub->Nm_Sub_Unit,
                                      'Program' => $belanja->program->Ket_Program,
                                      'Kegiatan' => $belanja->tahun->Ket_Kegiatan,
                                      //'verifikasi' => $belanja->kegiatan->Verifikasi_Bappeda,
                                    ];
        $urut++;
      }

      $ta_belanja_rinci = TaBelanjaRincProv::find()->all();
      $urut=0;
      foreach ($ta_belanja_rinci as $belanja_rinc) {
        if($belanja_rinc->kegiatan->Verifikasi_Bappeda != 1){
          continue;
        }
        $data['data']['Ta_Belanja_Rinc_Prov'][$urut]= [
                                      'Tahun' =>$belanja_rinc->Tahun,
                                      'Kd_Urusan' =>$belanja_rinc->Kd_Urusan,
                                      'Kd_Bidang' =>$belanja_rinc->Kd_Bidang,
                                      'Kd_Unit' =>$belanja_rinc->Kd_Unit,
                                      'Kd_Sub' =>$belanja_rinc->Kd_Sub,
                                      'Kd_Prog' =>$belanja_rinc->Kd_Prog,
                                      'ID_Prog' =>$belanja_rinc->ID_Prog,
                                      'Kd_Keg' =>$belanja_rinc->Kd_Keg,
                                      'Kd_Rek_1' =>$belanja_rinc->Kd_Rek_1,
                                      'Kd_Rek_2' =>$belanja_rinc->Kd_Rek_2,
                                      'Kd_Rek_3' =>$belanja_rinc->Kd_Rek_3,
                                      'Kd_Rek_4' =>$belanja_rinc->Kd_Rek_4,
                                      'Kd_Rek_5' =>$belanja_rinc->Kd_Rek_5,
                                      'No_Rinc' =>$belanja_rinc->No_Rinc,
                                      'Keterangan' =>$belanja_rinc->Keterangan,
                                      'Kd_Sumber' =>$belanja_rinc->Kd_Sumber,
                                      'Urusan' => $belanja_rinc->urusan->Nm_Urusan,
                                      'Bidang' => $belanja_rinc->bidang->Nm_Bidang,
                                      'Unit' => $belanja_rinc->unit->Nm_Unit,
                                      'Sub_Unit' => $belanja_rinc->sub->Nm_Sub_Unit,
                                      'Program' => $belanja_rinc->program->Ket_Program,
                                      'Kegiatan' => $belanja_rinc->kegiatan->Ket_Kegiatan,
                                      'Belanja' => $belanja_rinc->kdRek5->Nm_Rek_5,
                                    ];
        $urut++;
      }

      $ta_belanja_rinci_sub = TaBelanjaRincSubProv::find()->all();
      $urut=0;
      foreach ($ta_belanja_rinci_sub as $rinc_sub) {
        if($rinc_sub->kegiatan->Verifikasi_Bappeda != 1){
          continue;
        }
        $data['data']['Ta_Belanja_Rinc_Sub_Prov'][$urut]= [
                                      'Tahun' => $rinc_sub->Tahun,
                                      'Kd_Urusan' => $rinc_sub->Kd_Urusan,
                                      'Kd_Bidang' => $rinc_sub->Kd_Bidang,
                                      'Kd_Unit' => $rinc_sub->Kd_Unit,
                                      'Kd_Sub' => $rinc_sub->Kd_Sub,
                                      'Kd_Prog' => $rinc_sub->Kd_Prog,
                                      'ID_Prog' => $rinc_sub->ID_Prog,
                                      'Kd_Keg' => $rinc_sub->Kd_Keg,
                                      'Kd_Rek_1' => $rinc_sub->Kd_Rek_1,
                                      'Kd_Rek_2' => $rinc_sub->Kd_Rek_2,
                                      'Kd_Rek_3' => $rinc_sub->Kd_Rek_3,
                                      'Kd_Rek_4' => $rinc_sub->Kd_Rek_4,
                                      'Kd_Rek_5' => $rinc_sub->Kd_Rek_5,
                                      'No_Rinc' => $rinc_sub->No_Rinc,
                                      'No_ID' => $rinc_sub->No_ID,
                                      'Sat_1' => $rinc_sub->Sat_1,
                                      'Nilai_1' => $rinc_sub->Nilai_1,
                                      'Sat_2' => $rinc_sub->Sat_2,
                                      'Nilai_2' => $rinc_sub->Nilai_2,
                                      'Sat_3' => $rinc_sub->Sat_3,
                                      'Nilai_3' => $rinc_sub->Nilai_3,
                                      'Satuan123' => $rinc_sub->Satuan123,
                                      'Jml_Satuan' => $rinc_sub->Jml_Satuan,
                                      'Nilai_Rp' => $rinc_sub->Nilai_Rp,
                                      'Total' => $rinc_sub->Total,
                                      'Keterangan' => $rinc_sub->Keterangan,
                                      'Asal_Biaya' => $rinc_sub->Asal_Biaya,
                                      'Uraian_Asal_Biaya' => $rinc_sub->Uraian_Asal_Biaya,
                                      'Ref_Usulan_Rincian' => $rinc_sub->Ref_Usulan_Rincian,
                                      'Uraian_Ref_Usulan' => $rinc_sub->Uraian_Ref_Usulan,
                                      'Urusan' => $rinc_sub->urusan->Nm_Urusan,
                                      'Bidang' => $rinc_sub->bidang->Nm_Bidang,
                                      'Unit' => $rinc_sub->unit->Nm_Unit,
                                      'Sub_Unit' => $rinc_sub->sub->Nm_Sub_Unit,
                                      'Program' => $rinc_sub->program->Ket_Program,
                                      'Kegiatan' => $rinc_sub->kegiatan->Ket_Kegiatan,
                                      'Belanja' => $rinc_sub->kdRek5->Nm_Rek_5,
                                      'Rincian_Belanja' => $rinc_sub->belanjaRinc->Keterangan,
                                    ];
        $urut++;
      }

      $data_kirim = Json::encode($data);
      // echo "<pre><code>";
      echo $data_kirim;
      // echo "</code></pre>";
    }

    public function actionFormKirim()
    {
      // $data = [
      //   'info' => [
      //     'nama_provinsi' => 'Sumatera Utara',
      //     'nama_kab' => 'Medan',
      //     'Kd_Prov' => '12',
      //     'Kd_Kab' => '71',
      //   ],
      //   'data' => [
      //     'Ta_Program_Prov' => [
      //     ],
      //     'Ta_Kegiatan_Prov' => [
      //     ],
      //     'Ta_Belanja_Prov' => [
      //     ],
      //     'Ta_Belanja_Rinc_Prov' => [
      //     ],
      //     'Ta_Belanja_Rinc_Sub_Prov' => [
      //     ],
      //   ]
      // ];

      // //$data['data']['Ta_Program_Prov'][1]= ['nama'=>'padli'];
      // $ta_program = TaProgramProv::find()->all();
      // $urut=0;
      // foreach ($ta_program as $program) {
      //   $data['data']['Ta_Program_Prov'][$urut]= [
      //                                 'Tahun' => $program->Tahun,
      //                                 'Kd_Urusan' => $program->Kd_Urusan,
      //                                 'Kd_Bidang' => $program->Kd_Bidang,
      //                                 'Kd_Unit' => $program->Kd_Unit,
      //                                 'Kd_Sub' => $program->Kd_Sub,
      //                                 'Kd_Prog' => $program->Kd_Prog,
      //                                 'ID_Prog' => $program->ID_Prog,
      //                                 'Ket_Prog' => $program->Ket_Prog,
      //                                 'Urusan' => $program->urusan->Nm_Urusan,
      //                                 'Bidang' => $program->bidang->Nm_Bidang,
      //                                 'Unit' => $program->refUnit->Nm_Unit,
      //                                 'Sub Unit' => $program->refSubUnit->Nm_Sub_Unit,
      //                               ];
      //   $urut++;
      // }

      // $ta_kegiatan = TaKegiatanProv::find()->all();
      // $urut=0;
      // foreach ($ta_kegiatan as $kegiatan) {
      //   $data['data']['Ta_Kegiatan_Prov'][$urut]= [
      //                                 'Tahun' => $kegiatan->Tahun,
      //                                 'Kd_Urusan' => $kegiatan->Kd_Urusan,
      //                                 'Kd_Bidang' => $kegiatan->Kd_Bidang,
      //                                 'Kd_Prog' => $kegiatan->Kd_Prog,
      //                                 'Kd_Keg' => $kegiatan->Kd_Keg,
      //                                 'Kd_Unit' => $kegiatan->Kd_Unit,
      //                                 'Kd_Sub' => $kegiatan->Kd_Sub,
      //                                 'ID_Prog' => $kegiatan->ID_Prog,
      //                                 'Ket_Kegiatan' => $kegiatan->Ket_Kegiatan,
      //                                 'Lokasi' => $kegiatan->Lokasi,
      //                                 'Kelompok_Sasaran' => $kegiatan->Kelompok_Sasaran,
      //                                 'Status_Kegiatan' => $kegiatan->Status_Kegiatan,
      //                                 'Pagu_Anggaran' => $kegiatan->Pagu_Anggaran,
      //                                 'Waktu_Pelaksanaan' => $kegiatan->Waktu_Pelaksanaan,
      //                                 'Kd_Sumber' => $kegiatan->Kd_Sumber,
      //                                 'Status' => $kegiatan->Status,
      //                                 'Keterangan' => $kegiatan->Keterangan,
      //                                 'Pagu_Anggaran_Nt1' => $kegiatan->Pagu_Anggaran_Nt1,
      //                                 'Verifikasi_Bappeda' => $kegiatan->Verifikasi_Bappeda,
      //                                 'Tanggal_Verifikasi_Bappeda' => $kegiatan->Tanggal_Verifikasi_Bappeda,
      //                                 'Keterangan_Verifikasi_Bappeda' => $kegiatan->Keterangan_Verifikasi_Bappeda,
      //                                 'Kd_Urusan_Prov' => $kegiatan->Kd_Urusan_Prov,
      //                                 'Kd_Bidang_Prov' => $kegiatan->Kd_Bidang_Prov,
      //                                 'Kd_Unit_Prov' => $kegiatan->Kd_Unit_Prov,
      //                                 'Kd_Sub_Prov' => $kegiatan->Kd_Sub_Prov,
      //                                 'Urusan' => $kegiatan->urusan->Nm_Urusan,
      //                                 'Bidang' => $kegiatan->bidang->Nm_Bidang,
      //                                 'Unit' => $kegiatan->unit->Nm_Unit,
      //                                 'Sub_Unit' => $kegiatan->sub->Nm_Sub_Unit,
      //                                 'Program' => $kegiatan->program->Ket_Program,
      //                               ];
      //   $urut++;
      // }

      // $ta_belanja = TaBelanjaProv::find()->all();
      // $urut=0;
      // foreach ($ta_belanja as $belanja) {
      //   $data['data']['Ta_Belanja_Prov'][$urut]= [
      //                                 'Tahun' => $belanja->Tahun,
      //                                 'Kd_Urusan' => $belanja->Kd_Urusan,
      //                                 'Kd_Bidang' => $belanja->Kd_Bidang,
      //                                 'Kd_Unit' => $belanja->Kd_Unit,
      //                                 'Kd_Sub' => $belanja->Kd_Sub,
      //                                 'Kd_Prog' => $belanja->Kd_Prog,
      //                                 'ID_Prog' => $belanja->ID_Prog,
      //                                 'Kd_Keg' => $belanja->Kd_Keg,
      //                                 'Kd_Rek_1' => $belanja->Kd_Rek_1,
      //                                 'Kd_Rek_2' => $belanja->Kd_Rek_2,
      //                                 'Kd_Rek_3' => $belanja->Kd_Rek_3,
      //                                 'Kd_Rek_4' => $belanja->Kd_Rek_4,
      //                                 'Kd_Rek_5' => $belanja->Kd_Rek_5,
      //                                 'Kd_Ap_Pub' => $belanja->Kd_Ap_Pub,
      //                                 'Kd_Sumber' => $belanja->Kd_Sumber,
      //                                 'Urusan' => $belanja->urusan->Nm_Urusan,
      //                                 'Bidang' => $belanja->bidang->Nm_Bidang,
      //                                 'Unit' => $belanja->unit->Nm_Unit,
      //                                 'Sub_Unit' => $belanja->sub->Nm_Sub_Unit,
      //                                 'Program' => $belanja->program->Ket_Program,
      //                                 'Kegiatan' => $belanja->tahun->Ket_Kegiatan,
      //                               ];
      //   $urut++;
      // }

      // $ta_belanja_rinci = TaBelanjaRincProv::find()->all();
      // $urut=0;
      // foreach ($ta_belanja_rinci as $belanja_rinc) {
      //   $data['data']['Ta_Belanja_Rinc_Prov'][$urut]= [
      //                                 'Tahun' =>$belanja_rinc->Tahun,
      //                                 'Kd_Urusan' =>$belanja_rinc->Kd_Urusan,
      //                                 'Kd_Bidang' =>$belanja_rinc->Kd_Bidang,
      //                                 'Kd_Unit' =>$belanja_rinc->Kd_Unit,
      //                                 'Kd_Sub' =>$belanja_rinc->Kd_Sub,
      //                                 'Kd_Prog' =>$belanja_rinc->Kd_Prog,
      //                                 'ID_Prog' =>$belanja_rinc->ID_Prog,
      //                                 'Kd_Keg' =>$belanja_rinc->Kd_Keg,
      //                                 'Kd_Rek_1' =>$belanja_rinc->Kd_Rek_1,
      //                                 'Kd_Rek_2' =>$belanja_rinc->Kd_Rek_2,
      //                                 'Kd_Rek_3' =>$belanja_rinc->Kd_Rek_3,
      //                                 'Kd_Rek_4' =>$belanja_rinc->Kd_Rek_4,
      //                                 'Kd_Rek_5' =>$belanja_rinc->Kd_Rek_5,
      //                                 'No_Rinc' =>$belanja_rinc->No_Rinc,
      //                                 'Keterangan' =>$belanja_rinc->Keterangan,
      //                                 'Kd_Sumber' =>$belanja_rinc->Kd_Sumber,
      //                                 'Urusan' => $belanja_rinc->urusan->Nm_Urusan,
      //                                 'Bidang' => $belanja_rinc->bidang->Nm_Bidang,
      //                                 'Unit' => $belanja_rinc->unit->Nm_Unit,
      //                                 'Sub_Unit' => $belanja_rinc->sub->Nm_Sub_Unit,
      //                                 'Program' => $belanja_rinc->program->Ket_Program,
      //                                 'Kegiatan' => $belanja_rinc->kegiatan->Ket_Kegiatan,
      //                                 'Belanja' => $belanja_rinc->kdRek5->Nm_Rek_5,
      //                               ];
      //   $urut++;
      // }

      // $ta_belanja_rinci_sub = TaBelanjaRincSubProv::find()->all();
      // $urut=0;
      // foreach ($ta_belanja_rinci_sub as $rinc_sub) {
      //   $data['data']['Ta_Belanja_Rinc_Sub_Prov'][$urut]= [
      //                                 'Tahun' => $rinc_sub->Tahun,
      //                                 'Kd_Urusan' => $rinc_sub->Kd_Urusan,
      //                                 'Kd_Bidang' => $rinc_sub->Kd_Bidang,
      //                                 'Kd_Unit' => $rinc_sub->Kd_Unit,
      //                                 'Kd_Sub' => $rinc_sub->Kd_Sub,
      //                                 'Kd_Prog' => $rinc_sub->Kd_Prog,
      //                                 'ID_Prog' => $rinc_sub->ID_Prog,
      //                                 'Kd_Keg' => $rinc_sub->Kd_Keg,
      //                                 'Kd_Rek_1' => $rinc_sub->Kd_Rek_1,
      //                                 'Kd_Rek_2' => $rinc_sub->Kd_Rek_2,
      //                                 'Kd_Rek_3' => $rinc_sub->Kd_Rek_3,
      //                                 'Kd_Rek_4' => $rinc_sub->Kd_Rek_4,
      //                                 'Kd_Rek_5' => $rinc_sub->Kd_Rek_5,
      //                                 'No_Rinc' => $rinc_sub->No_Rinc,
      //                                 'No_ID' => $rinc_sub->No_ID,
      //                                 'Sat_1' => $rinc_sub->Sat_1,
      //                                 'Nilai_1' => $rinc_sub->Nilai_1,
      //                                 'Sat_2' => $rinc_sub->Sat_2,
      //                                 'Nilai_2' => $rinc_sub->Nilai_2,
      //                                 'Sat_3' => $rinc_sub->Sat_3,
      //                                 'Nilai_3' => $rinc_sub->Nilai_3,
      //                                 'Satuan123' => $rinc_sub->Satuan123,
      //                                 'Jml_Satuan' => $rinc_sub->Jml_Satuan,
      //                                 'Nilai_Rp' => $rinc_sub->Nilai_Rp,
      //                                 'Total' => $rinc_sub->Total,
      //                                 'Keterangan' => $rinc_sub->Keterangan,
      //                                 'Asal_Biaya' => $rinc_sub->Asal_Biaya,
      //                                 'Uraian_Asal_Biaya' => $rinc_sub->Uraian_Asal_Biaya,
      //                                 'Ref_Usulan_Rincian' => $rinc_sub->Ref_Usulan_Rincian,
      //                                 'Uraian_Ref_Usulan' => $rinc_sub->Uraian_Ref_Usulan,
      //                                 'Urusan' => $rinc_sub->urusan->Nm_Urusan,
      //                                 'Bidang' => $rinc_sub->bidang->Nm_Bidang,
      //                                 'Unit' => $rinc_sub->unit->Nm_Unit,
      //                                 'Sub_Unit' => $rinc_sub->sub->Nm_Sub_Unit,
      //                                 'Program' => $rinc_sub->program->Ket_Program,
      //                                 'Kegiatan' => $rinc_sub->kegiatan->Ket_Kegiatan,
      //                                 'Belanja' => $rinc_sub->kdRek5->Nm_Rek_5,
      //                                 'Rincian_Belanja' => $rinc_sub->belanjaRinc->Keterangan,
      //                               ];
      //   $urut++;
      // }

      // $data_kirim = Json::encode($data);

      return $this->render('form_kirim',[
                // 'data_kirim'=>$data_kirim 
      ]);
    }

    public function actionKirimProses()
    {
      $request = Yii::$app->request;
      $data_kirim = $request->post('data_json');
      $data_json= Json::decode($data_kirim);

      $nama_provinsi = $data_json['info']['nama_provinsi'];
      $nama_kab = $data_json['info']['nama_kab'];
      $Kd_Prov = $data_json['info']['Kd_Prov'];
      $Kd_Kab = $data_json['info']['Kd_Kab'];

      echo "
      $nama_provinsi
      $nama_kab
      $Kd_Prov
      $Kd_Kab
      ";

      echo "<br/>----- Program -----<br/>";
      foreach ($data_json['data']['Ta_Program_Prov'] as $program) {
        echo $program['Tahun']."<br/>";
        echo $program['Kd_Urusan']."<br/>";
        echo $program['Kd_Bidang']."<br/>";
        echo $program['Kd_Unit']."<br/>";
        echo $program['Kd_Sub']."<br/>";
        echo $program['Kd_Prog']."<br/>";
        echo $program['ID_Prog']."<br/>";
        echo $program['Ket_Prog']."<br/>";
        echo $program['Urusan']."<br/>";
        echo $program['Bidang']."<br/>";
        echo $program['Unit']."<br/>";
        echo $program['Sub Unit']."<br/>";
        echo "===============<br/>";
      }

      echo "<br/>----- Kegiatan -----<br/>";
      foreach ($data_json['data']['Ta_Kegiatan_Prov'] as $kegiatan) {
        echo $kegiatan['Tahun']."<br/>";
        echo $kegiatan['Kd_Urusan']."<br/>";
        echo $kegiatan['Kd_Bidang']."<br/>";
        echo $kegiatan['Kd_Prog']."<br/>";
        echo $kegiatan['Kd_Keg']."<br/>";
        echo $kegiatan['Kd_Unit']."<br/>";
        echo $kegiatan['Kd_Sub']."<br/>";
        echo $kegiatan['ID_Prog']."<br/>";
        echo $kegiatan['Ket_Kegiatan']."<br/>";
        echo $kegiatan['Lokasi']."<br/>";
        echo $kegiatan['Kelompok_Sasaran']."<br/>";
        echo $kegiatan['Status_Kegiatan']."<br/>";
        echo $kegiatan['Pagu_Anggaran']."<br/>";
        echo $kegiatan['Waktu_Pelaksanaan']."<br/>";
        echo $kegiatan['Kd_Sumber']."<br/>";
        echo $kegiatan['Status']."<br/>";
        echo $kegiatan['Keterangan']."<br/>";
        echo $kegiatan['Pagu_Anggaran_Nt1']."<br/>";
        echo $kegiatan['Verifikasi_Bappeda']."<br/>";
        echo $kegiatan['Tanggal_Verifikasi_Bappeda']."<br/>";
        echo $kegiatan['Keterangan_Verifikasi_Bappeda']."<br/>";
        echo $kegiatan['Kd_Urusan_Prov']."<br/>";
        echo $kegiatan['Kd_Bidang_Prov']."<br/>";
        echo $kegiatan['Kd_Unit_Prov']."<br/>";
        echo $kegiatan['Kd_Sub_Prov']."<br/>";
        echo "===============<br/>===============<br/>";
      }

      echo "<br/>----- belanja -----<br/>";
      foreach ($data_json['data']['Ta_Belanja_Prov'] as $belanja) {
        echo $belanja['Tahun']."<br/>";
        echo $belanja['Kd_Urusan']."<br/>";
        echo $belanja['Kd_Bidang']."<br/>";
        echo $belanja['Kd_Unit']."<br/>";
        echo $belanja['Kd_Sub']."<br/>";
        echo $belanja['Kd_Prog']."<br/>";
        echo $belanja['ID_Prog']."<br/>";
        echo $belanja['Kd_Keg']."<br/>";
        echo $belanja['Kd_Rek_1']."<br/>";
        echo $belanja['Kd_Rek_2']."<br/>";
        echo $belanja['Kd_Rek_3']."<br/>";
        echo $belanja['Kd_Rek_4']."<br/>";
        echo $belanja['Kd_Rek_5']."<br/>";
        echo $belanja['Kd_Ap_Pub']."<br/>";
        echo $belanja['Kd_Sumber']."<br/>";
        echo "===============<br/>===============<br/>===============<br/>";
      }

      echo "<br/>----- belanja rinc -----<br/>";
      foreach ($data_json['data']['Ta_Belanja_Rinc_Prov'] as $belanja_rinc) {
        echo $belanja_rinc['Tahun']."<br/>";
        echo $belanja_rinc['Kd_Urusan']."<br/>";
        echo $belanja_rinc['Kd_Bidang']."<br/>";
        echo $belanja_rinc['Kd_Unit']."<br/>";
        echo $belanja_rinc['Kd_Sub']."<br/>";
        echo $belanja_rinc['Kd_Prog']."<br/>";
        echo $belanja_rinc['ID_Prog']."<br/>";
        echo $belanja_rinc['Kd_Keg']."<br/>";
        echo $belanja_rinc['Kd_Rek_1']."<br/>";
        echo $belanja_rinc['Kd_Rek_2']."<br/>";
        echo $belanja_rinc['Kd_Rek_3']."<br/>";
        echo $belanja_rinc['Kd_Rek_4']."<br/>";
        echo $belanja_rinc['Kd_Rek_5']."<br/>";
        echo $belanja_rinc['No_Rinc']."<br/>";
        echo $belanja_rinc['Keterangan']."<br/>";
        echo $belanja_rinc['Kd_Sumber']."<br/>";
        echo "===============<br/>===============<br/>===============<br/>===============<br/>";
      }

      echo "<br/>----- belanja rinc sub -----<br/>";
      foreach ($data_json['data']['Ta_Belanja_Rinc_Sub_Prov'] as $rinc_sub) {
        echo $rinc_sub['Tahun']."<br/>";
        echo $rinc_sub['Kd_Urusan']."<br/>";
        echo $rinc_sub['Kd_Bidang']."<br/>";
        echo $rinc_sub['Kd_Unit']."<br/>";
        echo $rinc_sub['Kd_Sub']."<br/>";
        echo $rinc_sub['Kd_Prog']."<br/>";
        echo $rinc_sub['ID_Prog']."<br/>";
        echo $rinc_sub['Kd_Keg']."<br/>";
        echo $rinc_sub['Kd_Rek_1']."<br/>";
        echo $rinc_sub['Kd_Rek_2']."<br/>";
        echo $rinc_sub['Kd_Rek_3']."<br/>";
        echo $rinc_sub['Kd_Rek_4']."<br/>";
        echo $rinc_sub['Kd_Rek_5']."<br/>";
        echo $rinc_sub['No_Rinc']."<br/>";
        echo $rinc_sub['No_ID']."<br/>";
        echo $rinc_sub['Sat_1']."<br/>";
        echo $rinc_sub['Nilai_1']."<br/>";
        echo $rinc_sub['Sat_2']."<br/>";
        echo $rinc_sub['Nilai_2']."<br/>";
        echo $rinc_sub['Sat_3']."<br/>";
        echo $rinc_sub['Nilai_3']."<br/>";
        echo $rinc_sub['Satuan123']."<br/>";
        echo $rinc_sub['Jml_Satuan']."<br/>";
        echo $rinc_sub['Nilai_Rp']."<br/>";
        echo $rinc_sub['Total']."<br/>";
        echo $rinc_sub['Keterangan']."<br/>";
        echo $rinc_sub['Asal_Biaya']."<br/>";
        echo $rinc_sub['Uraian_Asal_Biaya']."<br/>";
        echo $rinc_sub['Ref_Usulan_Rincian']."<br/>";
        echo $rinc_sub['Uraian_Ref_Usulan']."<br/>";
        echo "===============<br/>===============<br/>===============<br/>===============<br/>===============<br/>";
      }
    }

    public function actionKirimProses2()
    {
      $request = Yii::$app->request;
      $data_kirim = $request->post('data_json');
      
      $data_json= Json::decode($data_kirim);

      $nama_provinsi = $data_json['info']['nama_provinsi'];
      $nama_kab = $data_json['info']['nama_kab'];
      $Kd_Prov = $data_json['info']['Kd_Prov'];
      $Kd_Kab = $data_json['info']['Kd_Kab'];

      foreach ($data_json['data']['Ta_Program_Prov'] as $program) {
        $Tahun=$program['Tahun'];
        $Kd_Urusan=$program['Kd_Urusan'];
        $Kd_Bidang=$program['Kd_Bidang'];
        $Kd_Unit=$program['Kd_Unit'];
        $Kd_Sub=$program['Kd_Sub'];
        $Kd_Prog=$program['Kd_Prog'];
        $ID_Prog=$program['ID_Prog'];
        $Ket_Prog=$program['Ket_Prog'];
        $Urusan=$program['Urusan'];
        $Bidang=$program['Bidang'];
        $Unit=$program['Unit'];
        $Sub=$program['Sub Unit'];
      }

      foreach ($data_json['data']['Ta_Kegiatan_Prov'] as $kegiatan) {
        $Tahun = $kegiatan['Tahun'];
        $Kd_Urusan = $kegiatan['Kd_Urusan'];
        $Kd_Bidang = $kegiatan['Kd_Bidang'];
        $Kd_Prog = $kegiatan['Kd_Prog'];
        $Kd_Keg = $kegiatan['Kd_Keg'];
        $Kd_Unit = $kegiatan['Kd_Unit'];
        $Kd_Sub = $kegiatan['Kd_Sub'];
        $ID_Prog = $kegiatan['ID_Prog'];
        $Ket_Kegiatan = $kegiatan['Ket_Kegiatan'];
        $Lokasi = $kegiatan['Lokasi'];
        $Kelompok_Sasaran = $kegiatan['Kelompok_Sasaran'];
        $Status_Kegiatan = $kegiatan['Status_Kegiatan'];
        $Pagu_Anggaran = $kegiatan['Pagu_Anggaran'];
        $Waktu_Pelaksanaan = $kegiatan['Waktu_Pelaksanaan'];
        $Kd_Sumber = $kegiatan['Kd_Sumber'];
        $Status = $kegiatan['Status'];
        $Keterangan = $kegiatan['Keterangan'];
        $Pagu_Anggaran_Nt1 = $kegiatan['Pagu_Anggaran_Nt1'];
        $Verifikasi_Bappeda = $kegiatan['Verifikasi_Bappeda'];
        $Tanggal_Verifikasi_Bappeda = $kegiatan['Tanggal_Verifikasi_Bappeda'];
        $Keterangan_Verifikasi_Bappeda = $kegiatan['Keterangan_Verifikasi_Bappeda'];
        $Kd_Urusan_Prov = $kegiatan['Kd_Urusan_Prov'];
        $Kd_Bidang_Prov = $kegiatan['Kd_Bidang_Prov'];
        $Kd_Unit_Prov = $kegiatan['Kd_Unit_Prov'];
        $Kd_Sub_Prov = $kegiatan['Kd_Sub_Prov'];
      }

      foreach ($data_json['data']['Ta_Belanja_Prov'] as $belanja) {
        $Tahun = $belanja['Tahun'];
        $Kd_Urusan = $belanja['Kd_Urusan'];
        $Kd_Bidang = $belanja['Kd_Bidang'];
        $Kd_Unit = $belanja['Kd_Unit'];
        $Kd_Sub = $belanja['Kd_Sub'];
        $Kd_Prog = $belanja['Kd_Prog'];
        $ID_Prog = $belanja['ID_Prog'];
        $Kd_Keg = $belanja['Kd_Keg'];
        $Kd_Rek_1 = $belanja['Kd_Rek_1'];
        $Kd_Rek_2 = $belanja['Kd_Rek_2'];
        $Kd_Rek_3 = $belanja['Kd_Rek_3'];
        $Kd_Rek_4 = $belanja['Kd_Rek_4'];
        $Kd_Rek_5 = $belanja['Kd_Rek_5'];
        $Kd_Ap_Pub = $belanja['Kd_Ap_Pub'];
        $Kd_Sumber = $belanja['Kd_Sumber'];
      }

      foreach ($data_json['data']['Ta_Belanja_Rinc_Prov'] as $belanja_rinc) {
        $Tahun = $belanja_rinc['Tahun'];
        $Kd_Urusan = $belanja_rinc['Kd_Urusan'];
        $Kd_Bidang = $belanja_rinc['Kd_Bidang'];
        $Kd_Unit = $belanja_rinc['Kd_Unit'];
        $Kd_Sub = $belanja_rinc['Kd_Sub'];
        $Kd_Prog = $belanja_rinc['Kd_Prog'];
        $ID_Prog = $belanja_rinc['ID_Prog'];
        $Kd_Keg = $belanja_rinc['Kd_Keg'];
        $Kd_Rek_1 = $belanja_rinc['Kd_Rek_1'];
        $Kd_Rek_2 = $belanja_rinc['Kd_Rek_2'];
        $Kd_Rek_3 = $belanja_rinc['Kd_Rek_3'];
        $Kd_Rek_4 = $belanja_rinc['Kd_Rek_4'];
        $Kd_Rek_5 = $belanja_rinc['Kd_Rek_5'];
        $No_Rinc = $belanja_rinc['No_Rinc'];
        $Keterangan = $belanja_rinc['Keterangan'];
        $Kd_Sumber = $belanja_rinc['Kd_Sumber'];
      }

      foreach ($data_json['data']['Ta_Belanja_Rinc_Sub_Prov'] as $rinc_sub) {
        $Tahun = $rinc_sub['Tahun'];
        $Kd_Urusan = $rinc_sub['Kd_Urusan'];
        $Kd_Bidang = $rinc_sub['Kd_Bidang'];
        $Kd_Unit = $rinc_sub['Kd_Unit'];
        $Kd_Sub = $rinc_sub['Kd_Sub'];
        $Kd_Prog = $rinc_sub['Kd_Prog'];
        $ID_Prog = $rinc_sub['ID_Prog'];
        $Kd_Keg = $rinc_sub['Kd_Keg'];
        $Kd_Rek_1 = $rinc_sub['Kd_Rek_1'];
        $Kd_Rek_2 = $rinc_sub['Kd_Rek_2'];
        $Kd_Rek_3 = $rinc_sub['Kd_Rek_3'];
        $Kd_Rek_4 = $rinc_sub['Kd_Rek_4'];
        $Kd_Rek_5 = $rinc_sub['Kd_Rek_5'];
        $No_Rinc = $rinc_sub['No_Rinc'];
        $No_ID = $rinc_sub['No_ID'];
        $Sat_1 = $rinc_sub['Sat_1'];
        $Nilai_1 = $rinc_sub['Nilai_1'];
        $Sat_2 = $rinc_sub['Sat_2'];
        $Nilai_2 = $rinc_sub['Nilai_2'];
        $Sat_3 = $rinc_sub['Sat_3'];
        $Nilai_3 = $rinc_sub['Nilai_3'];
        $Satuan123 = $rinc_sub['Satuan123'];
        $Jml_Satuan = $rinc_sub['Jml_Satuan'];
        $Nilai_Rp = $rinc_sub['Nilai_Rp'];
        $Total = $rinc_sub['Total'];
        $Keterangan = $rinc_sub['Keterangan'];
        $Asal_Biaya = $rinc_sub['Asal_Biaya'];
        $Uraian_Asal_Biaya = $rinc_sub['Uraian_Asal_Biaya'];
        $Ref_Usulan_Rincian = $rinc_sub['Ref_Usulan_Rincian'];
        $Uraian_Ref_Usulan = $rinc_sub['Uraian_Ref_Usulan'];
      }
    }

    public function actionDataVerifikasi()
    {
      $RefSubUnit = RefSubUnit::find()->all();
      return $this->render('hasil_rekap_pilih',[
          'RefSubUnit' => $RefSubUnit,
          'v' => '1',
      ]);
    }

}
