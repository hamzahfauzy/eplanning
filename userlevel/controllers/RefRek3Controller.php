<?php

namespace userlevel\controllers;

use Yii;
use common\models\RefRek3;
use referensi\models\search\RefRek3Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RefRek1;

/**
 * RefRek3Controller implements the CRUD actions for RefRek3 model.
 */
class RefRek3Controller extends Controller
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
     * Lists all RefRek3 models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefRek3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefRek3 model.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionView($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefRek3 #".$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3'=>$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3),
            ]);
        }
    }

    /**
     * Creates a new RefRek3 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefRek3();

        $dataRek = ArrayHelper::map(RefRek1::find()
                ->all()
        , 'Kd_Rek_1', 'Nm_Rek_1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefRek3",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataRek'=> $dataRek,

                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefRek3",
                    'content'=>'<span class="text-success">Create RefRek3 success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];        
            }else{           
                return [
                    'title'=> "Create new RefRek3",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataRek' => $dataRek,
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
                return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataRek' => $dataRek,
                    
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefRek3 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionUpdate($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefRek3 #".$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefRek3 #".$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3'=>$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefRek3 #".$Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3,
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
                return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefRek3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionDelete($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)->delete();

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
     * Delete multiple existing RefRek3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
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
     * Finds the RefRek3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return RefRek3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        if (($model = RefRek3::findOne(['Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2, 'Kd_Rek_3' => $Kd_Rek_3])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
