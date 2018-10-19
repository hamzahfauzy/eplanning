<?php

namespace referensi\controllers;

use Yii;
use common\models\RefRekAset3;
use referensi\models\search\RefRekAset3Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefRekAset3Controller implements the CRUD actions for RefRekAset3 model.
 */
class RefRekAset3Controller extends Controller
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
     * Lists all RefRekAset3 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefRekAset3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefRekAset3 model.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @return mixed
     */
    public function actionView($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefRekAset3 #".$Kd_Aset1, $Kd_Aset2, $Kd_Aset3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Aset1, $Kd_Aset2, $Kd_Aset3),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Aset1, $Kd_Aset2, $Kd_Aset3'=>$Kd_Aset1, $Kd_Aset2, $Kd_Aset3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Aset1, $Kd_Aset2, $Kd_Aset3),
            ]);
        }
    }

    /**
     * Creates a new RefRekAset3 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefRekAset3();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefRekAset3",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefRekAset3",
                    'content'=>'<span class="text-success">Create RefRekAset3 success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new RefRekAset3",
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
                return $this->redirect(['view', 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefRekAset3 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @return mixed
     */
    public function actionUpdate($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Aset1, $Kd_Aset2, $Kd_Aset3);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefRekAset3 #".$Kd_Aset1, $Kd_Aset2, $Kd_Aset3,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefRekAset3 #".$Kd_Aset1, $Kd_Aset2, $Kd_Aset3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Aset1, $Kd_Aset2, $Kd_Aset3'=>$Kd_Aset1, $Kd_Aset2, $Kd_Aset3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Update RefRekAset3 #".$Kd_Aset1, $Kd_Aset2, $Kd_Aset3,
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
                return $this->redirect(['view', 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefRekAset3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @return mixed
     */
    public function actionDelete($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)->delete();

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
     * Delete multiple existing RefRekAset3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
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
     * Finds the RefRekAset3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @return RefRekAset3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)
    {
        if (($model = RefRekAset3::findOne(['Kd_Aset1' => $Kd_Aset1, 'Kd_Aset2' => $Kd_Aset2, 'Kd_Aset3' => $Kd_Aset3])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
