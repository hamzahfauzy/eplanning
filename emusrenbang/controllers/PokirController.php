<?php

namespace emusrenbang\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKecamatan;
use eperencanana\models\search\TaMusrenbangKecamatanSearch;
use eperencanaan\models\TaMusrenbangKecamatanAcara;
use eperencanaan\models\search\TaMusrenbangKecamatanAcaraSearch;
use eperencanaan\models\TaMusrenbangKecamatanMedia;
use eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch;
use eperencanaan\models\TaRelasiMusrenbangKecamatan;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaMusrenbangKecamatanRiwayat;
use eperencanaan\models\TaMusrenbang;
use eperencanaan\models\search\TaMusrenbangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\RefKecamatan;
use common\models\RefJalan;
use common\models\RefBidangPembangunan;
use yii\web\UploadedFile;
use common\models\RefMedia;
use eperencanaan\models\TaUsulanKecamatanMedia;
use eperencanaan\models\TaMusrenbangKelurahan;
use common\models\RefKelurahan;
use common\models\RefSubUnit;
use eperencanaan\models\TaKecamatanVerifikasiUsulanKelurahan;
use yii\helpers\Json;
use yii\web\Cookie;
use yii\web\CookieCollection;
use common\models\RefRPJMD;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangKecamatanController implements the CRUD actions for TaMusrenbangKecamatan model.
 */
class PokirController extends Controller {
    //public $layout = "main";

    /**
     * @inheritdoc
     */
    public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec']
        ];

        return $ZULarray;
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    //where provinsi sampai Kecamatan
    public function Posisi() {
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


    public function getAsalDapil() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            $dapil = \eperencanaan\models\TaUserDapil::findOne(['Kd_User' => $id]);
        }
        return $dapil;
    }

    public function getDapilKelompok(){
        $dapil = $this->getAsalDapil();
        $array = ['or'];
        if ($dapil)
        foreach ($dapil['kdTaDapil'] as $key => $value){
            array_push($array, ['and',['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Kab' => $value['Kd_Kab']],
                    ['Kd_Kec' => $value['Kd_Kec']],
                    ['Kd_Kel' => $value['Kd_Kel']],
                    ['Kd_Urut' => $value['Kd_Urut']],
            
            ]);
        }
        else
        return $array;
    }
    public function getDapilKelompok_2(){
        $dapil = $this->getAsalDapil();
        $array = ['or'];
        if ($dapil)
        foreach ($dapil['kdTaDapil'] as $key => $value){
            array_push($array, ['and',['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Kab' => $value['Kd_Kab']],
                    ['Kd_Kec' => $value['Kd_Kec']],
                    ['Kd_Kel' => $value['Kd_Kel']],
                    ['Kd_Urut_Kel' => $value['Kd_Urut']],
            
            ]);
        }
        return $array;
    }
    /**
     * Lists all TaMusrenbangKecamatan models.
     * @return mixed
     */
    public function actionIndex() {
        $jlh_usulan = TaMusrenbang::find()
                ->where(['Kd_User' => $this->Kd_User()])->count();
        $ZULacara = \eperencanaan\models\TaPokirAcara::findOne(['Kd_User' => $this->Kd_User()]);
        $ZULacara = $ZULacara != null ? $ZULacara : new \eperencanaan\models\TaPokirAcara();

        $Dapil = \eperencanaan\models\TaUserDapil::find(['Kd_User' => $this->Kd_User()])->one();

        $DapilKec = \eperencanaan\models\TaDapil::find()->where(['Kd_Dapil' => $Dapil])->all();


        return $this->render('dashboard', [
                    'acara' => $ZULacara,
                    'jlh_usulan' => $jlh_usulan,
                    'Dapil' => $Dapil,
                    'DapilKec' => $DapilKec
        ]);
    }

    /**
     * Displays a single TaMusrenbangKecamatan model.
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
    public function actionView($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        return $this->render('view', [
                    'model' => $this->findModel($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran),
        ]);
    }

    /**
     * Creates a new TaMusrenbangKelurahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $user = (Yii::$app->user->identity->id);
        $model = new TaMusrenbang();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        // $models = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        // $Posisi = $this->Posisi();
     
        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
       
        // $unit =RefSubUnit::find()
        //     ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
        //     ->andwhere(['!=', 'Nm_Sub_Unit', ''])
        //     ->andWhere($PosisiUnit)
        //     ->orderby('Nm_Sub_Unit')
        //     ->all();

        $Kd_Dewan = [];

        $unit =RefSubUnit::find()->where($PosisiUnit)->all();    

        $dapil = ArrayHelper::map(\common\models\RefDapil::find()->all(), 'Kd_Dapil', 'Nm_Dapil');    

        $dataunit = [];
        foreach ($unit as $pil) {
            $val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
            $dataunit[$val_skpd]=$pil->Nm_Sub_Unit;
        }
                    
        $model = new TaMusrenbang();
        // $model->attributes = $models;
        $model->Kd_Prov = 12;
        $model->Tanggal = time();
        $model->Kd_User = $user;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

         if ($model->load(Yii::$app->request->post())) {

          
            $model->Tahun = date('Y');
            // print_r($model);exit;
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Kd_Asal_Usulan = '5';

            $request = Yii::$app->request;
            $skpd = $request->post('skpd');

            $skpd_arr = explode("|", $skpd);
            
            $model->Kd_Urusan = $skpd_arr[0];
            $model->Kd_Bidang = $skpd_arr[1];
            $model->Kd_Unit = $skpd_arr[2];
            $model->Kd_Sub = $skpd_arr[3];


            if ($model->save(false)) {

                $model->Kd_User = $user;
                
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Ta_Musrenbang_Id = $model->id;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Keterangan = "Tambah Usulan";
                $ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->save(false);

                return $this->redirect(['create']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'NASbidangpem' =>$NASbidangpem,
                'NASsatuan'=> $NASsatuan,
                'NASrpjmd' => $NASrpjmd,
                'dataunit' => $dataunit,
                'NASsatuan' => $NASsatuan,
                'dapil'=> $dapil,
                'Kd_Dewan'=> $Kd_Dewan                
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
    public function actionUpdate($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        $model = $this->findModel($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Musrenbang_Kelurahan' => $model->Kd_Ta_Musrenbang_Kelurahan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
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
    public function actionDelete($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        $this->findModel($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)->delete();

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
    protected function findModel($Tahun, $Kd_Ta_Musrenbang_Kelurahan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran) {
        if (($model = TaMusrenbangKelurahan::findOne(['Tahun' => $Tahun, 'Kd_Ta_Muserenbang_Kelurahan' => $Kd_Ta_Muserenbang_Kelurahan, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Jalan' => $Kd_Jalan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Satuan' => $Kd_Satuan, 'Kd_Sasaran' => $Kd_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRekapitulasi() {

        $acara = \eperencanaan\models\TaPokirAcara::findOne(['Kd_User' => $this->Kd_User()]);
        $TaFL = TaMusrenbang::find()->where($this->getDapilKelompok_2())->all();
        //print_r($TaFL);exit;
        $ZULmodel = new \eperencanaan\models\UploadPaskaRembuk();
        if ($ZULmodel->load(Yii::$app->request->post())) {
            $ZULmodel->imageFile = UploadedFile::getInstances($ZULmodel, 'imageFile');
            $ZULmodel->videoFile = UploadedFile::getInstances($ZULmodel, 'videoFile');
            //var_dump($ZULmodel->imageFile);exit;
            if ($ZULmodel->upload()) {
                $id = 0;
                foreach ($ZULmodel->imageFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanPokirMedia();
                    //print($user->Kd_Media);exit;
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->id = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Foto";
                    $ZULmodel2->save(false);
                    $id++;
                }
                $id = 0;
                foreach ($ZULmodel->videoFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameVideo[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanPokirMedia();
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->id = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Video";
                    $ZULmodel2->save(false);
                    $id++;
                }
            }
        }
        return $this->render('rekapitulasi', [
                    'data' => $TaFL,
                    'model' => $ZULmodel,
                    'acara' => $acara
        ]);
    }

    public function actionDokumen() {

        // print_r($this->Posisi());
        // die();

        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = TaMusrenbangKecamatanAcara::findOne($model);
        $searchModel = new TaMusrenbangKecamatanMediaSearch();
        $dataProvider = $searchModel->Samsearch(Yii::$app->request->queryParams, $model);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new \eperencanaan\models\UploadForm();

        return $this->render('dokumen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'acara' => $acara,
                    'model' => $model
        ]);
    }

    public function actionMulai() {
        $TaFLA = new \eperencanaan\models\TaPokirAcara();
        $TaFLA->Kd_User = $this->Kd_User();
        $TaFLA->Waktu_Mulai = time();
        $TaFLA->Tahun = date('Y');
        $TaFLA->save(false);
        return $this->redirect(['pokir/index']);
    }

    public function actionSelesai() {
        $TaFLA = \eperencanaan\models\TaPokirAcara::findOne(['Kd_User' => $this->Kd_User()]);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
        //TaMusrenbangKelurahan::updateAll(['status' => '1'], $model);
        return $this->redirect(['index']);
    }

    public function actionAbsensi($kode) {
        $ZULmodel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        if ($kode == 1) {

            $TaFLA = new TaMusrenbangKecamatanAcara();
            $TaFLA->Kd_Prov = $ZULmodel['Kd_Prov'];
            $TaFLA->Kd_Kab = $ZULmodel['Kd_Kab'];
            $TaFLA->Kd_Kec = $ZULmodel['Kd_Kec'];
            $TaFLA->Waktu_Unduh_Absen = time();
            $TaFLA->save(false);
        } else {
            $TaFLA = TaMusrenbangKecamatanAcara::findOne($ZULmodel);
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
                'SetHeader' => ['Generated By: Sistem e-Planning '.Yii::$app->levelcomponent->getKelompok()->kdKab->Nm_Kab.'||Generated On: ' . date("r")],
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
                'SetHeader' => ['Generated By: Sistem e-Planning '.Yii::$app->levelcomponent->getKelompok()->kdKab->Nm_Kab.'||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

        public function actionCetakUsulan() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFL = TaMusrenbangKelurahan::find()->where($model);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            //'orientation' => Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('lampiran_usulan', ['data' => $TaFL, 'link' => $TaFLA]),
            'options' => [
                'title' => 'Usulan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
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

    public function actionUbah($Kd_Ta_Musrenbang_Kelurahan) {
        $model = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $model->Tanggal = time();
        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $ZULWilDapil = \yii\helpers\ArrayHelper::map(\common\models\RefKelurahan::find()->
            where($this->getDapilKelompok())
            ->all(),
            function($model, $defaultValue) {
                return $model['Nm_Kel'];
            },
            function($model, $defaultValue) {
                return $model['Nm_Kel'].', '.$model->kecamatan->Nm_Kec;
            }
        );
        $model->Kd_Urut_Kel = \common\models\RefKelurahan::findOne([
            'Kd_Prov' => $model->Kd_Prov,
            'Kd_Kab' => $model->Kd_Kab,
            'Kd_Kec' => $model->Kd_Kec,
            'Kd_Kel' => $model->Kd_Kel,
            'Kd_Urut' => $model->Kd_Urut_Kel,
        ])->Nm_Kel;
        $model->Kd_Unit = $kels = \common\models\RefUnit::findOne([
            'Kd_Urusan' => $model->Kd_Urusan,
            'Kd_Bidang' => $model->Kd_Bidang,
            'Kd_Unit' => $model->Kd_Unit,
            
        ])->Nm_Unit;
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
        $ZULunit = \yii\helpers\ArrayHelper::map(\common\models\RefUnit::find()->all(),
            'Nm_Unit', 'Nm_Unit');
        if ($model->load(Yii::$app->request->post())) {
            //$model->Jumlah;
            $unit = \common\models\RefUnit::findOne(['Nm_Unit' => $model->Kd_Unit]);
            $model->Kd_Urusan = $unit->Kd_Urusan;
            $model->Kd_Bidang = $unit->Kd_Bidang;
            $model->Kd_Unit = $unit->Kd_Unit;
            $model->Kd_Sub = 0;
            $kelurahan =  \common\models\RefKelurahan::findOne(['Nm_Kel' => $model->Kd_Urut_Kel]);
            $model->Kd_Prov = $kelurahan->Kd_Prov;
            $model->Kd_Kab = $kelurahan->Kd_Kab;
            $model->Kd_Kec = $kelurahan->Kd_Kec;
            $model->Kd_Kel = $kelurahan->Kd_Kel;
            $model->Kd_Urut_Kel = $kelurahan->Kd_Urut;
            $model->Kd_Lingkungan = 0;
            $model->Kd_Jalan = 0;

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);


            if ($model->save(false)) {
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Ta_Musrenbang_Id = $Kd_Ta_Musrenbang_Kelurahan;
                $ZULaftersimpan->id = '';
                $ZULaftersimpan->Keterangan = "Ubah Usulan";
                $ZULaftersimpan->insert(false);
                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'NASbidangpem' => $ZULbidangpembangunan,
                        'NASsatuan' => $ZULsatuan,
                        'NASrpjmd' => $NASrpjmd,
                        'ZULkel' => $ZULWilDapil,
                        'ZULUnit' => $ZULunit
            ]);
        }
    }

    public function actionHapus($Kd_Ta_Musrenbang_Kelurahan) {
        //echo $Kd_Ta_Forum_Lingkungan;
        $ZULmodel = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangRiwayat();
        $ZULaftersimpan->attributes = $ZULmodel->attributes;
        $ZULaftersimpan->Tanggal = time();
        $ZULaftersimpan->Keterangan = "Hapus Usulan";
        $ZULaftersimpan->insert(false);
        $ZULmodel->delete();
        return $this->redirect(['rekapitulasi']);
    }

    protected function cariModel($Kd_Ta_Musrenbang_Kelurahan) {
        if (($model = TaMusrenbang::findOne(['id' => $Kd_Ta_Musrenbang_Kelurahan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionKoreksi($Kd_Ta_Musrenbang_Kelurahan) {

        $model = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $model->Tanggal = time();

        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');

        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        if ($model->load(Yii::$app->request->post())) {
            //$model->Jumlah;

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
            $ZULaftersimpan->attributes = $model->attributes;
            //$ZULaftersimpan->Status_Survey = 5;
            $ZULaftersimpan->Keterangan = "Ubah Harga Usulan";
            //$ZULaftersimpan->Tanggal = time();
            $ZULaftersimpan->save(false);

            if ($model->save()) {
                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
        } else {
            return $this->render('koreksi', [
                        'model' => $model,
                        'ZULbidpem' => $ZULbidangpembangunan,
                        'ZULsatuan' => $ZULsatuan,
                        'NASrpjmd' => $NASrpjmd
            ]);
        }
    }

    public function actionTambahJalan($Kd_Lingkungan, $Nama_Jalan) {
        //$post = Yii::$app->request->post();
        //$Kd_Lingkungan = $post["Kd_Lingkungan"];
        //$Nama_Jalan = $post["Nama_Jalan"];
        $data_kel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());

        $models = new RefJalan();
        $models->Kd_Prov = $data_kel['Kd_Prov'];
        $models->Kd_Kab = $data_kel['Kd_Kab'];
        $models->Kd_Kec = $data_kel['Kd_Kec'];
        $models->Kd_Kel = $data_kel['Kd_Kel'];
        $models->Kd_Urut_Kel = $data_kel['Kd_Urut_Kel'];
        $models->Kd_Lingkungan = $Kd_Lingkungan;
        $models->Nm_Jalan = $Nama_Jalan;


        $Kd_Jalan_Data = RefJalan::find()
                ->where(['Kd_Prov' => $data_kel['Kd_Prov'],
                    'Kd_Kab' => $data_kel['Kd_Kab'],
                    'Kd_Kec' => $data_kel['Kd_Kec'],
                    'Kd_Kel' => $data_kel['Kd_Kel'],
                    'Kd_Urut_Kel' => $data_kel['Kd_Urut_Kel'],
                    'Kd_Lingkungan' => $Kd_Lingkungan
                ])
                ->max('Kd_Jalan');
        //->count(); 

        $Kd_Jalan = $Kd_Jalan_Data + 1;
        $models->Kd_Jalan = $Kd_Jalan;

        if ($models->save(false)) {
            //Yii::$app->session->addFlash('success', 'Tambah Jalan Berhasil');
            return $this->redirect(['ta-musrenbang-kelurahan/tambah-usulan-lingkungan']);
        }
    }

    public function actionUsulankelurahan() {

        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFL = TaMusrenbangKelurahan::find()->where($model)->all();
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $ZULmodel = new \eperencanaan\models\UploadPaskaRembuk();
        if ($ZULmodel->load(Yii::$app->request->post())) {
            $ZULmodel->imageFile = UploadedFile::getInstances($ZULmodel, 'imageFile');
            $ZULmodel->videoFile = UploadedFile::getInstances($ZULmodel, 'videoFile');
            //var_dump($ZULmodel->imageFile);exit;
            if ($ZULmodel->upload()) {
                $id = 0;
                foreach ($ZULmodel->imageFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanKelurahanMedia();
                    //print($user->Kd_Media);exit;
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->Kd_Ta_Musrenbang_Kelurahan = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Foto";
                    $ZULmodel2->save(false);
                    $id++;
                }
                $id = 0;
                foreach ($ZULmodel->videoFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameVideo[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanKelurahanMedia();
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->Kd_Ta_Musrenbang_Kelurahan = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Video";
                    $ZULmodel2->save(false);
                    $id++;
                }
            }
        }
        // if ($TaFLA == null || $TaFLA->Waktu_Mulai == 0)
        //     return $this->redirect(['index']);
        return $this->render('usulankelurahan', [
                    'data' => $TaFL,
                    'acara' => $TaFLA,
                    'model' => $ZULmodel
        ]);
    }

    public function actionKordinat() {
        $post = Yii::$app->request->post();
        $kd_usulan = $post["kd_usulan"];
        $lat = $post["lat"];
        $long = $post["long"];

        $model = TaMusrenbangKelurahan::findOne(['Kd_Ta_Musrenbang_Kelurahan' => $kd_usulan]);
        $model->Latitute = $lat;
        $model->Longitude = $long;
        if ($model->save()) {
            $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangRiwayat();
            $ZULaftersimpan->attributes = $model->attributes;
            $ZULaftersimpan->Keterangan = "Ubah Koordinat Usulan";
            $ZULaftersimpan->Tanggal = time();
            $ZULaftersimpan->save(false);
            return $this->redirect(['usulankelurahan']);
        }
    }

    public function actionLihatriwayat($kode2) {
        $NASRiwayat = \eperencanaan\models\TaMusrenbangRiwayat::find()
                        ->where([
                                'Ta_Musrenbang_Id' => $kode2,
                            ])
                        ->all();
      
        return $this->renderPartial('modal_lihat_riwayat', [
                    'data_riwayat' => $NASRiwayat,
                        //'cek_usulan' =>$NASUsulan
        ]);
    }

    public function actionLihatdokumen($kode) {
        $PC_Dokumen = \eperencanaan\models\TaUsulanPokirMedia::find()
                ->where([
                    'id' => $kode,
                ])
                ->all();


        return $this->renderPartial('modal_lihat_dokumen', [
                                        'data_dokumen' => $PC_Dokumen
                                    ]);

    }

    public function actionKompilasi() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
        $jalan = ArrayHelper::map(RefJalan::find()->orderBy('Nm_Jalan')->where($posisi)->all(), 'Kd_Jalan', 'Nm_Jalan');
        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan
        $model = new TaMusrenbangKelurahan();
        $model->attributes = $posisi;
        $model->Tanggal = time();

        $data = $this->dataUsulanPilih(); //mengubah data di session ke array
        $data=[];
        $this->dataUsulanPilihCompile($data);

        if ($model->load(Yii::$app->request->post())) {
            $model->Tahun = date('Y');

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Kd_User = $this->Kd_User();

            if ($model->save(false)) {
                $Kd_Ta_Musrenbang_Kelurahan = $model->Kd_Ta_Musrenbang_Kelurahan;
                
                $data = $this->dataUsulanPilih(); //mengambil data dari session
                foreach ($data as $key => $value) {
                    $relasi = new TaRelasiMusrenbangKelurahan();
                    $relasi->Kd_Ta_Musrenbang_Kelurahan = $Kd_Ta_Musrenbang_Kelurahan;
                    $relasi->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = $key;
                    $relasi->save();

                    $update = TaKelurahanVerifikasiUsulanLingkungan::find()
                                ->where(['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $key])
                                ->one();
                    $update->Status_Pengelompokan = '1';
                    $update->save();
                }

                //menyimpan ke riwayat
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->Keterangan = "Tambah Usulan";

                $ZULaftersimpan->save(false);
                $this->actionKosongkanCookieUsulan(); //mengosongkan pilihan usulan
                return $this->redirect(['kompilasi']);
            }
        } else {
            return $this->render('kompilasi', [
                        'lingkungan' => $lingkungan,
                        'model' => $model,
                        'NASsatuan' => $NASsatuan,
                        'NASbidangpem' => $NASbidangpem,
                        'NASrpjmd' => $NASrpjmd,
                        'jalan' => $jalan,
            ]);
        }
    }

    public function actionEditKompilasi($Kd_Ta_Musrenbang_Kelurahan) {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $model=TaMusrenbangKelurahan::findOne(['Kd_Ta_Musrenbang_Kelurahan' => $Kd_Ta_Musrenbang_Kelurahan]);

        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
        $jalan = ArrayHelper::map(RefJalan::find()->orderBy('Nm_Jalan')->where($posisi)->all(), 'Kd_Jalan', 'Nm_Jalan');
        $lingkungan = RefLingkungan::find()
                ->where($posisi)
                ->all(); //mengambil lingkungan dari kelurahan
        //$model = new TaMusrenbangKelurahan();
        //$model->attributes = $posisi;
        //$model->Tanggal = time();

        //===membuat cookie usulan===//
        $data = $this->dataUsulanPilih(); //mengubah data di session ke array
        //menambahkan session ke array
        $data=[];//mengosongkan array

        $relasi_usulan = TaRelasiMusrenbangKelurahan::find()
                        ->where(['Kd_Ta_Musrenbang_Kelurahan' => $Kd_Ta_Musrenbang_Kelurahan])
                        ->all();
        $daftar_ubah=[];
        foreach ($relasi_usulan as $key => $value) {
            //echo $value['Kd_Ta_Musrenbang_Kelurahan_Verifikasi'].'<br/>';
            $Kode = $value->Kd_Ta_Musrenbang_Kelurahan_Verifikasi;
            $Lingkungan = $value->kdTaMusrenbangKelurahanVerifikasi->lingkungan->Nm_Lingkungan;
            $Usulan = $value->kdTaMusrenbangKelurahanVerifikasi->Jenis_Usulan;
            $Jumlah = $value->kdTaMusrenbangKelurahanVerifikasi->Jumlah." ";
            $Jumlah .= $value->kdTaMusrenbangKelurahanVerifikasi->kdSatuan->Uraian;
            $Harga = number_format($value->kdTaMusrenbangKelurahanVerifikasi->Harga_Total, 2, ',', '.');
            $data[$Kode]['lingkungan'] = $Lingkungan;
            $data[$Kode]['usulan'] = $Usulan;
            $data[$Kode]['jumlah'] = $Jumlah;
            $data[$Kode]['harga'] = $Harga;
            $daftar_ubah[]=$Kode;
        }
        //$data = array();//hapus data
        $this->dataUsulanPilihCompile($data);

        if ($model->load(Yii::$app->request->post())) {
            $model->Tahun = date('Y');

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Kd_User = $this->Kd_User();

            if ($model->save(false)) {
                //$Kd_Ta_Musrenbang_Kelurahan = $model->Kd_Ta_Musrenbang_Kelurahan;
                //kosongkan relasi
                /*
                $kosongkan = TaRelasiMusrenbangKelurahan::find()
                            ->where(['Kd_Ta_Musrenbang_Kelurahan' => $Kd_Ta_Musrenbang_Kelurahan])
                            ->all();
                */
                TaRelasiMusrenbangKelurahan::deleteAll(['Kd_Ta_Musrenbang_Kelurahan' => $Kd_Ta_Musrenbang_Kelurahan]);

                foreach ($daftar_ubah as $key => $value) { //mengosongkan yang sudah dipiliah
                    $update = TaKelurahanVerifikasiUsulanLingkungan::find()
                                ->where(['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $value])
                                ->one();
                    $update->Status_Pengelompokan = '0';
                    $update->save();
                }

                $data = $this->dataUsulanPilih(); //mengambil data dari session
                foreach ($data as $key => $value) {
                    $relasi = new TaRelasiMusrenbangKelurahan();
                    $relasi->Kd_Ta_Musrenbang_Kelurahan = $Kd_Ta_Musrenbang_Kelurahan;
                    $relasi->Kd_Ta_Musrenbang_Kelurahan_Verifikasi = $key;
                    $relasi->save();

                    $update = TaKelurahanVerifikasiUsulanLingkungan::find()
                                ->where(['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $key])
                                ->one();
                    $update->Status_Pengelompokan = '1';
                    $update->save();
                }
                
                //menyimpan ke riwayat
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->Keterangan = "Ubah Usulan";

                $ZULaftersimpan->save(false);
                
                $this->actionKosongkanCookieUsulan(); //mengosongkan pilihan usulan
                return $this->redirect(['rekapitulasi']);
            }
        } else {
            return $this->render('kompilasi', [
                        'lingkungan' => $lingkungan,
                        'model' => $model,
                        'NASsatuan' => $NASsatuan,
                        'NASbidangpem' => $NASbidangpem,
                        'NASrpjmd' => $NASrpjmd,
                        'jalan' => $jalan,
            ]);
        }
    }

    public function actionGetUsulan($Kd_Lingkungan,$Kd_Pem,$Nm_Permasalahan,$Jenis_Usulan) {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan
        //mengambil kd yang sudah ada di database
        //$relasi = TaRelasiMusrenbangKelurahan::find()
        //        ->all();
        
        /*
        $sisa = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($posisi)
                ->andWhere(['Status_Pengelompokan' => '0'])
                ->all();
        foreach ($sisa as $key => $value) {
            $daftar_terpakai[] = $value['Kd_Ta_Musrenbang_Kelurahan_Verifikasi'];
            //echo $value['Kd_Ta_Musrenbang_Kelurahan_Verifikasi']."<br/>";
        }
        */
        $daftar_terpakai = [];
        //mengambil kd yang sudah ada di cookie
        $datacookie = $this->dataUsulanPilih();
        foreach ($datacookie as $key => $value) {
            $daftar_terpakai[] = $key;
        }

        $data = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($posisi)
                ->andWhere(['Status_Pengelompokan' => '0'])
                ->andWhere(['in', 'Status_Penerimaan', [1, 2]])
                ->andWhere(['not in', 'Kd_Ta_Musrenbang_Kelurahan_Verifikasi', $daftar_terpakai]);

        if ($Kd_Lingkungan!=0) {
            $data->andWhere(['Kd_Lingkungan' => $Kd_Lingkungan]);
        }

        if ($Kd_Pem!=0) {
            $data->andWhere(['Kd_Pem' => $Kd_Pem]);
        }

        if ($Nm_Permasalahan!='') {
            $data->andWhere(['like', 'Nm_Permasalahan', $Nm_Permasalahan]);
        }

        if ($Jenis_Usulan!='') {
            $data->andWhere(['like', 'Jenis_Usulan', $Jenis_Usulan]);
        }

        $hasil=$data->all(); //mengambil usulan dari lingkungan tertentu

        return $this->renderpartial('get_usulan_lingkungan', [
                    'data' => $hasil,
        ]);
    }

    public function actionSetCookieUsulan($Lingkungan, $Permasalahan, $Kode, $Usulan, $Jumlah, $Satuan, $Harga) {
        $data = $this->dataUsulanPilih(); //mengubah data di session ke array
        //menambahkan session ke array
        $data[$Kode]['lingkungan'] = $Lingkungan;
        $data[$Kode]['permasalahan'] = $Permasalahan;
        $data[$Kode]['usulan'] = $Usulan;
        $data[$Kode]['jumlah'] = $Jumlah;
        $data[$Kode]['satuan'] = $Satuan;
        $data[$Kode]['harga'] = $Harga;
        //$data = array();//hapus data
        $isi = Json::encode($data); //mengubah data array ke jason

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => 'usulans',
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));

        echo 'Berhasil';
    }

    public function actionGetCookieUsulan() {
        $data = $this->dataUsulanPilih();

        return $this->renderpartial('get_cookie_lingkungan', [
                    'data' => $data,
        ]);
    }

    public function actionHapusCookieUsulan($Kode) {
        $data = $this->dataUsulanPilih(); //mengubah data di session ke array

        unset($data[$Kode]); //menghapus data di array
        //$data=[];
        //$data = array();//hapus data
        $isi = Json::encode($data); //mengubah data array ke jason

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => 'usulans',
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));

        echo 'Berhasil';
    }

    public function actionKosongkanCookieUsulan() {
        $data = $this->dataUsulanPilih(); //mengubah data di session ke array

        $data = [];
        $isi = Json::encode($data); //mengubah data array ke jason

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => 'usulans',
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));

        echo 'Berhasil';
    }

    public function dataUsulanPilih() {
        $cookies = Yii::$app->request->cookies;
        $isi = $cookies['usulans'];
        $data = Json::decode($isi);

        return $data;
    }

    public function dataUsulanPilihCompile($data) {
        $isi = Json::encode($data); //mengubah data array ke json

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => 'usulans',
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));
    }

    public function actionTambahUsulanLingkungan() {
        $posisi = $this->Posisi();

        $models = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');

        $model = new TaKelurahanVerifikasiUsulanLingkungan();
        $model->attributes = $models;
        $model->Tanggal = time();

        $lingkungan = RefLingkungan::find()
                        ->where($models)
                        ->all();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->Tahun = date('Y');
            // print_r($model);exit;
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Status_Penerimaan = '1';
            $model->Status_Revisi = '0';
            $model->Asal_Usulan = '1';
            $model->Kd_User = Yii::$app->user->identity->id;
            $ZULlingkungan = new TaForumLingkungan();
            $ZULlingkungan->attributes = $model->attributes;
            $ZULlingkungan->Status_Pembahasan = 1;
            $ZULlingkungan->Status_Survey = 5;
            $ZULlingkungan->save(false);
            $model->Kd_Ta_Forum_Lingkungan = $ZULlingkungan->Kd_Ta_Forum_Lingkungan;
            //print_r($model);
            if ($model->save(false)) {
                $ZULlingkunganriwayat = new \eperencanaan\models\TaForumLingkunganRiwayat();
                $ZULlingkunganriwayat->attributes = $ZULlingkungan->attributes;
                $ZULlingkunganriwayat->Keterangan = "Tambah Usulan dari Kelurahan";
                $ZULaftersimpan = new \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkunganRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Status_Pengelompokan = 0;
                $ZULaftersimpan->Keterangan_Riwayat = "Tambah Usulan";
                $ZULlingkunganriwayat->save(false);
                $ZULaftersimpan->save(false);
                //print($model->Kd_Ta_Forum_Lingkungan);exit;
                return $this->redirect(['create']);
            }
        } else {
            return $this->render('tambah_usulan_lingkungan', [
                        'model' => $model,
                        'NASsatuan' => $NASsatuan,
                        'NASbidangpem' => $NASbidangpem,
                        'NASrpjmd' => $NASrpjmd,
                        'ZULRefLingkungan' => ArrayHelper::map(\common\models\search\RefLingkungan::find()
                                        ->where($models)
                                        ->all(), 'Kd_Lingkungan', 'Nm_Lingkungan'),
                        'lingkungan' => $lingkungan
            ]);
        }
    }

    public function actionSisaUsulan() {
        $posisi = $this->Posisi(); //di ambil dari fungsi Posisi untuk mengambil provinsi sampai kelurahan

        $daftar_terpakai = [];
        //mengambil kd yang sudah ada di cookie
        $datacookie = $this->dataUsulanPilih();
        foreach ($datacookie as $key => $value) {
            $daftar_terpakai[] = $key;
        }

        $sisa = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($posisi)
                ->andWhere(['Status_Pengelompokan' => '0'])
                ->andWhere(['in', 'Status_Penerimaan', [1, 2]])
                ->andWhere(['not in', 'Kd_Ta_Musrenbang_Kelurahan_Verifikasi', $daftar_terpakai])
                ->count();
        echo $sisa;
    }

    public function actionExport() {
        $data = RefKecamatan::find()
                ->all();
        \moonland\phpexcel\Excel::widget([
            'models' => $data,
            'mode' => 'export', //default value as 'export'
            'columns' => ['Kd_Prov','Kd_Kab','Kd_Kec', 'Nm_Kec'], //without header working, because the header will be get label from attribute label. 
            'headers' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3', 'column4' => 'Header Column 4'], 
        ]);
    }

    public function actionModalAmbil() {
        $Posisi = $this->Posisi();
        $kelurahan = RefKelurahan::find()
                    ->where($Posisi)
                    ->all();

        $data_kelurahan=[];

        foreach ($kelurahan as $key => $value) {
            if($value->taMusrenbangKelurahanAcara){
                $Waktu_Mulai = $value->taMusrenbangKelurahanAcara->Waktu_Mulai;
                $Waktu_Selesai = $value->taMusrenbangKelurahanAcara->Waktu_Selesai;
            }
            else{
                $Waktu_Mulai = 0;
                $Waktu_Selesai = 0;
            }

            if($Waktu_Mulai==0 && $Waktu_Selesai==0){
                $data_kelurahan[$key]['Nm_Kel']=$value->Nm_Kel;
                $data_kelurahan[$key]['Status']='Belum Menyelenggarakan';
            }
        }

        return $this->renderajax('modal_ambil',[
                'data_kelurahan' => $data_kelurahan
        ]);
    }

    public function actionLaporan() {

        $data = TaMusrenbang::find()
            ->where(['Kd_User' => Yii::$app->user->identity->id])
            ->all();

        return $this->render('laporan',[
            'data'=>$data,
            ]);
    }

    public function actionLaporanCetak() {
        $dataUser = Yii::$app->user->identity;
        $data = TaMusrenbang::find()
            ->where(['Kd_User' => $dataUser->id])
            ->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan-cetak', ['data' => $data, 'dataUser' => $dataUser, ]),
            'options' => [
                'title' => 'Laporan Pokir',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionLaporanPokir() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchLaporanPokir(Yii::$app->request->queryParams);

        return $this->render('laporan-pokir', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}

