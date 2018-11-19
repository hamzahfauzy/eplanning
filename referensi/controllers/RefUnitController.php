<?php

namespace referensi\controllers;

use Yii;
use common\models\RefUnit;
use referensi\models\search\RefUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefBidang;
use common\models\RefUrusan;
use yii\helpers\ArrayHelper;

/**
 * RefUnitController implements the CRUD actions for RefUnit model.
 */
class RefUnitController extends Controller
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
     * Lists all RefUnit models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefUnit model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefUnit #".$Kd_Urusan, $Kd_Bidang, $Kd_Unit,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan, $Kd_Bidang, $Kd_Unit'=>$Kd_Urusan, $Kd_Bidang, $Kd_Unit],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit),
            ]);
        }
    }

    /**
     * Creates a new RefUnit model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefUnit(); 
        

        $dataUrusan = ArrayHelper::map(RefUrusan::find()
                ->all()
        , 'Kd_Urusan', 'Nm_Urusan');
            
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefUnit",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataUrusan'=>$dataUrusan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())) {

                $NASmax = RefUnit::find()->where(['Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang])
                    ->max('Kd_Unit');

                $Kd_Unit = $NASmax + 1;
                $model->Kd_Unit = $Kd_Unit;

             if ($model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefUnit",
                    'content'=>'<span class="text-success">Create RefUnit success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];  

             }       
            }else{           
                return [
                    'title'=> "Create new RefUnit",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataUrusan' => $dataUrusan,
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataUrusan' => $dataUrusan,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefUnit model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit);

         $dataUrusan = ArrayHelper::map(RefUrusan::find()
                ->all()
                , 'Kd_Urusan', 'Nm_Urusan');       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefUnit #".$Kd_Urusan, $Kd_Bidang, $Kd_Unit,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataUrusan' => $dataUrusan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefUnit #".$Kd_Urusan, $Kd_Bidang, $Kd_Unit,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataUrusan' =>$dataUrusan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan, $Kd_Bidang, $Kd_Unit'=>$Kd_Urusan, $Kd_Bidang, $Kd_Unit],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefUnit #".$Kd_Urusan, $Kd_Bidang, $Kd_Unit,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataUrusan' =>$dataUrusan,
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataUrusan' => $dataUrusan
                ]);
            }
        }
    }

    /**
     * Delete an existing RefUnit model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit)->delete();

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
     * Delete multiple existing RefUnit model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
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
     * Finds the RefUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return RefUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        if (($model = RefUnit::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
