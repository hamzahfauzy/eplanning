<?php

namespace eperencanaan\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\RefLingkungan;
use common\models\RefRPJMD;
use common\models\RefBidangPembangunan;
use common\models\RefStandardSatuan;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkunganRiwayat;

class MusrenbangSkpdVerifikasiUsulanKecamatanController extends \yii\web\Controller {

    //where provinsi sampai kelurahan
    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec'],
            'Kd_Kel' => $kelompok['Kd_Kel'],
            'Kd_Urut_Kel' => $kelompok['Kd_Urut_Kel']
        ];
        return $pos;
    }

    //where provinsi sampai kelurahan
    public function PosisiLingkungan() {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec'],
            'Kd_Kel' => $kelompok['Kd_Kel'],
            'Kd_Urut_Kel' => $kelompok['Kd_Urut_Kel'],
            'Kd_Lingkungan' => $kelompok['Kd_Lingkungan'],
        ];
        return $pos;
    }

    //where provinsi sampai kecamatan
    public function PosisiKecamatan() {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec']
        ];
        return $pos;
    }

    public function Kd_User() {
        $user = Yii::$app->user->identity->id;
        return $user;
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionUsulanLingkungan() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan
        $ZULstatus = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne($posisi)
                ->Status_Pembahasan_Usulan;
                
        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan

        $rpjmd = RefRPJMD::find()
                ->all(); //mengambil data Ref_RPJMD
        $model = new \yii\base\DynamicModel([
        'keterangan', 'Kd_Prioritas_Daerah'
         ]);
        $bidpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()
            ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $model->addRule(['keterangan', 'Kd_Prioritas_Daerah'], 'required')
        ->addRule(['keterangan','Kd_Prioritas_Daerah'],'string',['max'=>256]);
        $bidangpembangunan = ArrayHelper::map(RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota',
                'Nm_Prioritas_Pembangunan_Kota');

        return $this->render('usulan_lingkungan', [
                    'lingkungan' => $lingkungan,
                    'rpjmd' => $rpjmd,
                    'bidangpembangunan' => $bidangpembangunan,
                    'ZULstatus' => $ZULstatus,
                    'keterangan' => $model,
                    'bidpem' => $bidpem 
        ]);
    }

    public function actionGetUsulan($Kd_Lingkungan) {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $data = TaForumLingkungan::find()
                ->where($posisi)
                ->andWhere(['Kd_Lingkungan' => $Kd_Lingkungan])
                ->andWhere(['Status_Pembahasan' => '0'])
                ->all(); //mengambil usulan dari lingkungan tertentu

        return $this->renderpartial('get_usulan_lingkungan', [
                    'data' => $data,
        ]);
    }

    public function actionGetVerifikasi($Kd_Lingkungan, $status) {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $data = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($posisi)
                ->andWhere(['Kd_Lingkungan' => $Kd_Lingkungan]);

        if ($status == 'tolak') {
            $data->andWhere(['Status_Penerimaan' => 3]);
        }

        if ($status == 'terima') {
            $data->andWhere(['in', 'Status_Penerimaan', [1, 2]]);
            //$data->andWhere(['Status_Penerimaan' => 1]);
        }

        if ($status == 'revisi') {
            $data->andWhere(['in', 'Status_Revisi', ['1', '2']]);
        }

        $isi = $data->all(); //mengambil usulan dari lingkungan tertentu

        if ($status == 'revisi') {
            return $this->renderpartial('get_usulan_verifikasi_revisi', [
                        'data' => $isi,
            ]);
        } else {
            return $this->renderpartial('get_usulan_verifikasi', [
                        'data' => $isi,
            ]);
        }
    }

    //aksi untuk menerima usulan

    public function actionProsesTerimaUsulan($Kd_Ta_Forum_Lingkungan, $Kd_Prioritas_Pembangunan_Daerah, $Keterangan)
    {
      $models = new TaKelurahanVerifikasiUsulanLingkungan; //membuat usulan baru di TaKelurahanVerifikasiUsulanLingkungan  
	  
      $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
            ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
            ->one();
	  
		
      foreach($usulan as $key=>$data){
        if($key!='Status_Pembahasan')
        $models->$key=$data;
      }
	  
	  
      //$models->Status_Survey = $usulan->Status_Survey;
      $models->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = '';
      $models->Kd_Prioritas_Pembangunan_Daerah = $Kd_Prioritas_Pembangunan_Daerah;
      $models->Status_Penerimaan = 1;
      $models->Asal_Usulan = '1';
      $models->Status_Revisi = '0';
      $models->Keterangan = $Keterangan;
      $models->Status_Pengelompokan = '0';
      $models->Kd_User = $this->Kd_User();

      //ubah status usulan di ta forum lingkungan
      $usulan->Status_Pembahasan = '1';
	  
	  
	  if ($models->save() && $usulan->save()) {
        echo 'Berhasil';
      }
      else{
        echo 'Gagal';
      }
	  /*
      foreach($models->getAttributes() as $key => $values){
		  echo $key.",";
	  }
		
	  echo "<pre>";
	  print_r($models);
	  //print_r($models->getErrors());
	  echo "</pre>";
	  
	  echo "<pre>";
	  print_r($usulan);
	  //print_r($models->getErrors());
	  echo "</pre>";*/
	  

    }

    public function actionProsesTerimaUsulan2($Kd_Ta_Forum_Lingkungan, $Kd_Prioritas_Pembangunan_Daerah, $Keterangan)
    {
      $models = TaKelurahanVerifikasiUsulanLingkungan::find() //mengambil usulan dari lingkungan tertentu
            ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
            ->one();

      $models->Status_Penerimaan = 1;
      $models->Keterangan = $Keterangan;
      
      if ($models->save() ) {
        echo 'Berhasil';
      }
      else{
        echo 'Gagal';
      }
    }

    //aksi untuk menerima usulan
    public function actionProsesRevisiUsulan($Kd_Ta_Forum_Lingkungan, $Kd_Prioritas_Pembangunan_Daerah, $Keterangan, $Jumlah, $Satuan, $Harga, $Total, $Kd_Pem) {
        $models = new TaKelurahanVerifikasiUsulanLingkungan(); //membuat usulan baru di TaKelurahanVerifikasiUsulanLingkungan

        $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();
        foreach ($usulan as $key => $data) {
            if ($key != 'Status_Pembahasan')
                $models->$key = $data;
        }
        //
        //$models->Status_Survey = $usulan->Status_Survey;
        $models->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = '';
        $models->Kd_Prioritas_Pembangunan_Daerah = $Kd_Prioritas_Pembangunan_Daerah;
        $models->Status_Penerimaan = 2; //belum di tentukan atau harus direvisi
        $models->Asal_Usulan = '1';
        $models->Status_Revisi = '1'; //1 harus di cek lingkungan, 2 di cek kelurahan,0 selesai
        $models->Keterangan = $Keterangan;
        $models->Status_Pengelompokan = '0';
        $models->Kd_User = $this->Kd_User();

        $models->Jumlah = $Jumlah;
        $models->Kd_Satuan = $Satuan;
        $models->Harga_Satuan = $Harga;
        $models->Harga_Total = $Total;
        $models->Kd_Pem = $Kd_Pem;

        //ubah status usulan di ta forum lingkungan
        $usulan->Status_Pembahasan = '1';

        if ($models->save() && $usulan->save()) {
            echo 'Berhasil';
        } else {
            echo 'Gagal';
        }
    }

    //aksi untuk menerima usulan
    public function actionProsesTolakUsulan($Kd_Ta_Forum_Lingkungan, $Kd_Prioritas_Pembangunan_Daerah, $Keterangan)
    {
      $models = new TaKelurahanVerifikasiUsulanLingkungan(); //membuat usulan baru di TaKelurahanVerifikasiUsulanLingkungan

      $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
            ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
            ->one();
      foreach($usulan as $key=>$data){
        if($key!='Status_Pembahasan')
        $models->$key=$data;
      }
      //$models->Status_Survey = $usulan->Status_Survey;
      $models->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = '';
      $models->Kd_Prioritas_Pembangunan_Daerah = $Kd_Prioritas_Pembangunan_Daerah;
      $models->Status_Penerimaan = 3;
      $models->Asal_Usulan = '1';
      $models->Status_Revisi = '0';
      $models->Keterangan = $Keterangan;
      $models->Status_Pengelompokan = '0';
      $models->Kd_User = $this->Kd_User();

      //ubah status usulan di ta forum lingkungan
      $usulan->Status_Pembahasan = '1';
      
      if ($models->save() && $usulan->save()) {
        echo 'Berhasil';
      }
      else{
        echo 'Gagal';
      }

    }//aksi untuk menerima usulan

    public function actionProsesTolakUsulan2($Kd_Ta_Forum_Lingkungan, $Keterangan)
    {
      $models = TaKelurahanVerifikasiUsulanLingkungan::find() //mengambil usulan dari lingkungan tertentu
            ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
            ->one();

      $models->Status_Penerimaan = 3;
      $models->Keterangan = $Keterangan;
      
      if ($models->save() ) {
        echo 'Berhasil';
      }
      else{
        echo 'Gagal';
      }

    }

    public function actionUsulanRevisi() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan

        $rpjmd = RefRPJMD::find()
                ->all(); //mengambil data Ref_RPJMD

        return $this->render('usulan_revisi', [
                    'lingkungan' => $lingkungan,
                    'rpjmd' => $rpjmd,
        ]);
    }

    public function actionUsulanRevisiLingkungan() {
        $posisi = $this->PosisiLingkungan(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $data = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($posisi)
                ->andWhere(['Status_Revisi' => '1']);

        $isi = $data->all(); //mengambil usulan dari lingkungan tertentu

        return $this->render('usulan_revisi_lingkungan', [
                    'data' => $isi,
        ]);
    }

    public function actionUsulanTolak() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan
        $ZULstatus = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne($posisi)
                ->Status_Pembahasan_Usulan;
                
        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan
        return $this->render('usulan_tolak', [
                    'lingkungan' => $lingkungan,
                    'ZULstatus' => $ZULstatus
        ]);
    }

    public function actionUsulanTerima() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan
        $ZULstatus = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne($posisi)
                ->Status_Pembahasan_Usulan;
                
        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan
        return $this->render('usulan_terima', [
                    'lingkungan' => $lingkungan,
                    'ZULstatus' => $ZULstatus
        ]);
    }

    public function actionRevisi($Kd_Ta_Forum_Lingkungan) {
        $model = TaKelurahanVerifikasiUsulanLingkungan::findOne(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan]);
        if ($model == null)
            return $this->redirect(['ta-kelurahan-verifikasi-usulan-lingkungan/revisi-langsung', 'Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan]);
        $bidangpembangunan = ArrayHelper::map(RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $satuan = ArrayHelper::map(RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');

        if (Yii::$app->request->isPost) {
            //print_r(Yii::$app->request->post());exit;
            $model->load(Yii::$app->request->post());
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Status_Penerimaan = '2';
            $model->Status_Revisi = '1'; //di oper ke cek kelurahan
            if ($model->save(false)) {
                echo "Berhasil revisi usulan";
            } else {
                echo 'gagal query';
            }
        } else {
            
            return $this->renderAjax('revisi_form_ajax', [
                        'model' => $model,
                        'bidangpembangunan' => $bidangpembangunan,
                        'satuan' => $satuan
            ]);
        }
    }

    public function actionProsesTerimaUsulanVerifikasi($Kd_Ta_Musrenbang_Kelurahan_Verifikasi, $Kd_Prioritas_Pembangunan_Daerah, $Keterangan) {
        $models = TaKelurahanVerifikasiUsulanLingkungan::findOne(['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $Kd_Ta_Musrenbang_Kelurahan_Verifikasi]);
        $models->Kd_Prioritas_Pembangunan_Daerah = $Kd_Prioritas_Pembangunan_Daerah;
        $models->Status_Penerimaan = 2;
        $models->Status_Revisi = '0';
        $models->Kd_User = $this->Kd_User();
        if ($models->save()) {
            echo 'Berhasil';
        }
    }

    public function actionProsesRevisiUsulanVerifikasi($Kd_Ta_Musrenbang_Kelurahan_Verifikasi, $Keterangan) {
        $models = TaKelurahanVerifikasiUsulanLingkungan::findOne(['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $Kd_Ta_Musrenbang_Kelurahan_Verifikasi]);
        $models->Status_Revisi = '1';
        $models->Keterangan = $Keterangan;
        $models->Kd_User = $this->Kd_User();
        if ($models->save()) {
            echo 'Berhasil';
        }
    }

    public function actionTambahUsulan() {
        return $this->render('tambah_usulan', [
                    ''
        ]);
    }

    public function actionUsulKecamatan() {
        return $this->render('tambah_usulan', [
                    ''
        ]);
    }

    public function actionRevisiLangsung($Kd_Ta_Forum_Lingkungan) {
        $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();
        
        $bidangpembangunan = ArrayHelper::map(RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $satuan = ArrayHelper::map(RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        //$models->Status_Survey = $usulan->Status_Survey;
        if (Yii::$app->request->isPost) {
            //print_r(Yii::$app->request->post());exit;
            $usulan->load(Yii::$app->request->post());
           
            $models = new TaKelurahanVerifikasiUsulanLingkungan();
            $models->attributes = $usulan->attributes;
            $models->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = '';
            $models->Kd_Prioritas_Pembangunan_Daerah = 0;
            $models->Status_Penerimaan = 2; //belum di tentukan atau harus direvisi
            $models->Asal_Usulan = '1';
            $models->Status_Revisi = '1'; //1 harus di cek lingkungan, 2 di cek kelurahan,0 selesai
            $models->Keterangan = '';
            $models->Status_Pengelompokan = '0';
            $models->Kd_User = Yii::$app->user->identity->id;
            $models->Jumlah = str_replace(".", "", $models->Jumlah);
            $models->Harga_Satuan = str_replace(".", "", $models->Harga_Satuan);
            $models->Harga_Total = str_replace(".", "", $models->Harga_Total);

            //ubah status usulan di ta forum lingkungan
            $usulan->Status_Pembahasan = '1';
            //print_r($usulan);print_r($models);exit;
            $usulan->save(false);
            
            $models->save(false);
            
            echo "Berhasil revisi usulan!";exit;
            
//return $this->redirect(['usulan-lingkungan']);
        }
        else{
            
            //print_r($usulan);
            
        }
        return $this->renderAjax('revisi_form_ajax_langsung', [
                    'model' => $usulan,
                    'bidangpembangunan' => $bidangpembangunan,
                    'satuan' => $satuan,
                    'keterangan' => $model
        ]);
    }

    public function actionLihatUsulanLingkungan() {
        $PosisiLingkungan = $this->PosisiLingkungan(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $usulan = TaForumLingkungan::find()
                ->where($PosisiLingkungan)
                ->all(); //mengambil usulan dari lingkungan tertentu

        $terima = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($PosisiLingkungan)
                ->andWhere(['in', 'Status_Penerimaan', [1,2]])
                ->all();

        $tolak = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($PosisiLingkungan)
                ->andWhere(['in', 'Status_Penerimaan', [3]])
                ->all();

        return $this->render('lihat_usulan_lingkungan', [
                        'usulan' => $usulan,
                        'terima' => $terima,
                        'tolak' => $tolak,
        ]);
    }

    public function actionJumlahUsulan() {
        $Posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $usulan = TaForumLingkungan::find()
                ->where($Posisi)
                ->andWhere(['Status_Pembahasan' => '0'])
                ->count(); //mengambil usulan dari lingkungan tertentu
        
        $terima = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($Posisi)
                ->andWhere(['in', 'Status_Penerimaan', [1,2]])
                ->count();

        $tolak = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($Posisi)
                ->andWhere(['in', 'Status_Penerimaan', [3]])
                ->count();
        

        return $this->renderpartial('jumlah_usulan', [
                    'usulan' => $usulan,
                    'tolak' => $tolak,
                    'terima' => $terima,
        ]);
    }
    
    public function actionKeteranganLangsung($Kd_Ta_Forum_Lingkungan) {
        $usulan = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();
        if ($usulan == null){
            $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();
        }
        return $this->renderAjax('keterangan_ajax', ['model' => $usulan]);
    }

   public function actionLihatriwayat($kode2) {
        $NASRiwayat = TaKelurahanVerifikasiUsulanLingkunganRiwayat::find()
                        ->where([
                                'Kd_Ta_Forum_Lingkungan' => $kode2,
                            ])
                        ->all();
        print_r($NASRiwayat);      
        return $this->renderPartial('modal_lihat_riwayat', [
                    'data_riwayat' => $NASRiwayat,
                        //'cek_usulan' =>$NASUsulan
        ]);
    }

    public function actionLihatdokumen($kode) {
        $PC_Dokumen = TaForumLingkunganMedia::find()
                ->where([
                    'Kd_Ta_Forum_Lingkungan' => $kode,
                ])
                ->all();


        return $this->renderPartial('modal_lihat_dokumen', [
                                        'data_dokumen' => $PC_Dokumen
                                    ]);

    } 

    //perbaikan full di terima dkk
    public function actionModalDiterima($Kd_Ta_Forum_Lingkungan) {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();

				
		$rpjmd = RefRPJMD::find()
                ->all();
				
		/*		
        $rpjmd = RefRPJMD::find()
                ->where([ 'Tahun'=>$Tahun, 'Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab ])
                ->all(); //mengambil data Ref_RPJMD*/
                
        return $this->renderpartial('modal_usulan_terima', [
                    'Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan,
                    'usulan' => $usulan,
                    'rpjmd' => $rpjmd,
        ]);
    }

    //perbaikan full di terima dkk
    public function actionModalDirevisi($Kd_Ta_Forum_Lingkungan) {
        $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();

        $rpjmd = RefRPJMD::find()
                ->all(); //mengambil data Ref_RPJMD

        $satuan = RefStandardSatuan::find()->orderBy('Uraian')->all();


        $bidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
                
        return $this->renderpartial('modal_usulan_revisi', [
                    'Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan,
                    'usulan' => $usulan,
                    'rpjmd' => $rpjmd,
                    'satuan' => $satuan,
                    'bidangpem' => $bidangpem
        ]);
    }

    //perbaikan full di terima dkk
    public function actionModalDitolak($Kd_Ta_Forum_Lingkungan) {
        $usulan = TaForumLingkungan::find() //mengambil usulan dari lingkungan tertentu
                ->where(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])
                ->one();

        $rpjmd = RefRPJMD::find()
                ->all(); //mengambil data Ref_RPJMD
                
        return $this->renderpartial('modal_usulan_tolak', [
                    'Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan,
                    'usulan' => $usulan,
                    'rpjmd' => $rpjmd,
        ]);
    }
}
