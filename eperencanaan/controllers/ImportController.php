<?php

namespace eperencanaan\controllers;

use yii\helpers\ArrayHelper;
//use common\models\TaMusrenbangKelurahan;
//use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaMusrenbang;

class ImportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUsulanKelurahan()
    {
    	echo "Mulai import <br/>";
    	$usulan1 = \eperencanaan\models\TaMusrenbangKelurahan::find()
              ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
              ->where(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL])
              //->limit()
              ->all();

      // $usulan2 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find()
      //         ->where(['IN', 'Status_Penerimaan', [1,2]])
      //         ->all();

      $no=1;
      foreach ($usulan1 as $key => $value) {
      	$musrenbang = new TaMusrenbang;
      	echo $no++."<br/>";
      	echo "Tahun = ".$value->Tahun."<br/>";
				echo "Kd_Prov = ".$value->Kd_Prov."<br/>";
				echo "Kd_Kab = ".$value->Kd_Kab."<br/>";
				echo "Kd_Kec = ".$value->Kd_Kec."<br/>";
				echo "Kd_Kel = ".$value->Kd_Kel."<br/>";
				echo "Kd_Urut_Kel = ".$value->Kd_Urut_Kel."<br/>";
				echo "Kd_Lingkungan = ".$value->Kd_Lingkungan."<br/>";
				echo "Kd_Jalan = ".$value->Kd_Jalan."<br/>";
				echo "Kd_Urusan = ".$value->Kd_Urusan."<br/>";
				echo "Kd_Bidang = ".$value->Kd_Bidang."<br/>";
				echo "Kd_Prog = ".$value->Kd_Prog."<br/>";
				echo "Kd_Keg = ".$value->Kd_Keg."<br/>";
				echo "Kd_Pem = ".$value->Kd_Pem."<br/>";
				echo "Nm_Permasalahan = ".$value->Nm_Permasalahan."<br/>";
				echo "Kd_Klasifikasi = ".$value->Kd_Klasifikasi."<br/>";
				echo "Jenis_Usulan = ".$value->Jenis_Usulan."<br/>";
				echo "Jumlah = ".$value->Jumlah."<br/>";
				echo "Kd_Satuan = ".$value->Kd_Satuan."<br/>";
				echo "Harga_Satuan = ".$value->Harga_Satuan."<br/>";
				echo "Harga_Total = ".$value->Harga_Total."<br/>";
				echo "Kd_Sasaran = ".$value->Kd_Sasaran."<br/>";
				echo "Detail_Lokasi = ".$value->Detail_Lokasi."<br/>";
				echo "Latitute = ".$value->Latitute."<br/>";
				echo "Longitude = ".$value->Longitude."<br/>";
				echo "Tanggal = ".$value->Tanggal."<br/>";
				echo "status = ".$value->status."<br/>";
				echo "Status_Survey = ".$value->Status_Survey."<br/>";
				echo "Kd_Prioritas_Pembangunan_Daerah = ".$value->Kd_Prioritas_Pembangunan_Daerah."<br/>";
				echo "Status_Usulan = ".$value->Status_Usulan."<br/>";
				echo "Kd_User = ".$value->Kd_User."<br/>";
			  
      	$musrenbang->Tahun = $value->Tahun;
				$musrenbang->Kd_Prov = $value->Kd_Prov;
				$musrenbang->Kd_Kab = $value->Kd_Kab;
				$musrenbang->Kd_Kec = $value->Kd_Kec;
				$musrenbang->Kd_Kel = $value->Kd_Kel;
				$musrenbang->Kd_Urut_Kel = $value->Kd_Urut_Kel;
				$musrenbang->Kd_Lingkungan = $value->Kd_Lingkungan;
				$musrenbang->Kd_Jalan = $value->Kd_Jalan;
				$musrenbang->Kd_Urusan = $value->Kd_Urusan;
				$musrenbang->Kd_Bidang = $value->Kd_Bidang;
				$musrenbang->Kd_Prog = $value->Kd_Prog;
				$musrenbang->Kd_Keg = $value->Kd_Keg;
				$musrenbang->Kd_Unit = 0;
				$musrenbang->Kd_Sub = 0;
				$musrenbang->Kd_Pem = $value->Kd_Pem;
				$musrenbang->Nm_Permasalahan = $value->Nm_Permasalahan;
				$musrenbang->Kd_Klasifikasi = $value->Kd_Klasifikasi;
				$musrenbang->Jenis_Usulan = $value->Jenis_Usulan;
				$musrenbang->Jumlah = $value->Jumlah;
				$musrenbang->Kd_Satuan = $value->Kd_Satuan;
				$musrenbang->Harga_Satuan = $value->Harga_Satuan;
				$musrenbang->Harga_Total = $value->Harga_Total;
				$musrenbang->Kd_Sasaran = $value->Kd_Sasaran;
				$musrenbang->Detail_Lokasi = $value->Detail_Lokasi;
				$musrenbang->Latitute = $value->Latitute;
				$musrenbang->Longitude = $value->Longitude;
				$musrenbang->Tanggal = $value->Tanggal;
				$musrenbang->status = $value->status;
				$musrenbang->Status_Survey = $value->Status_Survey;
				$musrenbang->Kd_Prioritas_Pembangunan_Daerah = $value->Kd_Prioritas_Pembangunan_Daerah;
				//$musrenbang->Skor = NULL;
				//$musrenbang->Rincian_Skor = NULL;
				$musrenbang->Status_Usulan = $value->Status_Usulan;
				$musrenbang->Status_Penerimaan_Kelurahan = 1;
				$musrenbang->Alasan_Kelurahan = '';
				//$musrenbang->Status_Penerimaan_Kecamatan = NULL;
				//$musrenbang->Alasan_Kecamatan = NULL;
				// $musrenbang->Status_Penerimaan_Skpd = NULL;
				// $musrenbang->Alasan_Skpd = NULL;
				// $musrenbang->Status_Penerimaan_Kota = NULL;
				// $musrenbang->Alasan_Kota = NULL;
				$musrenbang->Kd_User = $value->Kd_User;
				// $musrenbang->Kd_Asal = NULL;
				// $musrenbang->Kd1 = NULL;
				// $musrenbang->Kd2 = NULL;
				// $musrenbang->Kd3 = NULL;
				// $musrenbang->Kd4 = NULL;
				// $musrenbang->Kd5 = NULL;
				// $musrenbang->Kd6 = NULL;
				// $musrenbang->Uraian_Usulan = NULL;
				// $musrenbang->Kd_Asal_Usulan = NULL;
				
				if ($musrenbang->save(false)) {
					echo "Berhasil";
				}
				else{
					echo "Gagal";
				}

			  echo "<br/><br/>";
      }

      //return $this->render('index');
    }
}
