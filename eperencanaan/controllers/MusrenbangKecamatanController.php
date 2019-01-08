<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbang;
use eperencanaan\models\search\TaMusrenbangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\RefUrusan;
use common\models\TaSubUnit;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefKecamatan;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD;
use common\models\RefKecamatanKriteriaPembobotan;
use eperencanaan\models\TaMusrenbangRiwayat;
use common\models\RefSubUnit;
use eperencanaan\models\KamusUsulan;
use common\models\RefJalan;


/**
 * TaMusrenbangController implements the CRUD actions for TaMusrenbang model.
 */
class MusrenbangKecamatanController extends Controller
{
    /**
     * @inheritdoc
     */

    public function NASarraymap($data) {
        $NASarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            // 'Kd_Kel' => $data['Kd_Kel'],
            // 'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
            // 'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $NASarray;
    }


     public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec'],
            // 'Kd_Kel' => $kelompok['Kd_Kel'],
            // 'Kd_Urut_Kel' => $kelompok['Kd_Urut_Kel']
        ];
        return $pos;
    }

    public function Kd_User() {
        $user = Yii::$app->user->identity->id;
        return $user;
    }

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
     * Lists all TaMusrenbang models.
     * @return mixed
     */
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaMusrenbang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        $user = (Yii::$app->user->identity->id);
        $model = new TaMusrenbang();
        $models = $this->NASarraymap(Yii::$app->levelcomponent->getKelompok());
        $Posisi = $this->Posisi();
     
        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->where([ 'Tahun'=>$Tahun, 'Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab, ])->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
       
        $unit =RefSubUnit::find()
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
        $model->attributes = $models;
        $model->Tanggal = time();
        $model->Kd_User = $user;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

         if ($model->load(Yii::$app->request->post())) {
			 
			 /*
			$reflink = RefLingkungan::find()
						->where(["Kd_Prov"=>12])
						->andwhere(["Kd_Kab"=>9])
						->andwhere(["Kd_Kec"=>$model->Kd_Kec])
						->andwhere(["Kd_Kel"=>$model->Kd_Kel])
						->andwhere(["Kd_Lingkungan"=>$model->Kd_Lingkungan])
						->one();
						
			//print_r($reflink);
			//return;
			$model->Kd_Urut_Kel = $reflink->Kd_Urut_Kel;
			*/
			$data =Yii::$app->request->post();
			$value = explode("|",@$data['TaMusrenbang']['Kd_Lingkungan']);
			/*
			echo "<pre>";
			print_r($value);
			return;*/
			@$model->Kd_Kel = $value[0];
			@$model->Kd_Urut_Kel = $value[1];
			@$model->Kd_Lingkungan = $value[2];
			@$model->Kd_Jalan = $data['TaMusrenbang']['Kd_Jalan'];
            $Tahun = Yii::$app->pengaturan->getTahun();
          
            $model->Tahun = $Tahun;
            // print_r($model);exit;
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            $model->Kd_Asal_Usulan = '3';

            $request = Yii::$app->request;
            $skpd = $request->post('skpd');
			//print_r($skpd);
			//return;
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
                //$ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->save(false);



                Yii::$app->session->addFlash('success', 'Tambah Usulan Berhasil');

                return $this->redirect(['create']);
            }
        } else {
			$kel = RefKelurahan::find()->where($models)->all();
			$valkel = [];
			foreach($kel as $rows){
				$valkel[] = ["Kd"=>$rows['Kd_Kel']."|".$rows['Kd_Urut'],"Nm"=>$rows['Nm_Kel']];
			}
			$forum=1;
            return $this->render('create', [
                'model' => $model,
                'NASbidangpem' =>$NASbidangpem,
                'NASsatuan'=> $NASsatuan,
                'NASrpjmd' => $NASrpjmd,
                'dataunit' => $dataunit,
                'NASsatuan' => $NASsatuan,
				'RefKelurahan' => ArrayHelper::map($valkel, 'Kd', 'Nm'),
				'ZULRefLingkungan' => ArrayHelper::map(\common\models\search\RefLingkungan::find()
                                        ->where($models)
                                        ->all(), 'Kd_Lingkungan', 'Nm_Lingkungan'),
										'forum'=>$forum,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$forum) 
    {
		
		$Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        $user = (Yii::$app->user->identity->id);
        $models = $this->NASarraymap(Yii::$app->levelcomponent->getKelompok());
        $Posisi = $this->Posisi();
        $model = $this->findModel($id);
		
		$unitpilihan = $model->Kd_Urusan.'|'.$model->Kd_Bidang.'|'.$model->Kd_Unit.'|'.$model->Kd_Sub;

		$NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->where([ 'Tahun'=>$Tahun, 'Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab, ])->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
		$kel1 = RefKelurahan::find()
                       ->where(["Kd_Kec"=>$model->Kd_Kec,
								 "Kd_Kel"=>$model->Kd_Kel,
								 "Kd_Urut"=>$model->Kd_Urut_Kel])
								 ->all();
						$lingkungan = RefLingkungan::find()
                       ->where(["Kd_Kec"=>$model->Kd_Kec,
								 "Kd_Kel"=>$model->Kd_Kel,
								 "Kd_Urut_Kel"=>$model->Kd_Urut_Kel,
								 "Kd_Lingkungan"=>$model->Kd_Lingkungan])
								 ->all();

		$jalan = RefJalan::find()
						->where(["Kd_Kec"=>$model->Kd_Kec,
								 "Kd_Kel"=>$model->Kd_Kel,
								 "Kd_Urut_Kel"=>$model->Kd_Urut_Kel,
								 "Kd_Lingkungan"=>$model->Kd_Lingkungan,
								 "Kd_Jalan"=>$model->Kd_Jalan])
						->all();
		
		$unit =RefSubUnit::find()
            ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
            ->andwhere(['!=', 'Nm_Sub_Unit', ''])
            ->orderby('Nm_Sub_Unit')
            ->all();
		
		$dataunit = [];
        foreach ($unit as $pil) {
            $val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
            $dataunit[$val_skpd]=$pil->Nm_Sub_Unit;
        }
		
        if ($model->load(Yii::$app->request->post())) {
			$reflink = RefLingkungan::find()
						->where(["Kd_Prov"=>12])
						->andwhere(["Kd_Kab"=>9])
						->andwhere(["Kd_Kec"=>$model->Kd_Kec])
						->andwhere(["Kd_Kel"=>$model->Kd_Kel])
						->andwhere(["Kd_Lingkungan"=>$model->Kd_Lingkungan])
						->one();
						
			//print_r($reflink);
			//return;
			//@$model->Kd_Urut_Kel = $reflink->Kd_Urut_Kel;
            $Tahun = Yii::$app->pengaturan->getTahun();
			
			$data =Yii::$app->request->post();
			@$value = explode("|",$data['TaMusrenbang']['Kd_Lingkungan']);
			/*
			echo "<pre>";
			print_r($value);
			return;*/
			///Comment By RG
			/*@$model->Kd_Kel = $value[0];
			@$model->Kd_Urut_Kel = $value[1];
			@$model->Kd_Lingkungan = $value[2];
			@$model->Kd_Jalan = $data['TaMusrenbang']['Kd_Jalan'];*/
          
            $model->Tahun = $Tahun;
            // print_r($model);exit;
            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);
            

            $request = Yii::$app->request;
            $skpd = $request->post('skpd');
            $skpd_arr = explode("|", $skpd);
            
            $model->Kd_Urusan = $skpd_arr[0];
            $model->Kd_Bidang = $skpd_arr[1];
            $model->Kd_Unit = $skpd_arr[2];
            $model->Kd_Sub = $skpd_arr[3];
			$model->Status_Penerimaan_Kecamatan = '2'; 
 if ($model->save(false)) {
			if ($model->Kd_Asal_Usulan == '3' && $forum!=101){
					//$model->Kd_Asal_Usulan = '3';//Comment By RG
					return $this->redirect(['ta-musrenbang-kecamatan-report/usulan-kecamatan']);
					
				}
				elseif ($forum==101)
			{
				return $this->redirect(['musrenbang-skpd/kecamatan-masuk']);
			}
			else
			{
				//$model->Kd_Asal_Usulan = '2';
				return $this->redirect(['musrenbang-kecamatan/skoring']);
				
			}
			
			
			
			 Yii::$app->session->addFlash('success', 'Edit Usulan Berhasil');
 }
            if ($model->save(false)) {

                $model->Kd_User = $user;
                
                $ZULaftersimpan = new \eperencanaan\models\TaMusrenbangRiwayat();
                $ZULaftersimpan->attributes = $model->attributes;
                $ZULaftersimpan->Ta_Musrenbang_Id = $model->id;
                $ZULaftersimpan->Status_Survey = 5;
                $ZULaftersimpan->Keterangan = "Update Usulan";
                //$ZULaftersimpan->Tanggal = time();
                $ZULaftersimpan->save(false);


               
				
			
			
            }
        } else {
			if ($forum==101)
			{
				$kel=RefKelurahan::find()
				->where(["Kd_Kec"=>$model->Kd_Kec])
								 
								 ->all();
				
				$ZULRefLingkungan = ArrayHelper::map(\common\models\search\RefLingkungan::find()
                                       ->where(["Kd_Kec"=>$model->Kd_Kec,
								 "Kd_Kel"=>$model->Kd_Kel,
								 "Kd_Urut_Kel"=>$model->Kd_Urut_Kel])
								 
								 ->all(), 'Kd_Lingkungan', 'Nm_Lingkungan');
				
				}
			else
			{
				$kel = RefKelurahan::find()->where($models)->all();
			$ZULRefLingkungan = ArrayHelper::map(\common\models\search\RefLingkungan::find()
                                        ->where($models)
                                        ->all(), 'Kd_Lingkungan', 'Nm_Lingkungan');
				
			}
			$valkel = [];
			foreach($kel as $rows){
				$valkel[] = ["Kd"=>$rows['Kd_Kel']."|".$rows['Kd_Urut'],"Nm"=>$rows['Nm_Kel']];
			}
            return $this->render('update', [
                'model' => $model,
				'NASbidangpem' =>$NASbidangpem,
                'NASsatuan'=> $NASsatuan,
                'NASrpjmd' => $NASrpjmd,
                'dataunit' => $dataunit,
				'unitpilihan' => $unitpilihan,
				'RefKelurahan' => ArrayHelper::map($valkel, 'Kd', 'Nm'),
				'ZULRefLingkungan'=>$ZULRefLingkungan,
			'lingkungan' =>  ArrayHelper::map($lingkungan, 'Kd_Lingkungan', 'Nm_Lingkungan'),//$lingkungan,
						'jalan' => ArrayHelper::map($jalan, 'Kd_Jalan', 'Nm_Jalan'),
						'kel1' => ArrayHelper::map($kel1, 'Kd_Kel', 'Nm_Kel'),
						'forum'=>$forum,
            ]);
        }
		
    }

    /**
     * Deletes an existing TaMusrenbang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	public function actionHapus($id){
		$this->findModel($id)->delete();
		
		        return $this->redirect(['ta-musrenbang-kecamatan-report/usulan-kecamatan']);
			
	}
	 
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
		

        //return $this->redirect(['ta-musrenbang-kecamatan-report/usulan-kecamatan']);
    }

    /**
     * Finds the TaMusrenbang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaMusrenbang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaMusrenbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //==============PADLI================//

    public function actionSkoring()
    {   
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $posisi = $this->Posisi();

        $kelurahan = RefKelurahan::find()
                ->where($posisi)
                ->all(); 

        $bid_pem = RefBidangPembangunan::find()
                ->all();

        $rpjmd = RefRPJMD::find()
                ->all();
				
                //->where(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab])
                
        // return $Tahun;

        return $this->render('skoring', [
                    'kelurahan' => $kelurahan,
                    'bid_pem' => $bid_pem,
                    'rpjmd' => $rpjmd,
            ]);
    }

    public function actionCekUsulan()
    {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        $request = Yii::$app->request;

        $Kd_Asal_Usulan = $request->post('Kd_Asal_Usulan');
        $Kd_Kel = $request->post('Kd_Kel');
        $Kd_Lingkungan = $request->post('Kd_Lingkungan');
        $Kd_Pem = $request->post('Kd_Pem');
        $Kd_Prioritas_Pembangunan_Daerah = $request->post('Kd_Prioritas_Pembangunan_Daerah');

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
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                // ->groupby(["Kd_Pem","Kd_Prioritas_Pembangunan_Daerah"]);
        

        $usulan = $data->all();
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
            ->andwhere(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$topScore['Skor'],"Urutan_Prioritas"=>0])
            ->count();
            if($TaMusrenbang > 1)
            {
                echo "<div class='alert alert-warning'>Terdapat usulan yang memiliki skor yang sama. harap tentukan prioritas. <a href='#' class='btn-prioritas' onclick='lihatPrioritas()'>Klik disini</a> untuk menentukan prioritas</div>";
                break;
            }
            // print_r(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$u->Skor,"Jumlah"=>$u->Jumlah]);
        endforeach;
        return;
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
                ->andwhere(["Kd_Pem"=>$Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$Kd_Prioritas_Pembangunan_Daerah])
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                ->orderby(["Skor" => SORT_DESC])
                ->one();
        return $data;
    }

    public function usulanPrioritas()
    {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        $request = Yii::$app->request;

        $Kd_Asal_Usulan = $request->post('Kd_Asal_Usulan');
        $Kd_Kel = $request->post('Kd_Kel');
        $Kd_Lingkungan = $request->post('Kd_Lingkungan');
        $Kd_Pem = $request->post('Kd_Pem');
        $Kd_Prioritas_Pembangunan_Daerah = $request->post('Kd_Prioritas_Pembangunan_Daerah');

        $posisi = $this->Posisi();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                ->groupby(["Kd_Pem","Kd_Prioritas_Pembangunan_Daerah"])
                ->orderby(["Skor" => SORT_DESC]);
        

        $usulan = $data->all();
        $ret = [];
        foreach($usulan as $key => $u):
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
            ->count();
            if($TaMusrenbang > 1)
            {
                $TaMusrenbang2 = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                ->andwhere(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$topScore['Skor']])
                ->all();
                $ret[$key] = $TaMusrenbang2;
            }
            // print_r(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$u->Skor,"Jumlah"=>$u->Jumlah]);
        endforeach;
        return $ret;
    }

    public function actionGetUsulan()
    {   
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        $request = Yii::$app->request;

        $Kd_Asal_Usulan = $request->post('Kd_Asal_Usulan');
        $Kd_Kel = $request->post('Kd_Kel');
        $Kd_Lingkungan = $request->post('Kd_Lingkungan');
        $Kd_Pem = $request->post('Kd_Pem');
        $Kd_Prioritas_Pembangunan_Daerah = $request->post('Kd_Prioritas_Pembangunan_Daerah');

        $posisi = $this->Posisi();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                ->orderby(["id"=>SORT_ASC]);

				// ->orderBy([
                //     "Kd_Pem"=>SORT_ASC,
                //     "Kd_Prioritas_Pembangunan_Daerah" => SORT_ASC,
                //     "Skor" => SORT_DESC,
                // ]);
        
        if ($Kd_Asal_Usulan != 0) {
            $data->andwhere(['=', 'Kd_Asal_Usulan', $Kd_Asal_Usulan]);
        }

        //echo $Kd_Asal_Usulan;
        //die();

        if ($Kd_Kel!=0) {
            $data->andwhere(['=', 'Kd_Urut_Kel', $Kd_Kel]);
        }

        if ($Kd_Lingkungan != 0) {
            $data->andwhere(['=', 'Kd_Lingkungan', $Kd_Lingkungan]);
        }

        if ($Kd_Pem!=0) {
            $data->andwhere(['=', 'Kd_Pem', $Kd_Pem]);
        }

        if ($Kd_Prioritas_Pembangunan_Daerah!=0) {
            $data->andwhere(['=', 'Kd_Prioritas_Pembangunan_Daerah', $Kd_Prioritas_Pembangunan_Daerah]);
        }

        $usulan = $data->all();

        $rpjmd = RefRPJMD::find()
                ->where(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab])
                ->all();

        $skpd = RefSubUnit::find()
                ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
                ->andwhere(['!=', 'Nm_Sub_Unit', ''])
                ->orderby('Nm_Sub_Unit')
                ->all();
				

        return $this->renderpartial('get_usulan', [
                'data' => $usulan,
                'rpjmd' => $rpjmd,
                'skpd' => $skpd,
        ]);
    }

    public function actionGetUsulanPrioritas()
    {   
        $usulan = $this->usulanPrioritas();

        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $rpjmd = RefRPJMD::find()
                ->where(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab])
                ->all();

        $skpd = RefSubUnit::find()
                ->where(['NOT LIKE', 'Nm_Sub_Unit', 'Kecamatan'])
                ->andwhere(['!=', 'Nm_Sub_Unit', ''])
                ->orderby('Nm_Sub_Unit')
                ->all();
				

        return $this->renderpartial('get_usulan_prioritas', [
                'data' => $usulan,
                'rpjmd' => $rpjmd,
                'skpd' => $skpd,
        ]);
    }

    public function actionSetUrutanPrioritas()
    {

        $request = Yii::$app->request;
        $id = $request->post("id");
        $val = $request->post("val");

        $model = TaMusrenbang::findOne($id);
        
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        
        

        $Kd_Asal_Usulan = $model->Kd_Asal_Usulan;
        $Kd_Kel = $model->Kd_Kel;
        $Kd_Lingkungan = $model->Kd_Lingkungan;
        $Kd_Pem = $model->Kd_Pem;
        $Kd_Prioritas_Pembangunan_Daerah = $model->Kd_Prioritas_Pembangunan_Daerah;

        $posisi = $this->Posisi();

        

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                ->andwhere(["Kd_Pem"=>$Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$Kd_Prioritas_Pembangunan_Daerah])
                ->andwhere(['Urutan_Prioritas'=>$val])
                ->one();
        if(empty($data))
        {
            $model->Urutan_Prioritas = $val;
            if($model->save(false))
                return "Prioritas Berhasil disimpan";
        }else{
            return "Gagal, Prioritas Sudah pernah Dipilih";
        }
        return 0;
    }

    public function actionSetPrioritas($id, $rpjmd, $alasan)
    {   
        $model = TaMusrenbang::findOne($id);
        $model->Kd_Prioritas_Pembangunan_Daerah = @$rpjmd;
        $model->Alasan_Kecamatan = $alasan;
		//$model->Status_Prioritas = '1'; 
        // $model->Kd_Urusan = $Kd_Urusan;
        // $model->Kd_Bidang = $Kd_Bidang;
        // $model->Kd_Unit = $Kd_Unit;
        // $model->Kd_Sub = $Kd_Sub;

        if ($rpjmd == 0) {
            $model->Status_Penerimaan_Kecamatan = '3'; //ditolak oleh kecamatan
			$model->Status_Prioritas = '0'; //ditolak oleh kecamatan
			$model->Skor = 0;
			
        }

        if($model->save()){
            $riwayat = new TaMusrenbangRiwayat();
            $riwayat->attributes = $model->attributes;
            $riwayat->Ta_Musrenbang_Id = $model->id;
            $riwayat->Keterangan = "Set Prioritas";
            $riwayat->save(false);
            echo "Prioritas Terpilih";
			//return $this->redirect(['skoring']); 
        }
        else{	
            echo "Gagal";
			print_r($model->errors);
        }
		
    }

    public function actionSetSkpd($id, $skpd)
    {   
        $isi_skpd =  explode("|", $skpd);
        $Kd_Urusan = $isi_skpd[0];
        $Kd_Bidang = $isi_skpd[1];
        $Kd_Unit = $isi_skpd[2];
        $Kd_Sub = $isi_skpd[3];

        $model = TaMusrenbang::findOne($id);
        $model->Kd_Urusan = $Kd_Urusan;
        $model->Kd_Bidang = $Kd_Bidang;
        $model->Kd_Unit = $Kd_Unit;
        $model->Kd_Sub = $Kd_Sub;

        if($model->save()){
            $riwayat = new TaMusrenbangRiwayat();
            $riwayat->attributes = $model->attributes;
            $riwayat->Ta_Musrenbang_Id = $model->id;
            $riwayat->Keterangan = "Set OPD";
            $riwayat->save(false);

            echo "OPD Terpilih";
        }
        else{
            echo "Pilih OPD Gagal";
        }
    }
	
	public function actionSetProgram($id, $kd){
		$model = TaMusrenbang::findOne($id);
		$model->Kd_Prog = $kd;
		
		if($model->save()){
            $riwayat = new TaMusrenbangRiwayat();
            $riwayat->attributes = $model->attributes;
            $riwayat->Ta_Musrenbang_Id = $model->id;
            $riwayat->Keterangan = "Set Program";
            $riwayat->save(false);
			
			$out = "";
			foreach ($model->kegiatans as $kegiatan):
	      			$out .= '<option value="'.$kegiatan['Kd_Keg'].'" >'.$kegiatan['Ket_Kegiatan'].'</option>';
      		endforeach;
			echo $out;
        }
        else{
            echo "Pilih Program Gagal";
        }
		
	}
	
	public function actionSetKegiatan($id,$kd){
		$model = TaMusrenbang::findOne($id);
		$model->Kd_Keg = $kd;
		
		if($model->save()){
            $riwayat = new TaMusrenbangRiwayat();
            $riwayat->attributes = $model->attributes;
            $riwayat->Ta_Musrenbang_Id = $model->id;
            $riwayat->Keterangan = "Set Kegiatan";
            $riwayat->save(false);

            echo "Kegiatan Terpilih";
        }
        else{
            echo "Pilih Kegiatan Gagal";
        }
		
	}

    public function actionModalSkoring($id)
    {
        $kriteria = RefKecamatanKriteriaPembobotan::find()->all();

        $model = TaMusrenbang::findOne($id);
        $Kd_Pem = $model->Kd_Pem;
        $Bidang_Pembangunan = $model->bidangPembangunan->Bidang_Pembangunan;
        
        return $this->renderAjax('modal_skoring',[
                'kriteria' => $kriteria,
                'Kd_Pem' => $Kd_Pem,
                'Bidang_Pembangunan' => $Bidang_Pembangunan,
                'id' => $id,
           ]);
    }

    public function actionModalPrioritas($id, $rpjmd)
    {
        if ($rpjmd == 0) {
            $isi_pilihan = 'Non Prioritas';
        }
        else{
            $pilihan = RefRPJMD::findOne(['Kd_Prioritas_Pembangunan_Kota'=>$rpjmd]);
            $isi_pilihan = $pilihan->Nm_Prioritas_Pembangunan_Kota;
        }

        // $isi_skpd =  explode("|", $skpd);
        
        // $Kd_Urusan = $isi_skpd[0];
        // $Kd_Bidang = $isi_skpd[1];
        // $Kd_Unit = $isi_skpd[2];
        // $Kd_Sub = $isi_skpd[3];

        return $this->renderAjax('modal_prioritas',[
                'id' => $id,
                'rpjmd' => $rpjmd,
                'isi_pilihan' => $isi_pilihan,
                // 'Kd_Urusan' => $Kd_Urusan,
                // 'Kd_Bidang' => $Kd_Bidang,
                // 'Kd_Unit' => $Kd_Unit,
                // 'Kd_Sub' => $Kd_Sub,
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
		if ($model->Status_Penerimaan_Kecamatan == '2')
		{
			$model->Status_Penerimaan_Kecamatan = '2'; //diterima
        }
	else
	{
		$model->Status_Penerimaan_Kecamatan = '1'; //diterima
	}
		//echo $model->Rincian_Skor;

        // $riwayat = new TaMusrenbangRiwayat();
        // $riwayat->attributes = $model->attributes;
        // $riwayat->Keterangan = "Skoring";
        // $riwayat->save(false);

        if ($model->save(false)) {
            $riwayat = new TaMusrenbangRiwayat();
            $riwayat->attributes = $model->attributes;
            $riwayat->Ta_Musrenbang_Id = $model->id;
            $riwayat->Keterangan = "Skoring";
            //$riwayat->save(false);

            echo "Skor Disimpan";
        }
        else{
            echo "Simpan Skor Gagal";
        }
        
    }

    public function actionGetLingkungan($Kd_Kel)
    {
        $Posisi = $this->Posisi();
        $lingkungan = RefLingkungan::find()
                    ->where($Posisi)
                    ->andwhere(['=', 'Kd_Urut_Kel', $Kd_Kel])
                    ->all();
        
        echo '<option value="0">-Pilih Lingkungan-</option>';
        foreach ($lingkungan as $key => $value) {
            echo '<option value="'.$value->Kd_Lingkungan.'">'.$value->Nm_Lingkungan.'</option>';
        }
    }

    public function actionImportUsulan()
    {
        $Posisi = $this->Posisi();
        $usulan1 = \eperencanaan\models\TaMusrenbangKelurahan::find()
              //->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
              //->where(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL])
              ->andwhere($Posisi)
              ->all();
		$dataSkoring1 = TaMusrenbang::find()
                ->where($Posisi)
                ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2']])
                ->exists();
        $usulan2 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find()
              ->where(['IN', 'Status_Penerimaan', [1,2]])
              ->andwhere($Posisi)
              ->all();
		if (@$dataSkoring1 == null||empty($dataSkoring1)) //Ditambah oleh RG untuk mengantisipasi double load data.
		{
        $connection = \Yii::$app->db; 
        $transaction = $connection->beginTransaction();
        try {
            foreach ($usulan1 as $key => $value) {
                $musrenbang = new TaMusrenbang;
                $musrenbang->Tahun = $value->Tahun;
                $musrenbang->Kd_Prov = $value->Kd_Prov;
                $musrenbang->Kd_Kab = $value->Kd_Kab;
                $musrenbang->Kd_Kec = $value->Kd_Kec;
                $musrenbang->Kd_Kel = $value->Kd_Kel;
                $musrenbang->Kd_Urut_Kel = $value->Kd_Urut_Kel;
                $musrenbang->Kd_Lingkungan = $value->Kd_Lingkungan;
                $musrenbang->Kd_Jalan = $value->Kd_Jalan;
                $musrenbang->Kd_Urusan = $value->Kd_Urusan;
                $musrenbang->Kd_Bidang = $value->Kd_Bidang;
                $musrenbang->Kd_Prog = $value->Kd_Prog;
                $musrenbang->Kd_Keg = $value->Kd_Keg;
                $musrenbang->Kd_Unit = 1;
                $musrenbang->Kd_Sub = 1;
                $musrenbang->Kd_Pem = $value->Kd_Pem;
                $musrenbang->Nm_Permasalahan = $value->Nm_Permasalahan;
                $musrenbang->Kd_Klasifikasi = $value->Kd_Klasifikasi;
                $musrenbang->Jenis_Usulan = $value->Jenis_Usulan;
                $musrenbang->Jumlah = $value->Jumlah;
                $musrenbang->Kd_Satuan = $value->Kd_Satuan;
                $musrenbang->Harga_Satuan = $value->Harga_Satuan;
                $musrenbang->Harga_Total = $value->Harga_Total;
                $musrenbang->Kd_Sasaran = $value->Kd_Sasaran;
                $musrenbang->Detail_Lokasi = $value->Detail_Lokasi;
                $musrenbang->Latitute = $value->Latitute;
                $musrenbang->Longitude = $value->Longitude;
                $musrenbang->Tanggal = $value->Tanggal;
                $musrenbang->status = $value->status;
                $musrenbang->Status_Survey = $value->Status_Survey;
                $musrenbang->Kd_Prioritas_Pembangunan_Daerah = $value->Kd_Prioritas_Pembangunan_Daerah;
                //$musrenbang->Skor = NULL;
                //$musrenbang->Rincian_Skor = NULL;
                //$musrenbang->Status_Usulan = $value->Status_Usulan;
                $musrenbang->Status_Penerimaan_Kelurahan = 1;
                $musrenbang->Alasan_Kelurahan = '';
                //$musrenbang->Status_Penerimaan_Kecamatan = NULL;
                //$musrenbang->Alasan_Kecamatan = NULL;
                // $musrenbang->Status_Penerimaan_Skpd = NULL;
                // $musrenbang->Alasan_Skpd = NULL;
                // $musrenbang->Status_Penerimaan_Kota = NULL;
                // $musrenbang->Alasan_Kota = NULL;
                $musrenbang->Kd_User = $value->Kd_User;
                // $musrenbang->Kd_Asal = NULL;
                // $musrenbang->Kd1 = NULL;
                // $musrenbang->Kd2 = NULL;
                // $musrenbang->Kd3 = NULL;
                // $musrenbang->Kd4 = NULL;
                // $musrenbang->Kd5 = NULL;
                // $musrenbang->Kd6 = NULL;
                // $musrenbang->Uraian_Usulan = NULL;
                $musrenbang->Kd_Asal_Usulan = '2';
                $musrenbang->Def_Operasional = $value->Def_Operasional;
                $musrenbang->Kd_Kamus_Usulan = $value->Kd_Kamus_Usulan;
                
                $musrenbang->save(false);
            }
			/*
            foreach ($usulan2 as $key => $value) {
                $musrenbang = new TaMusrenbang;
                $musrenbang->Tahun = $value->Tahun;
                $musrenbang->Kd_Prov = $value->Kd_Prov;
                $musrenbang->Kd_Kab = $value->Kd_Kab;
                $musrenbang->Kd_Kec = $value->Kd_Kec;
                $musrenbang->Kd_Kel = $value->Kd_Kel;
                $musrenbang->Kd_Urut_Kel = $value->Kd_Urut_Kel;
                $musrenbang->Kd_Lingkungan = $value->Kd_Lingkungan;
                $musrenbang->Kd_Jalan = $value->Kd_Jalan;
                $musrenbang->Kd_Urusan = $value->Kd_Urusan;
                $musrenbang->Kd_Bidang = $value->Kd_Bidang;
                $musrenbang->Kd_Prog = $value->Kd_Prog;
                $musrenbang->Kd_Keg = $value->Kd_Keg;
                //$musrenbang->Kd_Unit = 0;
                //$musrenbang->Kd_Sub = 0;
                $musrenbang->Kd_Pem = $value->Kd_Pem;
                $musrenbang->Nm_Permasalahan = $value->Nm_Permasalahan;
                $musrenbang->Kd_Klasifikasi = $value->Kd_Klasifikasi;
                $musrenbang->Jenis_Usulan = $value->Jenis_Usulan;
                $musrenbang->Jumlah = $value->Jumlah;
                $musrenbang->Kd_Satuan = $value->Kd_Satuan;
                $musrenbang->Harga_Satuan = $value->Harga_Satuan;
                $musrenbang->Harga_Total = $value->Harga_Total;
                $musrenbang->Kd_Sasaran = $value->Kd_Sasaran;
                $musrenbang->Detail_Lokasi = $value->Detail_Lokasi;
                $musrenbang->Latitute = $value->Latitute;
                $musrenbang->Longitude = $value->Longitude;
                $musrenbang->Tanggal = $value->Tanggal;
                $musrenbang->status = $value->status;
                $musrenbang->Status_Survey = $value->Status_Survey;
                $musrenbang->Kd_Prioritas_Pembangunan_Daerah = $value->Kd_Prioritas_Pembangunan_Daerah;
                //$musrenbang->Skor = NULL;
                //$musrenbang->Rincian_Skor = NULL;
                //$musrenbang->Status_Usulan = $value->status;
                $musrenbang->Status_Penerimaan_Kelurahan = $value->Status_Penerimaan;
                $musrenbang->Alasan_Kelurahan = $value->Keterangan;
                //$musrenbang->Status_Penerimaan_Kecamatan = NULL;
                //$musrenbang->Alasan_Kecamatan = NULL;
                // $musrenbang->Status_Penerimaan_Skpd = NULL;
                // $musrenbang->Alasan_Skpd = NULL;
                // $musrenbang->Status_Penerimaan_Kota = NULL;
                // $musrenbang->Alasan_Kota = NULL;
                $musrenbang->Kd_User = $value->Kd_User;
                // $musrenbang->Kd_Asal = NULL;
                // $musrenbang->Kd1 = NULL;
                // $musrenbang->Kd2 = NULL;
                // $musrenbang->Kd3 = NULL;
                // $musrenbang->Kd4 = NULL;
                // $musrenbang->Kd5 = NULL;
                // $musrenbang->Kd6 = NULL;
                // $musrenbang->Uraian_Usulan = NULL;
                $musrenbang->Kd_Asal_Usulan = $value->Asal_Usulan;
                
                $musrenbang->save(false);
            }*/
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        echo "<h2>Load data Berhasil</h2>";
		echo "<h3>Silahkan Klik Tombol Tutup atau Refresh Browser Anda (Tekan F5) </h3>";
		}
		else
		{
			echo "<h2>DATA SUDAH ADA/SUDAH DILOAD SEBELUMNYA!!!</h2>";
			echo "<h3>Silahkan Klik Tombol Tutup atau Refresh Browser Anda (Tekan F5) </h3>";
		}
    }

    //==============AKHIR PADLI================//

    //==============NUGRA================//
    
    //==============AKHIR NUGRA================//
}
