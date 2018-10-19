<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\search\TaForumLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use eperencanaan\models\TaForumLingkunganMedia;
use eperencanaan\models\Savelog;
use eperencanaan\models\TaForumLingkunganAcara;
use eperencanaan\models\search\TaForumLingkunganMediaSearch;
use eperencanaan\models\UploadForm;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use common\models\RefMedia;
use eperencanaan\models\TaLingkunganPaguIndikatif;
use eperencanaan\models\TaKelurahanPaguIndikatif;
use eperencanaan\models\TaKecamatanPaguIndikatif;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use mPDF;
use common\models\RefJalan;
use eperencanaan\models\TaUsulanLingkunganMedia;
use eperencanaan\models\TaForumLingkunganRiwayat;

//Yii::$app->view->params['main'] = 1;

class LingkunganController extends Controller {


    public $layout = "main";
    public $TaFLA, $TaFA;
    public $enableCsrfValidation = false;

    public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            'Kd_Kel' => $data['Kd_Kel'],
            'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
            'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $ZULarray;
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

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

    public function actionIndex() {
        
        $Nm_Pemda = $this->getKota();

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
		
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        $indikatifLingkungan = TaLingkunganPaguIndikatif::findOne($model);
        $indikatifKelurahan = TaKelurahanPaguIndikatif::findOne([
                    'Kd_Prov' => $model['Kd_Prov'],
                    'Kd_Kab' => $model['Kd_Kab'],
                    'Kd_Kec' => $model['Kd_Kec'],
                    'Kd_Kel' => $model['Kd_Kel'],
                    'Kd_Urut' => $model['Kd_Urut_Kel']]);
        $indikatifKecamatan = TaKecamatanPaguIndikatif::findOne([
                    'Kd_Prov' => $model['Kd_Prov'],
                    'Kd_Kab' => $model['Kd_Kab'],
                    'Kd_Kec' => $model['Kd_Kec']]);

        $ZULtotallingkungan = TaForumLingkungan::find()
                            ->where(['Kd_Prov' => $model['Kd_Prov']])
                            ->andwhere(['Kd_Kab' => $model['Kd_Kab']])
                            ->andwhere(['Kd_Kec' => $model['Kd_Kec']])
                            ->andwhere(['Kd_Kel' => $model['Kd_Kel']])
                            ->andwhere(['Kd_Urut_Kel' => $model['Kd_Urut_Kel']])
                            ->andwhere(['Kd_Lingkungan' => $model['Kd_Lingkungan']])
                            ->count();

        $usulanLingkungan = TaForumLingkungan::find()->where($model)->count();

        if ($indikatifLingkungan == null) {
            $indikatifLingkungan = 0;
        } else {
            $indikatifLingkungan = $indikatifLingkungan->Pagu_Indikatif;
        }

        if ($indikatifKelurahan == null) {
            $indikatifKelurahan = 0;
        } else {
            $indikatifKelurahan = $indikatifKelurahan->Pagu_Indikatif;
        }

        if ($indikatifKecamatan == null) {
            $indikatifKecamatan = 0;
        } else {
            $indikatifKecamatan = $indikatifKecamatan->Pagu_Indikatif;
        }

        //mulai rembuk warga
        if ($TaFLA == null) {
            $Tahun = Yii::$app->pengaturan->getTahun();
            $TaFLA = new TaForumLingkunganAcara;
			if ($TaFLA->load(Yii::$app->request->post())) {
				$TaFLA->Kd_Prov = $model['Kd_Prov'];
				$TaFLA->Kd_Kab = $model['Kd_Kab'];
				$TaFLA->Kd_Kec = $model['Kd_Kec'];
				$TaFLA->Kd_Kel = $model['Kd_Kel'];
				$TaFLA->Kd_Urut_Kel = $model['Kd_Urut_Kel'];
				$TaFLA->Kd_Lingkungan = $model['Kd_Lingkungan'];
                $TaFLA->Waktu_Unduh_Absen = time();
                $TaFLA->Tahun = $Tahun;
                if ($TaFLA->save(false)) {
             //       Yii::$app->session->addFlash('success', 'Silahkan Tambah Usulan Lingkungan');
                    return $this->redirect(['lingkungan/absensi', 'kode' => '1']);
                } else {
            //        Yii::$app->session->addFlash('warning', 'Gagal Memulai, Silahkan Coba lagi');
                    //   return $this->redirect(['lingkungan/index', 'pesan' => 'gagal']);
                    return $this->refresh();
                }
            }
        } else {
            
        }
        //penambahan info pada ta_lingkungan_acara
        return $this->render('dashboard', [
                    'indikatifLingkungan' => $indikatifLingkungan,
                    'indikatifKelurahan' => $indikatifKelurahan,
                    'indikatifKecamatan' => $indikatifKecamatan,
                    'usulanLingkungan' => $usulanLingkungan,
                    'ZULtotallingkungan' => $ZULtotallingkungan,
                    'acara' => $TaFLA,
                    'ZULnihil' => new \eperencanaan\models\UploadNihil()]
        );
    }

    public function actionTambah() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaForumLingkunganAcara::findOne($model);
		$ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
		$ZULsatuan =  ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(),'Kd_Satuan','Uraian');
        if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0 || $TaFLA->Waktu_Selesai !== 0)
            return $this->redirect(['index']);
        $models = new TaForumLingkungan();
        $models->Tanggal = time();
        $models->Tahun = $TaFLA->Tahun;
        $models->Kd_Prov = $TaFLA->Kd_Prov;
        $models->Kd_Kab = $TaFLA->Kd_Kab;
        $models->Kd_Kec = $TaFLA->Kd_Kec;
        $models->Kd_Kel = $TaFLA->Kd_Kel;
        $models->Kd_Urut_Kel = $TaFLA->Kd_Urut_Kel;
        $models->Kd_Lingkungan = $TaFLA->Kd_Lingkungan;
        if ($models->load(Yii::$app->request->post())) {
            //$models->Jumlah;
            $models->Jumlah = str_replace(".", "", $models->Jumlah);
            $models->Harga_Satuan = str_replace(".", "", $models->Harga_Satuan);
            $models->Harga_Total = str_replace(".", "", $models->Harga_Total);

            if ($models->save()) {
				$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
				$ZULaftersimpan->attributes = $models->attributes;
				$ZULaftersimpan->Status_Survey = 5;
				$ZULaftersimpan->Keterangan = "Tambah Usulan";
				//$ZULaftersimpan->Tanggal = time();
				$ZULaftersimpan->save(false);
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('Tambah Usulan Lingkungan', 'Tambah Usulan Lingkungan', '', '');
                Yii::$app->session->addFlash('success', 'Tambah Usulan Lingkungan Berhasil');
                return $this->redirect(['tambah']);
            }
        } else {
            return $this->render('tambah_usulan', [
                        'model' => $models,
						'ZULbidpem' => $ZULbidangpembangunan,
						'ZULsatuan' => $ZULsatuan
            ]);
        }
    }

    public function actionUpdate($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        $model = $this->findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran);
        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ubah', 'Tahun' => $model->Tahun, 'Kd_Ta_Forum_Lingkungan' => $model->Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('ubah', [
                        'model' => $model,
                        'ZULbidpem' => $ZULbidangpembangunan,
                        'ZULsatuan' => $ZULsatuan
            ]);
        }
    }

    public function actionRekapitulasi() {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFL = TaForumLingkungan::find()->where($model)->all();
        $TaFLA = TaForumLingkunganAcara::findOne($model);
		$ZULmodel = new \eperencanaan\models\UploadPaskaRembuk();
		if ($ZULmodel->load(Yii::$app->request->post())){
			$ZULmodel->imageFile = UploadedFile::getInstances($ZULmodel, 'imageFile');
			$ZULmodel->videoFile = UploadedFile::getInstances($ZULmodel, 'videoFile');
			//var_dump($ZULmodel->imageFile);exit;
			if ($ZULmodel->upload()) {
                    $id = 0;
                    foreach ($ZULmodel->imageFile as $file) {
						
                        $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameImage[$id]]);
                        if ($user == null)
                            continue;
                        $ZULmodel2 = new \eperencanaan\models\TaUsulanLingkunganMedia();
						//print($user->Kd_Media);exit;
						$ZULmodel2->Kd_Media = $user->Kd_Media;
						$ZULmodel2->Kd_Ta_Forum_Lingkungan = $ZULmodel->id;
						$ZULmodel2->Jenis_Dokumen = "Foto";
						$ZULmodel2->save(false);
                        $id++;
                    }
					$id = 0;
					 foreach ($ZULmodel->videoFile as $file) {

                        $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameVideo[$id]]);
                        if ($user == null)
                            continue;
                        $ZULmodel2 = new \eperencanaan\models\TaUsulanLingkunganMedia();
						$ZULmodel2->Kd_Media = $user->Kd_Media;
						$ZULmodel2->Kd_Ta_Forum_Lingkungan = $ZULmodel->id;
						$ZULmodel2->Jenis_Dokumen = "Video";
						$ZULmodel2->save(false);
                        $id++;
                    }
					
			}
		}
        if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        return $this->render('rekapitulasi_usulan', [
                    'data' => $TaFL,
                    'acara' => $TaFLA, 'model' => $ZULmodel
        ]);
    }

    public function actionDokumen() {
        //    $this->layout = "main_lingkungan";\
        $Tahun = Yii::$app->pengaturan->getTahun();
        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $ZULUser = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = TaForumLingkunganAcara::findOne($ZULUser);
        $searchModel = new TaForumLingkunganMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ZULUser);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s', time());

        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            if ($acara->load(Yii::$app->request->post())) {
                $acara->Waktu_Unduh_Berita_Acara = time();
                $acara->save(false);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('bap', ['stat' => 'SELESAI','usulan' => TaForumLingkungan::find()->where($ZULUser)->count(), 'model' => $acara, 'Tahun' => $Tahun]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.$waktu
                            ],
                        'SetFooter' => ['|Halaman {PAGENO}|'],
                    ]
                ]);
                return $pdf->render();
            } else {
                $model->absenFile = UploadedFile::getInstances($model, 'absenFile');
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->videoFile = UploadedFile::getInstances($model, 'videoFile');
                $model->beritaFile = UploadedFile::getInstance($model, 'beritaFile');
                $model->piFile = UploadedFile::getInstance($model, 'piFile');
		$model->TandaTerimaFile = UploadedFile::getInstance($model, 'TandaTerimaFile');
                if ($model->uploadFoto()) {
                    $id = 0;
                    foreach ($model->imageFile as $file) {

                        $user = RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
                        if ($user == null)
                            continue;
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Foto";
                        if ($TaFLM->save(false)) {
                            
                        }
                        $id++;
                    }
                    $id = 0;
                    foreach ($model->absenFile as $file) {

                        $user = RefMedia::findOne(['Nm_Media' => $model->nameAbsen[$id]]);
                        if ($user == null)
                            continue;
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        //print_r($acara);print_r($TaFLM);exit;
						$TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Absensi";
                        if ($TaFLM->save(false)) {
                            
                        }
                        $id++;
                    }
                    $id = 0;
                    foreach ($model->videoFile as $file) {

                        $user = RefMedia::findOne(['Nm_Media' => $model->nameVideo[$id]]);
                        if ($user == null)
                            continue;
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Video";
                        if ($TaFLM->save(false)) {
                            
                        }
                        $id++;
                    }
                    $user = RefMedia::findOne(['Nm_Media' => $model->nameBerita]);
                    if ($user !== null) {
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Berita Acara";
                        if ($TaFLM->save(false)) {
                            
                        }
                    }

                    $user = RefMedia::findOne(['Nm_Media' => $model->namePi]);
                    if ($user !== null) {
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Bukti Undangan";
                        if ($TaFLM->save(false)) {
                            
                        }
                    }
					
					$user = RefMedia::findOne(['Nm_Media' => $model->nameTandaTerima]);
                    if ($user !== null) {
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $acara->attributes; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Tanda Terima";
                        if ($TaFLM->save(false)) {
                            
                        }
                    }
                }
                return $this->refresh();
            }
        }

        return $this->render('dokumen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'acara' => $acara,
                    'model' => $model
        ]);
    }

    public function actionAwal() {
        $searchModel = new TaForumLingkunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {

        return $this->render('view', [
                    'model' => $this->findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran),
        ]);
    }

    public function actionCreate() {
        $model = new TaForumLingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Forum_Lingkungan' => $model->Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUbah($Kd_Ta_Forum_Lingkungan) {
        $model = $this->cariModel($Kd_Ta_Forum_Lingkungan);
        $model->Tanggal = time();
        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');

        if ($model->load(Yii::$app->request->post())) {
            //$model->Jumlah;
            
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);

            if ($model->save()) {
				$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
				$ZULaftersimpan->attributes = $model->attributes;
				$ZULaftersimpan->Status_Survey = 5;
				$ZULaftersimpan->Keterangan = "Ubah Usulan";
				$ZULaftersimpan->insert(false);
                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
            
        } else {
            return $this->render('tambah_usulan', [
                        'model' => $model,
                        'ZULbidpem' => $ZULbidangpembangunan,
                        'ZULsatuan' => $ZULsatuan
            ]);
        }
    }

    public function actionHapus($Kd_Ta_Forum_Lingkungan) {
        //echo $Kd_Ta_Forum_Lingkungan;
        $ZULmodel = $this->cariModel($Kd_Ta_Forum_Lingkungan);
		$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
		$ZULaftersimpan->attributes = $ZULmodel->attributes;
		$ZULaftersimpan->Status_Survey = 5;
		$ZULaftersimpan->Tanggal = time();
		$ZULaftersimpan->Keterangan = "Hapus Usulan";
		$ZULaftersimpan->insert(false);
		$ZULmodel->delete();
        return $this->redirect(['rekapitulasi']);
    }

    protected function cariModel($Kd_Ta_Forum_Lingkungan) {
        if (($model = TaForumLingkungan::findOne(['Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

      public function actionMulai() {
		  $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
		  $TaFLA = TaForumLingkunganAcara::findOne($model);

          $Tahun = Yii::$app->pengaturan->getTahun();
		  
		  $TaFLA->Waktu_Mulai = time();
		  $TaFLA->Tahun = $Tahun;

		  if ($TaFLA->save(false)) {
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('mulai forum lingkungan', 'mulai forum lingkungan', '', '');
				return $this->redirect(['lingkungan/index', 'pesan' => 'berhasil']);
		  }

		  else{
			return $this->redirect(['lingkungan/index', 'pesan' => 'gagal']);
		  }
	}
		  
    public function actionSelesai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('forum lingkungan selesai', 'forum lingkungan selesai', '', '');
        TaForumLingkungan::updateAll(['status' => '1'], $model);
        //Yii::$app->session->addFlash('success', 'Usulan berhasil dikirim ke kelurahan');
        return $this->redirect(['rekapitulasi']);
    }

    public function actionAbsensi($kode) {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();

        $ZULmodel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
		$TaFLA = TaForumLingkunganAcara::findOne($ZULmodel);
        if ($kode == 1) {
			$stat = "MULAI";
        } else {
			$stat = "SELESAI";
            //$TaFLA = TaForumLingkunganAcara::findOne($ZULmodel);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('absensi', ['stat' => $stat, 'model' => $TaFLA, 'Nm_Pemda' => $Nm_Pemda, 'Tahun' => $Tahun]),
            'options' => [
                'title' => 'Absensi',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
		
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('unduh absen', 'unduh absensi', '', '');
		
        return $pdf->render();
    }

    public function actionBeritaAcara($kode) {

        $Nm_Pemda = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $Tahun = Yii::$app->pengaturan->getTahun();
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s', time());

        if ($kode == 1) {
            $TaFLA->Waktu_Unduh_Berita_Acara = time();
            $TaFLA->save(false);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('bap', ['stat' => 'SELESAI','usulan' => TaForumLingkungan::find()->where($model)->count(), 'model' => $TaFLA, 'Nm_Pemda' => $Nm_Pemda, 'Tahun' => $Tahun]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 

                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.$waktu
                      ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionCetakUsulan() {
        $Tahun      = Yii::$app->pengaturan->getTahun();
        $Kelurahan  = Yii::$app->levelcomponent->getNamaKelurahan();
        $Lingkungan = Yii::$app->levelcomponent->getNamaLingkungan();
        $model      = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA      = TaForumLingkunganAcara::findOne($model);
        $TaFL       = TaForumLingkungan::find()->where($model);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            //'orientation' => Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('lampiran_usulan', [
                'data' => $TaFL, 
                'link' => $TaFLA, 
                'Tahun' => $Tahun,
                'Kelurahan' => $Kelurahan,
                'Lingkungan' => $Lingkungan
            ]),
            'options' => [
                'title' => 'Usulan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionSampleDownload($filename) {
        ob_clean();
        \Yii::$app->response->sendFile($filename)->send();
    }

    public function actionHimpunSemua() {
        $html = '';
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $ZULTaFLM = TaForumLingkunganMedia::find()->where($model)->all();
        $pdf = new mPDF('utf-8', 'Folio');
        $pdf->SetImportUse();
        $ZULcontent = $this->renderPartial('laporan', ['model' => \common\models\RefLingkungan::findOne($model)]);
        $pdf->WriteHTML($ZULcontent);
        foreach ($ZULTaFLM as $model) {
            if ($model->kdMedia->Type_Media == "pdf") {
                $pagesInFile = $pdf->SetSourceFile(Yii::getAlias('@webroot') . '/data/' . $model->kdMedia->Nm_Media);
                for ($i = 1; $i <= $pagesInFile; $i++) {
                    $tplId = $pdf->ImportPage($i);
                    $pdf->UseTemplate($tplId);
                    if (($i !== $pagesInFile)) {
                        $pdf->WriteHTML('<pagebreak />');
                    }
                }
                $pdf->WriteHTML('<pagebreak />');
            }
        }
        foreach ($ZULTaFLM as $model) {
            if ($model->kdMedia->Type_Media == "jpg" || $model->kdMedia->Type_Media == "jpeg") {
                $pdf->WriteHTML('<img src=' . Yii::getAlias('@webroot') . '/data/' . $model->kdMedia->Nm_Media . ' width="600px"; height="600px"></img>');
				$pdf->WriteHTML('<br />');
            }
        }
        return $pdf->Output();
        //echo phpinfo();
    }
	
	 public function actionHimpunSemua2($Kd_Prov,$Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan) {
        $html = '';
        $model = [
			'Kd_Prov' => $Kd_Prov,
			'Kd_Kab' => $Kd_Kab,
			'Kd_Kec' => $Kd_Kec,
			'Kd_Kel' => $Kd_Kel,
			'Kd_Urut_Kel' => $Kd_Urut_Kel,
			'Kd_Lingkungan' => $Kd_Lingkungan,
		];
        $ZULTaFLM = TaForumLingkunganMedia::find()->where($model)->all();
        $pdf = new mPDF('utf-8', 'Folio');
        $pdf->SetImportUse();
        $ZULcontent = $this->renderPartial('laporan', ['model' => \common\models\RefLingkungan::findOne($model)]);
        $pdf->WriteHTML($ZULcontent);
        foreach ($ZULTaFLM as $model) {
            if ($model->kdMedia->Type_Media == "pdf") {
				if (!file_exists(Yii::getAlias('@webroot') . '/data/' . $model->kdMedia->Nm_Media)){
				//	Yii::$app->session->addFlash('warning', 'Gagal Memulai, Silahkan Coba lagi');
					return $this->redirect(['dashboard/index']);
				}
                $pagesInFile = $pdf->SetSourceFile(Yii::getAlias('@webroot') . '/data/' . $model->kdMedia->Nm_Media);
                for ($i = 1; $i <= $pagesInFile; $i++) {
                    $tplId = $pdf->ImportPage($i);
                    $pdf->UseTemplate($tplId);
                    if (($i !== $pagesInFile)) {
                        $pdf->WriteHTML('<pagebreak />');
                    }
                }
                $pdf->WriteHTML('<pagebreak />');
            }
        }
        foreach ($ZULTaFLM as $model) {
            if ($model->kdMedia->Type_Media == "jpg" || $model->kdMedia->Type_Media == "jpeg") {
                $pdf->WriteHTML('<img src=' . Yii::getAlias('@webroot') . '/data/' . $model->kdMedia->Nm_Media . ' width="600px"; height="600px"></img>');
				$pdf->WriteHTML('<br />');
            }
        }
        return $pdf->Output();
        //echo phpinfo();
    }


    public function actionDokumenSurvey (){

         return $this->render('dokumen_survey');

    }

    public function actionKoreksi($Kd_Ta_Forum_Lingkungan) {

        $model = $this->cariModel($Kd_Ta_Forum_Lingkungan);
        $model->Tanggal = time();
        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        if ($model->load(Yii::$app->request->post())) {
            //$model->Jumlah;
            
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
			$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
			$ZULaftersimpan->attributes = $model->attributes;
			//$ZULaftersimpan->Status_Survey = 5;
			$ZULaftersimpan->Keterangan = "Ubah Harga Usulan";
				//$ZULaftersimpan->Tanggal = time();
			$ZULaftersimpan->save(false);

            if ($model->save()) {
                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
            
        } else {
            return $this->render('edit_usulan', [
                        'model' => $model,
                        'ZULbidpem' => $ZULbidangpembangunan,
                        'ZULsatuan' => $ZULsatuan
            ]);
        }
    }


     public function actionKordinat() {
        $post = Yii::$app->request->post();
        $kd_usulan = $post["kd_usulan"];
        $lat = $post["lat"];
        $long = $post["long"];
        
        $model = TaForumLingkungan::findOne(['Kd_Ta_Forum_Lingkungan' => $kd_usulan]);
        $model->Latitute = $lat;
        $model->Longitude = $long;
        if($model->save()){
			$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
				$ZULaftersimpan->attributes = $model->attributes;
				$ZULaftersimpan->Status_Survey = 5;
				$ZULaftersimpan->Keterangan = "Ubah Koordinat Usulan";
				$ZULaftersimpan->Tanggal = time();
				$ZULaftersimpan->save(false);
            return $this->redirect(['rekapitulasi']);
        }

    }

    public function actionUbahstatus($kode, $status) {
        $model = $this->cariModel($kode);
        $model->Status_Survey = $status;

        if ($model->save()) {
			$ZULaftersimpan = new \eperencanaan\models\TaForumLingkunganRiwayat();
			$ZULaftersimpan->attributes = $model->attributes;
			//$ZULaftersimpan->Status_Survey = 5;
			$ZULaftersimpan->Keterangan = "Ubah Status Survey Usulan";
			$ZULaftersimpan->Tanggal = time();
			$ZULaftersimpan->save(false);
            echo 'berhasil';
        }
        else{
            echo 'gagal';
        }

    }

    public function actionCekdokumen($kode) {
        $PC_jlh_foto = TaUsulanLingkunganMedia::find()
                        ->where([
                                    'Kd_Ta_Forum_Lingkungan' => $kode,
                                    'Jenis_Dokumen' => 'Foto',
                                ])
                        ->count();
        $PC_jlh_video = TaUsulanLingkunganMedia::find()
                        ->where([
                                    'Kd_Ta_Forum_Lingkungan' => $kode,
                                    'Jenis_Dokumen' => 'Video',
                                ])
                        ->count();
        echo "$PC_jlh_foto|$PC_jlh_video";
    }

    public function actionTambahjalan() {
        $post = Yii::$app->request->post();
        $nama = $post["nama"];
        
        $data_kel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());

        $models = new RefJalan();
        $models->Kd_Prov = $data_kel['Kd_Prov'];
        $models->Kd_Kab = $data_kel['Kd_Kab'];
        $models->Kd_Kec = $data_kel['Kd_Kec'];
        $models->Kd_Kel = $data_kel['Kd_Kel'];
        $models->Kd_Urut_Kel = $data_kel['Kd_Urut_Kel'];
        $models->Kd_Lingkungan = $data_kel['Kd_Lingkungan'];
        $models->Nm_Jalan = $nama;

        $Kd_Jalan_Data = RefJalan::find()
                ->where(['Kd_Prov' => $data_kel['Kd_Prov'], 
                            'Kd_Kab' => $data_kel['Kd_Kab'], 
                            'Kd_Kec' => $data_kel['Kd_Kec'], 
                            'Kd_Kel' => $data_kel['Kd_Kel'], 
                            'Kd_Urut_Kel' => $data_kel['Kd_Urut_Kel'], 
                            'Kd_Lingkungan' => $data_kel['Kd_Lingkungan']])
                ->max('Kd_Jalan');
                //->count(); 

        $Kd_Jalan = $Kd_Jalan_Data+1;
        $models->Kd_Jalan = $Kd_Jalan;

        if ($models->save()) {
            //Yii::$app->session->addFlash('success', 'Tambah Jalan Berhasil');
            return $this->redirect(['tambah']);
        }
    }
	
	public function actionHapusBerkas($id){
		\common\models\RefMedia::findOne(['Kd_Media' => $id])->delete();
		//TaForumLingkunganMedia::findOne(['Kd_Media' => $id])->delete();
		return $this->redirect(['lingkungan/dokumen']);
	}

    public function actionLihatdokumen($kode){
        $PC_Dokumen = TaUsulanLingkunganMedia::find()
                        ->where([
                                    'Kd_Ta_Forum_Lingkungan' => $kode,
                                ])
                        ->all();

        return $this->renderPartial('modal_lihat_dokumen', [
                                        'data_dokumen' => $PC_Dokumen
                                    ]);
    }

    public function actionLihatriwayat($kode2){
        $NASRiwayat = TaForumLingkunganRiwayat::find()
                        ->where([
                                'Kd_Ta_Forum_Lingkungan' => $kode2,
                            ])
                        ->all();
        /*
       $NASUsulan = (new Query())
                ->select(['Kd_Ta_Forum_Lingkungan'])
                ->from('Ta_Forum_Lingkungan_Riwayat')
                ->having(['COUNT(*)','>', 1 ])
                ->one();               

        */
        return $this->renderPartial('modal_lihat_riwayat', [

                                    'data_riwayat' => $NASRiwayat,
                                    //'cek_usulan' =>$NASUsulan
                            ]);
    }
    
    public function actionLaporan(){
        $content = $this->renderPartial('laporan');
        //return $this->render('laporan');
        $pdf = new mPDF('utf-8','Folio');
        $pdf->WriteHTML($content);
        return $pdf->Output();
    }
    
    public function actionNihil(){
        $ZULuser = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $ZULmodel = new \eperencanaan\models\UploadNihil();
        $time = time();
        $Tahun = Yii::$app->pengaturan->getTahun();
        
        if (Yii::$app->request->isPost){
            if (($ZULmodel->nihil = UploadedFile::getInstance($ZULmodel, 'nihil'))!=null){
                $ZULacara = new TaForumLingkunganAcara();
                $ZULTaMedia = new TaForumLingkunganMedia();
                $ZULacara->attributes = $ZULuser;
                $ZULTaMedia->attributes = $ZULuser;
                $ZULacara->Waktu_Mulai = $time;
                $ZULacara->Waktu_Selesai = $time;
                $ZULacara->Waktu_Unduh_Absen = $time;
                $ZULacara->Waktu_Unduh_Berita_Acara = $time;
                $ZULacara->Tahun = $Tahun;
                $ZULacara->save(false);
                $ZULmodel->simpan();
                //print_r($ZULacara->errors);exit;
                $ZULRefmedia = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameFile]);
                    if ($ZULRefmedia !== null) {
                        $ZULTaMedia->Tahun = $Tahun;
                        $kd_media = $ZULRefmedia->Kd_Media;
                        $ZULTaMedia->Kd_Media = $kd_media;
                        $ZULTaMedia->Jenis_Dokumen = "Surat Pernyataan Nihil";
                        if ($ZULTaMedia->save(false)) {
                            
                        }
                    }
                
            }
        }
        return $this->redirect(['lingkungan/index']);
    }
    
    public function actionBeritaNihil() {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = \common\models\RefLingkungan::findOne($model);
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('nihil', ['stat' => 'SELESAI','usulan' => TaForumLingkungan::find()->where($model)->count(), 'model' => $TaFLA]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 

                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                      ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
}

