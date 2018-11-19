<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\TaPeraturan;
use emusrenbang\models\search\TaPeraturanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use common\models\RefTahapan;
use common\models\RefPeraturan;
use emusrenbang\models\TaHasil;
use common\models\TaProgram;
use common\models\TaKegiatan;
use emusrenbang\models\TaBelanja;
use emusrenbang\models\TaBelanjaRinc;
use emusrenbang\models\TaBelanjaRincSub;

/**
 * TaPeraturanController implements the CRUD actions for TaPeraturan model.
 */
class TaPeraturanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaPeraturan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaPeraturanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaPeraturan model.
     * @param string $Tahun
     * @param integer $Kd_Tahapan
     * @param integer $Kd_Peraturan
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Tahapan, $Kd_Peraturan)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TaPeraturan #".$Tahun, $Kd_Tahapan, $Kd_Peraturan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Tahapan, $Kd_Peraturan),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Tahapan, $Kd_Peraturan'=>$Tahun, $Kd_Tahapan, $Kd_Peraturan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Tahapan, $Kd_Peraturan),
            ]);
        }
    }

    /**
     * Creates a new TaPeraturan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaPeraturan();  
        $model->Tahun = 2018;
        $RefTahapan = ArrayHelper::map(RefTahapan::find()->orderBy('No_Urut')->all(), 'Kd_Tahapan', 'Uraian');
        $RefPeraturan = ArrayHelper::map(RefPeraturan::find()->all(), 'Kd_Peraturan', 'Nm_Peraturan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TaPeraturan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'RefTahapan' => $RefTahapan,
                        'RefPeraturan' => $RefPeraturan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $model->save();
                    //mengambil semua program
                    $ta_program = TaProgram::find()->all();
                    foreach ($ta_program as $value) {
                      $model_program = new TaHasil();
                      //main
                      $model_program->Asal_Data = '1';
                      $model_program->Tahun = $model->Tahun;
                      $model_program->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_program->Kd_Peraturan = $model->Kd_Peraturan;
                      // $model_program->DateCreate = date('Y-m-d');
                      // $model_program->DateCreate = Yii::$app->formatter->asDatetime(date('Y-d-m h:i:s'));
                      $model_program->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_program->Tahun = $value->Tahun;
                      $model_program->Kd_Urusan = $value->Kd_Urusan;
                      $model_program->Kd_Bidang = $value->Kd_Bidang;
                      $model_program->Kd_Unit = $value->Kd_Unit;
                      $model_program->Kd_Sub = $value->Kd_Sub;
                      $model_program->Kd_Prog = $value->Kd_Prog;
                      $model_program->ID_Prog = $value->ID_Prog;
                      $model_program->Ket_Prog = $value->Ket_Prog;
                      $model_program->save(false);
                    }

                    //mengambil semua kegiatan
                    $ta_kegiatan = TaKegiatan::find()->all();
                    foreach ($ta_kegiatan as $kegiatan) {
                      $model_kegiatan = new TaHasil();
                      //main
                      $model_kegiatan->Asal_Data = '2';
                      $model_kegiatan->Tahun = $model->Tahun;
                      $model_kegiatan->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_kegiatan->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_kegiatan->DateCreate = new Expression('NOW()');

                      //copy
                      $model_kegiatan->Kd_Urusan = $kegiatan->Kd_Urusan;
                      $model_kegiatan->Kd_Bidang = $kegiatan->Kd_Bidang;
                      $model_kegiatan->Kd_Prog = $kegiatan->Kd_Prog;
                      $model_kegiatan->Kd_Keg = $kegiatan->Kd_Keg;
                      $model_kegiatan->Kd_Unit = $kegiatan->Kd_Unit;
                      $model_kegiatan->Kd_Sub = $kegiatan->Kd_Sub;
                      $model_kegiatan->ID_Prog = $kegiatan->ID_Prog;
                      $model_kegiatan->Ket_Kegiatan = $kegiatan->Ket_Kegiatan;
                      $model_kegiatan->Lokasi = $kegiatan->Lokasi;
                      $model_kegiatan->Kelompok_Sasaran = $kegiatan->Kelompok_Sasaran;
                      $model_kegiatan->Status_Kegiatan = $kegiatan->Status_Kegiatan;
                      $model_kegiatan->Pagu_Anggaran = $kegiatan->Pagu_Anggaran;
                      $model_kegiatan->Waktu_Pelaksanaan = $kegiatan->Waktu_Pelaksanaan;
                      $model_kegiatan->Kd_Sumber = $kegiatan->Kd_Sumber;
                      $model_kegiatan->Keterangan = $kegiatan->Keterangan;
                      $model_kegiatan->Pagu_Anggaran_Nt1 = $kegiatan->Pagu_Anggaran_Nt1;
                     
                      $model_kegiatan->save(false);
                    }

                    $ta_belanja = TaBelanja::find()->all();
                    foreach ($ta_belanja as $belanja) {
                      $model_belanja = new TaHasil();
                      //main
                      $model_belanja->Asal_Data = '3';
                      $model_belanja->Tahun = $model->Tahun;
                      $model_belanja->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_belanja->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_belanja->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_belanja->Tahun = $belanja->Tahun;
                      $model_belanja->Kd_Urusan = $belanja->Kd_Urusan;
                      $model_belanja->Kd_Bidang = $belanja->Kd_Bidang;
                      $model_belanja->Kd_Unit = $belanja->Kd_Unit;
                      $model_belanja->Kd_Sub = $belanja->Kd_Sub;
                      $model_belanja->Kd_Prog = $belanja->Kd_Prog;
                      $model_belanja->ID_Prog = $belanja->ID_Prog;
                      $model_belanja->Kd_Keg = $belanja->Kd_Keg;
                      $model_belanja->Kd_Rek_1 = $belanja->Kd_Rek_1;
                      $model_belanja->Kd_Rek_2 = $belanja->Kd_Rek_2;
                      $model_belanja->Kd_Rek_3 = $belanja->Kd_Rek_3;
                      $model_belanja->Kd_Rek_4 = $belanja->Kd_Rek_4;
                      $model_belanja->Kd_Rek_5 = $belanja->Kd_Rek_5;
                      $model_belanja->Kd_Ap_Pub = $belanja->Kd_Ap_Pub;
                      $model_belanja->Kd_Sumber = $belanja->Kd_Sumber;

                      $model_belanja->save(false);
                    }

                    $ta_belanja_rinc = TaBelanjaRinc::find()->all();
                    foreach ($ta_belanja_rinc as $belanja_rinc) {
                      $model_belanja_rinc = new TaHasil();
                      //main
                      $model_belanja_rinc->Asal_Data = '4';
                      $model_belanja_rinc->Tahun = $model->Tahun;
                      $model_belanja_rinc->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_belanja_rinc->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_belanja_rinc->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_belanja_rinc->Tahun = $belanja_rinc->Tahun;
                      $model_belanja_rinc->Kd_Urusan = $belanja_rinc->Kd_Urusan;
                      $model_belanja_rinc->Kd_Bidang = $belanja_rinc->Kd_Bidang;
                      $model_belanja_rinc->Kd_Unit = $belanja_rinc->Kd_Unit;
                      $model_belanja_rinc->Kd_Sub = $belanja_rinc->Kd_Sub;
                      $model_belanja_rinc->Kd_Prog = $belanja_rinc->Kd_Prog;
                      $model_belanja_rinc->ID_Prog = $belanja_rinc->ID_Prog;
                      $model_belanja_rinc->Kd_Keg = $belanja_rinc->Kd_Keg;
                      $model_belanja_rinc->Kd_Rek_1 = $belanja_rinc->Kd_Rek_1;
                      $model_belanja_rinc->Kd_Rek_2 = $belanja_rinc->Kd_Rek_2;
                      $model_belanja_rinc->Kd_Rek_3 = $belanja_rinc->Kd_Rek_3;
                      $model_belanja_rinc->Kd_Rek_4 = $belanja_rinc->Kd_Rek_4;
                      $model_belanja_rinc->Kd_Rek_5 = $belanja_rinc->Kd_Rek_5;
                      $model_belanja_rinc->No_Rinc = $belanja_rinc->No_Rinc;
                      $model_belanja_rinc->Keterangan = $belanja_rinc->Keterangan;
                      $model_belanja_rinc->Kd_Sumber = $belanja_rinc->Kd_Sumber;

                      $model_belanja_rinc->save(false);
                    }

                    $ta_belanja_rinci_sub = TaBelanjaRincSub::find()->all();
                    foreach ($ta_belanja_rinci_sub as $rinc_sub) {
                      $model_rinc_sub = new TaHasil();
                      //main
                      $model_rinc_sub->Asal_Data = '5';
                      $model_rinc_sub->Tahun = $model->Tahun;
                      $model_rinc_sub->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_rinc_sub->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_rinc_sub->DateCreate = new Expression('NOW()');

                      //copy
                      $model_rinc_sub->Kd_Urusan = $rinc_sub->Kd_Urusan;
                      $model_rinc_sub->Kd_Bidang = $rinc_sub->Kd_Bidang;
                      $model_rinc_sub->Kd_Unit = $rinc_sub->Kd_Unit;
                      $model_rinc_sub->Kd_Sub = $rinc_sub->Kd_Sub;
                      $model_rinc_sub->Kd_Prog = $rinc_sub->Kd_Prog;
                      $model_rinc_sub->ID_Prog = $rinc_sub->ID_Prog;
                      $model_rinc_sub->Kd_Keg = $rinc_sub->Kd_Keg;
                      $model_rinc_sub->Kd_Rek_1 = $rinc_sub->Kd_Rek_1;
                      $model_rinc_sub->Kd_Rek_2 = $rinc_sub->Kd_Rek_2;
                      $model_rinc_sub->Kd_Rek_3 = $rinc_sub->Kd_Rek_3;
                      $model_rinc_sub->Kd_Rek_4 = $rinc_sub->Kd_Rek_4;
                      $model_rinc_sub->Kd_Rek_5 = $rinc_sub->Kd_Rek_5;
                      $model_rinc_sub->No_Rinc = $rinc_sub->No_Rinc;
                      $model_rinc_sub->No_ID = $rinc_sub->No_ID;
                      $model_rinc_sub->Sat_1 = $rinc_sub->Sat_1;
                      $model_rinc_sub->Nilai_1 = $rinc_sub->Nilai_1;
                      $model_rinc_sub->Sat_2 = $rinc_sub->Sat_2;
                      $model_rinc_sub->Nilai_2 = $rinc_sub->Nilai_2;
                      $model_rinc_sub->Sat_3 = $rinc_sub->Sat_3;
                      $model_rinc_sub->Nilai_3 = $rinc_sub->Nilai_3;
                      $model_rinc_sub->Satuan123 = $rinc_sub->Satuan123;
                      $model_rinc_sub->Jml_Satuan = $rinc_sub->Jml_Satuan;
                      $model_rinc_sub->Nilai_Rp = $rinc_sub->Nilai_Rp;
                      $model_rinc_sub->Total = $rinc_sub->Total;
                      $model_rinc_sub->Keterangan = $rinc_sub->Keterangan;
                      $model_rinc_sub->Asal_Biaya = $rinc_sub->Asal_Biaya;
                      $model_rinc_sub->Uraian_Asal_Biaya = $rinc_sub->Uraian_Asal_Biaya;
                      $model_rinc_sub->Ref_Usulan_Rincian = $rinc_sub->Ref_Usulan_Rincian;
                      // $model_rinc_sub->Uraian_Ref_Usulan = $rinc_sub->Uraian_Ref_Usulan;

                      $model_rinc_sub->save(false);
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new TaPeraturan",
                    'content'=>'<span class="text-success">Create TaPeraturan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];         
            }else{           
                return [
                    'title'=> "Create new TaPeraturan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'RefTahapan' => $RefTahapan,
                        'RefPeraturan' => $RefPeraturan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $model->save();
                    //mengambil semua program
                    $ta_program = TaProgram::find()->all();
                    foreach ($ta_program as $value) {
                      $model_program = new TaHasil();
                      //main
                      $model_program->Asal_Data = '1';
                      $model_program->Tahun = $model->Tahun;
                      $model_program->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_program->Kd_Peraturan = $model->Kd_Peraturan;
                      // $model_program->DateCreate = date('Y-m-d');
                      // $model_program->DateCreate = Yii::$app->formatter->asDatetime(date('Y-d-m h:i:s'));
                      $model_program->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_program->Tahun = $value->Tahun;
                      $model_program->Kd_Urusan = $value->Kd_Urusan;
                      $model_program->Kd_Bidang = $value->Kd_Bidang;
                      $model_program->Kd_Unit = $value->Kd_Unit;
                      $model_program->Kd_Sub = $value->Kd_Sub;
                      $model_program->Kd_Prog = $value->Kd_Prog;
                      $model_program->ID_Prog = $value->ID_Prog;
                      $model_program->Ket_Prog = $value->Ket_Prog;
                      $model_program->save(false);
                    }

                    //mengambil semua kegiatan
                    $ta_kegiatan = TaKegiatan::find()->all();
                    foreach ($ta_kegiatan as $kegiatan) {
                      $model_kegiatan = new TaHasil();
                      //main
                      $model_kegiatan->Asal_Data = '2';
                      $model_kegiatan->Tahun = $model->Tahun;
                      $model_kegiatan->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_kegiatan->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_kegiatan->DateCreate = new Expression('NOW()');

                      //copy
                      $model_kegiatan->Kd_Urusan = $kegiatan->Kd_Urusan;
                      $model_kegiatan->Kd_Bidang = $kegiatan->Kd_Bidang;
                      $model_kegiatan->Kd_Prog = $kegiatan->Kd_Prog;
                      $model_kegiatan->Kd_Keg = $kegiatan->Kd_Keg;
                      $model_kegiatan->Kd_Unit = $kegiatan->Kd_Unit;
                      $model_kegiatan->Kd_Sub = $kegiatan->Kd_Sub;
                      $model_kegiatan->ID_Prog = $kegiatan->ID_Prog;
                      $model_kegiatan->Ket_Kegiatan = $kegiatan->Ket_Kegiatan;
                      $model_kegiatan->Lokasi = $kegiatan->Lokasi;
                      $model_kegiatan->Kelompok_Sasaran = $kegiatan->Kelompok_Sasaran;
                      $model_kegiatan->Status_Kegiatan = $kegiatan->Status_Kegiatan;
                      $model_kegiatan->Pagu_Anggaran = $kegiatan->Pagu_Anggaran;
                      $model_kegiatan->Waktu_Pelaksanaan = $kegiatan->Waktu_Pelaksanaan;
                      $model_kegiatan->Kd_Sumber = $kegiatan->Kd_Sumber;
                      $model_kegiatan->Keterangan = $kegiatan->Keterangan;
                      $model_kegiatan->Pagu_Anggaran_Nt1 = $kegiatan->Pagu_Anggaran_Nt1;
                     
                      $model_kegiatan->save(false);
                    }

                    $ta_belanja = TaBelanja::find()->all();
                    foreach ($ta_belanja as $belanja) {
                      $model_belanja = new TaHasil();
                      //main
                      $model_belanja->Asal_Data = '3';
                      $model_belanja->Tahun = $model->Tahun;
                      $model_belanja->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_belanja->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_belanja->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_belanja->Tahun = $belanja->Tahun;
                      $model_belanja->Kd_Urusan = $belanja->Kd_Urusan;
                      $model_belanja->Kd_Bidang = $belanja->Kd_Bidang;
                      $model_belanja->Kd_Unit = $belanja->Kd_Unit;
                      $model_belanja->Kd_Sub = $belanja->Kd_Sub;
                      $model_belanja->Kd_Prog = $belanja->Kd_Prog;
                      $model_belanja->ID_Prog = $belanja->ID_Prog;
                      $model_belanja->Kd_Keg = $belanja->Kd_Keg;
                      $model_belanja->Kd_Rek_1 = $belanja->Kd_Rek_1;
                      $model_belanja->Kd_Rek_2 = $belanja->Kd_Rek_2;
                      $model_belanja->Kd_Rek_3 = $belanja->Kd_Rek_3;
                      $model_belanja->Kd_Rek_4 = $belanja->Kd_Rek_4;
                      $model_belanja->Kd_Rek_5 = $belanja->Kd_Rek_5;
                      $model_belanja->Kd_Ap_Pub = $belanja->Kd_Ap_Pub;
                      $model_belanja->Kd_Sumber = $belanja->Kd_Sumber;

                      $model_belanja->save(false);
                    }

                    $ta_belanja_rinc = TaBelanjaRinc::find()->all();
                    foreach ($ta_belanja_rinc as $belanja_rinc) {
                      $model_belanja_rinc = new TaHasil();
                      //main
                      $model_belanja_rinc->Asal_Data = '4';
                      $model_belanja_rinc->Tahun = $model->Tahun;
                      $model_belanja_rinc->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_belanja_rinc->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_belanja_rinc->DateCreate = new Expression('NOW()');

                      //copy
                      // $model_belanja_rinc->Tahun = $belanja_rinc->Tahun;
                      $model_belanja_rinc->Kd_Urusan = $belanja_rinc->Kd_Urusan;
                      $model_belanja_rinc->Kd_Bidang = $belanja_rinc->Kd_Bidang;
                      $model_belanja_rinc->Kd_Unit = $belanja_rinc->Kd_Unit;
                      $model_belanja_rinc->Kd_Sub = $belanja_rinc->Kd_Sub;
                      $model_belanja_rinc->Kd_Prog = $belanja_rinc->Kd_Prog;
                      $model_belanja_rinc->ID_Prog = $belanja_rinc->ID_Prog;
                      $model_belanja_rinc->Kd_Keg = $belanja_rinc->Kd_Keg;
                      $model_belanja_rinc->Kd_Rek_1 = $belanja_rinc->Kd_Rek_1;
                      $model_belanja_rinc->Kd_Rek_2 = $belanja_rinc->Kd_Rek_2;
                      $model_belanja_rinc->Kd_Rek_3 = $belanja_rinc->Kd_Rek_3;
                      $model_belanja_rinc->Kd_Rek_4 = $belanja_rinc->Kd_Rek_4;
                      $model_belanja_rinc->Kd_Rek_5 = $belanja_rinc->Kd_Rek_5;
                      $model_belanja_rinc->No_Rinc = $belanja_rinc->No_Rinc;
                      $model_belanja_rinc->Keterangan = $belanja_rinc->Keterangan;
                      $model_belanja_rinc->Kd_Sumber = $belanja_rinc->Kd_Sumber;

                      $model_belanja_rinc->save(false);
                    }

                    $ta_belanja_rinci_sub = TaBelanjaRincSub::find()->all();
                    foreach ($ta_belanja_rinci_sub as $rinc_sub) {
                      $model_rinc_sub = new TaHasil();
                      //main
                      $model_rinc_sub->Asal_Data = '5';
                      $model_rinc_sub->Tahun = $model->Tahun;
                      $model_rinc_sub->Kd_Tahapan = $model->Kd_Tahapan;
                      $model_rinc_sub->Kd_Peraturan = $model->Kd_Peraturan;
                      $model_rinc_sub->DateCreate = new Expression('NOW()');

                      //copy
                      $model_rinc_sub->Kd_Urusan = $rinc_sub->Kd_Urusan;
                      $model_rinc_sub->Kd_Bidang = $rinc_sub->Kd_Bidang;
                      $model_rinc_sub->Kd_Unit = $rinc_sub->Kd_Unit;
                      $model_rinc_sub->Kd_Sub = $rinc_sub->Kd_Sub;
                      $model_rinc_sub->Kd_Prog = $rinc_sub->Kd_Prog;
                      $model_rinc_sub->ID_Prog = $rinc_sub->ID_Prog;
                      $model_rinc_sub->Kd_Keg = $rinc_sub->Kd_Keg;
                      $model_rinc_sub->Kd_Rek_1 = $rinc_sub->Kd_Rek_1;
                      $model_rinc_sub->Kd_Rek_2 = $rinc_sub->Kd_Rek_2;
                      $model_rinc_sub->Kd_Rek_3 = $rinc_sub->Kd_Rek_3;
                      $model_rinc_sub->Kd_Rek_4 = $rinc_sub->Kd_Rek_4;
                      $model_rinc_sub->Kd_Rek_5 = $rinc_sub->Kd_Rek_5;
                      $model_rinc_sub->No_Rinc = $rinc_sub->No_Rinc;
                      $model_rinc_sub->No_ID = $rinc_sub->No_ID;
                      $model_rinc_sub->Sat_1 = $rinc_sub->Sat_1;
                      $model_rinc_sub->Nilai_1 = $rinc_sub->Nilai_1;
                      $model_rinc_sub->Sat_2 = $rinc_sub->Sat_2;
                      $model_rinc_sub->Nilai_2 = $rinc_sub->Nilai_2;
                      $model_rinc_sub->Sat_3 = $rinc_sub->Sat_3;
                      $model_rinc_sub->Nilai_3 = $rinc_sub->Nilai_3;
                      $model_rinc_sub->Satuan123 = $rinc_sub->Satuan123;
                      $model_rinc_sub->Jml_Satuan = $rinc_sub->Jml_Satuan;
                      $model_rinc_sub->Nilai_Rp = $rinc_sub->Nilai_Rp;
                      $model_rinc_sub->Total = $rinc_sub->Total;
                      $model_rinc_sub->Keterangan = $rinc_sub->Keterangan;
                      $model_rinc_sub->Asal_Biaya = $rinc_sub->Asal_Biaya;
                      $model_rinc_sub->Uraian_Asal_Biaya = $rinc_sub->Uraian_Asal_Biaya;
                      $model_rinc_sub->Ref_Usulan_Rincian = $rinc_sub->Ref_Usulan_Rincian;
                      // $model_rinc_sub->Uraian_Ref_Usulan = $rinc_sub->Uraian_Ref_Usulan;

                      $model_rinc_sub->save(false);
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Tahapan' => $model->Kd_Tahapan, 'Kd_Peraturan' => $model->Kd_Peraturan]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'RefTahapan' => $RefTahapan,
                    'RefPeraturan' => $RefPeraturan,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaPeraturan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Tahapan
     * @param integer $Kd_Peraturan
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Tahapan, $Kd_Peraturan)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Tahapan, $Kd_Peraturan);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TaPeraturan #".$Tahun, $Kd_Tahapan, $Kd_Peraturan,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TaPeraturan #".$Tahun, $Kd_Tahapan, $Kd_Peraturan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Tahapan, $Kd_Peraturan'=>$Tahun, $Kd_Tahapan, $Kd_Peraturan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TaPeraturan #".$Tahun, $Kd_Tahapan, $Kd_Peraturan,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Tahapan' => $model->Kd_Tahapan, 'Kd_Peraturan' => $model->Kd_Peraturan]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaPeraturan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Tahapan
     * @param integer $Kd_Peraturan
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Tahapan, $Kd_Peraturan)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Tahapan, $Kd_Peraturan)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing TaPeraturan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Tahapan
     * @param integer $Kd_Peraturan
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the TaPeraturan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Tahapan
     * @param integer $Kd_Peraturan
     * @return TaPeraturan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Tahapan, $Kd_Peraturan)
    {
        if (($model = TaPeraturan::findOne(['Tahun' => $Tahun, 'Kd_Tahapan' => $Kd_Tahapan, 'Kd_Peraturan' => $Kd_Peraturan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
