<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefProvinsi;
use common\models\search\RefProvinsiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RefProvinsiController implements the CRUD actions for RefProvinsi model.
 */
class RefProvinsiController extends Controller
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
     * Lists all RefProvinsi models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefProvinsiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefProvinsi model.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @return mixed
     */
    public function actionView($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefProvinsi #".$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov'=>$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov),
            ]);
        }
    }

    /**
     * Creates a new RefProvinsi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefProvinsi();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefProvinsi",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefProvinsi",
                    'content'=>'<span class="text-success">Create RefProvinsi success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefProvinsi",
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
                return $this->redirect(['view', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefProvinsi model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @return mixed
     */
    public function actionUpdate($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefProvinsi #".$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefProvinsi #".$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov'=>$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefProvinsi #".$Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov,
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
                return $this->redirect(['view', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefProvinsi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @return mixed
     */
    public function actionDelete($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov)->delete();

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
     * Delete multiple existing RefProvinsi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
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
     * Finds the RefProvinsi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @return RefProvinsi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov)
    {
        if (($model = RefProvinsi::findOne(['Kd_Benua' => $Kd_Benua, 'Kd_Benua_Sub' => $Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $Kd_Benua_Sub_Negara, 'Kd_Prov' => $Kd_Prov])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
