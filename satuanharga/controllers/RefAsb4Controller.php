<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefAsb4;
use common\models\search\RefAsb4Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefAsb1;
use common\models\RefAsb2;
use common\models\RefAsb3;
use yii\helpers\ArrayHelper;

/**
 * RefAsb4Controller implements the CRUD actions for RefAsb4 model.
 */
class RefAsb4Controller extends Controller
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
     * Lists all RefAsb4 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefAsb4Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefAsb4 model.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @return mixed
     */
    public function actionView($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode ASB 4 #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4'=>$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4),
            ]);
        }
    }

    /**
     * Creates a new RefAsb4 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefAsb4();

        $dataAsb = ArrayHelper::map(RefAsb1::find()
                ->all()
        , 'Kd_Asb1', 'Nm_Asb1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode ASB 4",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                         'dataAsb' => $dataAsb,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()) {


                // $NASKd_RefAsb4 = RefAsb4::find()
                // ->where(['Kd_Asb1' => $model->Kd_Asb1,'Kd_Asb2' => $model->Kd_Asb2, 'Kd_Asb3' => $model->Kd_Asb3 ])
                // ->max('Kd_Asb4');

                // $Kd_Asb4 = $NASKd_RefAsb4+1;
                // $model->Kd_Asb4 = $Kd_Asb4;

             // if ($model->save()){
             //    return [
             //        'forceReload'=>'#crud-datatable-pjax',
             //        'title'=> "Tambah Kode ASB 4",
             //        'content'=>'<span class="text-success">Berhasil Tambah Kode ASB 4</span>',
             //        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
             //                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

             //    ];
             //   }

               try {
                    $model->save();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kode ASB 4",
                        'content'=>'<span class="text-success">Berhasil Tambah Kode ASB 4</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
               } catch (\Exception $e) {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kode ASB 4",
                        'content'=>'<span class="text-success">Berhasil Tambah Kode ASB 4</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
               }

            }else{
                return [
                    'title'=> "Tambah Kode ASB 4",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                         'dataAsb' => $dataAsb,
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
                return $this->redirect(['view', 'Kd_Asb1' => $model->Kd_Asb1, 'Kd_Asb2' => $model->Kd_Asb2, 'Kd_Asb3' => $model->Kd_Asb3, 'Kd_Asb4' => $model->Kd_Asb4]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                     'dataAsb' => $dataAsb,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefAsb4 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @return mixed
     */
    public function actionUpdate($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4);

        $dataAsb = ArrayHelper::map(RefAsb1::find()
                ->all()
        , 'Kd_Asb1', 'Nm_Asb1');
        $dataAsb2 = ArrayHelper::map(RefAsb2::find()
                ->where(['Kd_Asb1' => $Kd_Asb1])
                ->all()
        , 'Kd_Asb2', 'Nm_Asb2');
        $dataAsb3 = ArrayHelper::map(RefAsb3::find()
                ->where(['Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2])
                ->all()
        , 'Kd_Asb3', 'Nm_Asb3');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode ASB 4 #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'dataAsb2' => $dataAsb2,
                        'dataAsb3' => $dataAsb3,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode ASB 4 #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'dataAsb2' => $dataAsb2,
                        'dataAsb3' => $dataAsb3,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4'=>$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode ASB 4 #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'dataAsb2' => $dataAsb2,
                        'dataAsb3' => $dataAsb3,
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
                return $this->redirect(['view', 'Kd_Asb1' => $model->Kd_Asb1, 'Kd_Asb2' => $model->Kd_Asb2, 'Kd_Asb3' => $model->Kd_Asb3, 'Kd_Asb4' => $model->Kd_Asb4]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataAsb' => $dataAsb,
                    'dataAsb2' => $dataAsb2,
                    'dataAsb3' => $dataAsb3,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefAsb4 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @return mixed
     */
    public function actionDelete($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            try {   
                $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)->delete();
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
     * Delete multiple existing RefAsb4 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
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
     * Finds the RefAsb4 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @return RefAsb4 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)
    {
        if (($model = RefAsb4::findOne(['Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2, 'Kd_Asb3' => $Kd_Asb3, 'Kd_Asb4' => $Kd_Asb4])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
