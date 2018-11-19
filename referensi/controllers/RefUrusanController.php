<?php

namespace referensi\controllers;

use Yii;
use common\models\RefUrusan;
use common\models\search\RefUrusan as RefUrusanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;

/**
 * RefUrusanController implements the CRUD actions for RefUrusan model.
 */
class RefUrusanController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RefUrusan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefUrusanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefUrusan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($Kd_Urusan)
    {

        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);

        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
        return [
                    'title'=> "RefUrusan #".$Kd_Urusan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Urusan),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan' => $Kd_Urusan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{

            return $this->render('view', [
                'model' => $this->findModel($Kd_Urusan),
            ]);
        }
    }

    /**
     * Creates a new RefUrusan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $request = yii::$app->request;
        $model = new RefUrusan();

        if($request->isAjax){

        Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [

                'title'=> "Create new RefUrusan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),


                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefUrusan",
                    'content'=>'<span class="text-success">Create RefUrusan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];

            }else{           
                return [
                    'title'=> "Create new RefBidang",
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
       
           

    /**
     * Deletes an existing RefUrusan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


       public function actionUpdate($Kd_Urusan)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Urusan);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefBidang #".$Kd_Urusan,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefBidang #".$Kd_Urusan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan'=>$Kd_Urusan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefBidang #".$Kd_Urusan,
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($Kd_Urusan)
    {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);

        $request = Yii::$app->request;
        $this->findModel($Kd_Urusan)->delete();

        if($request->isAjax) {
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
     * Finds the RefUrusan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefUrusan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
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

    protected function findModel($Kd_Urusan)
    {
        if (($model = RefUrusan::findOne(['Kd_Urusan' => $Kd_Urusan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
