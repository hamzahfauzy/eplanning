<?php

namespace emusrenbang\controllers;

use Yii;
use eperencanaan\models\TaMusrenbang;
use emusrenbang\models\TaMusrenbangSearch;
use eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch;
use eperencanaan\models\search\TaMusrenbangKelurahanMediaSearch;
use eperencanaan\models\search\TaForumLingkunganMediaSearch;
use eperencanaan\models\search\TaPokirMediaSearch;
use emusrenbang\models\TaBelanjaRincSub;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD;
use common\models\RefSubUnit;
use common\models\RefStandardSatuan;
use common\models\RefDapil;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangController implements the CRUD actions for TaMusrenbang model.
 */
class TaMusrenbangController extends Controller {
    /**
     * @inheritdoc
     */
    public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => 12,//$data['Kd_Prov'],
            'Kd_Kab' => 9,//$data['Kd_Kab'],
            // 'Kd_Kec' => $data['Kd_Kec']
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

    /**
     * Lists all TaMusrenbang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaMusrenbang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaMusrenbang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TaMusrenbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Posisi()
    {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        return [
            'Kd_Urusan'=>@$kelompok->Kd_Urusan, 
            'Kd_Bidang'=>@$kelompok->Kd_Bidang,
            'Kd_Unit'=>@$kelompok->Kd_Unit, 
            'Kd_Sub'=>@$kelompok->Kd_Sub_Unit,
        ];
    }

    public function actionUsulanLingkungan() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchLingkungan(Yii::$app->request->queryParams);

        $Posisi = @$this->Posisi();

        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_bidpem = ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd = ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );

        return $this->render('usulan-lingkungan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_kecamatan' => $data_kecamatan,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
        ]);
    }

    public function actionUsulanKelurahan() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchKelurahan(Yii::$app->request->queryParams);

        $Posisi = @$this->Posisi();

        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_kelurahan = ArrayHelper::map(RefKelurahan::find()
                          ->where(['Kd_Prov' => $Kd_Prov])
                          ->andwhere(['Kd_Kab' => $Kd_Kab])
                          ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                          ->orderBy(['Nm_Kel' => SORT_ASC])
                          ->all(), 
                          'Kd_Urut', 
                          'Nm_Kel'
                        );

        $data_bidpem= ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd= ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );

        return $this->render('usulan-kelurahan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_kecamatan' => $data_kecamatan,
                    'data_kelurahan' => $data_kelurahan,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
        ]);
    }

    public function actionUsulanKecamatan() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchKecamatan(Yii::$app->request->queryParams);
        
        $Posisi = @$this->Posisi();
        
        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_kelurahan = ArrayHelper::map(
                              TaMusrenbang::find()
                                ->where($Posisi)
                                // ->andWhere(['Kd_Asal_Usulan'=>'1','2','3'])
                                ->groupBy(['Kd_Urut_Kel'])
                                ->all(),
                              'Kd_Urut_Kel',
                              'kelurahan.Nm_Kel'
                            );

        $data_lingkungan = ArrayHelper::map(
                              TaMusrenbang::find()
                                ->where($Posisi)
                                ->andWhere(['Kd_Asal_Usulan'=>'1'])
                                ->groupBy(['Kd_Lingkungan'])
                                ->all(),
                              'Kd_Lingkungan',
                              'lingkungan.Nm_Lingkungan'
                            );

        $data_bidpem= ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd= ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );

        return $this->render('usulan-kecamatan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_kecamatan' => $data_kecamatan,
                    'data_kelurahan' => $data_kelurahan,
                    'data_lingkungan' => $data_lingkungan,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
        ]);
    }

    public function actionCetakUsulanKecamatan() {
	$Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchKecamatan(Yii::$app->request->queryParams);
        
        $Posisi = @$this->Posisi();
        $data_infrastruktur = TaMusrenbang::find()
                        ->where($this->Posisi())
                        ->andWhere(['Kd_Pem' => ['1','2','3']])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->orderBy(['Kd_Kec' => SORT_DESC, 'skor' => SORT_DESC])
                        ->all();     

        $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('usulan_cetak_kecamatan', [
                //'Nm_Kec' => $Nm_Kec,
                          'data' => $data_infrastruktur, 
                                    //'data_sosbud' => $data_sosbud,
                                    //'data_ekonomi' => $data_ekonomi,
                            ]),
                    'options' => [
                        'title' => 'Usulan',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
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

    public function actionUsulanSemua() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);
        
        $Posisi = @$this->Posisi();

        $data_lingkungan = ArrayHelper::map(RefLingkungan::find()
                            ->andwhere(['Kd_Prov' => $Kd_Prov])
                            ->andwhere(['Kd_Kab' => $Kd_Kab])
                            ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                            ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
                            ->all(),
                            'Kd_Lingkungan',
                            'lingkungan.Nm_Lingkungan'
                          );

        $data_kelurahan = ArrayHelper::map(RefKelurahan::find()
                            ->where(['Kd_Prov' => $Kd_Prov])
                            ->andwhere(['Kd_Kab' => $Kd_Kab])
                            ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                            ->orderBy(['Nm_Kel' => SORT_ASC])
                            ->all(), 
                            'Kd_Urut', 
                            'Nm_Kel'
                          );

        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_bidpem = ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd = ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );

        return $this->render('usulan-semua', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_lingkungan' => $data_lingkungan,
                    'data_kelurahan' => $data_kelurahan,
                    'data_kecamatan' => $data_kecamatan,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
        ]);
    }
	
	//Usulan FOrum
	  public function actionUsulanForum() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchForum(Yii::$app->request->queryParams);
        
        $Posisi = @$this->Posisi();
        
        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_kelurahan = ArrayHelper::map(
                              TaMusrenbang::find()
                                ->where($Posisi)
                                // ->andWhere(['Kd_Asal_Usulan'=>'1','2','3'])
                                ->groupBy(['Kd_Urut_Kel'])
                                ->all(),
                              'Kd_Urut_Kel',
                              'kelurahan.Nm_Kel'
                            );

        $data_lingkungan = ArrayHelper::map(
                              TaMusrenbang::find()
                                ->where($Posisi)
                                ->andWhere(['Kd_Asal_Usulan'=>'1'])
                                ->groupBy(['Kd_Lingkungan'])
                                ->all(),
                              'Kd_Lingkungan',
                              'lingkungan.Nm_Lingkungan'
                            );

        $data_bidpem= ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd= ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );
		$data_skpd = ArrayHelper::map(
                              RefSubUnit::find()
                                ->all(),                             
							  'Kd_Sub',
                              'Nm_Sub_Unit'
                            );

        return $this->render('usulan-forum', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_kecamatan' => $data_kecamatan,
                    'data_kelurahan' => $data_kelurahan,
                    'data_lingkungan' => $data_lingkungan,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
					'data_skpd'=>$data_skpd,
        ]);
    }

    public function actionCetakUsulanForum() {
	   $Tahun = date('Y');

       // if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                    ->where($this->Posisi())
					->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
						
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                   // ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ]);

      
        $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('usulan_cetak_forum', [
					'data' => $query
                            ]),
                    'options' => [
                        'title' => 'Usulan',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
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
   
        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }
	//-------------------//
	
	
	
	public function actionUsulan($asal,$Kd_Kec) {
        if($Kd_Kec == 0 || $Kd_Kec == "*"|| $Kd_Kec == "")
			$KdKec = [];
		else
			$KdKec = ["Kd_Kec"=>$Kd_Kec];
		$model_kec = RefKecamatan::find()->where(['Kd_Prov' => 12])
                        ->andwhere(['Kd_Kab' => 9])->orderBy(["Nm_Kec"=>SORT_ASC])->all();
		$Posisi = $this->Posisi();
		if($asal == 3){
			$model = TaMusrenbang::find()
					  ->where($Posisi)
					  ->andWhere(["or",
									["Kd_Asal_Usulan"=>'1'],
									["Kd_Asal_Usulan"=>'2'],
									["Kd_Asal_Usulan"=>'3'],
								])
					  ->andWhere(["IS NOT","Skor",NULL])
					  ->andwhere ($KdKec)
					  ->orderBy(['Skor' => SORT_DESC,'Kd_Asal_Usulan' => SORT_ASC]);
		}else if($asal == 4){
			$model = TaMusrenbang::find()
				  ->where($Posisi)
				  ->andWhere(["or",
								["Status_Penerimaan_Skpd"=>'1'],
								["Status_Penerimaan_Skpd"=>'2']
							])
				  ->andWhere(["or",
								["Kd_Asal_Usulan"=>'1'],
								["Kd_Asal_Usulan"=>'2'],
								["Kd_Asal_Usulan"=>'3'],
								["Kd_Asal_Usulan"=>'4'],
								["Kd_Asal_Usulan"=>'5'],
								["Kd_Asal_Usulan"=>'6'],
								["Kd_Asal_Usulan"=>'7'],
								["Kd_Asal_Usulan"=>'8'],
							])
							->andwhere ($KdKec)
				->orderBy(['Skor' => SORT_DESC,'Kd_Asal_Usulan' => SORT_ASC]);
				  
		}
		else if($asal == 5){
			$model = TaMusrenbang::find()
				  ->where($Posisi)
				  ->andWhere(["or",
								["Kd_Asal_Usulan"=>'5'],
								["Kd_Asal_Usulan"=>'6'],
								["Kd_Asal_Usulan"=>'7'],
								["Kd_Asal_Usulan"=>'8'],
							])
							->andwhere ($KdKec)							
				->orderBy(['Skor' => SORT_DESC,'Kd_Asal_Usulan' => SORT_ASC]);
		}else{
			return null;
		}
      
        return $this->renderPartial('usulan', [
									'model'=>$model->all(),
		'KdKec'=>$Kd_Kec,
'model_kec'=>$model_kec,		
        ]); 
		
    }

    public function actionUsulanPokir() {
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchPokir(Yii::$app->request->queryParams);

        $Posisi = @$this->Posisi();

        $data_kecamatan = ArrayHelper::map(
                        RefKecamatan::find()
                        ->where(['Kd_Prov' => $Kd_Prov])
                        ->andwhere(['Kd_Kab' => $Kd_Kab])
                        ->orderBy(['Nm_Kec' => SORT_ASC])
                        ->asArray()
                        ->all(),
                        'Kd_Kec',
                        'Nm_Kec'
                    );

        $data_bidpem = ArrayHelper::map(
                              RefBidangPembangunan::find()
                                ->all(),
                              'Kd_Pem',
                              'Bidang_Pembangunan'
                            );

        $data_rpjmd = ArrayHelper::map(
                              RefRPJMD::find()
                                ->all(),
                              'Kd_Prioritas_Pembangunan_Kota',
                              'Nm_Prioritas_Pembangunan_Kota'
                            );

        $data_skpd = ArrayHelper::map(
                              RefSubUnit::find()
                                ->all(),
                              'Kd_Sub',
                              'Nm_Sub_Unit'
                            );


        // $data_satuan = ArrayHelper::map(RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $data_dapil = ArrayHelper::map(RefDapil::find()->orderBy('Nm_Dapil')->all(),'Kd_Dapil','Nm_Dapil');

        

        return $this->render('usulan-pokir', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'data_bidpem' => $data_bidpem,
                    'data_rpjmd' => $data_rpjmd,
                    // 'data_satuan' => $data_satuan,
                    'data_dapil' => $data_dapil,
                    'data_kecamatan' => $data_kecamatan,
					'data_skpd' => $data_skpd,
        ]);
    }

    public function actionKompilasiUsulan() {

        // Kompilasi usulan dan Nomenklatur redaksi usulan menjadi objek rincian belanja

        return $this->redirect(['kompilasi-usulan']);
    }



   public function actionUsulanKecamatanVerifikasi() {
      $searchModel = new TaMusrenbangSearch();
      $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);
      
      $Posisi = $this->Posisi();
      $data_lingkungan = ArrayHelper::map(
                            TaMusrenbang::find()
                              ->where($Posisi)
                              ->andWhere(['Kd_Asal_Usulan'=>['1','2','3']])
                              ->groupBy(['Kd_Kec'])
                              ->all(),
                            'Kd_Lingkungan',
                            'lingkungan.Nm_Lingkungan'
                          );
      $data_kelurahan = ArrayHelper::map(
                            TaMusrenbang::find()
                              ->where($Posisi)
                              ->andWhere(['Kd_Asal_Usulan'=>['1','2','3']])
                              ->groupBy(['Kd_Kec'])
                              ->all(),
                            'Kd_Kec',
                            'kelurahan.Nm_Kel'
                          );
      $data_kecamatan = ArrayHelper::map(
                            TaMusrenbang::find()
                              ->where($Posisi)
                              ->andWhere(['Kd_Asal_Usulan'=>['1','2','3']])
                              ->groupBy(['Kd_Kec'])
                              ->all(),
                            'Kd_Kec',
                            'kecamatan.Nm_Kec'
                          );

      $data_bidpem= ArrayHelper::map(
                            RefBidangPembangunan::find()
                              ->all(),
                            'Kd_Pem',
                            'Bidang_Pembangunan'
                          );

      $data_rpjmd= ArrayHelper::map(
                            RefRPJMD::find()
                              ->all(),
                            'Kd_Prioritas_Pembangunan_Kota',
                            'Nm_Prioritas_Pembangunan_Kota'
                          );

        
      return $this->render('usulan-lingkungan', [
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
                  'data_kecamatan' => $data_kecamatan,
                  'data_kelurahan' => $data_kelurahan,
                  'data_bidpem' => $data_bidpem,
                  'data_rpjmd' => $data_rpjmd,
      ]);
  }

  public function actionLihatFile($nama_file)
  { 
      return $this->renderpartial('lihat_file', [
              'nama_file' => $nama_file,
      ]);
  }

  public function actionSampleDownload($filename) {
      ob_clean();
      \Yii::$app->response->sendFile($filename)->send();
  }

  public function actionDokumenKecamatanTampil($Kd_Kec=''){
      $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
     //print_r($Posisi);
      $data_kecamatan = RefKecamatan::find()
						->where($Posisi)
                       // ->where(['Kd_Prov'=>12])
					//	->andWhere(['Kd_Kab'=>9])
						->groupBy(['Kd_Kec'])
                        ->all();

      $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      if ($Kd_Kec=='') {
          return $this->render('dokumen-kecamatan-tampil', [
              'data_kecamatan' => $data_kecamatan,
          ]);
      }

      $model['Kd_Kec'] = $Kd_Kec;

      $searchModel = new TaMusrenbangKecamatanMediaSearch();
      $dataProvider = $searchModel->Samsearch(Yii::$app->request->queryParams, $model);

      $model = new \eperencanaan\models\UploadForm();

      return $this->render('dokumen-kecamatan-tampil', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'data_kecamatan' => $data_kecamatan,
          'Kd_Kec' => $Kd_Kec,
          'model' => $model
      ]);
  }
    
  public function actionDokumenKelurahanTampil($Kd_Kec='',$Kd_Kel=''){
      $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      $data_kelurahan = [];
      $data_kecamatan = RefKecamatan::find()
                        ->where($Posisi)
						//->where(["Kd_Prov"=>12,"Kd_Kab"=>9])
                        ->groupBy(['Nm_Kec'])
                        ->all();

      $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      if ($Kd_Kec=='' || $Kd_Kel=='') {
          return $this->render('dokumen-kelurahan-tampil', [
              'data_kecamatan' => $data_kecamatan,
              'data_kelurahan' => $data_kelurahan,
          ]);
      }

      $data_kelurahan = RefKelurahan::find()
                        ->where($Posisi)
						->where(["Kd_Prov"=>12,"Kd_Kab"=>9])
                        ->andWhere(['Kd_Kec' => $Kd_Kec])
                        ->groupBy(['Nm_Kel'])
                        ->all();

      $model['Kd_Kec'] = $Kd_Kec;
      $model['Kd_Urut_Kel'] = $Kd_Kel;

      $searchModel = new TaMusrenbangKelurahanMediaSearch();
      $dataProvider = $searchModel->ZULsearch(Yii::$app->request->queryParams, $model);

      $model = new \eperencanaan\models\UploadForm();

      return $this->render('dokumen-kelurahan-tampil', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'data_kecamatan' => $data_kecamatan,
          'data_kelurahan' => $data_kelurahan,
          'Kd_Kec' => $Kd_Kec,
          'Kd_Kel' => $Kd_Kel,
          'model' => $model
      ]);
  }

  public function actionDokumenLingkunganTampil($Kd_Kec='',$Kd_Kel='',$Kd_Lingkungan=''){
      $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      $data_kelurahan = [];
      $data_lingkungan = [];
      $data_kecamatan = RefKecamatan::find()
                        ->where($Posisi)
                        ->groupBy(['Nm_Kec'])
                        ->all();

      $model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      if ($Kd_Kec=='' || $Kd_Kel=='' || $Kd_Lingkungan=='') {
          return $this->render('dokumen-lingkungan-tampil', [
              'data_kecamatan' => $data_kecamatan,
              'data_kelurahan' => $data_kelurahan,
              'data_lingkungan' => $data_lingkungan,
          ]);
      }

      $data_kelurahan = RefKelurahan::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Kec' => $Kd_Kec])
                        ->groupBy(['Nm_Kel'])
                        ->all();

      $data_lingkungan = RefLingkungan::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Kec' => $Kd_Kec])
                        ->andWhere(['Kd_Urut_Kel' => $Kd_Kel])
                        ->groupBy(['Nm_Lingkungan'])
                        ->all();

      $model['Kd_Kec'] = $Kd_Kec;
      $model['Kd_Urut_Kel'] = $Kd_Kel;
      $model['Kd_Lingkungan'] = $Kd_Lingkungan;

      $searchModel = new TaForumLingkunganMediaSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model);

      return $this->render('dokumen-lingkungan-tampil', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'data_kecamatan' => $data_kecamatan,
          'data_kelurahan' => $data_kelurahan,
          'data_lingkungan' => $data_lingkungan,
          'Kd_Kec' => $Kd_Kec,
          'Kd_Kel' => $Kd_Kel,
          'Kd_Lingkungan' => $Kd_Lingkungan,
          'model' => $model
      ]);
  }

  public function actionDokumenPokirTampil(){
      $searchModel = new TaPokirMediaSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('dokumen-pokir-tampil', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          // 'model' => $model
      ]);
  }

  public function actionGetKelurahan($Kd_Kec) {
      $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      $data_kecamatan = RefKelurahan::find()
                       // ->where($Posisi)
					   ->where(["Kd_Prov"=>12,"Kd_Kab"=>9])
                        ->andWhere(['Kd_Kec' => $Kd_Kec])
                        ->groupBy(['Nm_Kel'])
                        ->all();
      echo "<option value=''>Pilih Kelurahan</option>";
      foreach ($data_kecamatan as $key => $value) {
          echo "<option value='".$value->Kd_Urut."'>".$value->Nm_Kel."</option>";
      }

  }

  public function actionGetLingkungan($Kd_Kec,$Kd_Kel) {
      $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
      $data_kecamatan = RefLingkungan::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Kec' => $Kd_Kec])
                        ->andWhere(['Kd_Urut_Kel' => $Kd_Kel])
                        ->groupBy(['Nm_Lingkungan'])
                        ->all();
      echo "<option value=''>Pilih Lingkungan</option>";
      foreach ($data_kecamatan as $key => $value) {
          echo "<option value='".$value->Kd_Lingkungan."'>".$value->Nm_Lingkungan."</option>";
      }

  }

}
