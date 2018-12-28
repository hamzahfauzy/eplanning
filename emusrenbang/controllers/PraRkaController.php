<?php

namespace emusrenbang\controllers;
use Yii;
use emusrenbang\models\TaPaguUnit;
use common\models\TaPaguSubUnit;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\search\TaProgramSearch;
use common\models\TaPaguProgram;
use common\models\TaKegiatan;
use common\models\TaKegiatanSearch;
use common\models\RefProgram;
use common\models\RefKegiatan;
use common\models\RefIndikator;
use common\models\Satuan;
use common\models\RefRek1;
use common\models\RefRek2;
use common\models\RefRek3;
use common\models\RefRek4;
use common\models\RefRek5;
use common\models\RefApPub;
use common\models\RefSumberDana;
use common\models\RefStandardSatuan;
use common\models\RefSubUnit;
use common\models\TaKegiatanRancanganAwal;
use emusrenbang\models\TaIndikator;
use emusrenbang\models\TaBelanja;
use emusrenbang\models\TaBelanjaRinc;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaPaguKegiatan;
use eperencanaan\models\TaMusrenbang;

//========riwayat=========//
use emusrenbang\models\TaKegiatanRiwayat;
use emusrenbang\models\TaBelanjaRiwayat;
use emusrenbang\models\TaBelanjaRincRiwayat;
use emusrenbang\models\TaBelanjaRincSubRiwayat;

use emusrenbang\models\Savelog;

use yii\helpers\ArrayHelper;


class PraRkaController extends \yii\web\Controller
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
        if($model->save(false)){
          echo "Tambah Kamus Berhasil";

          $log = new Savelog();
          $log->save('tambah kamus berhasil', 'tambah kamus', 'Ref_Kegiatan', ''); //pesan, kegiatan, tabel, id dari tabel
        }
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
        $data = TaBelanjaRinc::findOne($PosisiKegiatan);

        $data_belanja=TaBelanjaRincSub::find()
                ->where($PosisiKegiatan)
                ->all();
		$unitskpd = Yii::$app->levelcomponent->getUnit();
		$pagu = TaPaguUnit::find()
				->where(['Tahun'=>date('Y')+1,
				'Kd_Urusan' => $unitskpd->Kd_Urusan,
                'Kd_Bidang' => $unitskpd->Kd_Bidang,
                'Kd_Unit' => $unitskpd->Kd_Unit, ])
				->all();
				
		$nilai_pagu = ($pagu) ? $pagu[0]->pagu : 0;
        return $this->render('belanja_rinc_sub', [
                'data' => $data,
                'data_belanja' => $data_belanja,
				'pagu'=>$nilai_pagu,
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

        $model = new TaBelanjaRincSub();

        $max_id=TaBelanjaRincSub::find()
                ->where($PosisiKegiatan)
                ->max('No_ID');
        $No_ID = $max_id + 1;


        $Ref_Usulan_Rincian = 6;
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
      $model = new TaBelanjaRincSub();
      if($model->load($request->post())){
        //$model->Ket_Kegiatan;

        $PosisiKegiatan = [
              'Kd_Urusan' => $model->Kd_Urusan, 
              'Kd_Bidang' => $model->Kd_Bidang,
              'Kd_Unit' => $model->Kd_Unit,
              'Kd_Sub' => $model->Kd_Sub,
              'Kd_Prog' => $model->Kd_Prog,
              'Kd_Keg' => $model->Kd_Keg,
              'Kd_Rek_1' => $model->Kd_Rek_1,
              'Kd_Rek_2' => $model->Kd_Rek_2,
              'Kd_Rek_3' => $model->Kd_Rek_3,
              'Kd_Rek_4' => $model->Kd_Rek_4,
              'Kd_Rek_5' => $model->Kd_Rek_5,
              'No_Rinc' => $model->No_Rinc,
              ];
        $data = TaBelanjaRinc::findOne($PosisiKegiatan);
		
		$pagu_skpd = ($data->taPaguSubUnit->pagu) ? $data->taPaguSubUnit->pagu : 0;
        $pemakaian_skpd = $data->getJlhBelanjaRincSubUnits()->sum('Total');
        $total_biaya = $model->Total;
        $total_pakai = $pemakaian_skpd + $total_biaya;
		/*
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
		echo "<pre>";
		print_r($model);
		echo "</pre>";

		echo $total_pakai;
		*/
        if ($total_pakai > $pagu_skpd) {
          echo "Pagu Tidak Mencukupi";
        }
        else{
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model_riwayat = new TaBelanjaRincSubRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Tambah";
              $model_riwayat->save();
			  
			  $ta_musrenbang = TaMusrenbang::find()->where(["id"=>$request->post('id_musrenbang')])->one();
        if(count($ta_musrenbang)){
            $ta_musrenbang->Status_Penerimaan_Kota = 1;
            $ta_musrenbang->save(false);
            $model->ID_Prog = $request->post('id_musrenbang');
        }
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
      $model = TaBelanjaRincSub::findOne($Posisi);
      
      // if ($model->delete()) {
      //   return "Hapus Berhasil";
      // }
//$No_ID = $model->No_ID;
      $connection = \Yii::$app->db;
      $transaction = $connection->beginTransaction();
      try {
          $model_riwayat = new TaBelanjaRincSubRiwayat();
          $model_riwayat->attributes = $model->attributes;
          $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
          $model_riwayat->Keterangan_Riwayat="Hapus";
          $model_riwayat->save();
		// 
			$ta_musrenbang = TaMusrenbang::find()->where(["id"=>$model->ID_Prog])->one();
		 if(count($ta_musrenbang)){
			 //echo "hapus gagal...";
			$ta_musrenbang->Status_Penerimaan_Kota = 0;
			$ta_musrenbang->save(false);
		 }
          $model->delete(false);
          
          echo "Hapus Berhasil";
          $transaction->commit();
      } catch (\Exception $e) {
          $transaction->rollBack();
          throw $e;
      } catch (\Throwable $e) {
          $transaction->rollBack();
          throw $e;
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
      $model = TaBelanjaRincSub::findOne($Posisi);
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
      $model = TaBelanjaRincSub::findOne($Posisi);

      $total_pra = $model->Total;
      $request = Yii::$app->request;
      if($model->load($request->post())){
        $PosisiKegiatan = [
              'Kd_Urusan' => $model->Kd_Urusan, 
              'Kd_Bidang' => $model->Kd_Bidang,
              'Kd_Unit' => $model->Kd_Unit,
              'Kd_Sub' => $model->Kd_Sub,
              'Kd_Prog' => $model->Kd_Prog,
              'Kd_Keg' => $model->Kd_Keg,
              'Kd_Rek_1' => $model->Kd_Rek_1,
              'Kd_Rek_2' => $model->Kd_Rek_2,
              'Kd_Rek_3' => $model->Kd_Rek_3,
              'Kd_Rek_4' => $model->Kd_Rek_4,
              'Kd_Rek_5' => $model->Kd_Rek_5,
              'No_Rinc' => $model->No_Rinc,
              ];
        $data = TaBelanjaRinc::findOne($PosisiKegiatan);

        $pagu_skpd = $data->taPaguSubUnit->pagu;
        $pemakaian_skpd = $data->getJlhBelanjaRincSubUnits()->sum('Total')-$total_pra;
        $total_biaya = $model->Total;
        $total_pakai = $pemakaian_skpd + $total_biaya;

        if ($total_pakai > $pagu_skpd) {
          echo "Pagu Tidak Mencukupi";
        }
        else{


          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model_riwayat = new TaBelanjaRincSubRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Ubah";
              $model_riwayat->save();

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
        $data = TaBelanja::findOne($PosisiKegiatan);

        $data_belanja = TaBelanjaRinc::find()->where($PosisiKegiatan)->all();
        $jlh_pagu_terpakai = TaBelanjaRincSub::find()
                            ->where($PosisiKegiatan)
                            ->sum('Total');
        $jlh_objek_rincian = TaBelanjaRincSub::find()
                            ->where($PosisiKegiatan)
                            ->count();

        return $this->render('belanja_rinc', [
                'data' => $data,
                'data_belanja' => $data_belanja,
                'jlh_pagu_terpakai' => $jlh_pagu_terpakai,
                'jlh_objek_rincian' => $jlh_objek_rincian,
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

		
			
        $model = new TaBelanjaRinc();

        $max_id=TaBelanjaRinc::find()
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
      $model = new TaBelanjaRinc();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model_riwayat = new TaBelanjaRincRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Tambah";
              $model_riwayat->save();

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
      $model = TaBelanjaRinc::findOne($Posisi);
      
      // if ($model->delete()) {
      //   return "Hapus Berhasil";
      // }

      $connection = \Yii::$app->db;
      $transaction = $connection->beginTransaction();
      try {
          $model_riwayat = new TaBelanjaRincRiwayat();
          $model_riwayat->attributes = $model->attributes;
          $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
          $model_riwayat->Keterangan_Riwayat="Hapus";
          $model_riwayat->save();

          $model->delete(false);
          
          echo "Hapus Berhasil";
          $transaction->commit();
      } catch (\Exception $e) {
          $transaction->rollBack();
          throw $e;
      } catch (\Throwable $e) {
          $transaction->rollBack();
          throw $e;
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
      $model = TaBelanjaRinc::findOne($Posisi);
      
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
      $model = TaBelanjaRinc::findOne($Posisi);
      $request = Yii::$app->request;
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model_riwayat = new TaBelanjaRincRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Ubah";
              $model_riwayat->save();
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
        $data = TaKegiatan::findOne($PosisiKegiatan);

        $data_belanja = TaBelanja::find()->where($PosisiKegiatan)->all();
        $jlh_pagu_terpakai = TaBelanjaRincSub::find()
                            ->where($PosisiKegiatan)
                            ->sum('Total');

        return $this->render('belanja', [
                'data' => $data,
                'data_belanja' => $data_belanja,
                'jlh_pagu_terpakai' => $jlh_pagu_terpakai,
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

        $model = new TaBelanja();

        $Data_Rek_1 = RefRek1::findOne(['Kd_Rek_1'=>5]);
        $Data_Rek_2 = RefRek2::findOne(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2]);
        $Data_Rek_3 = ArrayHelper::map(RefRek3::find()->where(['Kd_Rek_1'=>5, 'Kd_Rek_2'=>2])->all(), 
                                        'Kd_Rek_3',
                                        function($model, $defaultValue) {
                                          return $model->Kd_Rek_3.". ".$model->Nm_Rek_3;
                                        }
        );  
        $Data_Rek_4 = [];
        $Data_Rek_5 = [];


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
        ]);
    }

    public function actionTambahRincianProses()
    {
      $request = Yii::$app->request;
      $model = new TaBelanja();
      if($model->load($request->post())){
          //$model->Ket_Kegiatan;
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $model_riwayat = new TaBelanjaRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Tambah";
              $model_riwayat->save();

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
      $model = TaBelanja::findOne($Posisi);
      
      // if ($model->delete()) {
      //   return "Hapus Berhasil";
      // }

      $connection = \Yii::$app->db;
      $transaction = $connection->beginTransaction();
      try {
          $model_riwayat = new TaBelanjaRiwayat();
          $model_riwayat->attributes = $model->attributes;
          $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
          $model_riwayat->Keterangan_Riwayat="Hapus";
          $model_riwayat->save();

          $model->delete(false);
          
          echo "Hapus Berhasil";
          $transaction->commit();
      } catch (\Exception $e) {
          $transaction->rollBack();
          throw $e;
      } catch (\Throwable $e) {
          $transaction->rollBack();
          throw $e;
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

        $model = TaBelanja::findOne($Posisi);

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
              $model_riwayat = new TaBelanjaRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
              $model_riwayat->Keterangan_Riwayat="Ubah";
              $model_riwayat->save();

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

			
		    $kegiatanranwal = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$Tahun ,'Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])->all();
		    $status = count($kegiatanranwal);
        $searchModel = new TaKegiatanSearch();
        $dataProvider = $searchModel->searchKegiatan($PosisiKegiatan);
        $modelUnit = TaProgram::findOne($PosisiKegiatan);

        $jlh_pagu_terpakai = TaBelanjaRincSub::find()
                            ->where($PosisiKegiatan)
                            ->sum('Total');

        return $this->render('kegiatan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data' => $modelUnit,
                    'jlh_pagu_terpakai' => $jlh_pagu_terpakai,
					          'status'=>$status
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
		/*if ($Kd_Urusan==4 && $Kd_Bidang ==1 && $Kd_Unit==3) { //Khusus Untuk Sekretariat Daerah
        $Posisi_ref = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
			
			//'Kd_Unit' => $Kd_Unit,
		//	'Kd_Sub_Unit' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
        ];
		}
		else
		{*/
			$Posisi_ref = [
            'Kd_Urusan' => $Kd_Urusan, 
            'Kd_Bidang' => $Kd_Bidang,
			
			'Kd_Unit' => $Kd_Unit,
			'Kd_Sub_Unit' => $Kd_Sub, 
            'Kd_Prog' => $Kd_Prog,
        ];
		
        $model = new TaKegiatan();

        $max_id=TaKegiatan::find()
                ->where($PosisiKegiatan)
                ->max('ID_Prog');
        $ID_Prog = $max_id + 1;

        $max_kd=TaKegiatan::find()
                ->where($PosisiKegiatan)
                ->max('Kd_Keg');
        $Kd_Keg = $max_kd + 1;

        //============//
        $indikator=RefIndikator::find()
                      ->where(['In', 'Kd_Indikator', [2,3,4,7]])
                      ->all();

        //============//
        //$satuan=satuan::find()->all();
        // $satuan =  ArrayHelper::map(Satuan::find()->all(),'id','satuan');
	//	$tahun_ranwal =  ArrayHelper::map(TaKegiatan::find()->all(),'Tahun');
		
		$satuan =  ArrayHelper::map(RefStandardSatuan::find()->all(),'Kd_Satuan','Uraian');
		
        //============//
        $sumber_dana = ArrayHelper::map(RefSumberdana::find()->all(), 'Kd_Sumber', 'Nm_Sumber');

        //============//
        //$ref_kegiatan =  ArrayHelper::map(RefKegiatan::find()->where($Posisi_ref)->all(),'Ket_Kegiatan','Ket_Kegiatan');
        
		$ref_kegiatan = [];
        $dat_kegiatan = RefKegiatan::find()->where($Posisi_ref)->all();
		
		//Ditambah Ripin G
	//		print_r (date("Y"));
           
		$tahun_ranwal=date("Y"); //Jika Pengisian Data Ranwal Tahun 2017 maka perintah dibawah sudah tepat, jika tahun 2018 maka seluruh tahun harus ditambah 1
		if ($tahun_ranwal==2014) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target0."|".$value->Target1."|".$value->Pagu_Indikatif."|".$value->Tahun_Pertama] = $value->Ket_Kegiatan;
			}
		}
		else;
		if ($tahun_ranwal==2015) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target1."|".$value->Target2."|".$value->Tahun_Pertama."|".$value->Tahun_Kedua] = $value->Ket_Kegiatan;
			}
		}	
		else;
		if ($tahun_ranwal==2016) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target2."|".$value->Target3."|".$value->Tahun_Kedua."|".$value->Tahun_Ketiga] = $value->Ket_Kegiatan;
			}
		}
		else; //existing 
		if ($tahun_ranwal==2018) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target3."|".$value->Target4."|".$value->Tahun_Ketiga."|".$value->Tahun_Keempat] = $value->Ket_Kegiatan; 
			}
		} 
		else;
		if ($tahun_ranwal==2019) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target4."|".$value->Target5."|".$value->Tahun_Keempat."|".$value->Tahun_Kelima] = $value->Ket_Kegiatan;
			}
		}
		else;
		if ($tahun_ranwal==2020) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target4."|".$value->Target5."|".$value->Tahun_Keempat."|".$value->Tahun_Kelima] = $value->Ket_Kegiatan;
			}
		}
		else;
		if ($tahun_ranwal==2021) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target4."|".$value->Target5."|".$value->Tahun_Keempat."|".$value->Tahun_Kelima] = $value->Ket_Kegiatan;
			}
		}
		else;
		if ($tahun_ranwal==2021) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target4."|".$value->Target5."|".$value->Tahun_Keempat."|".$value->Tahun_Kelima] = $value->Ket_Kegiatan;
			}
		}
		else;
		if ($tahun_ranwal==2022) {
			foreach ($dat_kegiatan as $key => $value) {
				$ref_kegiatan[$value->Kd_Keg."|".$value->Ket_Kegiatan."|".$value->Indikator."|".$value->Satuan0."|".$value->Target4."|".$value->Target5."|".$value->Tahun_Keempat."|".$value->Tahun_Kelima] = $value->Ket_Kegiatan;
			}
		}
		// $ref_pagu_indikatif = [];
        // $dat_pagu_indikatif = RefKegiatan::find()->where($Posisi_ref)->all();
        // foreach ($dat_pagu_indikatif as $value) {
          // $ref_pagu_indikatif[$value->Kd_Keg] = $value->Pagu_Indikatif;
        // }
		


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
				//'ref_satuan' => $ref_satuan,
				//'ref_pagu_indikatif' => $ref_pagu_indikatif
                //'models' => $model2,
        ]);
    }

    public function actionTambahKegiatanProses()
    {
		$Tahun = 2019;
	  $request = Yii::$app->request;
      $model = new TaKegiatan();
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
			  
              //simpan ke riwayat
              $model_riwayat = new TaKegiatanRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=$Tahun.date('-m-d');
              $model_riwayat->Keterangan_Riwayat="Tambah";
              $model_riwayat->save(false);
			  

			  //pagu
              $model_pagu = new TaPaguKegiatan();
              $model_pagu->Tahun=$Tahun;
              $model_pagu->Kd_Keg=$model->Kd_Keg;
              $model_pagu->Kd_Urusan=$model->Kd_Urusan;
              $model_pagu->Kd_Bidang=$model->Kd_Bidang;
              $model_pagu->Kd_Unit=$model->Kd_Unit;
              $model_pagu->Kd_Sub=$model->Kd_Sub;
              $model_pagu->Kd_Prog=$model->Kd_Prog;
              $model_pagu->pagu=$model->Pagu_Anggaran;

              $model_pagu->save(false);
              
              
              $tolak_ukur = $request->post('tolak_ukur');
              $target = $request->post('target');
              $target_satuan = $request->post('target_satuan');
			  
			  /*
              $max_indi=TaIndikator::find()
                        ->where([
                            'Kd_Urusan' => $model->Kd_Urusan, 
                            'Kd_Bidang' => $model->Kd_Bidang,
                            'Kd_Unit' => $model->Kd_Unit,
                            'Kd_Sub' => $model->Kd_Sub,
                            'Kd_Prog' => $model->Kd_Prog,
                            'Kd_Keg' => $model->Kd_Keg,
                          ])
                        ->max('Kd_Indikator');
			  
			  $Kd_Indikator = $max_indi + 1; 
              */
			  $arr = [2,3,4,7];
			  $n = 0;
			  
              foreach ($tolak_ukur as $val) {
                $model_indikator = new TaIndikator();

                $model_indikator->Tahun = $Tahun;
                $model_indikator->Kd_Urusan = $model->Kd_Urusan;
                $model_indikator->Kd_Bidang = $model->Kd_Bidang;
                $model_indikator->Kd_Unit = $model->Kd_Unit;
                $model_indikator->Kd_Sub = $model->Kd_Sub;
                $model_indikator->Kd_Prog = $model->Kd_Prog;
                $model_indikator->ID_Prog = $model->ID_Prog;
                $model_indikator->Kd_Keg = $model->Kd_Keg;
                $model_indikator->Kd_Indikator = $arr[$n];
                //$model_indikator->Kd_Indikator = $Kd_Indikator;
                $model_indikator->No_ID = 0;
                $model_indikator->Tolak_Ukur= $val;
                $model_indikator->Target_Angka=str_replace('.', '', $target[$arr[$n]]);
                $model_indikator->Target_Uraian=str_replace('.', '', $target_satuan[$arr[$n]]);
				
				
                $model_indikator->save(false);
				$n++;
                //$Kd_Indikator++;
              }
			  
              
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
			'Kd_Unit' => $Kd_Unit,
			'Kd_Sub_Unit' => $Kd_Sub,
            'Kd_Prog' => $Kd_Prog,
        ];

        $model = TaKegiatan::findOne($PosisiKegiatan);

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

        $indikator_data=$model->getIndikator()->all();
        $indikator=RefIndikator::find()
                    ->where(['In', 'Kd_Indikator', [2,3,4,7]])
                    ->all();
        //============//
        //$satuan=satuan::find()->all();
       // $satuan =  ArrayHelper::map(Satuan::find()->all(),'id','satuan'); //diganti dengan perintah dibawha
	    $satuan =  ArrayHelper::map(RefStandardSatuan::find()->all(),'Kd_Satuan','Uraian');

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

        $model_indikator = TaIndikator::findall($PosisiKegiatan);
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

      $model = TaKegiatan::findone($Posisi);

      if($model->load($request->post())){
          $connection = \Yii::$app->db;
          $transaction = $connection->beginTransaction();
          try {
              $waktu_pelaksanaan_nilai = $request->post('waktu_pelaksanaan_nilai');
              $waktu_pelaksanaan_satuan = $request->post('waktu_pelaksanaan_satuan');
              $model->Waktu_Pelaksanaan = $waktu_pelaksanaan_nilai." ".$waktu_pelaksanaan_satuan;
              $model->Status = 0;
			  $pagu = $model->Pagu_Anggaran;
			  $dat_kegiatan = explode("|", $model->Ket_Kegiatan);
              $model->Kd_Keg = $dat_kegiatan[0];
              $model->Ket_Kegiatan = $dat_kegiatan[1];
              $model->save(false);
			  //no error
			  
			  //simpan ke riwayat
              $model_riwayat = new TaKegiatanRiwayat();
              $model_riwayat->attributes = $model->attributes;
              $model_riwayat->Tanggal_Riwayat=$Tahun.date('-m-d');
              $model_riwayat->Keterangan_Riwayat="Ubah";
              $model_riwayat->save(false);
			  //no error
			  
			  
			  $model_pagu = TaPaguKegiatan::findOne($Posisi);
              $model_pagu->pagu=$pagu;
              $model_pagu->save(false);
			  
			  $tolak_ukur = $request->post('tolak_ukur');
              $target = $request->post('target');
              $target_satuan = $request->post('target_satuan');
			  //no error
			  
			  TaIndikator::deleteAll($Posisi);
			  foreach ($tolak_ukur as $key => $toluk) {
                $model_indikator = new TaIndikator();

                $model_indikator->Tahun = $Tahun;
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

              echo "Edit Kegiatan Berhasil";
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
      $model = TaKegiatan::findOne($Posisi);
      $model2 = TaPaguKegiatan::findOne($Posisi);
      //$model3 = TaIndikator::findOne($Posisi);
      
      $connection = \Yii::$app->db;
      $transaction = $connection->beginTransaction();
      try {
          $model_riwayat = new TaKegiatanRiwayat();
          $model_riwayat->attributes = $model->attributes;
          $model_riwayat->Tanggal_Riwayat=date('Y-m-d');
          $model_riwayat->Keterangan_Riwayat="Hapus";
          $model_riwayat->save(false);

          TaIndikator::deleteall($Posisi);
          $model->delete();
          $model2->delete();
          
          echo "Hapus Berhasil";
          $transaction->commit();
      } catch (\Exception $e) {
          $transaction->rollBack();
          throw $e;
      } catch (\Throwable $e) {
          $transaction->rollBack();
          throw $e;
      }
    }

    //===========================//
    public function actionProgram()
    {

        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

        $searchModel = new TaProgramSearch();
        $dataProvider = $searchModel->searchProgram2(Yii::$app->request->queryParams);
        $modelUnit = TaSubUnit::find()->where($PosisiUnit)->all();
		//$modelUnit = TaSubUnit::find()->all();
		
		//$data = TaSubUnit::findone($PosisiUnit);
        //$data = RefSubUnit::findone($PosisiUnit);
		$unitskpd = Yii::$app->levelcomponent->getUnit();
		$data = TaSubUnit::find()->where(['Tahun'=>date('Y'),
						    'Kd_Urusan' => $unitskpd->Kd_Urusan,
                            'Kd_Bidang' => $unitskpd->Kd_Bidang,
                            'Kd_Unit' => $unitskpd->Kd_Unit, ])
							->one();
		
		$pagu = TaPaguUnit::find()
							->where(['Tahun'=>date('Y'),
						    'Kd_Urusan' => $unitskpd->Kd_Urusan,
                            'Kd_Bidang' => $unitskpd->Kd_Bidang,
                            'Kd_Unit' => $unitskpd->Kd_Unit, ])
							->all();

		
        $tabelanjanrincsub = TaBelanjaRincSub::find()
							  ->where($PosisiUnit)
							  ->sum('Total');

        $modelLevel = $PosisiUnit;

        return $this->render('program', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'modelLevel' => $modelLevel,
                    'modelUnit' => $modelUnit,
                    'data' => $data,
					'pagu' => $pagu,
                    'tabelanjanrincsub' => $tabelanjanrincsub,
					'baru' => $data
        ]);
    }

    public function actionPaguProgram()
    {

        $unitskpd = Yii::$app->levelcomponent->getUnit();
        $data = TaPaguSubUnit::find()
                        ->where([
                            'Tahun' => date("Y")+1,
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

    public function actionRincian()
    {
        return $this->render('rincian', ['cinta' => []]);
    }

}
