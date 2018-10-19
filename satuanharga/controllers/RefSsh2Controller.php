<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\search\RefSsh2Search;
use yii\web\Controller;
use \yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


// use yii\helpers\ArrayHelper;

/**
 * RefSsh2Controller implements the CRUD actions for RefSsh2 model.
 */
class RefSsh2Controller extends Controller
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
                    'delete' => ['post','get'],
                    'bulk-delete' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all RefSsh2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSsh2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefSsh2 model.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @return mixed
     */
    public function actionView($Kd_Ssh1, $Kd_Ssh2)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode SSH 2 #".$Kd_Ssh1, $Kd_Ssh2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2),
            ]);
        }
    }

    /**
     * Creates a new RefSsh2 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefSsh2();

        // $dataSsh = ArrayHelper::map(RefSsh1::find()
        //         ->all()
        // , 'Kd_Ssh1', 'Nm_Ssh1');

        $ssh1=RefSsh1::find()->all();
        $dataSsh = [];
        foreach($ssh1 as $key => $value){
            $dataSsh[$value['Kd_Ssh1']]=$value['Kd_Ssh1'].". ".$value['Nm_Ssh1'];
        }

        // $Array = [1,2,3,99];

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode SSH 2",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                         'dataSsh' => $dataSsh,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()){

              // $NASKd_RefSsh2 = RefSsh2::find()
              // ->where(['Kd_Ssh1' => $model->Kd_Ssh1])
              //   ->max('Kd_Ssh2');
              //   //->count();

              //   $Kd_Ssh2 = $NASKd_RefSsh2+1;

            // 'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 2</span>',

               // $ssh2 = $request->post();

               //  return print_r($ssh2);

               //  return [
               //      'forceReload'=>'#crud-datatable-pjax',
               //      'title'=> "Tambah Kode SSH 2",
               //      'content'=> print_r($ssh2),
               //      'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
               //              Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

               //  ];
              // $model->Kd_Ssh1 = 99;
              // $model->Kd_Ssh2 = 1;
              // $model->Nm_Ssh2 = "Test";

              // [RefSsh2] => Array ( [Kd_Ssh1] => 99 [Kd_Ssh2] => 3 [Nm_Ssh2] => dsdsds ) ) 

                // if($model->isNewRecord == true) {

                  // $ssh2Model =  RefSsh2::findOne(99, 1234);

                  // if(!$ssh2Model) {
                  //   $ssh2Model = new RefSsh2;
                  // }

                  // $ssh2Model->Kd_Ssh1 = 99;
                  // $ssh2Model->Kd_Ssh2 = 123;
                  // $ssh2Model->Nm_Ssh2 = "hello";


                  // if($ssh2Model->save()) {
                  // if($model->validate() && $model->save()) {


                    // $ssh2DeleteModel =  RefSsh2::findOne($model->getModel()->Kd_Ssh1, $model->getModel()->Kd_Ssh1);
                    // $ssh2DeleteModel->delete();

                    // $ssh2Model->Kd_Ssh1 = $model->getModel()->Kd_Ssh1;
                    // $ssh2Model->Kd_Ssh2 = $model->getModel()->Kd_Ssh2;

                    // if ($ssh2Model->load(Yii::$app->request->post()) && $ssh2Model->save()) {

                      //$ssh2Model = RefSsh2::model()->find('id=:ID',array(':ID'=>$id));

                      //$model->attributes=$ssh2Model->attributes;
                      
                      // $model->save();

                      // return [
                      //     'forceReload'=>'#crud-datatable-pjax',
                      //     'title'=> "Tambah Kode SSH 2",
                      //     'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 2</span>',
                      //     'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                      //             Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                      // ];

                    // }

                  // } else {

                  //     return [
                  //     'title'=> "Error",
                  //     'content'=>'<span class="text-danger"><pre>'.print_r($model->getErrors()).'</pre></span>',
                  //     'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                  //               Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                  //     ];

                  // }

                // }


                try {

                  // if($model->save())
                    $model->save();
                      return [
                          'forceReload'=>'#crud-datatable-pjax',
                          'title'=> "Tambah Kode SSH 2",
                          'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 2</span>',
                          'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                  Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                      ];
                }catch(\Exception $e) {
                    //$model->addError(null, $e->getMessage());
                        return [
                          'forceReload'=>'#crud-datatable-pjax',
                          'title'=> "Tambah Kode SSH 2",
                          'content'=>'<span class="text-success">Berhasil Tambah Kode SSH 2</span>',
                          'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                  Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                      ];
                }

            }else{
                return [
                    'title'=> "Tambah Kode SSH 2",
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
                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                     'dataSsh' => $dataSsh,
                ]);
            }
            
        }

    }

    /**
     * Updates an existing RefSsh2 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @return mixed
     */
    public function actionUpdate($Kd_Ssh1, $Kd_Ssh2)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Ssh1, $Kd_Ssh2);

        $dataSsh = ArrayHelper::map(RefSsh1::find()->all(), 'Kd_Ssh1', 'Nm_Ssh1');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode SSH 2 #".$Kd_Ssh1, $Kd_Ssh2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode SSH 2 #".$Kd_Ssh1, $Kd_Ssh2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Ssh1, $Kd_Ssh2'=>$Kd_Ssh1, $Kd_Ssh2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode SSH 2 #".$Kd_Ssh1, $Kd_Ssh2,
                    'content'=>$this->renderAjax('update', [
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
                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataSsh' => $dataSsh,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefSsh2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @return mixed
     */
    public function actionDelete($Kd_Ssh1, $Kd_Ssh2)
    {

        $request = Yii::$app->request;

        //$this->findModel($Kd_Ssh1, $Kd_Ssh2)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            try {

              $this->findModel($Kd_Ssh1, $Kd_Ssh2)->delete();
              return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];

            }catch(\Exception $e) {
               return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }

            
            // $data = $request->get();

            // return [
            //     'forceReload'=>'#crud-datatable-pjax',
            //     'title'=> "Tambah Kode SSH 2",
            //     'content'=> print_r($data)
            // ];

            // [r] => ref-ssh2/delete
            //         [Kd_Ssh1] => 99
            //         [Kd_Ssh2] => 1
            // )

        }

        else{
            
        //     *   Process for non-ajax request
            
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing RefSsh2 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
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
     * Finds the RefSsh2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @return RefSsh2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Ssh1, $Kd_Ssh2)
    {
        if (($model = RefSsh2::findOne(['Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // public function actionDelete($Kd_Ssh1, $Kd_Ssh2) {

    // $request = Yii::$app->request;
    // $NASmodel = $this->findModel($Kd_Ssh1, $Kd_Ssh2);
    // $NASmodel->delete();

    //  if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         return $this->redirect(['index']);
    //     }


    // }



}
