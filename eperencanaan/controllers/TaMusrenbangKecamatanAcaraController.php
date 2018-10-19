<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKecamatanAcara;
use eperencanaan\models\search\TaMusrenbangKecamatanAcaraSearch;
use eperencanaan\models\TaMusrenbang;
use common\models\RefKelurahan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangKecamatanAcaraController implements the CRUD actions for TaMusrenbangKecamatanAcara model.
 */
class TaMusrenbangKecamatanAcaraController extends Controller {

    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec'],
        ];
        return $pos;
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaMusrenbangKecamatanAcara models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangKecamatanAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKecamatanAcara model.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel) {
        return $this->render('view', [
                    'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel),
        ]);
    }

    /**
     * Creates a new TaMusrenbangKecamatanAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbangKecamatanAcara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKecamatanAcara model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel) {
        $model = $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbangKecamatanAcara model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel) {
        $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbangKecamatanAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return TaMusrenbangKecamatanAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec) {
        if (($model = TaMusrenbangKecamatanAcara::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec])) !== null) {
            return $model;
        }
        return null;
    }
	
	public function tanggal_indo($tanggal, $cetak_hari = false)
	{
		$hari = array ( 1 =>    'Senin',
					'Selasa',
					'Rabu',
					'Kamis',
					'Jumat',
					'Sabtu',
					'Minggu'
				);
				
		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split 	  = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		
		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}

    public function actionAbsensi($kode) {
        
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKecamatan = $this->findModel($Tahun, $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec);
        if ($ZULKecamatan == null) {
            $ZULKecamatan = new \eperencanaan\models\TaMusrenbangKecamatanAcara();
            $ZULKecamatan->Kd_Prov = $ZULmodel->Kd_Prov;
            $ZULKecamatan->Kd_Kab = $ZULmodel->Kd_Kab;
            $ZULKecamatan->Kd_Kec = $ZULmodel->Kd_Kec;
            
            if ($ZULKecamatan->load(Yii::$app->request->post())) {
                $ZULKecamatan->Waktu_Unduh_Absen = time();
                $ZULKecamatan->Tahun = $Tahun;
                // $ZULKecamatan->Waktu_Mulai = time();
                $ZULKecamatan->Kd_User = Yii::$app->user->identity->id;
                $ZULKecamatan->save(false);
            }
        }
		
		$tanggal = function($tanggal, $cetak_hari = false){
			return $this->tanggal_indo($tanggal, $cetak_hari);
		};
        if ($kode == 1) {
            $stat = "MULAI";
        } else {
            $stat = "SELESAI";
            //$TaFLA = TaForumLingkunganAcara::findOne($ZULmodel);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('absensi', ['stat' => $stat, 'model' => $ZULKecamatan, 'Nm_Pemda' => $Nm_Pemda, 'Tahun' => $Tahun,'tanggal'=>$tanggal]),
            'options' => [
                'title' => 'Absensi',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().' || Dicetak pada: ' .
                    $this->tanggal_indo(date("Y-m-d"),true) .'/' .(date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionMulai() {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKecamatan = $this->findModel($Tahun, $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec);

        $ZULKecamatan->Waktu_Mulai = time();
        
        if ($ZULKecamatan->save(false)) {
            return $this->redirect(['ta-musrenbang-kecamatan/index', 'pesan' => 'berhasil']);
        } else {
            return $this->redirect(['ta-musrenbang-kecamatan/index', 'pesan' => 'gagal']);
        }
    }
    
    public function actionSelesai() {
        $Posisi = $this->Posisi();

        $jlh_kelurahan = RefKelurahan::find()
                        ->where($Posisi)
                        ->count();

        $batas_infrastruktur=10 * $jlh_kelurahan;
        $batas_sosbud=3 * $jlh_kelurahan;
        $batas_ekonomi=3 * $jlh_kelurahan;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            //========beri tanda di prioritas=======//
            $data_infrastruktur = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_infrastruktur)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
            foreach ($data_infrastruktur as $key => $value) {
                $value->Status_Prioritas='1';
                $value->update(false);
            }

            $data_sosbud = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_sosbud)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
            foreach ($data_sosbud as $key => $value) {
                $value->Status_Prioritas='1';
                $value->update(false);
            }
        
            $data_ekonomi = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_ekonomi)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
            foreach ($data_ekonomi as $key => $value) {
                $value->Status_Prioritas='1';
                $value->update(false);
            }

            //======update selesai=====//
            $KecamatanAcara = TaMusrenbangKecamatanAcara::findone($Posisi);
            $KecamatanAcara->Waktu_Selesai = time();
            $KecamatanAcara->save(false);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        
        echo 'Musrenbang Selesai';
    }
    
    public function actionBeritaAcara($kode) {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $Posisi = $this->Posisi();
        $Nm_Pemda = $this->getKota();

        $jlh_usulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($Posisi)
                    ->count(); 
		$usulan_terima = TaMusrenbang::find()
						->where($Posisi)
						->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
						->andwhere(['or',
										['Status_Penerimaan_Kelurahan'=>'1'],
										['Status_Penerimaan_Kelurahan'=>'2'],
									])
						->andwhere(['or',
										['Status_Penerimaan_Kecamatan'=>'1'],
										['Status_Penerimaan_Kecamatan'=>'2'],
									])
						->andwhere(["IS NOT","Skor",NULL])
						->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
						->andwhere(["NOT",["Skor"=>0]])
						->all();
		
		
		$usulan_kecamatan = TaMusrenbang::find()
						->where($Posisi)
						->andWhere(['Kd_Asal_Usulan'=>'3'])
						->all();
						
		//$usulan_tolak = TaMusrenbang::find()->where($Posisi)->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2']])->andWhere(["or",["Status_Prioritas"=>NULL],["Status_Prioritas"=>'0']])->all();
		$usulan_tolak = TaMusrenbang::find()
		->where($Posisi)
		->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
		->andWhere(["or",["Status_Penerimaan_Kecamatan"=>NULL],
						 ["Status_Penerimaan_Kecamatan"=>'0'],
						 ["Status_Penerimaan_Kecamatan"=>'3'],
						 ["Skor"=>NULL],
						 ["Skor"=>0],
						 ["Kd_Prioritas_Pembangunan_Daerah"=>0]])
		->all();
		$tanggal = function($tanggal, $cetak_hari = false){
			return $this->tanggal_indo($tanggal, $cetak_hari);
		};

        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel($Tahun, $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        //$TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        if ($kode == 1 && $ZULKelurahan->load(Yii::$app->request->post())) {
            $ZULKelurahan->Waktu_Unduh_Berita_Acara = time();
            $ZULKelurahan->save(false);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('bap', 
												[
												'stat' => 'SELESAI',
												'usulan' => $jlh_usulan,
												'model' => $ZULKelurahan,
												'Tahun' => $Tahun,
												'Nm_Pemda' => $Nm_Pemda,
												'tanggal'=>$tanggal,
												'usulan_terima'=>$usulan_terima,
												'usulan_kecamatan'=>$usulan_kecamatan,
												'usulan_tolak'=>$usulan_tolak,
												]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
					$this->tanggal_indo(date("Y-m-d"),true) .'/' .(date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ],
        ]);
        return $pdf->render();
    }
    
    public function actionUbahStatusUsulan(){

        $Tahun = Yii::$app->pengaturan->getTahun();
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel($Tahun, $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        $ZULKelurahan->Status_Pembahasan_Usulan = 1;
        $ZULKelurahan->save(false);
        $this->redirect(['ta-musrenbang-kelurahan/kompilasi']);
    }

}
