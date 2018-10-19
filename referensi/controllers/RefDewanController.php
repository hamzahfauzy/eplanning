<?php

namespace referensi\controllers;

use Yii;
use eperencanaan\models\RefDewan;
use referensi\models\search\RefDewanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RefDapil;

/**
 * RefDewanController implements the CRUD actions for RefDewan model.
 */
class RefDewanController extends Controller
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
     * Lists all RefDewan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefDewanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefDewan model.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Dewan
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Dapil, $Kd_Dewan)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Ref Dewan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Dapil, $Kd_Dewan),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Dewan' => $Kd_Dewan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Dapil, $Kd_Dewan),
            ]);
        }
    }

    /**
     * Creates a new RefDewan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataDapil = ArrayHelper::map(RefDapil::find()->all(), 'Kd_Dapil', 'Nm_Dapil');
        $request = Yii::$app->request;
        $model = new RefDewan();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Ref Dewan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $model->Tahun = date('Y');
                if ($model->save()) {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Ref Dewan",
                        'content'=>'<span class="text-success">Tambah Ref Dewan berhasil</span>',
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];      
                }   
            }else{           
                return [
                    'title'=> "Tambah Ref Dewan",
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
            if ($model->load($request->post())) {
                $model->Tahun = date('Y');
                if ($model->save())
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Dapil' => $model->Kd_Dapil, 'Kd_Dewan' => $model->Kd_Dewan]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefDewan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Dewan
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Dapil, $Kd_Dewan)
    {
        $dataDapil = ArrayHelper::map(RefDapil::find()->all(), 'Kd_Dapil', 'Nm_Dapil');
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Dapil, $Kd_Dewan);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Ref Dewan",
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
                    'title'=> "Ref Dewan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Dewan' => $Kd_Dewan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit Ref Dewan",
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Dapil' => $model->Kd_Dapil, 'Kd_Dewan' => $model->Kd_Dewan]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefDewan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Dewan
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Dapil, $Kd_Dewan)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Dapil, $Kd_Dewan)->delete();

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
     * Delete multiple existing RefDewan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Dewan
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
     * Finds the RefDewan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Dewan
     * @return RefDewan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Dapil, $Kd_Dewan)
    {
        if (($model = RefDewan::findOne(['Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Dewan' => $Kd_Dewan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
