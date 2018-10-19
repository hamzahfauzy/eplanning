<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefHspk3;
use common\models\search\RefHspk3Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefHspk1;
use common\models\RefHspk2;
use yii\helpers\ArrayHelper;

/**
 * RefHspk3Controller implements the CRUD actions for RefHspk3 model.
 */
class RefHspk3Controller extends Controller
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
     * Lists all RefHspk3 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefHspk3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefHspk3 model.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @return mixed
     */
    public function actionView($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode HSPK 3 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3'=>$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3),
            ]);
        }
    }

    /**
     * Creates a new RefHspk3 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefHspk3();

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
                    'title'=> "Tambah Kode HSPK 3",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                         'dataHspk' => $dataHspk,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()){


              //  $NASKd_RefHspk3 = RefHspk3::find()
              // ->where(['Kd_Hspk1' => $model->Kd_Hspk1,'Kd_Hspk2' => $model->Kd_Hspk2])
              //   ->max('Kd_Hspk3');
              //   //->count();

              //   $Kd_Hspk3 = $NASKd_RefHspk3+1;
              //   $model->Kd_Hspk3 = $Kd_Hspk3;


             // if ($model->save()){
             //    return [
             //        'forceReload'=>'#crud-datatable-pjax',
             //        'title'=> "Tambah Kode HSPK 3",
             //        'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 3</span>',
             //        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
             //                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

             //    ];
             //   }

                try {
                    $model->save();
                    return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode HSPK 3",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 3</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
                } catch (\Exception $e) {
                    return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode HSPK 3",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 3</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
                }

            }else{
                return [
                    'title'=> "Tambah Kode HSPK 3",
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
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2, 'Kd_Hspk3' => $model->Kd_Hspk3]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                     'dataHspk' => $dataHspk,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefHspk3 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @return mixed
     */
    public function actionUpdate($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3);

        $dataHspk = ArrayHelper::map(RefHspk1::find()
               ->all()
       , 'Kd_Hspk1', 'Nm_Hspk1');
        $dataHspk2 = ArrayHelper::map(RefHspk2::find()
               ->where(['Kd_Hspk1' => $Kd_Hspk1])
               ->all()
       , 'Kd_Hspk2', 'Nm_Hspk2');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode HSPK 3 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                        'dataHspk2' => $dataHspk2,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode HSPK 3 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                        'dataHspk2' => $dataHspk2,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3'=>$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode HSPK 3 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                        'dataHspk2' => $dataHspk2,
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
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2, 'Kd_Hspk3' => $model->Kd_Hspk3]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataHspk' => $dataHspk,
                    'dataHspk2' => $dataHspk2,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefHspk3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @return mixed
     */
    public function actionDelete($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)
    {
        $request = Yii::$app->request;
        // $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)->delete();
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
     * Delete multiple existing RefHspk3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
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
     * Finds the RefHspk3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @return RefHspk3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)
    {
        if (($model = RefHspk3::findOne(['Kd_Hspk1' => $Kd_Hspk1, 'Kd_Hspk2' => $Kd_Hspk2, 'Kd_Hspk3' => $Kd_Hspk3])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
