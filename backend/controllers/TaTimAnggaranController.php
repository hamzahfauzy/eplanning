<?php

namespace backend\controllers;

use Yii;
use backend\models\TaTimAnggaran;
use backend\models\search\TaTimAnggaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * TaTimAnggaranController implements the CRUD actions for TaTimAnggaran model.
 */
class TaTimAnggaranController extends Controller
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
     * Lists all TaTimAnggaran models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaTimAnggaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaTimAnggaran model.
     * @param integer $Tahun
     * @param integer $Kd_Tim
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Tim, $No_Urut)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TaTimAnggaran #".$Tahun, $Kd_Tim, $No_Urut,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Tim, $No_Urut),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Tim, $No_Urut'=>$Tahun, $Kd_Tim, $No_Urut],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Tim, $No_Urut),
            ]);
        }
    }

    /**
     * Creates a new TaTimAnggaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaTimAnggaran();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TaTimAnggaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new TaTimAnggaran",
                    'content'=>'<span class="text-success">Create TaTimAnggaran success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new TaTimAnggaran",
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Tim' => $model->Kd_Tim, 'No_Urut' => $model->No_Urut]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaTimAnggaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Tim
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Tim, $No_Urut)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Tim, $No_Urut);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TaTimAnggaran #".$Tahun, $Kd_Tim, $No_Urut,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TaTimAnggaran #".$Tahun, $Kd_Tim, $No_Urut,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Tim, $No_Urut'=>$Tahun, $Kd_Tim, $No_Urut],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TaTimAnggaran #".$Tahun, $Kd_Tim, $No_Urut,
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Tim' => $model->Kd_Tim, 'No_Urut' => $model->No_Urut]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaTimAnggaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Tim
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Tim, $No_Urut)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Tim, $No_Urut)->delete();

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
     * Delete multiple existing TaTimAnggaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Tim
     * @param integer $No_Urut
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
     * Finds the TaTimAnggaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Tim
     * @param integer $No_Urut
     * @return TaTimAnggaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Tim, $No_Urut)
    {
        if (($model = TaTimAnggaran::findOne(['Tahun' => $Tahun, 'Kd_Tim' => $Kd_Tim, 'No_Urut' => $No_Urut])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
