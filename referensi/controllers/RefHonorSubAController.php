<?php

namespace referensi\controllers;

use Yii;
use common\models\RefHonorSubA;
use referensi\models\search\RefHonorSubASearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefHonorSubAController implements the CRUD actions for RefHonorSubA model.
 */
class RefHonorSubAController extends Controller
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
     * Lists all RefHonorSubA models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefHonorSubASearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefHonorSubA model.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @return mixed
     */
    public function actionView($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefHonorSubA #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A'=>$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A),
            ]);
        }
    }

    /**
     * Creates a new RefHonorSubA model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefHonorSubA();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefHonorSubA",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefHonorSubA",
                    'content'=>'<span class="text-success">Create RefHonorSubA success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefHonorSubA",
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
                return $this->redirect(['view', 'Kd_Honor' => $model->Kd_Honor, 'Kd_Honor_Sub' => $model->Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $model->Kd_Honor_Sub_A]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefHonorSubA model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @return mixed
     */
    public function actionUpdate($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefHonorSubA #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefHonorSubA #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A'=>$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefHonorSubA #".$Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A,
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
                return $this->redirect(['view', 'Kd_Honor' => $model->Kd_Honor, 'Kd_Honor_Sub' => $model->Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $model->Kd_Honor_Sub_A]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefHonorSubA model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @return mixed
     */
    public function actionDelete($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A)->delete();

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
     * Delete multiple existing RefHonorSubA model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
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
     * Finds the RefHonorSubA model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Honor
     * @param integer $Kd_Honor_Sub
     * @param integer $Kd_Honor_Sub_A
     * @return RefHonorSubA the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Honor, $Kd_Honor_Sub, $Kd_Honor_Sub_A)
    {
        if (($model = RefHonorSubA::findOne(['Kd_Honor' => $Kd_Honor, 'Kd_Honor_Sub' => $Kd_Honor_Sub, 'Kd_Honor_Sub_A' => $Kd_Honor_Sub_A])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
