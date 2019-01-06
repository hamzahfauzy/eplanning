<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKelurahanAcara;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\search\TaMusrenbangKelurahanAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangKelurahanAcaraController implements the CRUD actions for TaMusrenbangKelurahanAcara model.
 */
class TaMusrenbangKelurahanAcaraController extends Controller {

    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec'],
            'Kd_Kel' => $kelompok['Kd_Kel'],
            'Kd_Urut_Kel' => $kelompok['Kd_Urut_Kel']
        ];
        return $pos;
    }
	
	public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            'Kd_Kel' => $data['Kd_Kel'],
            'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
        ];

        return $ZULarray;
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
     * Lists all TaMusrenbangKelurahanAcara models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangKelurahanAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKelurahanAcara model.
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
     * Creates a new TaMusrenbangKelurahanAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbangKelurahanAcara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKelurahanAcara model.
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
     * Deletes an existing TaMusrenbangKelurahanAcara model.
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
     * Finds the TaMusrenbangKelurahanAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return TaMusrenbangKelurahanAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel) {
        if (($model = TaMusrenbangKelurahanAcara::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel])) !== null) {
            return $model;
        }
        //return null;
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
        $ZULKelurahan = $this->findModel(date('Y'), $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        if ($ZULKelurahan == null) {
            $ZULKelurahan = new \eperencanaan\models\TaMusrenbangKelurahanAcara();
            $ZULKelurahan->Kd_Prov = $ZULmodel->Kd_Prov;
            $ZULKelurahan->Kd_Kab = $ZULmodel->Kd_Kab;
            $ZULKelurahan->Kd_Kec = $ZULmodel->Kd_Kec;
            $ZULKelurahan->Kd_Kel = $ZULmodel->Kd_Kel;
            $ZULKelurahan->Kd_Urut_Kel = $ZULmodel->Kd_Urut_Kel;
            //line dihapus
            //$TaFLA->Kd_Lingkungan = $model['Kd_Lingkungan'];
            if ($ZULKelurahan->load(Yii::$app->request->post())) {
                $ZULKelurahan->Waktu_Unduh_Absen = time();
                $ZULKelurahan->Tahun = $Tahun;
                // $ZULKelurahan->Waktu_Mulai = time();
                $ZULKelurahan->Kd_user = Yii::$app->user->identity->id;
                $ZULKelurahan->save(false);
            }
        }
        if ($kode == 1) {
            $stat = "MULAI";
        } else {
            $stat = "SELESAI";
            //$TaFLA = TaForumLingkunganAcara::findOne($ZULmodel);
        }
		$tanggal = function($tanggal, $cetak_hari = false){
			return $this->tanggal_indo($tanggal, $cetak_hari);
		};
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('absensi', ['stat' => $stat, 'model' => $ZULKelurahan, 'Tahun' => $Tahun, 'Nm_Pemda' => $Nm_Pemda,'tanggal'=>$tanggal]),
            'options' => [
                'title' => 'Absensi',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    $this->tanggal_indo(date("Y-m-d"),true) . '/' .(date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionMulai() {
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel(date('Y'), $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);

        //print_r($ZULKelurahan);
        $ZULKelurahan->Waktu_Mulai = time();
        
        if ($ZULKelurahan->save(false)) {
            return $this->redirect(['ta-musrenbang-kelurahan/index', 'pesan' => 'berhasil']);
        } else {
            return $this->redirect(['ta-musrenbang-kelurahan/index', 'pesan' => 'gagal']);
        }
    }
    
    public function actionSelesai() {
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel(date('Y'), $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        $ZULKelurahan->Waktu_Selesai = time();
        $ZULKelurahan->save(false);
        /*\eperencanaan\models\TaMusrenbangKelurahan::updateAll(['status' => '1'], [
            'Kd_Prov' => $ZULKelurahan->Kd_Prov,
            'Kd_Kab' => $ZULKelurahan->Kd_Kab,
            'Kd_Kec' => $ZULKelurahan->Kd_Kec,
            'Kd_Kel' => $ZULKelurahan->Kd_Kel,
            'Kd_Urut_Kel' => $ZULKelurahan->Kd_Urut_Kel]);*/
        //Yii::$app->session->addFlash('success', 'Usulan berhasil dikirim ke kelurahan');
        return $this->redirect(['ta-musrenbang-kelurahan/rekapitulasi']);
    }
    
    public function actionBeritaAcara($kode) {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $Posisi = $this->Posisi();

        $jlh_usulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($Posisi)
                    ->count(); 

        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel(date('Y'), $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
		$tanggal = function($tanggal, $cetak_hari = false){
			return $this->tanggal_indo($tanggal, $cetak_hari);
		};
        //$TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        if ($kode == 1 && $ZULKelurahan->load(Yii::$app->request->post())) {
            $ZULKelurahan->Waktu_Unduh_Berita_Acara = time();
            $ZULKelurahan->save(false);
        }
		
		$kelurahan = Yii::$app->levelcomponent->getNamaKelurahan();
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFL = TaMusrenbangKelurahan::find()->where($model);
		
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('bap', [
												'stat' => 'SELESAI',
												'usulan' => $jlh_usulan,
												'model' => $ZULKelurahan,
												'Tahun' => $Tahun,
												'data' => $TaFL,
												'link' => $TaFLA,
												'kelurahan' => $kelurahan,
												'tanggal'=>$tanggal]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy' 
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                    $this->tanggal_indo(date("Y-m-d"),true) . '/' .(date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
    
    public function actionUbahStatusUsulan(){
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel(date('Y'), $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        $ZULKelurahan->Status_Pembahasan_Usulan = 1;
        $ZULKelurahan->save(false);
        //$this->redirect(['ta-musrenbang-kelurahan/kompilasi']);//Dikomen Oleh RG pada tanggal 15/08/2018
		$this->redirect(['ta-musrenbang-kelurahan/rekapitulasi']);//Ditambah Oleh RG pada tanggal 15/08/2018
    }

}
