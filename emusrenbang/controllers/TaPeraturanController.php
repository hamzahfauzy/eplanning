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
        $model->Tahun = date("Y")+1;
        $RefTahapan = ArrayHelper::map(RefTahapan::find()->orderBy('No_Urut')->all(), 'Kd_Tahapan', 'Uraian');
        $RefPeraturan = ArrayHelper::map(RefPeraturan::find()->all(), 'Kd_Peraturan', 'Nm_Peraturan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Posting Tahapan Perencanaan",
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
                    if ($model->save()) {
                        //$model->id;
                        // program
                        // main
                        $Asal_Data = '1';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Program
                          ")->execute();


                        // belanja_rinc
                        // main
                        $Asal_Data = '2';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Prog,
                                Kd_Keg,
                                Kd_Unit,
                                Kd_Sub,
                                ID_Prog,
                                Ket_Kegiatan,
                                Lokasi,
                                Kelompok_Sasaran,
                                Status_Kegiatan,
                                Pagu_Anggaran,
                                Waktu_Pelaksanaan,
                                Kd_Sumber,
                                Keterangan,
                                Pagu_Anggaran_Nt1,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Prog,
                                Kd_Keg,
                                Kd_Unit,
                                Kd_Sub,
                                ID_Prog,
                                Ket_Kegiatan,
                                Lokasi,
                                Kelompok_Sasaran,
                                Status_Kegiatan,
                                Pagu_Anggaran,
                                Waktu_Pelaksanaan,
                                Kd_Sumber,
                                Keterangan,
                                Pagu_Anggaran_Nt1,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Kegiatan
                          ")->execute();

                        // belanja_rinc
                        // main
                        $Asal_Data = '3';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                Kd_Ap_Pub,
                                Kd_Sumber,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                Kd_Ap_Pub,
                                Kd_Sumber,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja
                          ")->execute();

                        // belanja_rinc
                        // main
                        $Asal_Data = '4';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                Keterangan,
                                Kd_Sumber,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                Keterangan,
                                Kd_Sumber,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja_Rinc
                          ")->execute();

                        // belanja_rinc_sub
                        // main
                        $Asal_Data = '5';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                No_ID,
                                Sat_1,
                                Nilai_1,
                                Sat_2,
                                Nilai_2,
                                Sat_3,
                                Nilai_3,
                                Satuan123,
                                Jml_Satuan,
                                Nilai_Rp,
                                Total,
                                Keterangan,
                                Asal_Biaya,
                                Uraian_Asal_Biaya,
                                Ref_Usulan_Rincian,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                No_ID,
                                Sat_1,
                                Nilai_1,
                                Sat_2,
                                Nilai_2,
                                Sat_3,
                                Nilai_3,
                                Satuan123,
                                Jml_Satuan,
                                Nilai_Rp,
                                Total,
                                Keterangan,
                                Asal_Biaya,
                                Uraian_Asal_Biaya,
                                Ref_Usulan_Rincian,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja_Rinc_Sub
                          ")->execute();

                        // Ta_Indikator
                        // main
                        $Asal_Data = '6';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Indikator,
                                No_ID,
                                Tolak_Ukur,
                                Target_Angka,
                                Target_Uraian,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Indikator,
                                No_ID,
                                Tolak_Ukur,
                                Target_Angka,
                                Target_Uraian,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Indikator
                          ")->execute();

                        $transaction->commit();
                    }

                    
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Posting Tahapan Perencanaan",
                    'content'=>'<span class="text-success">Create TaPeraturan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];         
            }else{           
                return [
                    'title'=> "Posting Tahapan Perencanaan",
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
                    if ($model->save()) {

                        // belanja_rinc
                        // main
                        $Asal_Data = '1';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Ket_Prog,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Program
                          ")->execute();


                        // belanja_rinc
                        // main
                        $Asal_Data = '2';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Prog,
                                Kd_Keg,
                                Kd_Unit,
                                Kd_Sub,
                                ID_Prog,
                                Ket_Kegiatan,
                                Lokasi,
                                Kelompok_Sasaran,
                                Status_Kegiatan,
                                Pagu_Anggaran,
                                Waktu_Pelaksanaan,
                                Kd_Sumber,
                                Keterangan,
                                Pagu_Anggaran_Nt1,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Prog,
                                Kd_Keg,
                                Kd_Unit,
                                Kd_Sub,
                                ID_Prog,
                                Ket_Kegiatan,
                                Lokasi,
                                Kelompok_Sasaran,
                                Status_Kegiatan,
                                Pagu_Anggaran,
                                Waktu_Pelaksanaan,
                                Kd_Sumber,
                                Keterangan,
                                Pagu_Anggaran_Nt1,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Kegiatan
                          ")->execute();

                        // belanja_rinc
                        // main
                        $Asal_Data = '3';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                Kd_Ap_Pub,
                                Kd_Sumber,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                Kd_Ap_Pub,
                                Kd_Sumber,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja
                          ")->execute();

                        // belanja_rinc
                        // main
                        $Asal_Data = '4';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                Keterangan,
                                Kd_Sumber,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                Keterangan,
                                Kd_Sumber,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja_Rinc
                          ")->execute();

                        // belanja_rinc_sub
                        // main
                        $Asal_Data = '5';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                No_ID,
                                Sat_1,
                                Nilai_1,
                                Sat_2,
                                Nilai_2,
                                Sat_3,
                                Nilai_3,
                                Satuan123,
                                Jml_Satuan,
                                Nilai_Rp,
                                Total,
                                Keterangan,
                                Asal_Biaya,
                                Uraian_Asal_Biaya,
                                Ref_Usulan_Rincian,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Rek_1,
                                Kd_Rek_2,
                                Kd_Rek_3,
                                Kd_Rek_4,
                                Kd_Rek_5,
                                No_Rinc,
                                No_ID,
                                Sat_1,
                                Nilai_1,
                                Sat_2,
                                Nilai_2,
                                Sat_3,
                                Nilai_3,
                                Satuan123,
                                Jml_Satuan,
                                Nilai_Rp,
                                Total,
                                Keterangan,
                                Asal_Biaya,
                                Uraian_Asal_Biaya,
                                Ref_Usulan_Rincian,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Belanja_Rinc_Sub
                          ")->execute();

                        $Asal_Data = '6';
                        $Tahun = $model->Tahun;
                        $Kd_Tahapan = $model->Kd_Tahapan;
                        $Kd_Peraturan = $model->Kd_Peraturan;
                        // $DateCreate = new Expression('NOW()');
                        // copy
                        $connection->createCommand("
                            INSERT INTO Ta_Hasil (
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Indikator,
                                No_ID,
                                Tolak_Ukur,
                                Target_Angka,
                                Target_Uraian,
                                /*====*/
                                Asal_Data,
                                Tahun,
                                Kd_Tahapan,
                                Kd_Peraturan,
                                DateCreate
                              )
                            SELECT
                                Kd_Urusan,
                                Kd_Bidang,
                                Kd_Unit,
                                Kd_Sub,
                                Kd_Prog,
                                ID_Prog,
                                Kd_Keg,
                                Kd_Indikator,
                                No_ID,
                                Tolak_Ukur,
                                Target_Angka,
                                Target_Uraian,
                                /*====*/
                                ".$Asal_Data.",
                                ".$Tahun.",
                                ".$Kd_Tahapan.",
                                ".$Kd_Peraturan.",
                                NOW()
                            FROM Ta_Indikator
                          ")->execute();
                        
                        $transaction->commit();
                    }
                    
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
