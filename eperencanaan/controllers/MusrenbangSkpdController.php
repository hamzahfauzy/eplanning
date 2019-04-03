<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKecamatan;
use eperencanaan\models\MusrenbangSkpdAcara;
use eperencanaan\models\MusrenbangSkpdMedia;
use eperencanaan\models\search\MusrenbangSkpdMediaSearch;
use eperencanaan\models\TaMusrenbang;
use eperencanaan\models\KamusUsulan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use emusrenbang\models\TaMusrenbangSearch;
use common\models\RefKecamatan;
use common\models\RefJalan;
use common\models\RefLingkungan;
use common\models\RefKelurahan;
use yii\web\UploadedFile;
use common\models\RefBidangPembangunan;
use common\models\RefDapil;
use eperencanaan\models\RefDewan;
use common\models\TaUserDapil;
use common\models\RefMedia;
use common\models\RefKecamatanKriteriaPembobotan;
use common\models\RefForumKriteriaPembobotan;
use common\models\RefSubUnit;
use common\models\User;
use yii\helpers\Json;
use yii\web\Cookie;
use yii\web\CookieCollection;
use common\models\RefRPJMD;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangKecamatanController implements the CRUD actions for TaMusrenbangKecamatan model.
 */
class MusrenbangSkpdController extends Controller {
    //public $layout = "main";

    /**
     * @inheritdoc
     */
    public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
			'Kd_Sub_Unit' => $data['Kd_Sub_Unit'],
        ];

        return $ZULarray;
    }
	
	public function arraymap($data) {
        $ZULarray = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
			'Kd_Sub' => $data['Kd_Sub_Unit'],
        ];

        return $ZULarray;
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    //where provinsi sampai Kecamatan
    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        $pos = [
            'Kd_Urusan' => $kelompok['Kd_Urusan'],
            'Kd_Bidang' => $kelompok['Kd_Bidang'],
            'Kd_Unit' => $kelompok['Kd_Unit'],
			'Kd_Sub' => $kelompok['Kd_Sub_Unit']
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

    /**
     * Lists all TaMusrenbangKecamatan models.
     * @return mixed
     */
	public function Myarraymap($data) {
        $Myarraymap = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
			'Kd_Sub_Unit' => $data['Kd_Sub_Unit']
        ];
 
        return $Myarraymap;
    }
	 
    public function actionIndex() {
        $ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        $su = $this->arraymap(Yii::$app->levelcomponent->getUnit());
        $su = RefSubUnit::find()->where($su)->one();
        $user_kecamatan = explode(" ", $su->Nm_Sub_Unit);
        if($user_kecamatan[0] == "Kecamatan"){
            echo "<script>alert('Username atau Password Salah');location='index.php?r=dashboard/logout';</script>";
        }
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
        $ZULSkpd = $ZULSkpd !== null ? $ZULSkpd : new MusrenbangSkpdAcara();
		$usulanKec = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
                    ->andWhere(['or',
                        ['Kd_Asal_Usulan' => '1'],
                        ['Kd_Asal_Usulan' => '2'],
						['Kd_Asal_Usulan' => '3'],
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kelurahan' => '1'],
						['Status_Penerimaan_Kelurahan' => NULL],
                        ['Status_Penerimaan_Kelurahan' => '2']
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
						//['Status_Penerimaan_Kecamatan' => NULL],
                        ['Status_Penerimaan_Kecamatan' => '2']
                    ])
					 ->andWhere(["<>","Kd_Prioritas_Pembangunan_Daerah",'0'])
					->andwhere(["IS NOT","Skor",NULL])
                    ->count();
					
		$jum2 = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
                    ->andWhere(['or',
                        ['Kd_Asal_Usulan' => '1'],
                        ['Kd_Asal_Usulan' => '2'],
						['Kd_Asal_Usulan' => '3'],
                    ])
                   // ->andWhere(["<>","Kd_Prioritas_Pembangunan_Daerah",'0'])
					->andwhere(["IS NOT","Skor",NULL])
                    ->count();
					
		$usulankec1 = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
					->andwhere(['Kd_Asal_Usulan' => '3'])
					->count();
		//$usulanKec += $usulankec1;
		$usulanPokir = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
                    ->andWhere(['or',
                        ['Kd_Asal_Usulan' => '5'],
                        ['Kd_Asal_Usulan' => '6'],
                        ['Kd_Asal_Usulan' => '7'],
                        ['Kd_Asal_Usulan' => '8']
                    ])
                    ->count();
					
		

        $Posisi = $this->Posisi();


        $jlh_usulan = 1;

        $jlh_usulan_kel = 1;

        $jlh_usulan += 1;
        
        $ZULacara = \eperencanaan\models\MusrenbangSkpdAcara::find()
                ->where($this->Posisi())
                ->andWhere(['Waktu_Selesai' => 0]);

        // $dataSkoring = \eperencanaan\models\TaMusrenbang::find()
        //         ->where(['Status_Penerimaan_Kecamatan' => 0])
        //         ->andWhere(['IS', 'Status_Penerimaan_Kecamatan', NULL])
        //         ->andWhere($this->Posisi())
        //         ->count();

        $dataSkoring = TaMusrenbang::find()
                // ->andFilterWhere(['or',
                //     ['Status_Penerimaan_Kecamatan' => 0],
                //     ['IS', 'Status_Penerimaan_Kecamatan', NULL]
                //     ])
                ->andWhere($this->Posisi())
                ->exists();

        // $jlh_data = TaMusrenbang::find()
        //         ->where($Posisi)
        //         ->exists();

        $jlh_data_skoring = TaMusrenbang::find()
                ->where($Posisi)
                ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2']])
                ->andWhere(['IS', 'Status_Penerimaan_Kecamatan', NULL])
                ->exists();


        //echo "1. $jlh_data  <br/>";
        //echo "2. $jlh_data_skoring  <br/>";
        //die();

        return $this->render('dashboard', [
                    'acara' => $ZULSkpd,
                    'jlh_usulan' => $jlh_usulan,
                    'kel_acara' => $ZULacara,
                    'dataSkoring' => $dataSkoring,
                    'jlh_data_skoring' => $jlh_data_skoring,
					'usulanKec' => $usulanKec,
					'usulanPokir' => $usulanPokir,
					'jum2' => $jum2,
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
        $models = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');

        $model = new TaMusrenbangKelurahan();
        $model->attributes = $models;
        $model->Tanggal = time();

        if ($model->load(Yii::$app->request->post())) {
            $model->Tahun = date('Y');
            // print_r($model);exit;
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);


            //print_r($model);
            if ($model->save(false)) {

                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Keterangan = "Tambah Usulan";
                //$ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->save(false);

                return $this->redirect(['create']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'NASsatuan' => $NASsatuan,
                        'NASbidangpem' => $NASbidangpem,
                        'NASrpjmd' => $NASrpjmd,
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
        return $this->render('rekapitulasi', [
                    'data' => $TaFL,
                    'acara' => $TaFLA,
                    'model' => $ZULmodel
        ]);
    }

    public function actionDokumen() {

        // print_r($this->Posisi());
        // die();

        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getUnit());
        $acara = MusrenbangSkpdAcara::findOne($model);
        $searchModel = new MusrenbangSkpdMediaSearch();
		$refKecamatan = ArrayHelper::map(RefKecamatan::find()->where(["Kd_Prov"=>12,"Kd_Kab"=>9])->all(), 'Kd_Kec', 'Nm_Kec');
        $dataProvider = $searchModel->Samsearch(Yii::$app->request->queryParams, $model);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new \eperencanaan\models\UploadForm();

        return $this->render('dokumen',[
					'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'acara' => $acara,
                    'kecamatan' => $refKecamatan,
                    'model' => $model
					]);
    }

    public function actionMulai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Mulai = time();
        $TaFLA->Tahun = date('Y');
        $TaFLA->save(false);
        return $this->redirect(['musrenbang-skpd/index']);
    }

    public function actionSelesai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
        TaMusrenbangKelurahan::updateAll(['status' => '1'], $model);
        return $this->redirect(['index']);
    }
	
	public function actionHasil(){
		$model = $this->arraymap(Yii::$app->levelcomponent->getUnit());
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
        $ZULSkpd = $ZULSkpd !== null ? $ZULSkpd : new MusrenbangSkpdAcara();
		$forumopd = TaMusrenbang::find()->where($model)->all();
		$RPJMD = RefRPJMD::find()->all();
		
		$modelkecamatan = RefKecamatan::find()
					->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])->all();
					
		return $this->render('hasil', [
						'modelkecamatan'=>$modelkecamatan,
						'model' => $forumopd,
						'rpjmd' => $RPJMD,
						]);
						
//		print_r($forumopd);
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
                'SetHeader' => ['Generated By: Sistem e-Planning Kota Medan||Generated On: ' . date("r")],
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
                'SetHeader' => ['Dicetak dari: Sistem ePlanning Kab. Asahan '.$this->getKota().'||Dicetak tanggal: ' . 
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
	
	
	
	// ======================================================================================= 
	
	
	public function actionKecamatanMasuk(){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
        $ZULSkpd = $ZULSkpd !== null ? $ZULSkpd : new MusrenbangSkpdAcara();
		
		$RPJMD = RefRPJMD::find()->all();
		
		$modelkecamatan = RefKecamatan::find()
					->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])->all();
		$forum_acara = MusrenbangSkpdAcara::find()
					->where($ZULSkpdModel)
					->one();
		return $this->render('kecamatan-masuk', [
						'model' => $ZULSkpdModel,
						'modelkecamatan' => $modelkecamatan,
						'rpjmd' => $RPJMD,
						'acara'=>$forum_acara
						]);
	}

    public function actionCetakUsulanKecamatan($Kd_Kec,$status,$prioritas){
        $ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $kriteria = RefForumKriteriaPembobotan::find()->all();
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
        $status = ($status == 0) ? NULL : $status;
            if($Kd_Kec == 0)
                $Kd_Kec = ['<>','Kd_Kec',$Kd_Kec];
            else
                $Kd_Kec = ['Kd_Kec'=>$Kd_Kec];
            if($status == 3)
                $status = ['or',
                        ['Status_Penerimaan_Skpd' => NULL],
                        ['Status_Penerimaan_Skpd' => '1'],
                        ['Status_Penerimaan_Skpd' => '2'],
						['Status_Penerimaan_Skpd' => '3']
                    ];
            else
                $status = ['Status_Penerimaan_Skpd' => $status];
        
        if($prioritas == 0)
            $prioritas = ['<>','Kd_Prioritas_Pembangunan_Daerah',$prioritas];
        else
            $prioritas = ['Kd_Prioritas_Pembangunan_Daerah'=>$prioritas];
        
        $usulanKec = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
                    ->andwhere($Kd_Kec)
                    ->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
                    ->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
                    ->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
                    ->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
                   // ->andwhere(['<>','Skor',"NULL"])
                    ->andWhere($status)
                    ->andWhere($prioritas)
                    ->andWhere(['or',
                        ['Kd_Asal_Usulan' => '1'],
                        ['Kd_Asal_Usulan' => '2'],
                        ['Kd_Asal_Usulan' => '3']
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kelurahan' => '1'],
                        ['Status_Penerimaan_Kelurahan' => NULL],
                        ['Status_Penerimaan_Kelurahan' => '2']
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        //['Status_Penerimaan_Kecamatan' => NULL],
                        ['Status_Penerimaan_Kecamatan' => '2']
                    ])
					->andwhere(["IS NOT","Skor",NULL])
                    ->orderBy(["Skor"=>SORT_DESC,'Urutan_Prioritas'=>SORT_ASC])
					//->orderBy(["Skor"=>SORT_DESC,"Kd_Asal_Usulan"=>SORT_DESC])//RG
                    ->all();
					
					
        return $this->renderpartial("cetak-usulan-kecamatan",[
                            'data' => $usulanKec, 
                            'kriteria'=>$kriteria
                            ]);
    }

    public function actionCetakUsulanPokir($Kd_Kec,$status,$prioritas,$pokir){

        $ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
        $kriteria = RefForumKriteriaPembobotan::find()->all();
        $status = ($status == 0) ? NULL : $status;
            if($status == 4)
                $status = ['or',
                        ['Status_Penerimaan_Skpd' => NULL],
                        ['Status_Penerimaan_Skpd' => '1'],
                        ['Status_Penerimaan_Skpd' => '2'],
                        ['Status_Penerimaan_Skpd' => '3']
                    ];
            else
                $status = ['Status_Penerimaan_Skpd' => $status];
            
        if($prioritas == 0)
            $prioritas = ['<>','Kd_Prioritas_Pembangunan_Daerah',$prioritas];
        else
            $prioritas = ['Kd_Prioritas_Pembangunan_Daerah'=>$prioritas];
        
        if($Kd_Kec == 0)
            $Kd_Kec = ['<>','Kd_Kec',$Kd_Kec];
        else
            $Kd_Kec = ['Kd_Kec'=>$Kd_Kec];
		
		if($pokir == 0 || $pokir == ""){
			$xUser = [];
		}
		else
		{
		$data1=TaUserDapil::find()
		->where (['Kd_Dewan'=>$pokir])
						//			 ->where (['Kd_User'=>$rows['Kd_User']])
		->andWhere(['Tahun'=>date('Y')])
		->one(); 
									
									 $data2=RefDewan::find()
									->where (['Kd_Dewan'=>$data1['Kd_Dewan']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one();
		$xUser=['Kd_User'=>$data1['Kd_User']];
		}
        
        $usulanPokir = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
                    ->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
                    ->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
                    ->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
                    ->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
                    ->andwhere($status)
                    ->andwhere($prioritas)
                    ->andwhere($Kd_Kec)
					->andwhere($xUser)
                    ->andWhere(['or',
                        ['Kd_Asal_Usulan' => '5'],
                        ['Kd_Asal_Usulan' => '6'],
                        ['Kd_Asal_Usulan' => '7'],
                        ['Kd_Asal_Usulan' => '8']
                    ])
                    ->orderBy(["Skor"=>SORT_DESC,'Urutan_Prioritas'=>SORT_ASC])
                    ->all();

        return $this->renderpartial("cetak-usulan-kecamatan",[
                            'data' => $usulanPokir,
							'pokir_d' => $pokir,
                            'kriteria'=>$kriteria
                            ]);
    }
	
	public function actionPokirMasuk(){
		$RPJMD = RefRPJMD::find()->all();
        $modelkecamatan = RefKecamatan::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])->all();
        $modelpokir = RefDewan::find()
                    ->all();
					
		// new model pokir
		$modelpokir = $this->PokirModel();
        return $this->render('pokir-masuk', [
                       'modelkecamatan' => $modelkecamatan,
					   'modelpokir' => $modelpokir,
                        'rpjmd' => $RPJMD,
                        ]);

	}
	
	public function PokirModel(){
		$RPJMD = RefRPJMD::find()->all();
        $modelkecamatan = RefKecamatan::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])->all();
        $modelpokir = RefDewan::find()
                    ->all();
					
		$taUserDapil = TaUserDapil::find()->all();
		$maps = [];
		$pokir_user_id = [];
		$usulanPokir = TaMusrenbang::find()->where([">=","Kd_Asal_Usulan",5])->groupBy("Kd_User")->all();
		foreach($usulanPokir as $pokir)
		{
			$pokir_user_id[] = $pokir->Kd_User;
		}
		natsort($pokir_user_id);
		
		foreach($taUserDapil as $userDapil)
		{
			if(in_array($userDapil->Kd_User,$pokir_user_id))
			{
				$maps[] = [
					"Kd_User" => $userDapil->Kd_User,
					"Kd_Dapil" => $userDapil->Kd_Dapil,
					"Kd_Dewan" => $userDapil->Kd_Dewan,
				];
			}
		}
		
		$new_model_pokir = [];
		
		foreach($maps as $map)
		{
			$old_map = $map;
			unset($map["Kd_User"]);
			$pokir = RefDewan::find()
					->where($map)
					->one();
			
			$new_model_pokir[] = ["pokir"=>$pokir,"Kd_User"=>$old_map["Kd_User"]];
		}
		return $new_model_pokir;
	}
	
	public function actionGetAsalUsulan($id){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$usulan = TaMusrenbang::find()
                  ->where(['id' => $id])
                  ->one();
		
		$Kd_Kec = @$usulan->Kd_Kec;
		$Kd_Kel = @$usulan->Kd_Kel;
		$Kd_Urut_Kel = @$usulan->Kd_Urut_Kel;
		$Kd_Lingkungan = @$usulan->Kd_Lingkungan;
			$modelKec = RefKecamatan::find()
					 ->where(['Kd_Prov' => 12])
					 ->andWhere(['Kd_Kab' => 9])
					 ->andWhere(['Kd_Kec' => $Kd_Kec])
					 ->one();
			
			$modelKel = RefKelurahan::find()
					 ->where(['Kd_Prov' => 12])
					 ->andWhere(['Kd_Kab' => 9])
					 ->andWhere(['Kd_Kec' => $Kd_Kec])
					 ->andWhere(['Kd_Kel' => $Kd_Kel])
					 ->andWhere(['Kd_Urut' => $Kd_Urut_Kel])
					 ->one();
			
			$model = RefLingkungan::find()
					 ->where(['Kd_Prov' => 12])
					 ->andWhere(['Kd_Kab' => 9])
					 ->andWhere(['Kd_Kec' => $Kd_Kec])
					 ->andWhere(['Kd_Kel' => $Kd_Kel])
					 ->andWhere(['Kd_Urut_Kel' => $Kd_Urut_Kel])
					 ->andWhere(['Kd_Lingkungan' => $Kd_Lingkungan])
					 ->one();
					 
			$out = $model->Nm_Lingkungan;
			$out .= "<br>Desa/Kel. ".$modelKel->Nm_Kel;
			$out .= "<br>Kec. ".$modelKec->Nm_Kec;
		echo $out;
		
	}
	
	public function actionGetAsalUsulanPokir($id){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$usulan = TaMusrenbang::find()
                  ->where(['id' => $id])
                  ->one();
		
		$Kd_Kec = @$usulan->Kd_Kec;
		
		$User = User::find()->where(["id" => $usulan->Kd_User])->one();
		$modelKec = RefKecamatan::find()
					 ->where(['Kd_Prov' => 12])
					 ->andWhere(['Kd_Kab' => 9])
					 ->andWhere(['Kd_Kec' => $Kd_Kec])
					 ->one();
		$out = ["Kecamatan"=>$modelKec->Nm_Kec, "Username"=>$User->username];
		echo \yii\helpers\Json::encode($out);
		
	}
	
	public function actionGetUsulanKecamatan($Kd_Kec, $status, $prioritas){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$status = ($status == 0) ? NULL : $status;
			if($Kd_Kec == 0)
				$Kd_Kec = ['<>','Kd_Kec',$Kd_Kec];
			else
				$Kd_Kec = ['Kd_Kec'=>$Kd_Kec];
			if($status == 3)
				$status = ['or',
                        ['Status_Penerimaan_Skpd' => '0'],
                        ['Status_Penerimaan_Skpd' => '1'],
                        ['Status_Penerimaan_Skpd' => '2'],
						['Status_Penerimaan_Skpd' => '3']
                    ];
			else
				$status = ['Status_Penerimaan_Skpd' => $status];
		
		if($prioritas == 0)
			$prioritas = ['<>','Kd_Prioritas_Pembangunan_Daerah',$prioritas];
		else
			$prioritas = ['Kd_Prioritas_Pembangunan_Daerah'=>$prioritas];
		
		$usulanKec = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere($Kd_Kec)
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
					->andWhere($status)
					->andWhere($prioritas)
                    // ->andWhere(['or',
                        // ['Kd_Asal_Usulan' => '1'],
                        // ['Kd_Asal_Usulan' => '2'],
                        // ['Kd_Asal_Usulan' => '3']
                    // ])
                    // ->andWhere(['or',
                        // ['Status_Penerimaan_Kelurahan' => '1'],
                        // ['Status_Penerimaan_Kelurahan' => NULL],
                        // ['Status_Penerimaan_Kelurahan' => '2']
                    // ])
                    // ->andWhere(['or',
                        // ['Status_Penerimaan_Kecamatan' => '1'],
                        // //['Status_Penerimaan_Kecamatan' => NULL],
                        // ['Status_Penerimaan_Kecamatan' => '2']
                    // ])
					 // ->andWhere(['or',
                        // ['Status_Penerimaan_Skpd' => '1'],
                        // ['Status_Penerimaan_Skpd' => NULL],
                        // ['Status_Penerimaan_Skpd' => '2']
                    // ])
					->andwhere(["IS NOT","Skor",NULL])//add by RG
					//->andwhere(["IS NOT","Urutan_Prioritas",NULL])//add by HF
					->orderBy(['Status_Penerimaan_Skpd'=>SORT_DESC,'Skor'=>SORT_DESC,'Urutan_Prioritas'=>SORT_ASC])//RG
                    ->all();
					
		$_data = [];
		$_id = [];
		$_id_except = [];
		foreach($usulanKec as $usulan)
		{
			if(!empty($usulan->Kd_Kamus_Usulan) || $usulan->Kd_Kamus_Usulan != NULL)
			{
				$kd_kamus = $usulan->Kd_Urusan."/".$usulan->Kd_Bidang."/".$usulan->Kd_Unit."/".$usulan->Kd_Sub;
				$kamus = KamusUsulan::find()->where(["kode_kamus"=>$usulan->Kd_Kamus_Usulan])->one();
				if(!empty($kamus) && $kd_kamus == $kamus->SKPD)
				{
					$_data[] = $usulan;
					$_id[] = $usulan->id;
				}
				else
				{
					$_id_except[] = $usulan->id;
				}
			}else{
				$_data[] = $usulan;
				$_id[] = $usulan->id;
			}
		}
					
		$forum_acara = MusrenbangSkpdAcara::find()
					->where($ZULSkpdModel)
					->one();
		
		return $this->renderpartial("getusulankecamatan",[
							'data' => $_data,
							'acara'=>$forum_acara
							]);
	}
	
	public function actionPatch()
	{
		// $ta_musrenbang = TaMusrenbang::find()->all();
		// pokir
		$ta_musrenbang = TaMusrenbang::find()->where(['>=','Kd_Asal_Usulan',5])->all();
		foreach($ta_musrenbang as $usulan)
		{
			if($usulan->Kd_Kamus_Usulan == null || empty($usulan->Kd_Kamus_Usulan))
			{
				$kamus = KamusUsulan::find()->where(["nama_kamus"=>$usulan->Jenis_Usulan])->one();
				$usulan->Kd_Kamus_Usulan = $kamus->kode_kamus;
				$usulan->Def_Operasional = $kamus->Defenisi_Operasional;
				$usulan->save(false);
				echo $usulan->Jenis_Usulan." ".$usulan->id."<br>";
			}
			// $opd = $usulan->Kd_Urusan."/".$usulan->Kd_Bidang."/".$usulan->Kd_Unit."/".$usulan->Kd_Sub;
			// $kamus = KamusUsulan::find()->where(["nama_kamus"=>$usulan->Jenis_Usulan])->one();
			// if(!empty($kamus))
			// {
				// print_r($kamus);
				// if($opd != $kamus->SKPD)
				// {
					// // $new_skpd = explode("/",$kamus->SKPD);
					// // $usulan->Kd_Urusan = $new_skpd[0];
					// // $usulan->Kd_Bidang = $new_skpd[1];
					// // $usulan->Kd_Unit = $new_skpd[2];
					// // $usulan->Kd_Sub = $new_skpd[3];
					// // $usulan->save(false);	
					// echo $usulan->Jenis_Usulan." ".$usulan->id."<br>";
				// }
			// }
		}

	}
	
	public function actionGetHasil($Kd_Kec, $status, $prioritas){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$status = ($status == 0) ? NULL : $status;
			if($Kd_Kec == 0)
				$Kd_Kec = ['<>','Kd_Kec',$Kd_Kec];
			else
				$Kd_Kec = ['Kd_Kec'=>$Kd_Kec];
			if($status == 0)
				$status = ['or',
                        ['Status_Penerimaan_Skpd' => '1'],
                        ['Status_Penerimaan_Skpd' => '2'],
                        ['Status_Penerimaan_Skpd' => '3']
                    ];
			else
				$status = ['Status_Penerimaan_Skpd' => $status];
		
		if($prioritas == 0)
			$prioritas = ['<>','Kd_Prioritas_Pembangunan_Daerah',$prioritas];
		else
			$prioritas = ['Kd_Prioritas_Pembangunan_Daerah'=>$prioritas];
		
		$usulanKec = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere($Kd_Kec)
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
					->andWhere($status)
					->andWhere($prioritas)
					->orderBy(["Skor"=>SORT_DESC])
                    ->all();
		return $this->renderpartial("gethasil",[
							'data' => $usulanKec
							]);
	}
	
	public function actionGetUsulanPokir($status,$prioritas,$kec,$pokir){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$status = ($status == 0) ? NULL : $status;
			if($status == 4)
				$status = ['>=','Status_Penerimaan_Skpd',0];
			else
				$status = ['Status_Penerimaan_Skpd' => $status];
			
		if($prioritas == 0)
			$prioritas = ['<>','Kd_Prioritas_Pembangunan_Daerah',$prioritas];
		else
			$prioritas = ['Kd_Prioritas_Pembangunan_Daerah'=>$prioritas];
		
		if($kec == 0)
			$kec = ['<>','Kd_Kec',$kec];
		else
			$kec = ['Kd_Kec'=>$kec];
		
		
		
		if($pokir == 0 || $pokir == ""){
			$xUser = [];
		}
		else
		{
			$xUser = ["Kd_User" => $pokir];
		// $data1=TaUserDapil::find()
		// ->where (['Kd_Dewan'=>$pokir])
						// //			 ->where (['Kd_User'=>$rows['Kd_User']])
		// ->andWhere(['Tahun'=>date('Y')])
		// ->one(); 
		
			// $data2=RefDewan::find()
			// ->where (['Kd_Dewan'=>$data1->Kd_Dewan])
			// ->andWhere(['Tahun'=>date('Y')])
			// ->one();
			
		// $xUser=['Kd_User'=>$data1['Kd_User']];
		}
		
        $usulanPokir = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Urusan' => $ZULSkpdModel['Kd_Urusan']])
					->andwhere(['Kd_Bidang' => $ZULSkpdModel['Kd_Bidang']])
					->andwhere(['Kd_Unit' => $ZULSkpdModel['Kd_Unit']])
					->andwhere(['Kd_Sub' => $ZULSkpdModel['Kd_Sub_Unit']])
					->andwhere($status)
					->andwhere($prioritas)
					->andwhere($kec)
					//->andwhere(['Kd_User' => $data1['Kd_User']])
					->andwhere($xUser)
                    ->andWhere(['>=','Kd_Asal_Usulan',5])
					->orderBy(["Skor"=>SORT_DESC,"Kd_Asal_Usulan"=>SORT_DESC])//RG;
                    ->all();
					
		
		
		$dapil = function($Kd_User){
			$model = TaUserDapil::find()->where(['Kd_User'=>$Kd_User])->one();
			return $model->refDapil->Nm_Dapil;
		};
		
		$fraksi = function($Kd_User){
			$model = TaUserDapil::find()->where(['Kd_User'=>$Kd_User])->one();
			return $model->refFraksi->Nm_Fraksi;
		};
		
		return $this->renderpartial("getusulanpokir",[
							'data' => $usulanPokir,
							'dapil'=>$dapil,
							'fraksi'=>$fraksi,
							'pokir_d'=>$pokir,
							]);
	}
	
	public function actionShowUsulanKecamatan($id){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$usulanKec = TaMusrenbang::find()
                    ->where(['id' => $id])
                    ->all();
		return $this->renderpartial("showusulankecamatan",[
							'data' => $usulanKec,
							]);
	}
	
	public function actionShowUsulanPokir($id){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$usulanKec = TaMusrenbang::find()
                    ->where(['id' => $id])
                    ->all();
		return $this->renderpartial("showusulanpokir",[
							'data' => $usulanKec,
							]);
	}
	
	//public function actionUsulanTerima($id,$alasan){
		public function actionUsulanTerima($id,$alasan,$urutan){ //Kode 1 Rencana ubah prioritas
		$model = TaMusrenbang::findOne(['id' => $id]);
		$model->Status_Penerimaan_Skpd = 1;
		$model->Alasan_Skpd = $alasan;
		$model->Urutan_Prioritas = $urutan; //Kode 2 rencana ubah prioritas
		if($model->save(false))
			if($model->Kd_Asal_Usulan >= 5)
				echo 1; //$this->redirect(['pokir-masuk', 'pesan' => 'berhasil']);
			else
				echo 1; //$this->redirect(['kecamatan-masuk', 'pesan' => 'berhasil']);
		else
			echo 0;
		// $this->redirect(['kecamatan-masuk', 'pesan' => 'berhasil']);
		return;
	}
	
	public function actionUsulanTolak($id,$alasan){
		$model = TaMusrenbang::findOne(['id' => $id]);
		$model->Status_Penerimaan_Skpd = 3;
		$model->Alasan_Skpd = $alasan;
		if($model->save(false))
			if($model->Kd_Asal_Usulan >= 5)
				echo 1; //$this->redirect(['pokir-masuk', 'pesan' => 'berhasil']);
			else
				echo 1; //$this->redirect(['kecamatan-masuk', 'pesan' => 'berhasil']);
		else
			echo 0;
		// $this->redirect(['kecamatan-masuk', 'pesan' => 'berhasil']);
		return;
		if($model->save(false))
			if($model->Kd_Asal_Usulan >= 5)
				return $this->redirect(['pokir-masuk', 'pesan' => 'berhasil']);
			else
				return $this->redirect(['kecamatan-masuk', 'pesan' => 'berhasil']);
	}
	
	public function actionModalSkoring($id)
    {
        $kriteria = RefForumKriteriaPembobotan::find()->all();

        $model = TaMusrenbang::findOne($id);
        $Kd_Pem = $model->Kd_Pem;
        $Bidang_Pembangunan = $model->bidangPembangunan->Bidang_Pembangunan;
        
        return $this->renderAjax('skoring',[
                'kriteria' => $kriteria,
                'Kd_Pem' => $Kd_Pem,
                'Bidang_Pembangunan' => $Bidang_Pembangunan,
                'id' => $id,
           ]);
    }
	
	public function actionGetSkor($id){
		$ZULSkpdModel = $this->Myarraymap(Yii::$app->levelcomponent->getUnit());
        //unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULSkpd = \eperencanaan\models\MusrenbangSkpdAcara::findOne($ZULSkpdModel);
		$usulanKec = TaMusrenbang::find()
                    ->where(['id' => $id])
                    ->all();
		return $this->renderpartial("get-skor",[
							'data' => $usulanKec,
							]);
	}
	
	public function actionSkoringSimpan()
    {
        $request = Yii::$app->request;
        $bobot = $request->post('bobot');
        $id = $request->post('id');
        $skor = $request->post('skor');
        //echo $id;
        $data = serialize($bobot);
        //echo $data;
        $model = TaMusrenbang::findOne($id);
        //echo $model->id;
        $model->Rincian_Skor = $data;
        $model->Skor = $skor;
        $model->Status_Penerimaan_Kecamatan = '1'; //diterima
        //echo $model->Rincian_Skor;

        // $riwayat = new TaMusrenbangRiwayat();
        // $riwayat->attributes = $model->attributes;
        // $riwayat->Keterangan = "Skoring";
        // $riwayat->save(false);

        if ($model->save(false)) {
            echo "Skor Disimpan";
        }
        else{
            echo "Simpan Skor Gagal";
        }
        
    }

    public function actionUbah($Kd_Ta_Musrenbang_Kelurahan) {
        $model = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $model->Tanggal = time();
        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');

        if ($model->load(Yii::$app->request->post())) {
            //$model->Jumlah;

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);


            if ($model->save(false)) { 
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
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

    public function actionHapus($Kd_Ta_Musrenbang_Kelurahan) {
        //echo $Kd_Ta_Forum_Lingkungan;
        $ZULmodel = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
        $ZULaftersimpan->attributes = $ZULmodel->attributes;
        $ZULaftersimpan->Status_Survey = 5;
        $ZULaftersimpan->Tanggal = time();
        $ZULaftersimpan->Keterangan = "Hapus Usulan";
        $ZULaftersimpan->insert(false);
        $ZULmodel->delete();
        return $this->redirect(['rekapitulasi']);
    }

    protected function cariModel($Kd_Ta_Musrenbang_Kelurahan) {
        if (($model = TaMusrenbangKelurahan::findOne(['Kd_Ta_Musrenbang_Kelurahan' => $Kd_Ta_Musrenbang_Kelurahan])) !== null) {
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
            $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangKelurahanRiwayat();
            $ZULaftersimpan->attributes = $model->attributes;
            $ZULaftersimpan->Status_Survey = 5;
            $ZULaftersimpan->Keterangan = "Ubah Koordinat Usulan";
            $ZULaftersimpan->Tanggal = time();
            $ZULaftersimpan->save(false);
            return $this->redirect(['usulankelurahan']);
        }
    }

    public function actionLihatriwayat($kode2) {
        $NASRiwayat = TaMusrenbangKelurahanRiwayat::find()
                        ->where([
                                'Kd_Ta_Musrenbang_Kelurahan' => $kode2,
                            ])
                        ->all();
      
        return $this->renderPartial('modal_lihat_riwayat', [


                    'data_riwayat' => $NASRiwayat,
                        //'cek_usulan' =>$NASUsulan
        ]);
    }

    public function actionLihatdokumen($kode) {
        $PC_Dokumen = TaUsulanKelurahanMedia::find()
                ->where([
                    'Kd_Ta_Musrenbang_Kelurahan' => $kode,
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
	
	public function actionUnduh() {
        //print ("a");exit;
        // $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getUnit());
        $acara = MusrenbangSkpdAcara::findOne($Posisi);
        //print_r($acara);exit;
        // $searchModel = new \eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch();
        // $dataProvider = $searchModel->ZULsearch(Yii::$app->request->queryParams, $ZULUser);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);

        $model = new \eperencanaan\models\UploadForm();
        if (Yii::$app->request->isPost) {
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Berita Acara";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->namePi]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Bukti Undangan";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->nameTandaTerima]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Tanda Terima";
                    if ($TaFLM->save(false)) {
                        
                    }
                }
            }
        
        }
        
        return $this->redirect(['musrenbang-skpd/dokumen']);
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
	
	public function actionShow(){
		$Posisi = $this->Posisi();
        $skpd = RefSubUnit::find()
                    ->where($Posisi)
                    ->all();

        $data=[];

        foreach ($skpd as $key => $value) {
            if($value->taMusrenbangSkpdAcara){
                $Waktu_Mulai = $value->taMusrenbangSkpdAcara->Waktu_Mulai;
                $Waktu_Selesai = $value->taMusrenbangSkpdAcara->Waktu_Selesai;
            }
            else{
                $Waktu_Mulai = 0;
                $Waktu_Selesai = 0;
            }

            if($Waktu_Mulai==0 && $Waktu_Selesai==0){
                //$data[$key]['Nm_Kel']=$value->Nm_Kel;
                //$data[$key]['Status']='Belum Menyelenggarakan';
            }
        }
		

        return $this->renderajax('modal_ambil',[
                'data' => $data
        ]);
	}
}

