<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefSsh4;
use common\models\search\RefSsh4Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use yii\helpers\ArrayHelper;

/**
 * RefSsh4Controller implements the CRUD actions for RefSsh4 model.
 */
class RefSsh4Controller extends Controller
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
     * Lists all RefSsh4 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSsh4Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefSsh4 model.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @return mixed
     */
    public function actionView($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode SSH 4 #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update', 'Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2, 'Kd_Ssh3' => $Kd_Ssh3, 'Kd_Ssh4' => $Kd_Ssh4,'Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4'=>$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4),
            ]);
        }
    }

    /**
     * Creates a new RefSsh4 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefSsh4();
        
        // $dataSsh = ArrayHelper::map(RefSsh1::find()
        //         ->all()
        // , 'Kd_Ssh1', 'Nm_Ssh1');

        $ssh=RefSsh1::find()
            ->all();
        $dataSsh =[];
        foreach($ssh as $key => $value){
            $dataSsh[$value['Kd_Ssh1']]=$value['Kd_Ssh1'].". ".$value['Nm_Ssh1'];
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode SSH 4",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()) {

              //  $NASKd_RefSsh4 = RefSsh4::find()
              // ->where(['Kd_Ssh1' => $model->Kd_Ssh1,'Kd_Ssh2' => $model->Kd_Ssh2,'Kd_Ssh3' => $model->Kd_Ssh3 ])
              //   ->max('Kd_Ssh4');

              //   $Kd_Ssh4 = $NASKd_RefSsh4+1;
              //   $model->Kd_Ssh4 = $Kd_Ssh4;


             // if ($model->save()){
             //    return [
             //        'forceReload'=>'#crud-datatable-pjax',
             //        'title'=> "Tambah Kode SSH 4",
             //        'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 4</span>',
             //        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
             //                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

             //    ];
             // }

             try {
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode SSH 4",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 4</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
             } catch (\Exception $e) {
                 return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode SSH 4",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 4</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
             }
            }else{
                return [
                    'title'=> "Tambah Kode SSH 4",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
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
                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2, 'Kd_Ssh3' => $model->Kd_Ssh3, 'Kd_Ssh4' => $model->Kd_Ssh4]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataSsh' => $dataSsh,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefSsh4 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @return mixed
     */
    public function actionUpdate($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4);

        $dataSsh = ArrayHelper::map(RefSsh1::find()
              ->all()
      , 'Kd_Ssh1', 'Nm_Ssh1');
        $dataSsh2 = ArrayHelper::map(RefSsh2::find()
              ->where(['Kd_Ssh1' => $Kd_Ssh1])
              ->all()
      , 'Kd_Ssh2', 'Nm_Ssh2');
        $dataSsh3 = ArrayHelper::map(RefSsh3::find()
              ->where(['Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2])
              ->all()
      , 'Kd_Ssh3', 'Nm_Ssh3');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode SSH 4 #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSsh2' => $dataSsh2,
                        'dataSsh3' => $dataSsh3,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode SSH 4 #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSsh2' => $dataSsh2,
                        'dataSsh3' => $dataSsh3,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4'=>$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode SSH 4 #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSsh2' => $dataSsh2,
                        'dataSsh3' => $dataSsh3,
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
                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2, 'Kd_Ssh3' => $model->Kd_Ssh3, 'Kd_Ssh4' => $model->Kd_Ssh4]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataSsh' => $dataSsh,
                    'dataSsh2' => $dataSsh2,
                    'dataSsh3' => $dataSsh3,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefSsh4 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @return mixed
     */
    public function actionDelete($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            //$curr_row = new RefSsh4();
            // $curr_row = RefSsh4::findOne($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4);
            // $curr_row->delete();

            try {
              
            $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)->delete();
              
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            // $curr_row = RefSsh4::findOne($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4);
            // $curr_row->delete();
            
            } catch (\Exception $e) {
            
                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Tambah Kode SSH 4",
                //     'content'=>'<span class="text-success"> Hello World </span>',
                //     'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                //             Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                // ];

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
     * Delete multiple existing RefSsh4 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
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
     * Finds the RefSsh4 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @return RefSsh4 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)
    {
        if (($model = RefSsh4::findOne(['Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2, 'Kd_Ssh3' => $Kd_Ssh3, 'Kd_Ssh4' => $Kd_Ssh4])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
