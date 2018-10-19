<?php

namespace referensi\controllers;

use Yii;
use common\models\RefAnalisaSubA;
use referensi\models\search\RefAnalisaSubASearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RefAnalisa;

/**
 * RefAnalisaSubAController implements the CRUD actions for RefAnalisaSubA model.
 */
class RefAnalisaSubAController extends Controller
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
     * Lists all RefAnalisaSubA models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefAnalisaSubASearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefAnalisaSubA model.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @param integer $Kd_Analisa_Sub_A
     * @return mixed
     */
    public function actionView($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefAnalisaSubA #".$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A'=>$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A),
            ]);
        }
    }

    /**
     * Creates a new RefAnalisaSubA model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefAnalisaSubA(); 


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
                    'title'=> "Create new RefAnalisaSubA",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAnalisa' => $dataAnalisa,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){ 

                $max = RefAnalisaSubA::find()->where(['Kd_Analisa_Sub_A' => $model->Kd_Analisa_Sub_A])->max('Kd_Analisa_Sub_A');
                $model->Kd_Analisa_Sub_A = $max + 1;

                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefAnalisaSubA",
                    'content'=>'<span class="text-success">Create RefAnalisaSubA success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new RefAnalisaSubA",
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

              $max = RefAnalisaSubA::find()->where(['Kd_Analisa_Sub_A' => $model->Kd_Analisa_Sub_A])->max('Kd_Analisa_Sub_A');
                $model->Kd_Analisa_Sub_A = $max + 1;

             $model->save();
                return $this->redirect(['view', 'Kd_Analisa' => $model->Kd_Analisa, 'Kd_Analisa_Sub' => $model->Kd_Analisa_Sub, 'Kd_Analisa_Sub_A' => $model->Kd_Analisa_Sub_A]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataAnalisa' => $dataAnalisa,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefAnalisaSubA model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @param integer $Kd_Analisa_Sub_A
     * @return mixed
     */
    public function actionUpdate($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A);

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
                    'title'=> "Update RefAnalisaSubA #".$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A,
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
                    'title'=> "RefAnalisaSubA #".$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                         'dataAnalisa' => $dataAnalisa,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A'=>$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefAnalisaSubA #".$Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A,
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
                return $this->redirect(['view', 'Kd_Analisa' => $model->Kd_Analisa, 'Kd_Analisa_Sub' => $model->Kd_Analisa_Sub, 'Kd_Analisa_Sub_A' => $model->Kd_Analisa_Sub_A]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefAnalisaSubA model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @param integer $Kd_Analisa_Sub_A
     * @return mixed
     */
    public function actionDelete($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A)->delete();

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
     * Delete multiple existing RefAnalisaSubA model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @param integer $Kd_Analisa_Sub_A
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
     * Finds the RefAnalisaSubA model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Analisa
     * @param integer $Kd_Analisa_Sub
     * @param integer $Kd_Analisa_Sub_A
     * @return RefAnalisaSubA the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Analisa, $Kd_Analisa_Sub, $Kd_Analisa_Sub_A)
    {
        if (($model = RefAnalisaSubA::findOne(['Kd_Analisa' => $Kd_Analisa, 'Kd_Analisa_Sub' => $Kd_Analisa_Sub, 'Kd_Analisa_Sub_A' => $Kd_Analisa_Sub_A])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
