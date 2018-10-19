<?php

namespace referensi\controllers;

use Yii;
use common\models\RefAnalisaSub;
use referensi\models\search\RefAnalisaSubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefAnalisa;
use yii\helpers\ArrayHelper;

/**
 * RefAnalisaSubController implements the CRUD actions for RefAnalisaSub model.
 */
class RefAnalisaSubController extends Controller
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
     * Lists all RefAnalisaSub models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefAnalisaSubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefAnalisaSub model.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @return mixed
     */
    public function actionView($Kd_Analisa, $Kd_Analisa_Sub)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefAnalisaSub #".$Kd_Analisa, $Kd_Analisa_Sub,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Analisa, $Kd_Analisa_Sub),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Analisa, $Kd_Analisa_Sub'=>$Kd_Analisa, $Kd_Analisa_Sub],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Analisa, $Kd_Analisa_Sub),
            ]);
        }
    }

    /**
     * Creates a new RefAnalisaSub model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefAnalisaSub();

         $dataAnalisa = ArrayHelper::map(RefAnalisa::find()
                ->all()
        , 'Kd_Analisa', 'Nm_Analisa');


        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new RefAnalisaSub",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())) {

            $max = RefAnalisaSub::find()->where(['Kd_Analisa_Sub' => $model->Kd_Analisa_Sub])->max('Kd_Analisa_Sub');
                $model->Kd_Analisa_Sub = $max + 1;

            $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefAnalisaSub",
                    'content'=>'<span class="text-success">Create RefAnalisaSub success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefAnalisaSub",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
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


            $max = RefAnalisaSub::find()->where(['Kd_Analisa_Sub' => $model->Kd_Analisa_Sub])->max('Kd_Analisa_Sub');
                $model->Kd_Analisa_Sub = $max + 1;

             $model->save();
                return $this->redirect(['view', 'Kd_Analisa' => $model->Kd_Analisa, 'Kd_Analisa_Sub' => $model->Kd_Analisa_Sub]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataAnalisa' => $dataAnalisa,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefAnalisaSub model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @return mixed
     */
    public function actionUpdate($Kd_Analisa, $Kd_Analisa_Sub)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Analisa, $Kd_Analisa_Sub);


         $dataAnalisa = ArrayHelper::map(RefAnalisa::find()
                ->all()
        , 'Kd_Analisa', 'Nm_Analisa');       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefAnalisaSub #".$Kd_Analisa, $Kd_Analisa_Sub,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefAnalisaSub #".$Kd_Analisa, $Kd_Analisa_Sub,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Analisa, $Kd_Analisa_Sub'=>$Kd_Analisa, $Kd_Analisa_Sub],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefAnalisaSub #".$Kd_Analisa, $Kd_Analisa_Sub,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
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
                return $this->redirect(['view', 'Kd_Analisa' => $model->Kd_Analisa, 'Kd_Analisa_Sub' => $model->Kd_Analisa_Sub]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataAnalisa' => $dataAnalisa,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefAnalisaSub model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @return mixed
     */
    public function actionDelete($Kd_Analisa, $Kd_Analisa_Sub)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Analisa, $Kd_Analisa_Sub)->delete();

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
     * Delete multiple existing RefAnalisaSub model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
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
     * Finds the RefAnalisaSub model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @return RefAnalisaSub the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Analisa, $Kd_Analisa_Sub)
    {
        if (($model = RefAnalisaSub::findOne(['Kd_Analisa' => $Kd_Analisa, 'Kd_Analisa_Sub' => $Kd_Analisa_Sub])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
