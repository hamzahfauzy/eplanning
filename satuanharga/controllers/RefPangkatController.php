<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefPangkat;
use common\models\search\RefPangkatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefPangkatController implements the CRUD actions for RefPangkat model.
 */
class RefPangkatController extends Controller
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
     * Lists all RefPangkat models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefPangkatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefPangkat model.
     * @param integer $Kd_Golongan
     * @param integer $Kd_Golongan_Ruang
     * @param integer $Kd_Pangkat
     * @return mixed
     */
    public function actionView($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefPangkat #".$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat'=>$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat),
            ]);
        }
    }

    /**
     * Creates a new RefPangkat model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefPangkat();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefPangkat",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefPangkat",
                    'content'=>'<span class="text-success">Create RefPangkat success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefPangkat",
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
                return $this->redirect(['view', 'Kd_Golongan' => $model->Kd_Golongan, 'Kd_Golongan_Ruang' => $model->Kd_Golongan_Ruang, 'Kd_Pangkat' => $model->Kd_Pangkat]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefPangkat model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Golongan
     * @param integer $Kd_Golongan_Ruang
     * @param integer $Kd_Pangkat
     * @return mixed
     */
    public function actionUpdate($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefPangkat #".$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefPangkat #".$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat'=>$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefPangkat #".$Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat,
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
                return $this->redirect(['view', 'Kd_Golongan' => $model->Kd_Golongan, 'Kd_Golongan_Ruang' => $model->Kd_Golongan_Ruang, 'Kd_Pangkat' => $model->Kd_Pangkat]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefPangkat model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Golongan
     * @param integer $Kd_Golongan_Ruang
     * @param integer $Kd_Pangkat
     * @return mixed
     */
    public function actionDelete($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat)->delete();

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
     * Delete multiple existing RefPangkat model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Golongan
     * @param integer $Kd_Golongan_Ruang
     * @param integer $Kd_Pangkat
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
     * Finds the RefPangkat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Golongan
     * @param integer $Kd_Golongan_Ruang
     * @param integer $Kd_Pangkat
     * @return RefPangkat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Golongan, $Kd_Golongan_Ruang, $Kd_Pangkat)
    {
        if (($model = RefPangkat::findOne(['Kd_Golongan' => $Kd_Golongan, 'Kd_Golongan_Ruang' => $Kd_Golongan_Ruang, 'Kd_Pangkat' => $Kd_Pangkat])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
