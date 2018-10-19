<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaRpjmdProgramPrioritas;
use common\models\TaRpjmdMisi;
use common\models\TaRpjmdTujuan;
use common\models\TaRpjmdSasaran;
use common\models\TaRpjmdPrioritasPembangunanDaerah;
use common\models\RefBidangPembangunan;
use common\models\TaRpjmdProgramPrioritasSearch;
use common\models\RefKamusProgram;
use common\models\RefRPJMD2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * TaRpjmdProgramPrioritasController implements the CRUD actions for TaRpjmdProgramPrioritas model.
 */
class TaRpjmdProgramPrioritasController extends Controller
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
     * Lists all TaRpjmdProgramPrioritas models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaRpjmdProgramPrioritasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaRpjmdProgramPrioritas model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Kd_Prog,$No_Prioritas)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Prog,$No_Prioritas),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Prog' => $Kd_Prog,'No_Prioritas' => $No_Prioritas],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Prog,$No_Prioritas),
            ]);
        }
    }

    /**
     * Creates a new TaRpjmdProgramPrioritas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaRpjmdProgramPrioritas(); 

        $dataMisi = ArrayHelper::map(TaRpjmdMisi::find()
                ->all()
        ,'No_Misi', 'Misi'); 

/*		$dataPrioritas = ArrayHelper::map(RefBidangPembangunan::find()
                ->all()
        ,'Kd_Pem', 'Bidang_Pembangunan');  */
		
		$dataPrioritas = ArrayHelper::map(RefRPJMD2::find()
                ->all()
        ,'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota'); 
		
		
		/*
		
        $dataPrioritas = ArrayHelper::map(TaRpjmdPrioritasPembangunanDaerah::find()
                ->all()
        ,'No_Prioritas', 'Prioritas_Pembangunan_Daerah'); 
		*/

        $dataProgram = ArrayHelper::map(RefKamusProgram::find()
                ->all()
        ,'Kd_Program', 'Nm_Program'); 
        $model->load($request->post());
        $model->Tahun = date('Y');
        // echo "<pre>";
        // print_r($model);
        // die();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataPrioritas' => $dataPrioritas,
                        'dataProgram' => $dataProgram,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())) {
                $model->Tahun = date('Y')-1;
                if ($model->save(false)) {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Program Prioritas Pemerintah Daerah",
                        'content'=>'<span class="text-success">Tambah Program Prioritas Pemerintah Daerah berhasil</span>',
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Tambah lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];   
                }      
            }else{           
                return [
                    'title'=> "Tambah Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataPrioritas' => $dataPrioritas,
                        'dataProgram' => $dataProgram,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $model->Tahun = date('Y');
                if ($model->save(false))
                    return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataMisi' => $dataMisi,
                    'dataPrioritas' => $dataPrioritas,
                    'dataProgram' => $dataProgram,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaRpjmdProgramPrioritas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionUpdate($Kd_Prog,$No_Prioritas)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Prog,$No_Prioritas);   

        $dataMisi = ArrayHelper::map(TaRpjmdMisi::find()
                ->all()
        ,'No_Misi', 'Misi'); 

        $dataTujuan = ArrayHelper::map(TaRpjmdTujuan::find()
                ->all()
        ,'No_Tujuan', 'Tujuan'); 

        $dataSasaran = ArrayHelper::map(TaRpjmdSasaran::find()
                ->all()
        ,'No_Sasaran', 'Sasaran'); 

       /* $dataPrioritas = ArrayHelper::map(TaRpjmdPrioritasPembangunanDaerah::find()
                ->all()
        ,'No_Prioritas', 'Prioritas_Pembangunan_Daerah'); 
*/
$dataPrioritas = ArrayHelper::map(RefRPJMD2::find()
                ->all()
        ,'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota'); 

        $dataProgram = ArrayHelper::map(RefKamusProgram::find()
                ->all()
        ,'Kd_Program', 'Nm_Program'); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
                        'dataSasaran' => $dataSasaran,
                        'dataPrioritas' => $dataPrioritas,
                        'dataProgram' => $dataProgram,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
                        'dataSasaran' => $dataSasaran,
                        'dataPrioritas' => $dataPrioritas,
                        'dataProgram' => $dataProgram,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update', 'Kd_Prog' => $Kd_Prog,'No_Prioritas' => $No_Prioritas],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit Program Prioritas Pemerintah Daerah",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
                        'dataSasaran' => $dataSasaran,
                        'dataPrioritas' => $dataPrioritas,
                        'dataProgram' => $dataProgram,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'Kd_Prog' => $model->Kd_Prog,'No_Prioritas' => $model->No_Prioritas]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataMisi' => $dataMisi,
                    'dataTujuan' => $dataTujuan,
                    'dataSasaran' => $dataSasaran,
                    'dataPrioritas' => $dataPrioritas,
                    'dataProgram' => $dataProgram,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaRpjmdProgramPrioritas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Kd_Prog,$No_Prioritas)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Prog,$No_Prioritas)->delete();

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
     * Delete multiple existing TaRpjmdProgramPrioritas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
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
     * Finds the TaRpjmdProgramPrioritas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return TaRpjmdProgramPrioritas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Prog,$No_Prioritas)
    {
        if (($model = TaRpjmdProgramPrioritas::findOne(['Kd_Prog' => $Kd_Prog],['No_Prioritas' => $No_Prioritas])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetNomorPrioritas($No_Misi,$No_Tujuan,$No_Sasaran) {
        echo TaRpjmdProgramPrioritas::find()
                ->where(['No_Misi' => $No_Misi,
                         'No_Tujuan' => $No_Tujuan,
                         'No_Sasaran' => $No_Sasaran,
                        ])
                ->max('No_Prioritas')+1;
    }

    public function actionGetTujuan($No_Misi) {
        $Tujuan=TaRpjmdTujuan::find()
            ->where(['No_Misi' => $No_Misi,])
            ->all();
        echo "<option value=0>Pilih Tujuan</option>";
        foreach($Tujuan as $e){
            echo "<option value=$e[No_Tujuan]>$e[No_Tujuan] $e[Tujuan]</option>";
        }
    }

    public function actionGetSasaran($No_Misi, $No_Tujuan) {
        $Sasaran=TaRpjmdSasaran::find()
            ->where(['No_Misi' => $No_Misi,
                     'No_Tujuan' => $No_Tujuan,
                ])
            ->all();
        echo "<option value=0>Pilih Sasaran</option>";
        foreach($Sasaran as $e){
            echo "<option value=$e[No_Sasaran]>$e[No_Sasaran] $e[Sasaran]</option>";
        }
    }

}
