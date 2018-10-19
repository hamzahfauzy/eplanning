<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\MusrenbangSkpdAcara;
use eperencanaan\models\search\TaMusrenbangKecamatanAcaraSearch;
use eperencanaan\models\TaMusrenbang;
use common\models\RefKelurahan;
use common\models\RefKecamatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * TaMusrenbangKecamatanAcaraController implements the CRUD actions for TaMusrenbangKecamatanAcara model.
 */
class MusrenbangSkpdAcaraController extends Controller {

    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        $pos = [
            'Kd_Urusan' => $kelompok['Kd_Urusan'],
            'Kd_Bidang' => $kelompok['Kd_Bidang'],
            'Kd_Unit' => $kelompok['Kd_Unit'],
			'Kd_Sub_Unit' => $kelompok['Kd_Sub_Unit'],
        ];
        return $pos;
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
     * Lists all TaMusrenbangKecamatanAcara models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MusrenbangSkpdAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKecamatanAcara model.
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
     * Creates a new TaMusrenbangKecamatanAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MusrenbangSkpdAcara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKecamatanAcara model.
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
     * Deletes an existing TaMusrenbangKecamatanAcara model.
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
     * Finds the TaMusrenbangKecamatanAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @return TaMusrenbangKecamatanAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub_Unit) {
        if (($model = MusrenbangSkpdAcara::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub_Unit' => $Kd_Sub_Unit])) !== null) {
            return $model;
        }
        return null;
    }

    public function actionAbsensi($kode) {
        
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();
        $ZULmodel = Yii::$app->levelcomponent->getUnit();
        $ZULSkpd = $this->findModel($Tahun, $ZULmodel->Kd_Urusan, $ZULmodel->Kd_Bidang, $ZULmodel->Kd_Unit, $ZULmodel->Kd_Sub_Unit);
        if ($ZULSkpd == null) {
            $ZULSkpd = new \eperencanaan\models\MusrenbangSkpdAcara();
            $ZULSkpd->Kd_Urusan = $ZULmodel->Kd_Urusan;
            $ZULSkpd->Kd_Bidang = $ZULmodel->Kd_Bidang;
            $ZULSkpd->Kd_Unit = $ZULmodel->Kd_Unit;
			$ZULSkpd->Kd_Sub_Unit = $ZULmodel->Kd_Sub_Unit;
            
            if ($ZULSkpd->load(Yii::$app->request->post())) {
                $ZULSkpd->Waktu_Unduh_Absen = time();
                $ZULSkpd->Tahun = $Tahun;
                // $ZULKecamatan->Waktu_Mulai = time();
                $ZULSkpd->Kd_User = Yii::$app->user->identity->id;
                $ZULSkpd->save(false);
            }
        }
        if ($kode == 1) {
            $stat = "MULAI";
        } else {
            $stat = "SELESAI";
            //$TaFLA = TaForumLingkunganAcara::findOne($ZULmodel);
        }
		
		$namaopd = Yii::$app->levelcomponent->getNamaOPD();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('absensi', ['stat' => $stat,'model' => $ZULSkpd, 'Nm_Pemda' => $Nm_Pemda, 'Tahun' => $Tahun]),
            'options' => [
                'title' => 'Absensi',
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

    public function actionMulai() {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $ZULmodel = Yii::$app->levelcomponent->getUnit();
		
        $ZULSkpd = $this->findModel($Tahun, $ZULmodel->Kd_Urusan, $ZULmodel->Kd_Bidang, $ZULmodel->Kd_Unit, $ZULmodel->Kd_Sub_Unit);
		
        $ZULSkpd->Waktu_Mulai = time();
        
        if ($ZULSkpd->save(false)) {
            return $this->redirect(['musrenbang-skpd/index', 'pesan' => 'berhasil']);
        } else {
            return $this->redirect(['musrenbang-skpd/index', 'pesan' => 'gagal']);
        }
    }
    
    public function actionSelesai() {
        $Posisi = $this->Posisi();
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $KecamatanAcara = MusrenbangSkpdAcara::findone($Posisi);
            $KecamatanAcara->Waktu_Selesai = time();
            $KecamatanAcara->save(false);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        
        echo 'Musrenbang Selesai';
    }
    
    public function actionBeritaAcara($kode) {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $Posisi = $this->Posisi();
        $Nm_Pemda = $this->getKota();

        $jlh_usulan = \eperencanaan\models\MusrenbangSkpdAcara::find()
                    ->where($Posisi)
                    ->count(); 
					
		$post = Yii::$app->request->post();

		$ZULmodel = Yii::$app->levelcomponent->getUnit();
					
		$usulan_terima = TaMusrenbang::find()
						->where(["Kd_Urusan"=>$ZULmodel->Kd_Urusan, 
								 "Kd_Bidang"=>$ZULmodel->Kd_Bidang, 
								 "Kd_Unit"=>$ZULmodel->Kd_Unit, 
								 "Kd_Sub"=>$ZULmodel->Kd_Sub_Unit])
						->andWhere(["Kd_Kec"=>$post['MusrenbangSkpdAcara']['Kd_Kec']])
						
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
					->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2']
						])
						->andwhere(["IS NOT","Skor",NULL])//add by RG
						->orderBy(["Skor"=>SORT_DESC])
						->all();			
		
		$usulan_tolak = TaMusrenbang::find()
						->where(["Kd_Urusan"=>$ZULmodel->Kd_Urusan, 
								 "Kd_Bidang"=>$ZULmodel->Kd_Bidang, 
								 "Kd_Unit"=>$ZULmodel->Kd_Unit, 
								 "Kd_Sub"=>$ZULmodel->Kd_Sub_Unit])
						->andWhere(["Kd_Kec"=>$post['MusrenbangSkpdAcara']['Kd_Kec']])
						->andWhere(["or",

                                        ["Kd_Asal_Usulan"=>'1'],
                                        ["Kd_Asal_Usulan"=>'2'],
                                        ["Kd_Asal_Usulan"=>'3'], ])
						->andWhere(["or",
										["Status_Penerimaan_Skpd"=>NULL],
										["Status_Penerimaan_Skpd"=>'3'] ])
										->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2']
						])
					->andwhere(["IS NOT","Skor",NULL])//add by RG
						->orderBy(["Status_Penerimaan_Skpd"=>SORT_DESC])
						->all();
						
		$usulan_tolak_pokir = TaMusrenbang::find()
						->where(["Kd_Urusan"=>$ZULmodel->Kd_Urusan, 
								 "Kd_Bidang"=>$ZULmodel->Kd_Bidang, 
								 "Kd_Unit"=>$ZULmodel->Kd_Unit, 
								 "Kd_Sub"=>$ZULmodel->Kd_Sub_Unit])
						->andWhere(["Kd_Kec"=>$post['MusrenbangSkpdAcara']['Kd_Kec']])
						->andWhere(["or",

                                        ["Kd_Asal_Usulan"=>'4'],
                                        ["Kd_Asal_Usulan"=>'5'],
                                        ["Kd_Asal_Usulan"=>'6'],
                                        ["Kd_Asal_Usulan"=>'7'],
                                        ["Kd_Asal_Usulan"=>'8'], ])
						->andWhere(["or",
										["Status_Penerimaan_Skpd"=>NULL],
										["Status_Penerimaan_Skpd"=>'3'] ])
										

					//->andwhere(["IS NOT","Skor",NULL])//add by RG
						->orderBy(["Status_Penerimaan_Skpd"=>SORT_DESC])
						->all();
						
		$kecamatan = function($kd){
			$model = RefKecamatan::find()->where(["Kd_Kec"=>$kd])->one();
			return $model;
		};
					
        $ZULKelurahan = $this->findModel($Tahun, $ZULmodel->Kd_Urusan, $ZULmodel->Kd_Bidang, $ZULmodel->Kd_Unit, $ZULmodel->Kd_Sub_Unit);
        //$TaFLA = TaMusrenbangKelurahanAcara::findOne($model);
        if ($kode == 1 && $ZULKelurahan->load(Yii::$app->request->post())) {
            $ZULKelurahan->Waktu_Unduh_Berita_Acara = time();
            $ZULKelurahan->save(false);
        }
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('bap', [
												'stat' => 'SELESAI',
												'usulan' => $jlh_usulan, 
												'model' => $ZULKelurahan,
												'usulan_terima'=>$usulan_terima,
												'usulan_tolak'=>$usulan_tolak,
												'usulan_tolak_pokir'=>$usulan_tolak_pokir,
												'Tahun' => $Tahun, 
												'kecamatan' => $kecamatan, 
												'post'=>$post,
												'Nm_Pemda' => $Nm_Pemda]),
            'options' => [
                'title' => 'Berita Acara',
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
    
    public function actionUbahStatusUsulan(){

        $Tahun = Yii::$app->pengaturan->getTahun();
        $ZULmodel = Yii::$app->levelcomponent->getKelompok();
        $ZULKelurahan = $this->findModel($Tahun, $ZULmodel->Kd_Prov, $ZULmodel->Kd_Kab, $ZULmodel->Kd_Kec, $ZULmodel->Kd_Kel, $ZULmodel->Kd_Urut_Kel);
        $ZULKelurahan->Status_Pembahasan_Usulan = 1;
        $ZULKelurahan->save(false);
        $this->redirect(['ta-musrenbang-kelurahan/kompilasi']);
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
}
