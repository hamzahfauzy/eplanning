<?php

namespace referensi\controllers;

use Yii;
use common\models\RefKecamatanKriteriaPembobotan;
use common\models\search\RefKecamatanKriteriaPembobotanSearch;
use common\models\RefKecamatanKriteriaBobot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefKecamatanKriteriaPembobotanController implements the CRUD actions for RefKecamatanKriteriaPembobotan model.
 */
class RefKecamatanKriteriaPembobotanController extends Controller
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
     * Lists all RefKecamatanKriteriaPembobotan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefKecamatanKriteriaPembobotanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefKecamatanKriteriaPembobotan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefKecamatanKriteriaPembobotan #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new RefKecamatanKriteriaPembobotan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefKecamatanKriteriaPembobotan();
        $dataBobot = [];
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefKecamatanKriteriaPembobotan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataBobot' => $dataBobot,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $range = $request->post('range');
                $skor = $request->post('skor');
                
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $model->save();
                    $Kd_Kriteria = $model->Kd_Kriteria;
                    
                    foreach ($range as $key => $value) {
                        $No_Urut = $key;
                        $isi_range = $value;
                        $isi_skor = $skor[$key];
                        
                        $bobot = new RefKecamatanKriteriaBobot();
                        $bobot->Kd_Kriteria=$Kd_Kriteria;
                        $bobot->No_Urut=$No_Urut;
                        $bobot->Range=$isi_range;
                        $bobot->Skor=$isi_skor;
                        $bobot->save();
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefKecamatanKriteriaPembobotan",
                    'content'=>'<span class="text-success">Create RefKecamatanKriteriaPembobotan success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefKecamatanKriteriaPembobotan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataBobot' => $dataBobot,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) ) {
                $range = $request->post('range');
                $skor = $request->post('skor');
                
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $model->save();
                    $Kd_Kriteria = $model->Kd_Kriteria;
                    
                    foreach ($range as $key => $value) {
                        $No_Urut = $key;
                        $isi_range = $value;
                        $isi_skor = $skor[$key];
                        
                        $bobot = new RefKecamatanKriteriaBobot();
                        $bobot->Kd_Kriteria=$Kd_Kriteria;
                        $bobot->No_Urut=$No_Urut;
                        $bobot->Range=$isi_range;
                        $bobot->Skor=$isi_skor;
                        $bobot->save();
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['view', 'id' => $model->Kd_Kriteria]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataBobot' => $dataBobot,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefKecamatanKriteriaPembobotan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataBobot = RefKecamatanKriteriaBobot::find()
                        ->where(['Kd_Kriteria' => $model->Kd_Kriteria])
                        ->all();


        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefKecamatanKriteriaPembobotan #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataBobot' => $dataBobot,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){

                $range = $request->post('range');
                $skor = $request->post('skor');
                // echo 'sadf';
                // die();
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    RefKecamatanKriteriaBobot::deleteAll(['Kd_Kriteria' => $model->Kd_Kriteria]);
                    $model->save();
                    $Kd_Kriteria = $model->Kd_Kriteria;
                    
                    foreach ($range as $key => $value) {
                        $No_Urut = $key;
                        $isi_range = $value;
                        $isi_skor = $skor[$key];
                        
                        $bobot = new RefKecamatanKriteriaBobot();
                        $bobot->Kd_Kriteria=$Kd_Kriteria;
                        $bobot->No_Urut=$No_Urut;
                        $bobot->Range=$isi_range;
                        $bobot->Skor=$isi_skor;
                        $bobot->save();
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefKecamatanKriteriaPembobotan #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataBobot' => $dataBobot,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefKecamatanKriteriaPembobotan #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataBobot' => $dataBobot,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $range = $request->post('range');
                $skor = $request->post('skor');
                // echo 'sadf';
                // die();
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    RefKecamatanKriteriaBobot::deleteAll(['Kd_Kriteria' => $model->Kd_Kriteria]);
                    $model->save();
                    $Kd_Kriteria = $model->Kd_Kriteria;
                    
                    foreach ($range as $key => $value) {
                        $No_Urut = $key;
                        $isi_range = $value;
                        $isi_skor = $skor[$key];
                        
                        $bobot = new RefKecamatanKriteriaBobot();
                        $bobot->Kd_Kriteria=$Kd_Kriteria;
                        $bobot->No_Urut=$No_Urut;
                        $bobot->Range=$isi_range;
                        $bobot->Skor=$isi_skor;
                        $bobot->save();
                    }

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['view', 'id' => $model->Kd_Kriteria]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataBobot' => $dataBobot,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefKecamatanKriteriaPembobotan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

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
     * Delete multiple existing RefKecamatanKriteriaPembobotan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the RefKecamatanKriteriaPembobotan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefKecamatanKriteriaPembobotan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefKecamatanKriteriaPembobotan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
