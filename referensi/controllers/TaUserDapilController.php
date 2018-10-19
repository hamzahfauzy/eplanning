<?php

namespace referensi\controllers;

use Yii;
use common\models\TaUserDapil;
use common\models\RefDapil;
use common\models\search\TaUserDapilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * TaUserDapilController implements the CRUD actions for TaUserDapil model.
 */
class TaUserDapilController extends Controller
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
     * Lists all TaUserDapil models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaUserDapilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaUserDapil model.
     * @param string $Tahun
     * @param integer $Kd_User
     * @param integer $Kd_Dapil
     * @return mixed
     */
    public function actionView($Tahun, $Kd_User, $Kd_Dapil)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "User Dapil",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_User, $Kd_Dapil),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_User, $Kd_Dapil'=>$Tahun, $Kd_User, $Kd_Dapil],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_User, $Kd_Dapil),
            ]);
        }
    }

    /**
     * Creates a new TaUserDapil model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaUserDapil(); 

        $dataDapil =  ArrayHelper::map(RefDapil::find()->all(),'Kd_Dapil', 'Nm_Dapil'); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah User Dapil",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah User Dapil",
                    'content'=>'<span class="text-success">Tambah User Dapil berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah User Dapil",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_User' => $model->Kd_User, 'Kd_Dapil' => $model->Kd_Dapil]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaUserDapil model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_User
     * @param integer $Kd_Dapil
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_User, $Kd_Dapil)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_User, $Kd_Dapil);      

        $dataDapil =  ArrayHelper::map(RefDapil::find()->all(),'Kd_Dapil', 'Nm_Dapil'); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit User Dapil",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "User Dapil",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun, $Kd_User, $Kd_Dapil'=>$Tahun, $Kd_User, $Kd_Dapil],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit User Dapil",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_User' => $model->Kd_User, 'Kd_Dapil' => $model->Kd_Dapil]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaUserDapil model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_User
     * @param integer $Kd_Dapil
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_User, $Kd_Dapil)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_User, $Kd_Dapil)->delete();

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
     * Delete multiple existing TaUserDapil model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_User
     * @param integer $Kd_Dapil
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
     * Finds the TaUserDapil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_User
     * @param integer $Kd_Dapil
     * @return TaUserDapil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_User, $Kd_Dapil)
    {
        if (($model = TaUserDapil::findOne(['Tahun' => $Tahun, 'Kd_User' => $Kd_User, 'Kd_Dapil' => $Kd_Dapil])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
