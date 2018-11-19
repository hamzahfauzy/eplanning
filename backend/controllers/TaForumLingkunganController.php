<?php

namespace backend\controllers;

use Yii;
use backend\models\TaForumLingkungan;
use backend\models\search\TaForumLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * TaForumLingkunganController implements the CRUD actions for TaForumLingkungan model.
 */
class TaForumLingkunganController extends Controller
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
     * Lists all TaForumLingkungan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaForumLingkunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaForumLingkungan model.
     * @param integer $Kd_Forum_Lingkungan
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub_Unit
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Program
     * @param integer $Kd_Kegiatan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Jenis_Usulan
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionView($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TaForumLingkungan #".$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan'=>$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan),
            ]);
        }
    }

    /**
     * Creates a new TaForumLingkungan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaForumLingkungan();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TaForumLingkungan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new TaForumLingkungan",
                    'content'=>'<span class="text-success">Create TaForumLingkungan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new TaForumLingkungan",
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
                return $this->redirect(['view', 'Kd_Forum_Lingkungan' => $model->Kd_Forum_Lingkungan, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Jenis_Usulan' => $model->Kd_Jenis_Usulan, 'Kd_Satuan' => $model->Kd_Satuan]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaForumLingkungan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Forum_Lingkungan
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub_Unit
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Program
     * @param integer $Kd_Kegiatan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Jenis_Usulan
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionUpdate($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TaForumLingkungan #".$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TaForumLingkungan #".$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan'=>$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TaForumLingkungan #".$Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan,
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
                return $this->redirect(['view', 'Kd_Forum_Lingkungan' => $model->Kd_Forum_Lingkungan, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Jenis_Usulan' => $model->Kd_Jenis_Usulan, 'Kd_Satuan' => $model->Kd_Satuan]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaForumLingkungan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Forum_Lingkungan
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub_Unit
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Program
     * @param integer $Kd_Kegiatan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Jenis_Usulan
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionDelete($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan)->delete();

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
     * Delete multiple existing TaForumLingkungan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Forum_Lingkungan
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub_Unit
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Program
     * @param integer $Kd_Kegiatan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Jenis_Usulan
     * @param integer $Kd_Satuan
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
     * Finds the TaForumLingkungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Forum_Lingkungan
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub_Unit
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Program
     * @param integer $Kd_Kegiatan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Jenis_Usulan
     * @param integer $Kd_Satuan
     * @return TaForumLingkungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Forum_Lingkungan, $Kd_Unit, $Kd_Sub_Unit, $Kd_Lingkungan, $Kd_Jalan, $Kd_Program, $Kd_Kegiatan, $Kd_Klasifikasi, $Kd_Jenis_Usulan, $Kd_Satuan)
    {
        if (($model = TaForumLingkungan::findOne(['Kd_Forum_Lingkungan' => $Kd_Forum_Lingkungan, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub_Unit' => $Kd_Sub_Unit, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Jalan' => $Kd_Jalan, 'Kd_Program' => $Kd_Program, 'Kd_Kegiatan' => $Kd_Kegiatan, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Jenis_Usulan' => $Kd_Jenis_Usulan, 'Kd_Satuan' => $Kd_Satuan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
