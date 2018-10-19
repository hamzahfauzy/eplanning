<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefHonorSubADetail;
use common\models\search\RefHonorSubADetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefHonorSubADetailController implements the CRUD actions for RefHonorSubADetail model.
 */
class RefHonorSubADetailController extends Controller
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
     * Lists all RefHonorSubADetail models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefHonorSubADetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefHonorSubADetail model.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @param integer $Kd_Honor_Sub_A_Detail
     * @return mixed
     */
    public function actionView($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefHonorSubADetail #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail'=>$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail),
            ]);
        }
    }

    /**
     * Creates a new RefHonorSubADetail model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefHonorSubADetail();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefHonorSubADetail",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefHonorSubADetail",
                    'content'=>'<span class="text-success">Create RefHonorSubADetail success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefHonorSubADetail",
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
                return $this->redirect(['view', 'Kd_Honor' => $model->Kd_Honor, 'Kd_Honor_Sub' => $model->Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $model->Kd_Honor_Sub_A, 'Kd_Honor_Sub_A_Detail' => $model->Kd_Honor_Sub_A_Detail]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefHonorSubADetail model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @param integer $Kd_Honor_Sub_A_Detail
     * @return mixed
     */
    public function actionUpdate($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefHonorSubADetail #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefHonorSubADetail #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail'=>$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefHonorSubADetail #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail,
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
                return $this->redirect(['view', 'Kd_Honor' => $model->Kd_Honor, 'Kd_Honor_Sub' => $model->Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $model->Kd_Honor_Sub_A, 'Kd_Honor_Sub_A_Detail' => $model->Kd_Honor_Sub_A_Detail]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefHonorSubADetail model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @param integer $Kd_Honor_Sub_A_Detail
     * @return mixed
     */
    public function actionDelete($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail)->delete();

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
     * Delete multiple existing RefHonorSubADetail model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @param integer $Kd_Honor_Sub_A_Detail
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
     * Finds the RefHonorSubADetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @param integer $Kd_Honor_Sub_A_Detail
     * @return RefHonorSubADetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A, $Kd_Honor_Sub_A_Detail)
    {
        if (($model = RefHonorSubADetail::findOne(['Kd_Honor' => $Kd_Honor, 'Kd_Honor_Sub' => $Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $Kd_Honor_Sub_A, 'Kd_Honor_Sub_A_Detail' => $Kd_Honor_Sub_A_Detail])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
