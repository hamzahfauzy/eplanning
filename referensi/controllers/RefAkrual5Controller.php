<?php

namespace referensi\controllers;

use Yii;
use common\models\RefAkrual5;
use referensi\models\search\RefAkrual5Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefAkrual5Controller implements the CRUD actions for RefAkrual5 model.
 */
class RefAkrual5Controller extends Controller
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
     * Lists all RefAkrual5 models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefAkrual5Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefAkrual5 model.
     * @param integer $Kd_Akrual_1
     * @param integer $Kd_Akrual_2
     * @param integer $Kd_Akrual_3
     * @param integer $Kd_Akrual_4
     * @param integer $Kd_Akrual_5
     * @return mixed
     */
    public function actionView($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefAkrual5 #".$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5'=>$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5),
            ]);
        }
    }

    /**
     * Creates a new RefAkrual5 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefAkrual5();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefAkrual5",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefAkrual5",
                    'content'=>'<span class="text-success">Create RefAkrual5 success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefAkrual5",
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
                return $this->redirect(['view', 'Kd_Akrual_1' => $model->Kd_Akrual_1, 'Kd_Akrual_2' => $model->Kd_Akrual_2, 'Kd_Akrual_3' => $model->Kd_Akrual_3, 'Kd_Akrual_4' => $model->Kd_Akrual_4, 'Kd_Akrual_5' => $model->Kd_Akrual_5]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefAkrual5 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Akrual_1
     * @param integer $Kd_Akrual_2
     * @param integer $Kd_Akrual_3
     * @param integer $Kd_Akrual_4
     * @param integer $Kd_Akrual_5
     * @return mixed
     */
    public function actionUpdate($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefAkrual5 #".$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefAkrual5 #".$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5'=>$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefAkrual5 #".$Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5,
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
                return $this->redirect(['view', 'Kd_Akrual_1' => $model->Kd_Akrual_1, 'Kd_Akrual_2' => $model->Kd_Akrual_2, 'Kd_Akrual_3' => $model->Kd_Akrual_3, 'Kd_Akrual_4' => $model->Kd_Akrual_4, 'Kd_Akrual_5' => $model->Kd_Akrual_5]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefAkrual5 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Akrual_1
     * @param integer $Kd_Akrual_2
     * @param integer $Kd_Akrual_3
     * @param integer $Kd_Akrual_4
     * @param integer $Kd_Akrual_5
     * @return mixed
     */
    public function actionDelete($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5)->delete();

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
     * Delete multiple existing RefAkrual5 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Akrual_1
     * @param integer $Kd_Akrual_2
     * @param integer $Kd_Akrual_3
     * @param integer $Kd_Akrual_4
     * @param integer $Kd_Akrual_5
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
     * Finds the RefAkrual5 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Akrual_1
     * @param integer $Kd_Akrual_2
     * @param integer $Kd_Akrual_3
     * @param integer $Kd_Akrual_4
     * @param integer $Kd_Akrual_5
     * @return RefAkrual5 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Akrual_1, $Kd_Akrual_2, $Kd_Akrual_3, $Kd_Akrual_4, $Kd_Akrual_5)
    {
        if (($model = RefAkrual5::findOne(['Kd_Akrual_1' => $Kd_Akrual_1, 'Kd_Akrual_2' => $Kd_Akrual_2, 'Kd_Akrual_3' => $Kd_Akrual_3, 'Kd_Akrual_4' => $Kd_Akrual_4, 'Kd_Akrual_5' => $Kd_Akrual_5])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
