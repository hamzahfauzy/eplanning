<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefHspk2;
use common\models\search\RefHspk2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefHspk1;
use yii\helpers\ArrayHelper;

/**
 * RefHspk2Controller implements the CRUD actions for RefHspk2 model.
 */
class RefHspk2Controller extends Controller
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
     * Lists all RefHspk2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefHspk2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefHspk2 model.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @return mixed
     */
    public function actionView($Kd_Hspk1, $Kd_Hspk2)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode HSPK 2 #".$Kd_Hspk1, $Kd_Hspk2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2'=>$Kd_Hspk1, $Kd_Hspk2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2),
            ]);
        }
    }

    /**
     * Creates a new RefHspk2 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefHspk2();

        $dataHspk = ArrayHelper::map(RefHspk1::find()
                ->all()
        , 'Kd_Hspk1', 'Nm_Hspk1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode HSPK 2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()) {

             // $NASKd_RefHspk2 = RefHspk2::find()
             //  ->where(['Kd_Hspk1' => $model->Kd_Hspk1])
             //    ->max('Kd_Hspk2');
             //    //->count();

             //    $Kd_Hspk2 = $NASKd_RefHspk2+1;
             //    $model->Kd_Hspk2 = $Kd_Hspk2;


             //if ($model->save()){

            try {
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode HSPK 2",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 2</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            } catch (\Exception $e) {
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode HSPK 2",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 2</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }
     
            //}
            }else{
                return [
                    'title'=> "Tambah Kode HSPK 2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
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
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataHspk' => $dataHspk,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefHspk2 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @return mixed
     */
    public function actionUpdate($Kd_Hspk1, $Kd_Hspk2)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Hspk1, $Kd_Hspk2);

        $dataHspk = ArrayHelper::map(RefHspk1::find()
                ->all()
        , 'Kd_Hspk1', 'Nm_Hspk1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode HSPK 2 #".$Kd_Hspk1, $Kd_Hspk2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode HSPK 2 #".$Kd_Hspk1, $Kd_Hspk2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2'=>$Kd_Hspk1, $Kd_Hspk2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode HSPK 2 #".$Kd_Hspk1, $Kd_Hspk2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
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
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataHspk' => $dataHspk,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefHspk2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @return mixed
     */
    public function actionDelete($Kd_Hspk1, $Kd_Hspk2)
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $this->findModel($Kd_Hspk1, $Kd_Hspk2)->delete();
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            } catch (\Exception $e) {
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }
           
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing RefHspk2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
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
     * Finds the RefHspk2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @return RefHspk2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Hspk1, $Kd_Hspk2)
    {
        if (($model = RefHspk2::findOne(['Kd_Hspk1' => $Kd_Hspk1, 'Kd_Hspk2' => $Kd_Hspk2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
