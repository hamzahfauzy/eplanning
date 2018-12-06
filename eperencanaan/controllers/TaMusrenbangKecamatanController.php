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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\RefKecamatan;
use common\models\RefJalan;
use common\models\RefLingkungan;
use yii\web\UploadedFile;
use common\models\RefMedia;
use eperencanaan\models\TaUsulanKecamatanMedia;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\SaveLog;
use common\models\RefKelurahan;
use eperencanaan\models\TaKecamatanVerifikasiUsulanKelurahan;
use yii\helpers\Json;
use yii\web\Cookie;
use yii\web\CookieCollection;
use common\models\RefRPJMD;
use kartik\mpdf\Pdf;

use eperencanaan\models\KamusUsulan;
use common\models\RefSubUnit;
use common\models\RefStandardSatuan;

/**
 * TaMusrenbangKecamatanController implements the CRUD actions for TaMusrenbangKecamatan model.
 */
class TaMusrenbangKecamatanController extends Controller {
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

    public function topScore($Kd_Pem,$Kd_Prioritas_Pembangunan_Daerah)
    {
        $posisi = $this->Posisi();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                ->andwhere(['>=', 'Skor', "4"])
                ->andwhere(["Kd_Pem"=>$Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$Kd_Prioritas_Pembangunan_Daerah])
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                ->orderby(["Skor" => SORT_DESC])
                ->one();
        return $data;
    }

    public function CekUsulan()
    {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $posisi = $this->Posisi();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"]);
				// ->andwhere(['!=', 'Skor', NULL]);
				

        $usulan = $data->all();
        $ret = 0;
        foreach($usulan as $u):
            $topScore = $this->topScore($u->Kd_Pem,$u->Kd_Prioritas_Pembangunan_Daerah);
            $TaMusrenbang = TaMusrenbang::find()
            ->where($posisi)
            //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
            ->andwhere(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$topScore['Skor']])
            ->andwhere(['Urutan_Prioritas'=> 0])
            ->count();
            if($TaMusrenbang > 1)
            {
                $ret = 1;
                break;
            }
            // print_r(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$u->Skor,"Jumlah"=>$u->Jumlah]);
        endforeach;
        return $ret;
    }

    /**
     * Lists all TaMusrenbangKecamatan models.
     * @return mixed
     */
    public function actionIndex() {
        $ZULKecamatanModel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULKecamatan = \eperencanaan\models\TaMusrenbangKecamatanAcara::findOne($ZULKecamatanModel);
        $ZULKecamatan = $ZULKecamatan !== null ? $ZULKecamatan : new TaMusrenbangKecamatanAcara();
        /*
          $searchModel = new TaMusrenbangKecamatanSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          ]);
         */

        $Posisi = $this->Posisi();

        // print_r($Posisi);
        // die();

        $jlh_usulan = TaKelurahanVerifikasiUsulanLingkungan::find()
                ->where($Posisi)
                ->andWhere(["in","Status_Penerimaan", [1,2]])
                ->count(); //mengambil usulan dari Kelurahan tertentu

        $jlh_usulan_kel = \eperencanaan\models\TaMusrenbangKelurahan::find()
		  //$jlh_usulan_kel = \eperencanaan\models\TaMusrenbang::find()
                ->where($this->Posisi())
                //->leftjoin('Ta_Relasi_Musrenbang_Kelurahan','Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
                //->andWhere(['IS','Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan',NULL])
				->count();

        $jlh_usulan = $jlh_usulan_kel;
        
        $ZULacara = \eperencanaan\models\TaMusrenbangKelurahanAcara::find()
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
		$dataSkoring1 = TaMusrenbang::find()
                ->where($Posisi)
                ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2']])
                ->exists();
				
		$belumSkor = TaMusrenbang::find()
                ->where($Posisi)
                ->andWhere(['Skor' => NULL])
                ->exists();

        //echo "1. $jlh_data  <br/>";
        //echo "2. $jlh_data_skoring  <br/>";
        //die();

        $cek = $this->CekUsulan();

        return $this->render('dashboard', [
                    'cek' => $cek,
                    'acara' => $ZULKecamatan,
                    'jlh_usulan' => $jlh_usulan,
                    'kel_acara' => $ZULacara,
                    'dataSkoring' => $dataSkoring,
					'dataSkoring1' => $dataSkoring1,
					'belumSkor' => $belumSkor,
                    'jlh_data_skoring' => $jlh_data_skoring,
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
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('Tambah Usulan', 'Tambah Usulan', '', '');
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
					$send = array("skpd"=>$skpd,"opd"=>$opd,"urusan"=>$opd_arr[0],"bidang"=>$opd_arr[1],"unit"=>$opd_arr[2],"sub"=>$opd_arr[3],"satuan"=>$rows["satuan_kamus"],"harga"=>$rows['harga_kamus'],"defOP"=>$rows['Defenisi_Operasional'],"nama"=>$rows['nama_kamus']);
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
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Mulai = time();
        $TaFLA->Tahun = date('Y');
        $TaFLA->save(false);
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('Mulai Musrenbang Kecamatan', 'Mulai Musrenbang Kecamatan', '', '');
        return $this->redirect(['lingkungan/index']);
    }

    public function actionSelesai() {
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        $TaFLA->Waktu_Selesai = time();
        $TaFLA->save(false);
        TaMusrenbangKelurahan::updateAll(['status' => '1'], $model);
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('Selesai Musrenbang Kecamatan', 'Selesai Musrenbang Kecamatan', '', '');
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
                'SetHeader' => ['Generated By: Sistem e-Planning Kabupaten Asahan||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('unduh absensi', 'unduh absensi', '', '');
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
                'SetHeader' => ['Generated By: Sistem e-Planning Kabupaten Asahan||Generated On: ' . date("r")],
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
		$models = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $model = $this->cariModel($Kd_Ta_Musrenbang_Kelurahan);
        $model->Tanggal = time();
		$lingkungan = RefLingkungan::find()
                        ->where($models)
                        ->all();
						

		$jalan = RefJalan::find()
						->where(["Kd_Kec"=>$model->Kd_Kec,
								 "Kd_Kel"=>$model->Kd_Kel,
								 "Kd_Urut_Kel"=>$model->Kd_Urut_Kel,
								 "Kd_Lingkungan"=>$model->Kd_Lingkungan,
								 "Kd_Jalan"=>$model->Kd_Jalan])
						->all();
        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
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
                return $this->redirect(['ta-musrenbang-kecamatan-report/index']);
            }
        } else {
            return $this->render('tambah_usulan', [
                        'model' => $model,
                        'ZULbidpem' => $ZULbidangpembangunan,
                        'ZULsatuan' => $ZULsatuan,
						'NASsatuan' => $NASsatuan,
                        'NASbidangpem' => $NASbidangpem,
						'ZULRefLingkungan' => ArrayHelper::map(\common\models\search\RefLingkungan::find()
                                        ->where($models)
                                        ->all(), 'Kd_Lingkungan', 'Nm_Lingkungan'),
                        'NASrpjmd' => $NASrpjmd,
						'lingkungan' => $lingkungan,
						'jalan' => ArrayHelper::map($jalan, 'Kd_Jalan', 'Nm_Jalan'),
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
			Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
			Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
			Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
			Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
			$log = new Savelog();
			$log->save('Tambah Jalan', 'Tambah Jalan', '', '');
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
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('Kompilasi Usulan', 'Kompilasi Usulan', '', '');
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
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('Edit Kompilasi Usulan', 'Edit Kompilasi Usulan', '', '');
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
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
				Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
				Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
				$log = new Savelog();
				$log->save('Tambah Usulan Lingkungan', 'Tambah Usulan Lingkungan', '', '');
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

            if($Waktu_Mulai==0 || $Waktu_Selesai==0){
                $data_kelurahan[$key]['Nm_Kel']=$value->Nm_Kel;
                $data_kelurahan[$key]['Status']='Belum Menyelenggarakan';
            }
        }

        return $this->renderajax('modal_ambil',[
                'data_kelurahan' => $data_kelurahan,
        ]);
    }
}

