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
use common\models\RefSubUnit;

/**
 * TaMusrenbangController implements the CRUD actions for TaMusrenbang model.
 */
class TaMusrenbangController extends Controller
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
        $models = $this->NASarraymap(Yii::$app->levelcomponent->getKelompok());

        $NASbidangpem = ArrayHelper::map(\common\models\RefBidangPembangunan::find()->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        $NASsatuan = ArrayHelper::map(\common\models\RefStandardSatuan::find()->orderBy('Uraian')->all(), 'Kd_Satuan', 'Uraian');
        $NASrpjmd = ArrayHelper::map(\common\models\RefRPJMD::find()->all(), 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
       
        $NASunit = ArrayHelper::map(\common\models\RefUnit::find()->all(), 'Kd_Unit', 'Nm_Unit');

        
        $model = new TaMusrenbang();
        $model->attributes = $models;
        $model->Tanggal = time();

          if ($model->load(Yii::$app->request->post())) {
            $Tahun = Yii::$app->pengaturan->getTahun();
            $model->Tahun = $Tahun;

            $model->Jumlah = str_replace(".", "", $model->Jumlah);
            $model->Harga_Satuan = str_replace(".", "", $model->Harga_Satuan);
            $model->Harga_Total = str_replace(".", "", $model->Harga_Total);


            //print_r($model);
            if ($model->save(false)) {

                // print_r($_POST); exit();
                $ZULaftersimpan = new \eperencanaan\models\MusrenbangRiwayat();
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
                'NASbidangpem' =>$NASbidangpem,
                'NASsatuan'=> $NASsatuan,
                'NASrpjmd' => $NASrpjmd,
                'NASunit' => $NASunit,
                'NASsatuan' => $NASsatuan,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = TaMusrenbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionSkoring()
    {	
        $posisi = $this->Posisi();

        $kelurahan = RefKelurahan::find()
                ->where($posisi)
                ->all(); 

        $bid_pem = RefBidangPembangunan::find()
                ->all();

        $rpjmd = RefRPJMD::find()
                ->all();

        return $this->render('skoring', [
                    'kelurahan' => $kelurahan,
                    'bid_pem' => $bid_pem,
        			'rpjmd' => $rpjmd,
        	]);
    }

    public function actionGetUsulan()
    {   
        $request = Yii::$app->request;

        $Kd_Kel = $request->post('Kd_Kel');
        $Kd_Lingkungan = $request->post('Kd_Lingkungan');
        $Kd_Pem = $request->post('Kd_Pem');
        $Kd_Prioritas_Pembangunan_Daerah = $request->post('Kd_Prioritas_Pembangunan_Daerah');

        $posisi = $this->Posisi();

        $data = TaMusrenbang::find()
                ->where($posisi)
                ->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]);
        
        if ($Kd_Kel) {
            $data->andwhere(['=', 'Kd_Urut_Kel', $Kd_Kel]);
        }

        if ($Kd_Lingkungan != '' || $Kd_Lingkungan != 0) {
            $data->andwhere(['=', 'Kd_Lingkungan', $Kd_Lingkungan]);
        }

        if ($Kd_Pem) {
            $data->andwhere(['=', 'Kd_Pem', $Kd_Pem]);
        }

        if ($Kd_Prioritas_Pembangunan_Daerah) {
            $data->andwhere(['=', 'Kd_Prioritas_Pembangunan_Daerah', $Kd_Prioritas_Pembangunan_Daerah]);
        }

        $usulan = $data->all();

        $rpjmd = RefRPJMD::find()
                ->all();

        $skpd = RefSubUnit::find()
                ->orderby('Nm_Sub_Unit')
                ->all();

        return $this->renderpartial('get_usulan', [
                'data' => $usulan,
                'rpjmd' => $rpjmd,
                'skpd' => $skpd,
        ]);
    }

    public function actionSetPrioritas($id, $rpjmd)
    {   
        $model = TaMusrenbang::findOne($id);
        $model->Kd_Prioritas_Pembangunan_Daerah = $rpjmd;

        if ($rpjmd == '0') {
            $model->Status_Penerimaan_Kecamatan = '3'; //ditolak oleh kecamatan
        }

        if($model->save()){
            echo "Prioritas Terpilih";
        }
        else{
            echo "Pilih Prioritas Gagal";
        }
    }

    public function actionModalSkoring($id)
    {
        $kriteria = RefKecamatanKriteriaPembobotan::find()->all();
        
        return $this->renderAjax('modal_skoring',[
                'kriteria' => $kriteria,
                'id' => $id,
           ]);
    }

    public function actionSkoringSimpan()
    {
        $request = Yii::$app->request;
        $bobot = $request->post('bobot');
        $id = $request->post('id');
        //echo $id;
        $data = serialize($bobot);
        //echo $data;
        $model = TaMusrenbang::findOne($id);
        //echo $model->id;
        $model->Rincian_Skor = $data;
        $model->Status_Penerimaan_Kecamatan = '1'; //diterima
        //echo $model->Rincian_Skor;
        if ($model->save()) {
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
        
        echo '<option value="">-Pilih Lingkungan-</option>';
        foreach ($lingkungan as $key => $value) {
            echo '<option value="'.$value->Kd_Lingkungan.'">'.$value->Nm_Lingkungan.'</option>';
        }
    }

    public function actionGetForm($Asal) {
      if ($Asal == 1) {
        $data = ArrayHelper::map(RefSsh1::find()->all(), 'Kd_Ssh1', 'Nm_Ssh1');
        $tujuan = 'get_isian_ssh';
      }
      else if ($Asal == 2) {
        $data = ArrayHelper::map(RefHspk1::find()->all(), 'Kd_Hspk1', 'Nm_Hspk1');
        $tujuan = 'get_isian_hspk';
      }
      else if ($Asal == 3) {
        $data = ArrayHelper::map(RefAsb1::find()->all(), 'Kd_Asb1', 'Nm_Asb1');
        $tujuan = 'get_isian_asb';
      }
      return $this->renderpartial($tujuan, [
          'data' => $data
      ]);

    }
}
