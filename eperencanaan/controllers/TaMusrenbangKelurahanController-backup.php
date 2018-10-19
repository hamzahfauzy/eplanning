<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\search\TaMusrenbangKelurahanSearch;
use eperencanaan\models\TaMusrenbangKelurahanAcara;
use eperencanaan\models\search\TaMusrenbangKelurahanAcaraSearch;
use eperencanaan\models\TaMusrenbangKelurahanMedia;
use eperencanaan\models\search\TaMusrenbangKelurahanMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaMusrenbangKelurahanController implements the CRUD actions for TaMusrenbangKelurahan model.
 */
class TaMusrenbangKelurahanController extends Controller {

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
     * Lists all TaMusrenbangKelurahan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangKelurahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKelurahan model.
     * @param string $Tahun
     * @param integer $Kd_Ta_Muserenbang_Kelurahan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        return $this->render('view', [
                    'model' => $this->findModel($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran),
        ]);
    }

    /**
     * Creates a new TaMusrenbangKelurahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbangKelurahan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Muserenbang_Kelurahan' => $model->Kd_Ta_Muserenbang_Kelurahan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKelurahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Ta_Muserenbang_Kelurahan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        $model = $this->findModel($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Muserenbang_Kelurahan' => $model->Kd_Ta_Muserenbang_Kelurahan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbangKelurahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Ta_Muserenbang_Kelurahan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        $this->findModel($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbangKelurahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Ta_Muserenbang_Kelurahan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return TaMusrenbangKelurahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Ta_Muserenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        if (($model = TaMusrenbangKelurahan::findOne(['Tahun' => $Tahun, 'Kd_Ta_Muserenbang_Kelurahan' => $Kd_Ta_Muserenbang_Kelurahan, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Jalan' => $Kd_Jalan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Satuan' => $Kd_Satuan, 'Kd_Sasaran' => $Kd_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

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

    public function actionRekapitulasi() {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFL = TaMusrenbangKelurahan::find()->where($model)->all();
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        return $this->render('rekapitulasi_usulan', [
                    'data' => $TaFL,
                    'acara' => $TaFLA
        ]);
    }

    public function actionDokumen() {
        $this->layout = "main_lingkungan";
        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = TaMusrenbangKelurahanAcara::findOne($model);
        $searchModel = new TaMusrenbangKelurahanMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->absenFile = UploadedFile::getInstance($model, 'absenFile');
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
            $model->beritaFile = UploadedFile::getInstance($model, 'beritaFile');

            if ($model->uploadFoto()) {
                for ($x = 0; $x < 4; $x++) {
                    $kd_media = RefMedia::findOne(['Nm_Media' => $model->nameFile[$x]])->Kd_Media;
                    $TaFLM = new TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $this->model; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = $ZULketerangan[$x];
                    if ($TaFLM->save(false)) {
                        
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

    public function actionMulai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Mulai = time();
        $TaFLA->Tahun = date('Y');
        $TaFLA->save(false);
        return $this->redirect(['lingkungan/index']);
    }

    public function actionSelesai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
        TaMusrenbangKelurahan::updateAll(['status' => '1'], $model);
        return $this->redirect(['index']);
    }

    public function actionAbsensi($kode) {
        $ZULmodel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        if ($kode == 1) {

            $TaFLA = new TaMusrenbangKelurahanAcara();
            $TaFLA->Kd_Prov = $ZULmodel['Kd_Prov'];
            $TaFLA->Kd_Kab = $ZULmodel['Kd_Kab'];
            $TaFLA->Kd_Kec = $ZULmodel['Kd_Kec'];
            $TaFLA->Kd_Kel = $ZULmodel['Kd_Kel'];
            $TaFLA->Kd_Urut_Kel = $ZULmodel['Kd_Urut_Kel'];
            $TaFLA->Kd_Lingkungan = $ZULmodel['Kd_Lingkungan'];
            $TaFLA->Waktu_Unduh_Absen = time();
            //print_r($ZULmodel);exit();
            $TaFLA->save(false);
        } else {
            $TaFLA = TaMusrenbangKelurahanAcara::findOne($ZULmodel);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('absensi', ['model' => $TaFLA]),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Sistem e-Perencanaan Kota Medan||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionBeritaAcara($kode) {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        if ($kode == 1) {
            $TaFLA->Waktu_Unduh_Berita_Acara = time();
            $TaFLA->save(false);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('bap', ['model' => $TaFLA]),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Sistem e-Perencanaan Kota Medan||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionCetakUsulan() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFL = TaMusrenbangKelurahan::find()->where($model)->all();
        //$TaFLA = TaMusrenbangKelurahanAcara::findOne([ 'Kd_Kel' => '2']);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('lampiran_usulan', ['data' => $TaFL, 'link' => $TaFLA]),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Sistem e-Perencanaan Kota Medan||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionSampleDownload($filename) {
        ob_clean();
        \Yii::$app->response->sendFile($filename)->send();
    }

}
