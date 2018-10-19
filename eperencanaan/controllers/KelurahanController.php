<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\search\TaForumLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use eperencanaan\models\TaForumLingkunganMedia;
use eperencanaan\models\TaForumLingkunganAcara;
use eperencanaan\models\search\TaForumLingkunganMediaSearch;
use eperencanaan\models\UploadForm;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use eperencanaan\models\RefMedia;
use eperencanaan\models\TaLingkunganPaguIndikatif;
use eperencanaan\models\TaKelurahanPaguIndikatif;
use eperencanaan\models\TaKecamatanPaguIndikatif;
use yii\db\Query;

/**
 * KelurahanController implements the CRUD actions for TaForumLingkunganMedia model.
 */
//Yii::$app->view->params['main'] = 2;

class KelurahanController extends Controller
{
    public $layout = "main_kelurahan";
    public $TaFLA, $TaFA;
    //public $enableCsrfValidation = false;

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
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all TaForumLingkunganMedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        //line-baru
        $ZULKelurahanModel = $model;
        unset($ZULKelurahanModel['Kd_Lingkungan']);
        $ZULKelurahan = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne($ZULKelurahanModel);
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

        $NASTotalLingkungan = (new Query())
                ->select(['SUM(Harga_Total) AS cnt'])
                ->from('Ta_Forum_Lingkungan')
                ->where($model)
                ->one();

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
        
        //penambahan info pada ta_lingkungan_acara
        return $this->render('dashboard', [
                    'indikatifLingkungan' => $indikatifLingkungan,
                    'indikatifKelurahan' => $indikatifKelurahan,
                    'indikatifKecamatan' => $indikatifKecamatan,
                    'usulanLingkungan' => $usulanLingkungan,
                    'NASTotalLingkungan' => $NASTotalLingkungan,
                    'acara' => $ZULKelurahan]
        );
    }

    public function actionTambah() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0 || $TaFLA->Waktu_Selesai !== 0)
            return $this->redirect(['index']);
        $models = new TaForumLingkungan();
        $models->Tanggal = time();
        $models->Tahun = date('Y');
        $models->Kd_Prov = $model['Kd_Prov'];
        $models->Kd_Kab = $model['Kd_Kab'];
        $models->Kd_Kec = $model['Kd_Kec'];
        $models->Kd_Kel = $model['Kd_Kel'];
        $models->Kd_Urut_Kel = $model['Kd_Urut_Kel'];
        $models->Kd_Lingkungan = $model['Kd_Lingkungan'];
        if ($models->load(Yii::$app->request->post())) {
            //$models->Jumlah;
            $models->Jumlah = str_replace(".", "", $models->Jumlah);
            $models->Harga_Satuan = str_replace(".", "", $models->Harga_Satuan);
            $models->Harga_Total = str_replace(".", "", $models->Harga_Total);

            if ($models->save()) {

                Yii::$app->session->addFlash('success', 'Tambah Usulan Lingkungan Berhasil');
                return $this->redirect(['tambah', 'pesan' => 'berhasil']);
            }
        } else {
            return $this->render('tambah_usulan', [
                        'model' => $models,
            ]);
        }
    }

    public function actionUsulanmasuk() {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFL = TaForumLingkungan::find()->all();
        $TaFLA = TaForumLingkunganAcara::findOne($model);
        if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        return $this->render('usulan_masuk', [
                    'data' => $TaFL,
                    'acara' => $TaFLA
        ]);
    }

    public function actionRekapitulasi() {

        // $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        // $TaFL = TaForumLingkungan::find()->where($model)->all();
        // $TaFLA = TaForumLingkunganAcara::findOne($model);
        // if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0)
        //     return $this->redirect(['index']);
        return $this->render('rekapitulasi_usulan', [
                    'data' => $TaFL,
                    'acara' => $TaFLA
        ]);
    }

    public function actionDokumen() {
        //    $this->layout = "main_lingkungan";
        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $ZULUser = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = TaForumLingkunganAcara::findOne($ZULUser);
        $searchModel = new TaForumLingkunganMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ZULUser);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            if ($acara->load(Yii::$app->request->post()) && $acara->save(false)) {
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('bap', ['model' => $acara]),
                    'options' => [
                        'title' => 'Privacy Policy - Krajee.com',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . date("r")],
                        'SetFooter' => ['|Halaman {PAGENO}|'],
                    ]
                ]);
                return $pdf->render();
            } else {
                $model->absenFile = UploadedFile::getInstances($model, 'absenFile');
                $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
                $model->videoFile = UploadedFile::getInstances($model, 'videoFile');
                $model->beritaFile = UploadedFile::getInstance($model, 'beritaFile');
                if ($model->uploadFoto()) {
                    $id = 0;
                    foreach ($model->imageFile as $file) {

                        $user = RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
                        if ($user == null)
                            continue;
                        $kd_media = $user->Kd_Media;
                        $TaFLM = new TaForumLingkunganMedia();
                        $TaFLM->attributes = $ZULUser; //massive assignment
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
                        $TaFLM->attributes = $ZULUser; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Absen";
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
                        $TaFLM->attributes = $ZULUser; //massive assignment
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
                        $TaFLM->attributes = $ZULUser; //massive assignment
                        $TaFLM->Kd_Media = $kd_media;
                        $TaFLM->Jenis_Dokumen = "Berita Acara";
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

    public function actionView($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media),
        ]);
    }

    /**
     * Creates a new TaForumLingkunganMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaForumLingkunganMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media)
    {
        $model = $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media)
    {
        $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Media)
    {
        if (($model = TaForumLingkunganMedia::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Media' => $Kd_Media])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
