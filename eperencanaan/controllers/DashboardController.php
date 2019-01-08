<?php

namespace eperencanaan\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use eperencanaan\models\TaKecamatanPaguIndikatif;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\TaKritikSaran;
use eperencanaan\models\search\TaAgendaPerencanaanKelurahanSearch;
use eperencanaan\models\Savelog;
use eperencanaan\models\search\TaAgendaPerencanaanLingkunganSearch;
use eperencanaan\models\Setting;
use eperencanaan\models\KamusUsulan;
use eperencanaan\models\PantauMusrenbang;
use eperencanaan\models\PantauForum;
use eperencanaan\models\PantauRenja;
use eperencanaan\models\PantauKecamatan;
use eperencanaan\models\PantauKunjung;
use eperencanaan\models\PantauPokir;
use eperencanaan\models\TampilAgenda;
use common\models\RefSubUnit;
use emusrenbang\models\TaMusrenbangSearch;
use eperencanaan\models\TaMusrenbang;
use common\models\RefMedia;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefDapil;
use common\models\RefDewan;
use common\models\RefFraksiDprd;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD;
use common\models\RefStandardSatuan;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\TaKegiatan;
use common\models\TaUserDapil;
use eperencanaan\models\TaForumLingkunganMedia;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\TaMusrenbangKelurahanMedia;
use eperencanaan\models\TaMusrenbangKecamatanMedia;
use eperencanaan\models\TaUsulanLingkunganMedia;
use eperencanaan\models\TaUsulanKecamatanMedia;
use eperencanaan\models\TaUsulanKelurahanMedia;
use eperencanaan\models\TaUsulanPokirMedia;
use common\models\TaKegiatanRancanganAwal;
use common\models\RefJalan;
use eperencanaan\models\search\TaForumLingkunganSearch;
use common\models\TaIdentitas;
use common\models\TaPemda;
use common\models\RefProvinsi;
use common\models\RefKabupaten;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use kartik\mpdf\Pdf;
use eperencanaan\models\TaMusrenbangKecamatanAcara;

class DashboardController extends Controller {

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

    public function getKota($wil=null) {
        if ($wil) return [
                "Kab" => Yii::$app->pengaturan->Kolom('Nm_Pemda'),
                "Prov" => Yii::$app->pengaturan->nmProvinsi(),
            ];
        return Yii::$app->pengaturan->Kolom('Nm_Pemda');
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

    public $layout = "main_dashboard";
	
	public function actionMediaKelurahan($Kd){
		
		$model = TaUsulanKelurahanMedia::find()
					->where(["Kd_Ta_Musrenbang_Kelurahan"=>$Kd])
					->all();
		//print_r($model);
		$media = function($id){
			$model = RefMedia::find()->where(["Kd_Media"=>$id])->one();
			return $model;
		};
		return $this->render("media-kel",["model"=>$model,"media"=>$media]);
	}
	
	public function actionMediaPokir($Kd){
		
		$model = TaUsulanPokirMedia::find()
					->where(["id"=>$Kd])
					->all();
		//print_r($model);
		$media = function($id){
			$model = RefMedia::find()->where(["Kd_Media"=>$id])->one();
			return $model;
		};
		return $this->render("media-kel",["model"=>$model,"media"=>$media]);
	}
	
	public function actionModalLokasi($Kd){
		
		$model = TaMusrenbangKelurahan::find()
					->where(["Kd_Ta_Musrenbang_Kelurahan"=>$Kd])
					->one();
		$lat = $model->Latitute;
		$lng = $model->Longitude;
		return $this->render("modal_lokasi",["lat"=>$lat,"lng"=>$lng]);
	}
	
	public function actionMediaKecamatan($Kd){
		
		$model = TaUsulanKecamatanMedia::find()
					->where(["Kd_Ta_Musrenbang_Kecamatan"=>$Kd])
					->all();
		//print_r($model);
		$media = function($id){
			$model = RefMedia::find()->where(["Kd_Media"=>$id])->one();
			return $model;
		};
		return $this->render("media-kel",["model"=>$model,"media"=>$media]);
	}

	
	 
	
    public function actionIndex() {
		$setting = Setting::find()->all();
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchLingkungan(Yii::$app->request->queryParams);

        $model = new LoginForm();
        $paguKec = TaKecamatanPaguIndikatif::find([['Kd_Prov' => '12', 'Kd_Kab' => '9']])
                ->sum('Pagu_Indikatif');

        $totalPaguLing = TaForumLingkungan::find(['Kd_Prov' => '12', 'Kd_Kab' => '9'])
                ->sum('Harga_Total');

        $usulanLing = TaForumLingkungan::find()
                    ->count();

        $usulan_kel1 = TaMusrenbangKelurahan::find()
                    ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
                    ->andwhere(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL])
                    ->count();
            

        //$usulan_kel2 = TaKelurahanVerifikasiUsulanLingkungan::find()
        //            ->count();

        $usulan_kel2 = TaMusrenbangKelurahan::find()->count();// + $usulan_kel2;
		
		$musrenbang = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->all();
					
		$jumlah_usulan_kec1 = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
								/*
					->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
									['Status_Penerimaan_Kelurahan'=>NULL],
								])
					->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									['Status_Penerimaan_Kecamatan'=>NULL],
								])
					//->andwhere(["IS NOT","Skor",NULL])*/
					->count();
		$jumlahusulankec =  $jumlah_usulan_kec1;
		$jumlah_usulan_tolak_kec = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
								])
					->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
									['Status_Penerimaan_Kelurahan'=>NULL],
								])
					->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'3'],
									//['Status_Penerimaan_Kecamatan'=>'2'],
								])
					->count();
					
		$jumlah_usulan_pokir = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								])
					->count();
		$jumlah_usulan_opd = $jumlahusulankec + $jumlah_usulan_pokir;
			
		
		//add by RG
        $usulanKecPro = TaMusrenbang::find()
                    ->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
                 /*  
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2'],
						//['Status_Penerimaan_Kecamatan' => '3']
						
                    ])
					->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]]) */
				
				->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2'],
						//['Status_Penerimaan_Kecamatan' => '3']
						
                    ])
					->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ])
                    ->count(); 
					
		$jumlah_usulan_opd1 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
			/*	->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>NULL],
									['Status_Penerimaan_Kelurahan'=>'2'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>NULL],
									['Status_Penerimaan_Kecamatan'=>'2'],
								]) */ 
				->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
									//['Status_Penerimaan_Skpd'=>'3'],
								
								])				
				->count();
        $jumlahKegiatan = TaKegiatan::find()->count();

        $dataIdentitas = TaPemda::find()
                        ->where(['Tahun'=>'2017'])
                        ->one();        

        if (!isset($dataIdentitas)) {
            return $this->redirect(['dashboard/identitas']);
        } 
        else {

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                $DNJadwal = Yii::$app->levelcomponent->getJadwal();
                $PC_Level_data = Yii::$app->levelcomponent->getLevel();
                if ($PC_Level_data != '') {
                    $PC_Level = $PC_Level_data->Kd_Level;
                } else {
                    $PC_Level = 3;
                }

                if ($PC_Level == 1) {
                    return $this->redirect(['laporan/index']);
                }
                $ZULuser = Yii::$app->levelcomponent->getKelompok();
				//jika bukan forum opd
				if($ZULuser){
					if ($ZULuser['Kd_Kel'] == 0) {
						return $this->redirect(['ta-musrenbang-kecamatan/index']);
					} else if ($ZULuser['Kd_Lingkungan'] == 0 && $ZULuser['Kd_Kel'] != 0) {
						return $this->redirect(['ta-musrenbang-kelurahan/index']);
					} else {
						return $this->redirect(['lingkungan/index']);
					}
				}else{
					return $this->redirect(['musrenbang-skpd/index']);
				}
            } 
            else {
                if (!Yii::$app->user->isGuest) {
                    //tambahan
                    $ZULuser = Yii::$app->levelcomponent->getKelompok();
                    $DNJadwal = Yii::$app->levelcomponent->getJadwal();
					if($ZULuser){
						if ($ZULuser['Kd_Kel'] == 0) {
							return $this->redirect(['ta-musrenbang-kecamatan/index']);
						}else if ($ZULuser['Kd_Lingkungan'] == 0 && $ZULuser['Kd_Kel'] != 0) {
							return $this->redirect(['ta-musrenbang-kelurahan/index']);
							/*
							echo "<pre>";
							print_r($ZULuser);
							echo "</pre>";
							*/
						} else {

							return $this->redirect(['lingkungan/index']);
						}
					}else{
						//return $this->redirect(['musrenbang-skpd/index']);
						$OPD = Yii::$app->levelcomponent->getUnit();
						if($OPD)
							return $this->redirect(['musrenbang-skpd/index']);
						else
							return $this->redirect(['pokir/index']);
					}
                } 
                else {
                    return $this->render('index', [
                                'totalPaguLing' => $totalPaguLing,
                                'paguKec' => $paguKec,
                                'usulanLing' => $usulanLing,
                                'usulanKel' => $usulan_kel2,
                                'jumlahKegiatan' => $jumlahKegiatan,
								'jumlahUsulanKec' => $jumlahusulankec,
								'model' => $model,
								'jumlahUsulanPokir' => $jumlah_usulan_pokir,
								'jumlahUsulanOPD' => $jumlah_usulan_opd,
								'jumlahUsulanOPD1' => $jumlah_usulan_opd1,
								'usulanKecPro'=>$usulanKecPro,
                    ]);
                }
            }
        } 
        
    }

    public function actionLoadData(){
        $usulan_kel2 = TaMusrenbangKelurahan::find()->count();// + $usulan_kel2;
        $jumlahKegiatan = TaKegiatan::find()->count();
		
		$musrenbang = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->all();
					
		$jumlah_usulan_kec1 = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
					->count();
		$jumlahusulankec =  $jumlah_usulan_kec1;
					
		$jumlah_usulan_pokir = TaMusrenbang::find()
					->where(['Kd_Prov' => 12])
					->andwhere(['Kd_Kab' => 9])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								])
					->count();
		$jumlah_usulan_opd = $jumlahusulankec + $jumlah_usulan_pokir;
		
		
		
		$response = ["usulanKel"=>$usulan_kel2,"usulanKec"=>$jumlahusulankec,"usulanPokir"=>$jumlah_usulan_pokir,"usulanopd"=>$jumlah_usulan_opd,"jumlahkegiatan"=>$jumlahKegiatan];
		
        $jumlahKegiatan = TaKegiatan::find()->count();
                    return $this->renderPartial('load-data', [
                                'response' => $response
                    ]);
    }
	
	public function actionRekap(){
		$model = new LoginForm();
		
		$dataKec = RefKecamatan::find()
                ->where(['Kd_Prov' => '12', 'Kd_Kab' => '9'])
				->orderBy("Nm_Kec")
                ->all();
				
		$datakel = function($kec_id){
			$model = RefKelurahan::find()
					->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
					->orderBy("Nm_Kel")
					->count();
			return $model;
		};
		
		$usulanperkel = function($kec_id){
			$model = RefKelurahan::find()
					->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
					->orderBy("Nm_Kel")
					->all();
			
			$jumlah = 0;
			foreach($model as $rows){
				$jumlaUsulanKel1 = TaMusrenbangKelurahan::find()
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->count();
				//DI KOMENT OLEH RIPIN GINTING
				$jumlaUsulanKel2 = TaKelurahanVerifikasiUsulanLingkungan::find()
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->count();
				$jumlah += $jumlaUsulanKel1; 
			}
			
			return $jumlah;
		};
		
		$usulankelterima = function($kec_id){
			$model = RefKelurahan::find()
					->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
					->orderBy("Nm_Kel")
					->all();
			
			$jumlah = 0;
			foreach($model as $rows){
				//$jumlaUsulanKel2 = TaKelurahanVerifikasiUsulanLingkungan::find() // di KOMEN OLEH RIPIN , asumsi usulan dari rembug warga ikut dihitung.
				$jumlaUsulanKel2 = TaMusrenbangKelurahan::find() // DITAMBAH OLEH RIPIN, asumsi usulan dari rembug warga di abaikan
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->count();
				$jumlah += $jumlaUsulanKel2;
			}
			
			return $jumlah;
		};
//by Ripin G
		//Hitung Total Biaya Per Kelurahan
		$biayaperkel = function($kec_id){
			$model = RefKelurahan::find()
					->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
					->orderBy("Nm_Kel")
					->all();
			
			$jumlah = 0;
			foreach($model as $rows){
				$jumlaUsulanKel1 = TaMusrenbangKelurahan::find()
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->sum('Harga_Total');
									
				$jumlaUsulanKel2 = TaKelurahanVerifikasiUsulanLingkungan::find()
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->sum('Harga_Total');
				$jumlah += $jumlaUsulanKel1;
			}
			
			return $jumlah;
		};
		
		//Hitung Jumlah Biaya Per Kelurahan Yang Diterima Oleh Kelurahan
		$biayakelterima = function($kec_id){
			$model = RefKelurahan::find()
					->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
					->orderBy("Nm_Kel")
					->all();
			
			$jumlah = 0;
			foreach($model as $rows){
				//$jumlaUsulanKel2 = TaKelurahanVerifikasiUsulanLingkungan::find()// dikomen oleh RG
				$jumlaUsulanKel2 = TaMusrenbangKelurahan::find() 
									->where(['Kd_Prov' => '12', 'Kd_Kab' => '9','Kd_Kec'=>$kec_id])
									->andWhere(['Kd_Kel'=>$rows['Kd_Kel'],'Kd_Urut_Kel'=>$rows['Kd_Urut']])
									->sum('Harga_Total');
				$jumlah += $jumlaUsulanKel2;
			}
			
			return $jumlah;
		};
		
		//Hitung Total Biaya Kecamatan
		$biayakecamatan = function($kec_id){
			$model = TaMusrenbang::find()
					 ->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,"Kd_Kec"=>$kec_id])
					 ->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
					 ->sum('Harga_Total');
			return $model;
		};
		
		//Hitung Biaya Per Kecamatan
		$biayakecamatanterima = function($kec_id){
			$model = TaMusrenbang::find()
					->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,'Kd_Kec'=>$kec_id])

					->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
								/*
					->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
								]) */
					->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
								])
					//->andwhere(["IS NOT","Skor",NULL])
					->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]])
					->sum('Harga_Total');
					
			$model2 = TaMusrenbang::find()
					->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,'Kd_Kec'=>$kec_id,'Kd_Asal_Usulan'=>'3'])
					->sum('Harga_Total');
					
			return $model;//+$model2;
		};
		//usulan kecamatan atau usulan yang di teruskan ke kecamatan
		$usulankecamatan = function($kec_id){
			$model = TaMusrenbang::find()
					 ->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,'Kd_Kec'=>$kec_id])
					 ->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'] // usulan kecamatan
								])
					 ->count();
			return $model;
		};
		
		
		$usulankecamatanterima = function($kec_id){
			$model = TaMusrenbang::find()
					 ->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,'Kd_Kec'=>$kec_id])
					->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
					/*->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
								])*/
					->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									
								])
				->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]])
					// ->andwhere(["IS NOT","Skor",NULL])
					 ->count();
					 
			$model2 = TaMusrenbang::find()
					 ->where(['Kd_Prov' => 12, 'Kd_Kab' => 9,'Kd_Kec'=>$kec_id,'Kd_Asal_Usulan'=>'3'])
					 ->count();
			return $model;//+$model2;
		};
		
		$usulanpokir = function($kec_id){
			$model = TaMusrenbang::find()
					 ->where(['Kd_Prov' => '12', 'Kd_Kab' => '9',"Kd_Kec"=>$kec_id])
					 ->andwhere(["or",
									["Kd_Asal_Usulan"=>'5'],
									["Kd_Asal_Usulan"=>'6'],
									["Kd_Asal_Usulan"=>'7'],
									["Kd_Asal_Usulan"=>'8'],
								])
					 ->count();
			return $model;
		};
		$usulanpokirterima = function($kec_id){
			$model = TaMusrenbang::find()
					 ->where(['Kd_Prov' => '12', 'Kd_Kab' => '9',"Kd_Kec"=>$kec_id,"Status_Penerimaan_Skpd"=>'1'])
					 ->andwhere(["or",
									["Kd_Asal_Usulan"=>'5'],
									["Kd_Asal_Usulan"=>'6'],
									["Kd_Asal_Usulan"=>'7'],
									["Kd_Asal_Usulan"=>'8']
								])
					 ->count();
			return $model;
		};
		
		return $this->renderPartial('table-rekap', [
								'model' => $model,
                                'dataKec' => $dataKec,
								'datakel'=>$datakel,
								'usulanperkel'=>$usulanperkel,
								'usulankelterima'=>$usulankelterima,
								'biayaperkel'=>$biayaperkel,
								'biayakelterima'=>$biayakelterima,
								'usulankecamatan'=>$usulankecamatan,
								'usulankecamatanterima'=>$usulankecamatanterima,
								'biayakecamatan'=>$biayakecamatan,
								'biayakecamatanterima'=>$biayakecamatanterima,
								'usulanpokir'=>$usulanpokir,
								'usulanpokirterima'=>$usulanpokirterima
                    ]);
	}
	
	public function actionPokirLogin(){
		$model = new LoginForm();
		return $this->render("login-pokir",['model'=>$model]);
	}

	public function actionLogin() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
            Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
            Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
            Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
            $log = new Savelog();
            $log->save('login berhasil', 'login', '', '');
            return $this->redirect(['dashboard/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
	
    public function actionLoginLingkungan() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['lingkungan/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLoginMusrenbangKelurahan() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['ta-musrenbang-kelurahan/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLoginMusrenbangKecamatan() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['ta-musrenbang-kecamatan/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLoginSkpd() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['musrenbang-skpd/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLoginPokir() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['pokir/index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }


    public function actionLoginRkpd() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->redirect(['emusrenbang/site/index']);
   
            $url = $_POST['/site/index']; // www.example.com/get_response/
            $arr = array('response' => 'Failed', 'msg' => 'login success', 'tokenKey' => 'token');

            $this->redirect('http://' . $url . '?' . http_build_query($arr));
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }


    public function actionAgendakel() {

        $searchModel = new TaAgendaPerencanaanKelurahanSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('agendakel', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgendawarga() {

        $searchModel = new TaAgendaPerencanaanLingkunganSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('agendawarga', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSaran() {

        $model = new TaKritikSaran();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', 'Tambah Usulan Lingkungan Berhasil');
            return $this->redirect(['dashboard/saran']);
        } else {
            return $this->render('saran', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPanduanRembukWarga() {
        return $this->render('panduan-rembuk-warga');
    }

    public function actionPanduanMusrenbangKelurahan() {
        return $this->render('panduan-musrenbang-kelurahan');
    }

    public function actionPanduanMusrenbangKecamatan() {
        return $this->render('panduan-musrenbang-kecamatan');
    }

    public function actionSopRembukWarga() {
        return $this->render('sop-rembuk-warga');
    }

    public function actionSopMusrenbangKelurahan() {
        return $this->render('sop-musrenbang-kelurahan');
    }

    public function actionSopMusrenbangKecamatan() {
        return $this->render('sop-musrenbang-kecamatan');
    }

    public function actionBerita() {
        $ZULmodel = new \yii\base\DynamicModel(['kecamatan',
            'kelurahan'
        ]);
        $ZULmodel->addRule(['kecamatan', 'kelurahan'], 'required');
        if ($ZULmodel->hasErrors()) {
            // validation fails
        } else {
            // validation succeeds
        }

        $dataKec = ArrayHelper::map(RefKecamatan::find()->where(['Kd_Prov' => '12', 'Kd_Kab' => '9'])->all(), 'Kd_Kec', 'Nm_Kec');
        $ZULsearchModel = new \common\models\search\RefLingkunganSearch();
        if ($ZULmodel->load(Yii::$app->request->post())) {
            $ZULdataprovider = $ZULsearchModel->Zulsearch(Yii::$app->request->queryParams, $ZULmodel->kecamatan, $ZULmodel->kelurahan);
        } else {
            $ZULdataprovider = $ZULsearchModel->Zulsearch(Yii::$app->request->queryParams, 0, 0);
        }
        return $this->render('berita', ['ZULmodel' => $ZULmodel, 'dataProvider' => $ZULdataprovider, 'searchModel' => $ZULsearchModel, 'dataKec' => $dataKec]);
    }

    public function actionHasilrapat() {

        return $this->render('hasilrapat');
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLaporan() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['laporan/index']);
        } else {
            return $this->render('login_bappeda', [
                        'model' => $model
            ]);
        }
    }

    public function actionStatistik() {
        $model = array();
        return $this->render('statistik', [
                    'model' => $model
        ]);
    }

    public function actionLihatUsulan() {
        $ZULnmkel = '';
        $ZULmodel = new \yii\base\DynamicModel(['kelurahan']);
        $ZULmodel->addRule(['kelurahan'], 'required');
        if ($ZULmodel->load(\Yii::$app->request->get())) {
            //print_r($ZULmodel);exit;
            $ZULtemp = \common\models\search\RefKelurahan::findOne(['Kd_Prov' => 12, 'Kd_Kab' => 9, 'Nm_Kel' => $ZULmodel->kelurahan]);
            //print_r($ZULtemp);exit;
            $ZULusulan = TaForumLingkungan::find()->where([
                'Kd_Prov' => $ZULtemp->Kd_Prov,
                'Kd_Kab' => $ZULtemp->Kd_Kab,
                'Kd_Kec' => $ZULtemp->Kd_Kec,
                'Kd_Urut_Kel' => $ZULtemp->Kd_Urut,
            ]);
            $ZULnmkel = $ZULmodel->kelurahan;
        } else {
            $ZULusulan = TaForumLingkungan::find();
        }
        $ZULcount = clone $ZULusulan;
        $pages = new \yii\data\Pagination(['totalCount' => $ZULcount->count()]);
        $pages->pageSize = 5;
        $models = $ZULusulan->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('lihat_usulan', [
                    'models' => $models,
                    'pages' => $pages,
                    'kelurahan' => ArrayHelper::getColumn(\common\models\RefKelurahan::find()
                                    ->where(['Kd_Prov' => 12, 'Kd_Kab' => 9])->all(), 'Nm_Kel'),
                    'model' => $ZULmodel,
                    'nm_kel' => $ZULnmkel
        ]);
    }

    public function actionMusrenbang()
    {
        $RefSubUnit = RefSubUnit::find()->all();

        return $this->render('musrenbang', [
          'RefSubUnit' => $RefSubUnit,
        ]);
    }

    public function actionLihatUsulanSpesifik($id) {

        $usulan = TaForumLingkungan::find()->where(['SHA2(Kd_Ta_Forum_Lingkungan, 256)' => $id])->one();
        $foto = \eperencanaan\models\TaUsulanLingkunganMedia::find()->where(['SHA2(Kd_Ta_Forum_Lingkungan, 256)' => $id])->all();
        return $this->render('lihat_usulan_spesifik', ['usulan' => $usulan, 'foto' => $foto]);
    }

    public function actionGetKelurahan($Kd_Kec)
    {
        $Kd_Prov = 12;
        $Kd_Kab = 9;

        $kelurahan = RefKelurahan::find()
                    ->where(['Kd_Prov' => $Kd_Prov])
                    ->andWhere(['Kd_Kab' => $Kd_Kab])
                    ->andwhere(['=', 'Kd_Kec', $Kd_Kec])
                    ->all();
        
        echo '<option value="0">- Pilih Kelurahan -</option>';
        foreach ($kelurahan as $key => $value) {
            echo '<option value="'.$value->Kd_Urut.'">'.$value->Nm_Kel.'</option>';
        }
    }

    public function actionGetLingkungan($Kd_Kec, $Kd_Kel)
    {
        $Kd_Prov = 12;
        $Kd_Kab = 9;

        $lingkungan = RefLingkungan::find()
                    ->where(['Kd_Prov' => $Kd_Prov])
                    ->andWhere(['Kd_Kab' => $Kd_Kab])
                    ->andwhere(['=', 'Kd_Kec', $Kd_Kec])
                    ->andwhere(['=', 'Kd_Urut_Kel', $Kd_Kel])
                    ->all();
        
        echo '<option value="0">- Pilih Lingkungan -</option>';
        foreach ($lingkungan as $key => $value) {
            echo '<option style="text-transform: capitalize;" value="'.$value->Kd_Lingkungan.'">'.$value->Nm_Lingkungan.'</option>';
        }
    }

    public function actionGetKelurahan2($kd_kec)
    {
        $countKel = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->count();
 
        $Kels = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->all();
 
        if($countKel > 0){
            foreach($Kels as $Kel){
                echo "<option value='".$Kel->Kd_Urut."'>".$Kel->Nm_Kel."</option>";
            }
        }
        else{
            echo "<option>-Pilih Kelurahan-</option>";
        }
 
    }

    public function actionGetLingkungan2($kd_kec, $kd_kel)
    {
        $countLing = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Urut_Kel' => $kd_kel])
                ->count();
 
        $Lings = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Urut_Kel' => $kd_kel])
                ->all();
 
        if($countLing > 0){
            foreach($Lings as $Ling){
                echo "<option value='".$Ling->Kd_Lingkungan."'>".$Ling->Nm_Lingkungan."</option>";
            }
        }
        else{
            echo "<option>-Pilih Lingkungan-</option>";
        }
 
    }

    public function actionLihatFile($nama_file)
    { 
        return $this->renderpartial('lihat_file', [
                'nama_file' => $nama_file,
        ]);
    }

    public function actionUsulanLingkungan()
    {    
		$model = new LoginForm();
        $searchModel = new TaForumLingkunganSearch();
        $dataProvider = $searchModel->searchLihatUsulan(Yii::$app->request->queryParams);

        $data_kec = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $ref_jalan = ArrayHelper::map(RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
                ->andwhere(['Kd_Lingkungan' => $searchModel->Kd_Lingkungan])
                ->asArray()
                ->all(), 
                'Kd_Jalan', 
                'Nm_Jalan'
        );

        return $this->render('usulan-lingkungan', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
				'model' => $model,
        ]);
    }
	
	public function getTotalUsulan(){
	}

    public function actionUsulanKelurahan($halaman=1,$jumlah_record="*",$Kd_Kec=18,$desa_id="",$kata_kunci="") 
    {
		$halaman = $halaman - 1;
		$model = new LoginForm();
        //$data = TaKelurahanVerifikasiUsulanLingkungan::find()->all();
	
		if($kata_kunci == "")
			$keyword = []; 
		else
			$keyword = ["or",
						   	["LIKE","Nm_Permasalahan",$kata_kunci],
						   	["LIKE","Jenis_Usulan",$kata_kunci],
							["LIKE","Detail_Lokasi",$kata_kunci],
							
						  ];
		
		if($Kd_Kec == 0 || $Kd_Kec == "*")
			$KdKec = [];
		else
			$KdKec = ["Kd_Kec"=>$Kd_Kec];
		
		if($desa_id == "" || $desa_id == "*")
			$desaid = [];
		else{
			$desaid = explode("|",$desa_id);
			$desaid = ["Kd_Kel"=>$desaid[0],"Kd_Urut_Kel"=>$desaid[1]];
		}
		
		if($jumlah_record == "*"){
			$ss = TaMusrenbangKelurahan::find()
			->where($keyword)
			->andwhere($KdKec)
			->andwhere($desaid)
			->count();
			$jumlah_record = $ss;
		}
			
		$data = TaMusrenbangKelurahan::find()
			->where($keyword)
			->andwhere($KdKec)
			->andwhere($desaid)
			->offset($halaman)
			->limit($jumlah_record)
			->all();
		if(1)
			$total_usulan = count(TaMusrenbangKelurahan::find()->all());
		else
			$total_usulan = count($data);
		$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return @$model->Nm_Kec;
		};
		
		$satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return @$model->Uraian;
		};
		
		/*$model_desa=RefKelurahan::find()
					->where(['Kd_Prov' => 12])
                    ->andwhere(['Kd_Kab' => 9])
					->andwhere(['Kd_Kec' => $kd_kec])
					->orderBy(["Nm_Kel"=>SORT_ASC])->all(); */
						
			
        $desa = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut' => $kd_urut_kel])
                ->one();
				return @$model->Nm_Kel;
			
		};
		
		$lingkungan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link){
			$model = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->one();
				return @$model->Nm_Lingkungan;
			
		};
		$jalan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link,$kd_jalan){
		$model = RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->andwhere(['Kd_Jalan' => $kd_jalan])
                ->one();
				return @$model->Nm_Jalan;
			
		};
		
		
		$opd = function($urusan,$bidang,$kd_kamus){
			if(!empty($kd_kamus)){
				$kamus = KamusUsulan::find()->where(["kode_kamus"=>$kd_kamus])->one();
				return $kamus->SKPD_Ket;
			}
			
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan,"Kd_Bidang"=>$bidang,"Kd_Unit"=>1])->one();
			return @$model->Nm_Sub_Unit;
		};
		/*
		$opd = function($usulan){
			$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			$SKPD = explode("/",$model->SKPD);
			$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
			return $subunit->Nm_Sub_Unit;
		};
		*/
        return $this->render('usulan-kelurahan', [
                'data' => $data,
                'nama_kec' => $data_kec,
                'nama_desa' => $desa,
                'satuan' => $satuan,
                'nama_lingkungan' => $lingkungan,
                'nama_jalan' => $jalan,
				'untuk'=>'kelurahan',
				'opd'=>$opd,
				'model' => $model,
				'model_kec'=>$model_kec,
				'total_usulan'=>$total_usulan,
				'jumlah_record'=>$jumlah_record,
				'halaman'=>$halaman+1,
				'kata_kunci'=>$kata_kunci,
				'KdKec'=>$Kd_Kec,
				'desa_id'=>$desa_id,
				//'model_desa'=>$model_desa,
        ]);
    }

     public function actionUsulanKecamatan($halaman=1,$jumlah_record="*",$Kd_Kec=18,$desa_id="",$kata_kunci1="",$Setuju="",$kec="") 
    {
		$halaman = $halaman - 1;
		$model = new LoginForm();
        //$data = TaKelurahanVerifikasiUsulanLingkungan::find()->all();
	
		if($kata_kunci1 == "")
			$keyword = []; 
		else
			$keyword = ["or",
						   	["LIKE","Nm_Permasalahan",$kata_kunci1],
						   	["LIKE","Jenis_Usulan",$kata_kunci1],
							["LIKE","Detail_Lokasi",$kata_kunci1],
							["LIKE","Kd_Urusan",$kata_kunci1],
							["LIKE","Kd_Bidang",$kata_kunci1],
							["LIKE","Kd_Unit",$kata_kunci1],
						  ];
		
		if($Kd_Kec == 0 || $Kd_Kec == "*")
			$KdKec = [];
		else
			$KdKec = ["Kd_Kec"=>$Kd_Kec];
		
		if($desa_id == "" || $desa_id == "*")
			$desaid = [];
		
		else{
			$desaid = explode("|",$desa_id);
			$desaid = ["Kd_Kel"=>$desaid[0],"Kd_Urut_Kel"=>$desaid[1]];
		}
		
		if($jumlah_record == "*"){
			$ss = TaMusrenbang::find()
			->where($keyword)
			->andwhere($KdKec)
			->andwhere($desaid)
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
									])
			
			->count();
			$jumlah_record = $ss;
		}
			
        
		$opd = function($urusan,$bidang){
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan,"Kd_Bidang"=>$bidang,"Kd_Unit"=>1])->one();
			return $model->Nm_Sub_Unit;
		};
		/*
		$opd = function($usulan){
			$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			$SKPD = explode("/",$model->SKPD);
			$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
			return $subunit->Nm_Sub_Unit;
		};
		*/
		$satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return $model->Uraian;
		};
		if ($Setuju==""):
		$data = TaMusrenbang::find()
			->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
									['Status_Penerimaan_Kelurahan'=>NULL],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									['Status_Penerimaan_Kecamatan'=>'3'],
									
								])		
			->where($keyword)
			->andwhere($KdKec)
			->andwhere($desaid)
			->offset($halaman)
			->limit($jumlah_record)
			->all();
		elseif ($Setuju==1):
			$data = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kec])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
                ->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]])
				//->andwhere(">","Kd_Prioritas_Pembangunan_Daerah",0)
				->all();
		else:
				$data = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kec])
				->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
				->andWhere(["or",["Status_Penerimaan_Kecamatan"=>NULL],
							  ["Status_Penerimaan_Kecamatan"=>'0'],
							  ["Status_Penerimaan_Kecamatan"=>'3'],
							  ["Skor"=>NULL],
							  ["Skor"=>0],
							  ["Kd_Prioritas_Pembangunan_Daerah"=>0]])
				
				->all();
		endif;
		/*	
        $data = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>'2'],
									['Status_Penerimaan_Kelurahan'=>NULL],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									['Status_Penerimaan_Kecamatan'=>'3'],
									
								])				
				//->andwhere(["IS NOT","Skor",NULL])
				->all();*/
				/*
		$muskel = function($Tahun,$Kd_Kec,$Kd_Kel,$Kd_Urut_Kel,$Kd_Lingkungan,){
			$model = TaMusrenbangKelurahan::find()
			->where('Tahun' => 'Tahun', 
            'Kd_Prov' => 'Kd_Prov', 
            'Kd_Kab' => 'Kd_Kab', 
            'Kd_Kec' => 'Kd_Kec', 
            'Kd_Kel' => 'Kd_Kel', 
            'Kd_Urut_Kel' => 'Kd_Urut_Kel', 
            'Kd_Lingkungan' => 'Kd_Lingkungan', 
            'Kd_Jalan' => 'Kd_Jalan',
            'Nm_Permasalahan' => 'Nm_Permasalahan',
            'Jenis_Usulan' => 'Jenis_Usulan')->all();
		};*/
		if(1)
			$total_usulan = count(TaMusrenbang::find()
								->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
									])
								->all());
		else
			$total_usulan = count($data);
		$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return @$model->Nm_Kec;
		};

        $desa = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut' => $kd_urut_kel])
                ->one();
				return @$model->Nm_Kel;
			
		};
		
		$lingkungan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link){
			$model = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->one();
				return @$model->Nm_Lingkungan;
			
		};
		$jalan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link,$kd_jalan){
			$model = RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->andwhere(['Kd_Jalan' => $kd_jalan])
                ->one();
				return @$model->Nm_Jalan;
			
		};
	
        return $this->render('usulan-kecamatan', [
                'data' => $data,
                'nama_kec' => $data_kec,
                'nama_desa' => $desa,
                'satuan' => $satuan,
                'nama_lingkungan' => $lingkungan,
                'nama_jalan' => $jalan,
				'untuk'=>'kecamatan',
				'opd'=>$opd,
				'model' => $model,
				'satuan' => $satuan,
              
				'model_kec'=>$model_kec,
				'total_usulan'=>$total_usulan,
				'jumlah_record'=>$jumlah_record,
				'halaman'=>$halaman+1,
				'kata_kunci1'=>$kata_kunci1,
				'KdKec'=>$Kd_Kec,
				'desa_id'=>$desa_id,

        ]);
    }
	
	public function actionGetDesa($Kd_Kec){
		$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $Kd_Kec])
                ->all();
		$output = "";
		foreach($model as $val){
			$output .= "<option value='".@$val->Kd_Kel."|".@$val->Kd_Urut."'>".@$val->Nm_Kel."</option>";
		}
		
		echo $output;
	}
	
	public function actionHasilForumOpd($Setuju,$Urusan,$Bidang,$Unit,$Sub) {
		$model = new LoginForm();
		$opd = function($usulan){
			$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			$SKPD = explode("/",$model->SKPD);
			$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
			return $subunit->Nm_Sub_Unit;
		};
		$satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return $model->Uraian;
		};
		if ($Setuju=="[]" || $Urusan=="" || empty($Urusan)||$Urusan=="[]") :
			$data = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
				/*->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kelurahan'=>'1'],
									['Status_Penerimaan_Kelurahan'=>NULL],
									['Status_Penerimaan_Kelurahan'=>'2'],
								])
				->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>NULL],
									['Status_Penerimaan_Kecamatan'=>'2'],
								]) */
				->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
									['Status_Penerimaan_Skpd'=>'3'],
								
								])				
				->all();
				
		 
		elseif ($Setuju==1) :
				$data = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $Urusan])
				->andwhere(['Kd_Bidang' => $Bidang])
				->andwhere(['Kd_Unit' => $Unit])
				->andwhere(['Kd_Sub' => $Sub])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
								])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->all();
		elseif ($Setuju==2) :
				$data = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $Urusan])
				->andwhere(['Kd_Bidang' => $Bidang])
				->andwhere(['Kd_Unit' => $Unit])
				->andwhere(['Kd_Sub' => $Sub])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									//['Status_Penerimaan_Skpd'=>'2'],
								])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["<=","Kd_Asal_Usulan",'4'])
				->all();
		elseif ($Setuju==3) :
				$data = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $Urusan])
				->andwhere(['Kd_Bidang' => $Bidang])
				->andwhere(['Kd_Unit' => $Unit])
				->andwhere(['Kd_Sub' => $Sub])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									//['Status_Penerimaan_Skpd'=>'2'],
								])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere([">","Kd_Asal_Usulan",'4'])
				->all();
		else:
				$data = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $Urusan])
				->andwhere(['Kd_Bidang' => $Bidang])
				->andwhere(['Kd_Unit' => $Unit])
				->andwhere(['Kd_Sub' => $Sub])
                ->andwhere(['Status_Penerimaan_Skpd'=>'3'])
				
				->all();
				
				
		endif;
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return @$model->Nm_Kec;
		};

        $desa = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut' => $kd_urut_kel])
                ->one();
				return @$model->Nm_Kel;
			
		};
		
		$lingkungan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link){
			$model = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->one();
				return @$model->Nm_Lingkungan;
			
		};
		$jalan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link,$kd_jalan){
			$model = RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->andwhere(['Kd_Jalan' => $kd_jalan])
                ->one();
				return @@$model->Nm_Jalan;
			
		};
		
        return $this->render('hasil-forum-opd', [
                'data' => $data,
				//'data1' => $data1,
                'nama_kec' => $data_kec,
                'nama_desa' => $desa,
                'satuan' => $satuan,
                'nama_lingkungan' => $lingkungan,
                'nama_jalan' => $jalan,
				'untuk'=>'kecamatan',
				'opd'=>$opd,
				'model' => $model,
        ]);
    }


    public function actionUsulanSemua() {
		$modellogin = new LoginForm();
        $searchModelTerima = new TaMusrenbangSearch();
        $dataProviderTerima = $searchModelTerima->searchUsulanSemuaTerima(Yii::$app->request->queryParams);

        $searchModelTolak = new TaForumLingkunganSearch();
        $dataProviderTolak = $searchModelTolak->searchUsulanSemuaTolak(Yii::$app->request->queryParams);

        $data_kec = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $ref_jalan = ArrayHelper::map(RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $searchModelTerima->Kd_Kec])
                ->andwhere(['Kd_Urut_Kel' => $searchModelTerima->Kd_Urut_Kel])
                ->andwhere(['Kd_Lingkungan' => $searchModelTerima->Kd_Lingkungan])
                ->asArray()
                ->all(), 
                'Kd_Jalan', 
                'Nm_Jalan'
        );

        $model = TaMusrenbang::find()
                ->where(['or',
                    ['Kd_Asal_Usulan' => '1'],
                    ['Kd_Asal_Usulan' => '2'],
                    ['Kd_Asal_Usulan' => '3']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kecamatan' => '1'],
                    ['Status_Penerimaan_Kecamatan' => '2']
                ])
                ->all();

        return $this->render('usulan-semua', [
                'dataProviderTerima' => $dataProviderTerima,
                'dataProviderTolak' => $dataProviderTolak,
                'searchModelTerima' => $searchModelTerima,
                'searchModelTolak' => $searchModelTolak,
                'data_kec' => $data_kec,
                'ref_jalan' => $ref_jalan,
				'model' => $modellogin,
                // 'model' => $model,
        ]);

    }
	
	
    public function actionUsulanPokir($Setuju,$kd1,$dewan)
		
	
    {
		$model = new LoginForm();
		$opd = function($SKPD){
			//$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			$SKPD = explode("/",$SKPD);
			$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
			return $subunit->Nm_Sub_Unit;
		};
		
		
		$satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return $model->Uraian;
		};
		
		$dapil = function($Kd_User){
			$model = TaUserDapil::find()->where(['Kd_User'=>$Kd_User])->one();
			return $model->refDapil->Nm_Dapil;
		};
		
		$fraksi = function($Kd_User){
			$model = TaUserDapil::find()->where(['Kd_User'=>$Kd_User])->one();
			return $model->refFraksi->Nm_Fraksi;
		};
		
		$rpjmd = function($kd){
			$model = RefRPJMD::find()->where(["Kd_Prioritas_Pembangunan_Kota"=>$kd])->one();
			return $model->Nm_Prioritas_Pembangunan_Kota;
		};
		
		$bidpem = function($kd){
			$model = RefBidangPembangunan::find()->where(["Kd_Pem"=>$kd])->one();
			return $model->Bidang_Pembangunan;
		};
			//if ($Setuju=="[]" || $Urusan=="" || empty($Urusan)||$Urusan=="[]") :
		if ($Setuju=="" ||$Setuju=="[]" || empty($Setuju) || $kd1=="" || empty($kd1)||$kd1=="[]"    || $dewan=="" || empty($dewan)||$dewan=="[]") :
        $data = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								])
				->all();
		else:
		$data = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
				->andwhere(['Kd_Kab' => 9])
				->andwhere(['Kd_User' => $kd1])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								])
				->all();
		endif;
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return @$model->Nm_Kec;
		};

        $desa = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut' => $kd_urut_kel])
                ->one();
				return @$model->Nm_Kel;
			
		};
		
		$lingkungan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link){
			$model = RefLingkungan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->one();
				return @$model->Nm_Lingkungan;
			
		};
		$jalan = function($kd_kec,$kd_kel,$kd_urut_kel,$kd_link,$kd_jalan){
			$model = RefJalan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
                ->andwhere(['Kd_Lingkungan' => $kd_link])
                ->andwhere(['Kd_Jalan' => $kd_jalan])
                ->one();
				return @$model->Nm_Jalan;
			
		};
		
        return $this->render('usulan-pokir', [
                'data' => $data,
                'nama_kec' => $data_kec,
				'opd'=>$opd,
				'satuan'=>$satuan,
				'rpjmd'=>$rpjmd,
				'bidpem'=>$bidpem,
				'dapil'=>$dapil,
				'fraksi'=>$fraksi,
				'model' => $model,
				'dewan' => $dewan,
        ]);
    }

    public function actionGetUsulanPokir()
    {
        $post = $request = Yii::$app->request->post();
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchPokir(Yii::$app->request->queryParams);

        return $this->render('get_usulan_pokir', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }


    public function actionGetUsulanKelurahan()
    {
        $request = Yii::$app->request;

        $Kd_Prov    = 12;
        $Kd_Kab     = 9;
        $Kd_Kec     = $request->post('Kd_Kec');
        $Kd_Kel     = $request->post('Kd_Kel');        

        $data = TaMusrenbang::find()
                ->where(['Kd_Prov' => $Kd_Prov])
                ->andwhere(['Kd_Kab' => $Kd_Kab])
                ->andwhere(['Kd_Kec' => $Kd_Kec])
                ->andwhere(['Kd_Urut_Kel' => $Kd_Kel])
                ->andwhere(['or',
                    ['Kd_Asal_Usulan' => '1'],
                    ['Kd_Asal_Usulan' => '2']
                ])
                ->andwhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ])
                ->all();

        return $this->renderpartial('get_usulan_kelurahan', [
                'data' => $data,
        ]);
    }

    public function actionGetUsulanKecamatan()
    {
        $request = Yii::$app->request;

        $Kd_Prov    = 12;
        $Kd_Kab     = 9;
        $Kd_Kec     = $request->post('Kd_Kec');

        $dokumen = TaMusrenbangKecamatanMedia::find()
                ->where(['Kd_Prov' => $Kd_Prov])
                ->andWhere(['Kd_Kab' => $Kd_Kab])
                ->andWhere(['=', 'Kd_Kec', $Kd_Kec])
                ->all();        

        $data = TaMusrenbang::find()
                ->where(['Kd_Prov' => $Kd_Prov])
                ->andWhere(['Kd_Kab' => $Kd_Kab])
                ->andWhere(['Kd_Kec' => $Kd_Kec])
                ->andWhere(['or',
                    ['Kd_Asal_Usulan' => '1'],
                    ['Kd_Asal_Usulan' => '2'],
                    ['Kd_Asal_Usulan' => '3']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kecamatan' => '1'],
                    ['Status_Penerimaan_Kecamatan' => '2']
                ])
                ->all();

        return $this->renderpartial('get_usulan_kecamatan', [
                'data' => $data,
                'dokumen' => $dokumen,
        ]);
    }

    public function actionGetUsulanKecamatan2($Kd_Kec)
    {
        $Kd_Prov        = 12;
        $Kd_Kab         = 9;

        $dataProvider = new ActiveDataProvider([
                        'query' => TaMusrenbang::find()
                            ->where(['Kd_Prov' => 12])
                            ->andWhere(['Kd_Kab' => 9])
                            ->andWhere(['Kd_Kec' => $Kd_Kec])
                            ->andWhere(['or',
                                ['Kd_Asal_Usulan' => 1],
                                ['Kd_Asal_Usulan' => 2],
                                ['Kd_Asal_Usulan' => 3]
                            ])
                            ->andWhere(['or',
                                ['Status_Penerimaan_Kelurahan' => '1'],
                                ['Status_Penerimaan_Kelurahan' => '2']
                            ])
                            ->andWhere(['or',
                                ['Status_Penerimaan_Kecamatan' => '1'],
                                ['Status_Penerimaan_Kecamatan' => '2']
                            ]),
                        'pagination' => false,
        ]);

        return $this->renderAjax('get_usulan_kecamatan2', [
                'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetUserDapil($Kd_Dapil)
    {
        $user_dapil = TaUserDapil::find()
                    ->where(['Kd_Dapil' => $Kd_Dapil])
                    ->all();
        
        echo '<option value="">- Pilih User Daerah Pemilihan -</option>';
        foreach ($user_dapil as $key => $value) {
            echo '<option style="text-transform: capitalize;" value="'.$value->Kd_User.'">'.$value->Nm_User_Dapil.'</option>';
        }
    }

    public function actionDokumenLingkungan()
    {
        $data = TaUsulanLingkunganMedia::find()
                        ->where(['Kd_Ta_Forum_Lingkungan' => 286])
                        ->all();

        return $this->render('dokumen-lingkungan', [
                'data' => $data,
        ]);
    }

    public function actionLaporanRenja() {
		$model = new LoginForm();
        $subunit = RefSubUnit::find()
                   ->where(['not', ['Nm_Sub_Unit' => '']])
				 ->andwhere(['not',["Nm_Sub_Unit"=>'Export - Import BL']])
				->andwhere(['not',["Nm_Sub_Unit"=>'Bupati dan Wakil Bupati']])
				->andwhere(['not',["Nm_Sub_Unit"=>'Dewan Perwakilan Rakyat Daerah']])
				->andwhere(['not',["Nm_Sub_Unit"=>'SEMUA']])
                    ->all();
        return $this->render('laporan-renja', ['subunit' => $subunit,'model' => $model]);
    } 
	
	
    public function actionLaporanRenja1($urusan,$bidang,$unit,$sub) { 
		$model = new LoginForm();
        $subunit = RefSubUnit::find()
                   ->where(['Kd_Urusan'=>$urusan])
				   ->andwhere(['Kd_Bidang'=>$bidang])
				   ->andwhere(['Kd_Unit'=>$unit])
				   ->andwhere(['Kd_Sub'=>$sub])
                    ->all();
        return $this->render('laporan-renja1', ['subunit' => $subunit,'model' => $model]);
    } 
	
	public function actionKamususulan(){
		$model = new LoginForm();
		$kamususulan = KamusUsulan::find()->all();
		$opd = function($var){
			$var = explode("/",$var);
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$var[0],"Kd_Bidang"=>$var[1],"Kd_Unit"=>$var[2]])->one();
			return $model->Nm_Sub_Unit;
		};
		$satuan = function($Kd_Satuan){
			$model = RefStandardSatuan::find()->where(["Kd_Satuan"=>$Kd_Satuan])->one();
			return $model->Uraian;
		};
		return $this->render('kamus-usulan',[
							'model'=>$model,
							"kamus"=>$kamususulan,
							"opd"=>$opd,
							"satuan"=>$satuan
						]);
	}
	
	
	 public function actionPantaumusrenbang($jumlah_record="*",$Kd_Kec=0,$desa_id="") 
    {
		
		$model = new LoginForm();
        //$data = TaKelurahanVerifikasiUsulanLingkungan::find()->all();
	
		
		
		if($Kd_Kec == 0 || $Kd_Kec == "*")
			$KdKec = [];
		else
			$KdKec = ["Kd_Kec"=>$Kd_Kec];
	
		$data1 = RefKelurahan::find()
			->where(['Kd_Prov' => 12])
            ->andwhere(['Kd_Kab' => 9])
			->andwhere($KdKec)
			
			
			->limit($jumlah_record)
			->all();
		
		
			
		$data = PantauMusrenbang::find()
			
			->andwhere($KdKec)
			
			
			->limit($jumlah_record)
			->all();
		
			/*
		$tot_usulan = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = TaMusrenbangKelurahan::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut_Kel' => $kd_urut_kel])
				->count();
			
		};*/
		$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return $model->Nm_Kec;
		};
		
		

        $desa = function($kd_kec,$kd_kel,$kd_urut_kel){
			$model = RefKelurahan::find()
                ->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $kd_kec])
                ->andwhere(['Kd_Kel' => $kd_kel])
                ->andwhere(['Kd_Urut' => $kd_urut_kel])
                ->one();
				return $model->Nm_Kel;
			
		};
		
		
		
		/*
		$opd = function($usulan){
			$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			$SKPD = explode("/",$model->SKPD);
			$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
			return $subunit->Nm_Sub_Unit;
		};
		*/
        return $this->render('pantau-musrenbang', [
                'data' => $data,
				'data1' => $data1,
                'nama_kec' => $data_kec,
                'nama_desa' => $desa,
              
				'untuk'=>'kelurahan',
				
				'model' => $model,
				'model_kec'=>$model_kec,
				'jumlah_record'=>$jumlah_record,
				
				'KdKec'=>$Kd_Kec,
				'desa_id'=>$desa_id,
				//'model_desa'=>$model_desa,
        ]);
    }

		
	 public function actionPantaurenja($Kd_Urusan="",$Kd_Bidang="",$Kd_Unit="",$Kd_Sub="") 
    {
		
		$model = new LoginForm();
        //$data = TaKelurahanVerifikasiUsulanLingkungan::find()->all();
	
		
			$KdUrusan= ["Kd_Urusan"=>$Kd_Urusan];
			$KdBidang= ["Kd_Bidang"=>$Kd_Bidang];
			$KdUnit= ["Kd_Unit"=>$Kd_Unit];
			$KdSub= ["Kd_Sub"=>$Kd_Sub];
			
		$data1=RefSubUnit::find()
				//->where ("<>","Nm_Sub","Export - Import BL")
				->where(["NOT",["Nm_Sub_Unit"=>'Export - Import BL']])
				->andwhere(["NOT",["Nm_Sub_Unit"=>'Bupati dan Wakil Bupati']])
				->andwhere(["NOT",["Nm_Sub_Unit"=>'Dewan Perwakilan Rakyat Daerah']])
				->andwhere(["NOT",["Nm_Sub_Unit"=>'SEMUA']])
				->all();
      
	
		
		
		$opd = function($urusan,$bidang,$unit,$sub){
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan,"Kd_Bidang"=>$bidang,"Kd_Unit"=>$unit,"Kd_Sub"=>$sub])->one();
			return $model->Nm_Sub_Unit;
		};
		/*	$xData=TaKegiatanRancanganAwal::find()
			   ->where ($KdUrusan)
			   ->andWhere($KdBidang)
			   ->andWhere($KdUnit)
			   ->andWhere($KdSub)
			   ->count();
			   echo $xData;
			 if ($xData<=0){*/
				$data = PantauRenja::find()
				->all();
			 /*}
			 else
			 {
				 $data = TaKegiatanRancanganAwal::find()
				->all();
			 }
		
		*/
		
        return $this->render('pantau-renja', [
                'data' => $data,
				    'data1' => $data1,  
				'opd'=>$opd,
				
			'model' => $model,
				'KdUrusan'=>$Kd_Urusan,
			'KdBidang'=>$Kd_Bidang,
				
				//'model_desa'=>$model_desa,
        ]);
    }

	
	 public function actionPantaukunjung() 
    {
		$model = new LoginForm();
  
        return $this->render('pantau-kunjung', [
    			'model' => $model,
        ]);	
    }
	
	 public function actionPantaukecamatan() 
    {
		$model = new LoginForm();
 
		$data = PantauKecamatan::find()
			
			->all();
		
		$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		
		$data_kec = function($kd_kec){
                    $model = RefKecamatan::find()
                        ->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])
                        ->andwhere(['Kd_Kec' => $kd_kec])
                        ->one();
					return $model->Nm_Kec;
		};
	 
        return $this->render('pantau-kecamatan', [
                'data' => $data,
				'model' => $model,
                'nama_kec' => $data_kec,
                
        ]);	
    }
	
	
	
	
			
	 public function actionPantaupokir() 
    {
		$model = new LoginForm();
		$max1 = PantauPokir::find()			
			->max('Masa_Reses');
			
		$data = PantauPokir::find()			
			->where (['Masa_Reses'=>$max1]) 
			->all();
		
	 
        return $this->render('pantau-pokir', [
				'data' =>$data,
				'model' => $model,
				
                    
        ]);	
    }
	
public function actionPantauforum() 
    {
		$model = new LoginForm();
		//$max1 = PantauForum::find()			
			//->max('Masa_Reses');
			
		$data = PantauForum::find()			
		//	->where (['Masa_Reses'=>$max1]) 
			->all();
		//$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
          //              ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		
		$data_opd = function($urusan,$bidang,$unit,$sub){
                    $model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan],["Kd_Bidang"=>$bidang],["Kd_Unit"=>$unit],["Kd_Sub"=>$sub])->all();
					return @$model->Nm_Sub_Unit;
				};
		$opd1 = function($urusan,$bidang,$unit,$sub){
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan,"Kd_Bidang"=>$bidang,"Kd_Unit"=>$unit,"Kd_Sub"=>$sub])->one();
			return @$model->Nm_Sub_Unit;
		
		};
	 
        return $this->render('pantau-forum', [
				'data' =>$data,
				'model' => $model,
				'data_opd' => $data_opd,
				'opd1' => $opd1,
				
                    
        ]);	
    }

public function actionPantauharini() 
    {
		$model = new LoginForm();
 	       return $this->render('pantau-harini', [
				'model' => $model,
        ]);	
    }
	
	public function actionPantaukemaren() 
    {
		$model = new LoginForm();
       return $this->render('pantau-kemaren', [
  		'model' => $model,
				
        ]);	
    }
		public function actionPantaubulani() 
    {
		$model = new LoginForm();
	       return $this->render('pantau-bulani', [
				'model' => $model,
				
        ]);	
    }
	public function actionTampilagenda() 
    {
		
		$model = new LoginForm();
        //$data = TaKelurahanVerifikasiUsulanLingkungan::find()->all();
	
		
			
		
			
		 $data = TampilAgenda::find()
			->all();
		
		
		
        return $this->render('tampil-agenda', [
                'data' => $data,  
				'model' => $model,
				
        ]);
    }
    public function actionGetLaporanRenja() {
        $post = explode('.', $request = Yii::$app->request->post('Kd_Sub'));
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $tahun = 2019;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $post[0], 'Kd_Bidang' => $post[1], 'Kd_Unit' => $post[2], 'Kd_Sub' => $post[3]])->one();


        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        return $this->renderPartial('get_laporan_renja', [
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'dataKeteranganKeg' => $dataKeteranganKeg
        ]);
    }

    public function actionCetakLaporanRenja($urusan, $bidang, $unit, $sub) {

        $tahun = 2019;
        $kelompok = $this->getKota(true);


        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak_laporan_renja', [
                'tahun' => $tahun,
                'kelompok' => $kelompok,
                'subunit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan,
                'dataKeteranganKeg' => $dataKeteranganKeg
                    // 'dataUrusBidang'=>$dataUrusBidang
            ]),
            'options' => [
                'title' => 'Laporan Renja',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10'],
            ]
        ]);
        return $pdf->render();
    }
//Add By RG
 public function actionGetLaporanRenjaRanwal() {
        $post = explode('.', $request = Yii::$app->request->post('Kd_Sub'));
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $tahun = 2019;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $post[0], 'Kd_Bidang' => $post[1], 'Kd_Unit' => $post[2], 'Kd_Sub' => $post[3]])->one();


        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        return $this->renderPartial('get_laporan_renja_ranwal', [
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'dataKeteranganKeg' => $dataKeteranganKeg
        ]);
    }

    public function actionCetakLaporanRenjaRanwal($urusan, $bidang, $unit, $sub) {

        $tahun = 2019;
        $kelompok = $this->getKota(true);


        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak_laporan_renja_ranwal', [
                'tahun' => $tahun,
                'kelompok' => $kelompok,
                'subunit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan,
                'dataKeteranganKeg' => $dataKeteranganKeg
                    // 'dataUrusBidang'=>$dataUrusBidang
            ]),
            'options' => [
                'title' => 'Laporan Renja',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10'],
            ]
        ]);
        return $pdf->render();
    }
//Batas

    public function actionIdentitas(){

      
        $model = new TaPemda();
        
        // $modelProvinsi = RefProvinsi::find()->all();
        
        $modelProvinsi = ArrayHelper::map(RefProvinsi::find()
                          ->all(), 'Kd_Prov', 'Nm_Prov');
   
        $Tahun = 2017;
      

        if($model->load(Yii::$app->request->post())){

        $prov = $model->Kd_Prov;
        $kab = $model->Kd_Kab;
        $hostname = Yii::$app->levelcomponent->getServerName();
        $ippublic = Yii::$app->levelcomponent->getUserHost();

        $modelProvinsi= RefKabupaten::find()->where(['Kd_Prov' => $prov, 'Kd_Kab' => $kab])->one();

        $kabupaten = $modelProvinsi->Nm_Kab;

        $model->Tahun = $Tahun;
        $model->Nm_Pemda = $modelProvinsi;
        $model->Created_At = time();
        $model->Status = 0;
        $model->Nm_Pemda = $kabupaten;
        $model->Hostname = $hostname;
        $model->Ip_Public = $ippublic;      

        // $kabupaten =[];
        // foreach ($modelProvinsi as $value) {
                // $kabupaten[$value['Nm_Kab']]=$value['Nm_Kab'];
        // }

        // print_r($kabupaten); exit();   
        if ($model->save(false)) {
          return $this->redirect(['index']);
         }
        } else {

        return $this->render('form_identitas', [
        'model'=>$model,
        'modelProvinsi'=>$modelProvinsi,
        ]);
        }
    }

      public function actionKirimidentitas($Kd_Prov, $Kd_Kab, $Email,$Token
        ){

      
        $model = new TaPemda();
        
        // $modelProvinsi = RefProvinsi::find()->all();
        
        $modelProvinsi = ArrayHelper::map(RefProvinsi::find()
                          ->all(), 'Kd_Prov', 'Nm_Prov');
   
        $Tahun = 2017;
      

        if($model->load(Yii::$app->request->post())){

        $prov = $model->Kd_Prov;
        $kab = $model->Kd_Kab;
        $hostname = Yii::$app->levelcomponent->getServerName();
        $ippublic = Yii::$app->levelcomponent->getUserHost();

        $modelProvinsi= RefKabupaten::find()->where(['Kd_Prov' => $prov, 'Kd_Kab' => $kab])->one();

        $kabupaten = $modelProvinsi->Nm_Kab;

        $model->Tahun = $Tahun;
        $model->Nm_Pemda = $modelProvinsi;
        $model->Created_At = time();
        $model->Status = 0;
        $model->Nm_Pemda = $kabupaten;
        $model->Hostname = $hostname;
        $model->Ip_Public = $ippublic;      

        // $kabupaten =[];
        // foreach ($modelProvinsi as $value) {
                // $kabupaten[$value['Nm_Kab']]=$value['Nm_Kab'];
        // }

        // print_r($kabupaten); exit();   
        if ($model->save(false)) {
          return $this->redirect(['index']);
         }
        } else {

        return $this->render('form_identitas', [
        'model'=>$model,
        'modelProvinsi'=>$modelProvinsi,
        ]);
        }
    }
	
	 public function actionDokumen() {

        // print_r($this->Posisi());
        // die();

        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = TaMusrenbangKecamatanAcara::findOne($model);
        $searchModel = new TaMusrenbangKecamatanMediaSearch();
        $dataProvider = $searchModel->Samsearch(Yii::$app->request->queryParams, $model);
      //  if ($acara == null || $acara->Waktu_Mulai == 0)
       //     return $this->redirect(['index']);
      //  $model = new \eperencanaan\models\UploadForm();

        return $this->render('dokumen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'acara' => $acara,
                    'model' => $model
        ]);
    }
	

}