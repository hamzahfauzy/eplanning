<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\RefRpjmd2;
use common\models\search\RefRpjmdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefRpjmdController implements the CRUD actions for RefRpjmd model.
 */
class RefRpjmdController2 extends Controller
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
     * Lists all RefRpjmd models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefRpjmdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefRpjmd model.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Prioritas_Pembangunan_Kota
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefRpjmd #".$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota'=>$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota),
            ]);
        }
    }

    /**
     * Creates a new RefRpjmd model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefRpjmd2();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefRpjmd2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefRpjmd2",
                    'content'=>'<span class="text-success">Create RefRpjmd2 success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefRpjmd2",
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Prioritas_Pembangunan_Kota' => $model->Kd_Prioritas_Pembangunan_Kota]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefRpjmd model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Prioritas_Pembangunan_Kota
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefRpjmd2 #".$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefRpjmd2 #".$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota'=>$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefRpjmd2 #".$Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota,
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Prioritas_Pembangunan_Kota' => $model->Kd_Prioritas_Pembangunan_Kota]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefRpjmd model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Prioritas_Pembangunan_Kota
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota)->delete();

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
     * Delete multiple existing RefRpjmd model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Prioritas_Pembangunan_Kota
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
     * Finds the RefRpjmd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Prioritas_Pembangunan_Kota
     * @return RefRpjmd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Prioritas_Pembangunan_Kota)
    {
        if (($model = RefRpjmd2::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Prioritas_Pembangunan_Kota' => $Kd_Prioritas_Pembangunan_Kota])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
