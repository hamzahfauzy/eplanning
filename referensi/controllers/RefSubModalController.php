<?php

namespace referensi\controllers;

use Yii;
use common\models\RefSubModal;
use referensi\models\search\RefSubModalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefSubModalController implements the CRUD actions for RefSubModal model.
 */
class RefSubModalController extends Controller
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
     * Lists all RefSubModal models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefSubModalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefSubModal model.
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @param integer $Kd_Sub_Modal
     * @return mixed
     */
    public function actionView($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefSubModal #".$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal'=>$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal),
            ]);
        }
    }

    /**
     * Creates a new RefSubModal model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefSubModal();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefSubModal",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefSubModal",
                    'content'=>'<span class="text-success">Create RefSubModal success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefSubModal",
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
                return $this->redirect(['view', 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5, 'Kd_Sub_Modal' => $model->Kd_Sub_Modal]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefSubModal model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @param integer $Kd_Sub_Modal
     * @return mixed
     */
    public function actionUpdate($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefSubModal #".$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefSubModal #".$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal'=>$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefSubModal #".$Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal,
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
                return $this->redirect(['view', 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5, 'Kd_Sub_Modal' => $model->Kd_Sub_Modal]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefSubModal model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @param integer $Kd_Sub_Modal
     * @return mixed
     */
    public function actionDelete($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal)->delete();

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
     * Delete multiple existing RefSubModal model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @param integer $Kd_Sub_Modal
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
     * Finds the RefSubModal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @param integer $Kd_Sub_Modal
     * @return RefSubModal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Rek_4, $Kd_Rek_5, $Kd_Sub_Modal)
    {
        if (($model = RefSubModal::findOne(['Kd_Rek_4' => $Kd_Rek_4, 'Kd_Rek_5' => $Kd_Rek_5, 'Kd_Sub_Modal' => $Kd_Sub_Modal])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
