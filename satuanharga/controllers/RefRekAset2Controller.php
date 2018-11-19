<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefRekAset2;
use common\models\search\RefRekAset2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefRekAset1;
use yii\helpers\ArrayHelper;

/**
 * RefRekAset2Controller implements the CRUD actions for RefRekAset2 model.
 */
class RefRekAset2Controller extends Controller
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
     * Lists all RefRekAset2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefRekAset2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefRekAset2 model.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @return mixed
     */
    public function actionView($Kd_Aset1, $Kd_Aset2)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode Aset 2 #".$Kd_Aset1, $Kd_Aset2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Aset1, $Kd_Aset2),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Aset1, $Kd_Aset2'=>$Kd_Aset1, $Kd_Aset2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Aset1, $Kd_Aset2),
            ]);
        }
    }

    /**
     * Creates a new RefRekAset2 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefRekAset2();

        $dataAset = ArrayHelper::map(RefRekAset1::find()
                ->all()
        , 'Kd_Aset1', 'Nm_Aset1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode Aset 2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAset' => $dataAset,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode Aset 2",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode Aset 2</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Tambah Kode Aset 2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAset' => $dataAset,
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
                return $this->redirect(['view', 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataAset' => $dataAset,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefRekAset2 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @return mixed
     */
    public function actionUpdate($Kd_Aset1, $Kd_Aset2)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Aset1, $Kd_Aset2);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode Aset 2 #".$Kd_Aset1, $Kd_Aset2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode Aset 2 #".$Kd_Aset1, $Kd_Aset2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Aset1, $Kd_Aset2'=>$Kd_Aset1, $Kd_Aset2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode Aset 2 #".$Kd_Aset1, $Kd_Aset2,
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
                return $this->redirect(['view', 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefRekAset2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @return mixed
     */
    public function actionDelete($Kd_Aset1, $Kd_Aset2)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Aset1, $Kd_Aset2)->delete();

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
     * Delete multiple existing RefRekAset2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
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
     * Finds the RefRekAset2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @return RefRekAset2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Aset1, $Kd_Aset2)
    {
        if (($model = RefRekAset2::findOne(['Kd_Aset1' => $Kd_Aset1, 'Kd_Aset2' => $Kd_Aset2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
