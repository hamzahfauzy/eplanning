<?php

namespace backend\controllers;

use Yii;
use backend\models\TaUraianKegiatan;
use backend\models\search\TaUraianKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * TaUraianKegiatanController implements the CRUD actions for TaUraianKegiatan model.
 */
class TaUraianKegiatanController extends Controller
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
     * Lists all TaUraianKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaUraianKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaUraianKegiatan model.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TaUraianKegiatan #".$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg'=>$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg),
            ]);
        }
    }

    /**
     * Creates a new TaUraianKegiatan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaUraianKegiatan();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TaUraianKegiatan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new TaUraianKegiatan",
                    'content'=>'<span class="text-success">Create TaUraianKegiatan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new TaUraianKegiatan",
                    'content'=>$this->renderAjax('create', [
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
                return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaUraianKegiatan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionUpdate($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TaUraianKegiatan #".$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TaUraianKegiatan #".$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg'=>$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TaUraianKegiatan #".$tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg,
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
                return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaUraianKegiatan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        $request = Yii::$app->request;
        $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)->delete();

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
     * Delete multiple existing TaUraianKegiatan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
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
     * Finds the TaUraianKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return TaUraianKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        if (($model = TaUraianKegiatan::findOne(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
