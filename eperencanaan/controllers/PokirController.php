<?php

namespace eperencanaan\controllers;

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
use common\models\TaPokirReses;
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
use eperencanaan\models\TaPokirAcara;
use eperencanaan\models\search\TaPokirMediaSearch; 
use eperencanaan\models\TaUserDapil;
use eperencanaan\models\TaDapil;
use eperencanaan\models\RefDewan;
use eperencanaan\models\TaMusrenbangRiwayat;
use common\models\RefStandardSatuan;
use common\models\RefUnit;
use eperencanaan\models\KamusUsulan;

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

    public function getDapilKelompok_3(){
        $dapil = $this->getAsalDapil();
        $array = ['or'];
        if ($dapil)
        foreach ($dapil->kdTaDapil as $key => $value){
            array_push($array, ['and',['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Prov' => $value['Kd_Prov']],
                    ['Kd_Kab' => $value['Kd_Kab']],
                    ['Kd_Kec' => $value['Kd_Kec']],
            
            ]);
        }
        return $array;
    }
    /**
     * Lists all TaMusrenbangKecamatan models.
     * @return mixed
     */

    public function actionIndex() {
        $user       = Yii::$app->user->identity->id;
        //echo $user;
        //return;
        $TaPokirReses = TaPokirReses::find()->one();
        $Asal_Reses = $TaPokirReses->Masa_Reses+4;
        $jlh_usulan = TaMusrenbang::find()
                        ->where(['Kd_User' => $this->Kd_User()])
                        ->andwhere(['Kd_Asal_Usulan' => $Asal_Reses])
                        ->count();
        $jlh_usulan_semua = TaMusrenbang::find()
                        ->where(['Kd_User' => $this->Kd_User()])
                        ->count();
        $ZULacara   = TaPokirAcara::find()->where(['Kd_User' => $this->Kd_User(),'Masa_Reses'=>$TaPokirReses->Masa_Reses])->one();
        $ZULacara   = $ZULacara != null ? $ZULacara : new TaPokirAcara();
        // $Dapil      = TaUserDapil::find(['Kd_User' => $this->Kd_User()])->one();
        $Dapil      = TaUserDapil::find()->where(['Kd_User' => $user])->one();
        $DapilKec   = TaDapil::find()
                        ->andwhere(['Kd_Dapil' => $Dapil->Kd_Dapil])
                        ->all();
		
        return $this->render('dashboard', [
                    'acara'         => $ZULacara,
                    'jlh_usulan'    => $jlh_usulan,
                    'jlh_usulan_semua'    => $jlh_usulan_semua,
                    'Dapil'         => $Dapil,
                    'DapilKec'      => $DapilKec,
					
                    'reses'         => $TaPokirReses
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
        $Kolom = Yii::$app->pengaturan;
        $cari = [
            'Tahun' => $Kolom->Kolom('Tahun'),
            'Kd_Prov' => $Kolom->Kolom('Kd_Prov'),
            'Kd_Kab' => $Kolom->Kolom('Kd_Kab'),
        ];
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $user           = (Yii::$app->user->identity->id);
        $model          = new TaMusrenbang();

        $NASbidangpem   = ArrayHelper::map(RefBidangPembangunan::find()
                        ->all(), 
                        'Kd_Pem', 'Bidang_Pembangunan');

        $NASsatuan      = ArrayHelper::map(RefStandardSatuan::find()
                        ->orderBy('Uraian')
                        ->all(), 
                        'Kd_Satuan', 'Uraian');

        $NASrpjmd       = ArrayHelper::map(RefRPJMD::find()
                        ->all(), 
                        'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
        $Dapil      = TaUserDapil::find()->where(['Kd_User' => $user])->one();
        $DapilKec   = TaDapil::find()
                        ->andwhere(['Kd_Dapil' => $Dapil->Kd_Dapil])
                        ->all();
		$data_kec = [];
		if ($Dapil->Kd_Dewan==46) //Kode 46 adalah kode Badan Anggaran agar semua kecamatan ditampilkan. Jika Kode Banggar Berubah maka kode ini harus diganti juga
		{
              $data_kec       = ArrayHelper::map(RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab]) 
                        ->all(), 
                        'Kd_Kec', 'Nm_Kec');
		}
		else
		{
		
        foreach ($DapilKec as $val) {
        	$data_kec[$val->refKecamatan->Kd_Kec] = $val->refKecamatan->Nm_Kec;
        }
		}
        $unit           = RefSubUnit::find()
                        ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
                        ->andwhere(['!=', 'Nm_Sub_Unit', ''])
                        ->orderby('Nm_Sub_Unit')
                        ->all();

        $dataunit = [];
        foreach ($unit as $pil) {
            $val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
            $dataunit[$val_skpd]=$pil->Nm_Sub_Unit;
        }
                    
        $model = new TaMusrenbang();
        $model->Kd_Prov = $Kd_Prov;
        $model->Kd_Kab = $Kd_Kab;
        $model->Tanggal = time();
        $model->Kd_User = $user;

        if ($model->load(Yii::$app->request->post())) {

            $TaPokirReses = TaPokirReses::find()->one();
            $Kd_Asal_Usulan = ($TaPokirReses->Masa_Reses + 4);
            $model->Tahun = date('Y');
            $model->Kd_Klasifikasi  = 0;
			$model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Kd_Asal_Usulan  = $Kd_Asal_Usulan;

            $request    = Yii::$app->request;
            $skpd       = $request->post('skpd');
            $skpd_arr   = explode("|", $skpd);
            
            $model->Kd_Urusan = $skpd_arr[0];
            $model->Kd_Bidang = $skpd_arr[1];
            $model->Kd_Unit = $skpd_arr[2];
            $model->Kd_Sub = $skpd_arr[3];

            if ($model->save(false)) {
                $model->Kd_User = $user;
                $ZULaftersimpan = new TaMusrenbangRiwayat();
                $ZULaftersimpan->attributes         = $model->attributes;
                $ZULaftersimpan->Ta_Musrenbang_Id   = $model->id;
                $ZULaftersimpan->Status_Survey      = 5;
                $ZULaftersimpan->Keterangan         = "Tambah Usulan";
                $ZULaftersimpan->Tanggal            = time();
                $ZULaftersimpan->save(false);

                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'NASbidangpem' =>$NASbidangpem,
                'NASsatuan'=> $NASsatuan,
                'NASrpjmd' => $NASrpjmd,
                'dataunit' => $dataunit,
                'NASsatuan' => $NASsatuan,
                'data_kec' => $data_kec,
				'SubUnit'=>'',
				
            ]);
        }
    }

    public function actionUbah($Kd_Pokir) {

        $model = $this->cariModel($Kd_Pokir);
        $model->Tanggal = time();
		$SubUnit = $model->Kd_Urusan.'|'.$model->Kd_Bidang.'|'.$model->Kd_Unit.'|'.$model->Kd_Sub;

        $ZULbidangpembangunan = ArrayHelper::map(RefBidangPembangunan::find()
                                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');

        $ZULsatuan = ArrayHelper::map(RefStandardSatuan::find()
                    ->orderBy('Uraian')->all(), 
                    'Kd_Satuan', 'Uraian');
        
        $NASrpjmd = ArrayHelper::map(RefRPJMD::find()
                    ->all(), 
                    'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');

        $ZULunit = ArrayHelper::map(RefUnit::find()
                    ->all(),
                    'Nm_Unit', 'Nm_Unit');
					
		$unit           = RefSubUnit::find()
                        ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
                        ->andwhere(['!=', 'Nm_Sub_Unit', ''])
                        ->orderby('Nm_Sub_Unit')
                        ->all(); 

        $dataunit = [];
        foreach ($unit as $pil) {
            $val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
            $dataunit[$val_skpd]=$pil->Nm_Sub_Unit;
        }
		
		// $user           = (Yii::$app->user->identity->id);
		// if ($user=="" || empty($user))
		// {
				$xx=ArrayHelper::map(TaMusrenbang::find()
                        ->where(['id' => $Kd_Pokir])
                        ->all(), 
                        'Kd_User','Kd_User'); 
				$Dapil      = TaUserDapil::find()->where(['Kd_User' => $xx])->one();
		// }
		// else
		// {
		///	 $Dapil      = TaUserDapil::find()->where(['Kd_User' => $user])->one();
		// }
        
        $DapilKec   = TaDapil::find()
                        ->andwhere(['Kd_Dapil' => @$Dapil->Kd_Dapil])
                        ->all();
		$data_kec = [];
		
        
		
		if (@$Dapil->Kd_Dewan==46) //Kode 46 adalah kode Badan Anggaran agar semua kecamatan ditampilkan. Jika Kode Banggar Berubah maka kode ini harus diganti juga
		{
        $data_kec       = ArrayHelper::map(RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->all(), 
                        'Kd_Kec', 'Nm_Kec'); 
		}
		else
		{
			foreach ($DapilKec as $val) {
        	$data_kec[$val->refKecamatan->Kd_Kec] = $val->refKecamatan->Nm_Kec;
        }
		}
        
        if ($model->load(Yii::$app->request->post())) {

            $model->Jumlah          = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan    = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total     = str_replace(".", "", $model->Harga_Total);
			$request = Yii::$app->request;
            $skpd = $request->post('skpd');
            $skpd_arr = explode("|", $skpd);
            
            $model->Kd_Urusan = $skpd_arr[0];
            $model->Kd_Bidang = $skpd_arr[1];
            $model->Kd_Unit = $skpd_arr[2];
            $model->Kd_Sub = $skpd_arr[3];
            if ($model->save(false)) {
                $ZULaftersimpan = new TaMusrenbangRiwayat();
                $ZULaftersimpan->attributes         = $model->attributes;
                $ZULaftersimpan->Ta_Musrenbang_Id   = $model->id;
                $ZULaftersimpan->id                 = '';
                $ZULaftersimpan->Keterangan         = "Ubah Usulan";
                $ZULaftersimpan->insert(false);
                return $this->redirect(['rekapitulasi', 'pesan' => 'berhasil']);
            }
        } 
        else {
            return $this->render('create', [
                        'model' => $model,
                        'NASbidangpem' => $ZULbidangpembangunan,
                        'NASsatuan' => $ZULsatuan,
                        'NASrpjmd' => $NASrpjmd,
                        'dataunit' => $dataunit,
                        'data_kec' => $data_kec,
						'SubUnit' => $SubUnit
            ]);
        }
    }

    public function actionHapus($Kd_Pokir) {
        $model      = $this->cariModel($Kd_Pokir);
        $riwayat    = new TaMusrenbangRiwayat();
        $riwayat->attributes        = $model->attributes;
        $riwayat->Ta_Musrenbang_Id  = $model->id;
        $riwayat->Status_Survey     = 5;
        $riwayat->Tanggal           = time();
        $riwayat->Keterangan        = "Hapus Usulan";
        $riwayat->insert(false);
        if ($model->delete()) {
            Yii::$app->session->addFlash('success', 'Data berhasil dihapus!');
            return $this->redirect(['rekapitulasi']);
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
        $TaPokirReses = TaPokirReses::find()->one();
        $Kd_Asal_Usulan = $TaPokirReses->Masa_Reses+4;
        $acara = TaPokirAcara::find()->where(['Kd_User' => $this->Kd_User(),'Masa_Reses'=>$TaPokirReses->Masa_Reses])->one();
        $TaFL = TaMusrenbang::find()
                ->where(['Kd_User' => $this->Kd_User()])
                ->andWhere(['Kd_Asal_Usulan' => $Kd_Asal_Usulan])
                ->all();
        $UsulanSemua = TaMusrenbang::find()
                ->where(['Kd_User' => $this->Kd_User()])
                ->all();
		$SubUnit = function($urusan,$bidang,$unit,$sub_unit){
			$model = RefSubUnit::find()
								->where([
										'Kd_Urusan'=>$urusan,
										'Kd_Bidang'=>$bidang,
										'Kd_Unit'=>$unit,
										'Kd_Sub'=>$sub_unit
										])->one();
			return $model->Nm_Sub_Unit;
		};
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
                    'acara' => $acara,
                    'UsulanSemua' => $UsulanSemua,
					'SubUnit' => $SubUnit
        ]);
    }

    public function actionDokumen() {
        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        // $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $model['Kd_User'] = $this->Kd_User();
        $acara = TaPokirAcara::findOne($model);
        $searchModel = new TaPokirMediaSearch();
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
        $TaFLA = new TaPokirAcara();
        if ($TaFLA->load(Yii::$app->request->post())) {
            $TaFLA->Kd_User = $this->Kd_User();
            $TaFLA->Waktu_Mulai = time();
            $TaFLA->Tahun = date('Y');
            $TaPokirReses = TaPokirReses::find()->one();
            $Kd_Jadwal = $TaPokirReses->Masa_Reses+4;
            $TaFLA->Kd_Jadwal = $Kd_Jadwal;
            $TaFLA->save(false);
        }
        return $this->redirect(['pokir/index']);
    }

    public function actionSelesai() {
        $TaPokirReses = TaPokirReses::find()->one();
        $TaFLA = TaPokirAcara::find()->where(['Kd_User' => $this->Kd_User(),'Masa_Reses'=>$TaPokirReses->Masa_Reses])->one();
        //return print_r($TaFLA);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
        return $this->redirect(['index']);
    }

    public function actionAbsensi($kode) {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s', time());
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();
        $model = $this->Kd_User();

        if ($kode == 1) {
            $TaFLA = new TaPokirAcara();
            $TaFLA->Kd_User = $model;
            $TaFLA->Waktu_Unduh_Absen = time();
            $TaFLA->save(false);
        } else {
            $TaFLA = TaPokirAcara::findOne($model);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('absensi', [
                'model' => $TaFLA,
                'Nm_Pemda' => $Nm_Pemda,
                'Tahun' => $Tahun,
            ]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$Nm_Pemda.'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.$waktu
                    ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionBeritaAcara($kode) {

        $user = $this->Kd_User();
        $model = TaPokirAcara::findOne($user);
        $usulan = TaMusrenbang::find()->where(['Kd_Asal_Usulan' => 5])->andwhere(['Kd_User' => $user])->count();
		$data=TaPokirAcara::find()->where(['Kd_User' => $user])->all();
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s', time());
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('bap', [
                'model' => $model, 
                'usulan' => $usulan,
                'Nm_Pemda' => $Nm_Pemda,
                'Tahun' => $Tahun,
				'data'=>$data,
                ]),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$Nm_Pemda.'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.$waktu
                    ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
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

    protected function cariModel($Kd_Pokir) {
        if (($model = TaMusrenbang::findOne(['id' => $Kd_Pokir])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionKoreksi($Kd_Ta_Musrenbang_Kelurahan) {

        $model = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $model->Tanggal = time();

        $NASrpjmd = ArrayHelper::map(RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');

        $ZULbidangpembangunan = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $ZULsatuan = ArrayHelper::map(RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        if ($model->load(Yii::$app->request->post())) {

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

    public function actionGetUsulan($Kd_Lingkungan,$Kd_Pem,$Nm_Permasalahan,$Jenis_Usulan) {
        $posisi = $this->Posisi();
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

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchLaporanPokir(Yii::$app->request->queryParams);

        return $this->render('laporan',[
            'searchModel'=> $searchModel,
            'dataProvider'=>$dataProvider,
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
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
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

    public function actionCetakRekapitulasi() {
        $TaPokirReses = TaPokirReses::find()->one();
        $Tahun = Yii::$app->pengaturan->getTahun();
        $acara = TaPokirAcara::findOne(['Kd_User' => $this->Kd_User()]);
        $TaFL = TaMusrenbang::find()->where(['Kd_User' => $this->Kd_User()])->andWhere(['Kd_Asal_Usulan' => '5'])->all();
        $SubUnit = function($urusan,$bidang,$unit,$sub_unit){
			$model = RefSubUnit::find()
								->where([
										'Kd_Urusan'=>$urusan,
										'Kd_Bidang'=>$bidang,
										'Kd_Unit'=>$unit,
										'Kd_Sub'=>$sub_unit
										])->one();
			return $model->Nm_Sub_Unit;
		};
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('cetak-rekapitulasi', ['Tahun' => $Tahun, 'data' => $TaFL, 'acara' => $acara, 'SubUnit'=>$SubUnit,'reses'=>$TaPokirReses]),
            'options' => [
                'title' => 'Cetak Rekapitulasi',
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
	public function actionKamus($param){
		$kamususulan = KamusUsulan::find()->all();		
		$_opd = function($var){
			$var = explode("/",$var);
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$var[0],"Kd_Bidang"=>$var[1],"Kd_Unit"=>$var[2]])->one();
			return $model->Nm_Sub_Unit;
		};
		$_satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return $model->Uraian;
		};
		$i=1;
		$add = "";
		$response = "<table class='table table-bordered'>
						<thead>
						  <tr>
							<th>No</th>
							<th>Usulan Kegiatan</th>
							<th>Defenisi Operasional</th>
							<th>Harga Satuan (Rp.)</th>
							<th>Satuan</th>
							<th>OPD</th>
							<th>Tipe</th>
							<th>Pilih</th>
						  </tr>
						</thead>
						<tbody>";
						
				foreach($kamususulan as $rows){
					$i=$i+1;
					//echo $rows["SKPD"];
					$defOP = $rows["Defenisi_Operasional"];
					$skpd = $_opd($rows["SKPD"]);
					$satuan = $_satuan($rows["satuan_kamus"]);
					$tipe = ($rows["tipe"]==1) ? "Fisik" : "Non-Fisik";
					//$tipe = $rows["tipe"];
					$harga = number_format($rows["harga_kamus"],2,',','.');
					$opd = str_replace("/","|",$rows["SKPD"]);
					$opd_arr = explode("|",$opd);
					$send = array("skpd"=>$skpd,"opd"=>$opd,"urusan"=>$opd_arr[0],"bidang"=>$opd_arr[1],"unit"=>$opd_arr[2],"sub"=>$opd_arr[3],"satuan"=>$rows["satuan_kamus"],"harga"=>$rows['harga_kamus'],"defOP"=>$rows['Defenisi_Operasional'],"nama"=>$rows['nama_kamus'],"xUnit"=>$rows['SKPD']);
					
					$send = json_encode($send);
					if($param != false){
						if(strpos(strtolower($rows['nama_kamus']), strtolower($param)) > -1)
							  $add .= "<tr> 
								<td> $i </td>
								<td>$rows[nama_kamus]</td>
								<td>$rows[Defenisi_Operasional]</td>
								<td style='text-align:right'> ".number_format($rows['harga_kamus'],2,',','.')."</td>
								<td>$satuan</td>
								<td>$skpd</td>
								<td>$tipe</td>
								<td><button class='btn btn-primary' onclick='btnPilih($send);'>Pilih</button></td>
							  </tr>";						
					}else{
						$add .= "<tr>
							<td>$i </td>
							<td>$rows[nama_kamus]</td>
							<td>$rows[Defenisi_Operasional]</td>
							<td style='text-align:right'>".number_format($rows['harga_kamus'],2,',','.')."</td>
							<td>$satuan</td>
							<td>$skpd</td>
							<td>$tipe</td>
							<td><button class='btn btn-primary' onclick='btnPilih($send);'>Pilih</button></td>
						  </tr>";
					}
				}
				
			$response .= $add ."</tbody></table>";
			echo $response;
	}
}

