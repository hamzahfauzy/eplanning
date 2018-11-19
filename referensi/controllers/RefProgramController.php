<?php

namespace referensi\controllers;

use Yii;
use common\models\RefProgram;
use referensi\models\search\RefProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefUrusan;
use yii\helpers\ArrayHelper;

/**
 * RefProgramController implements the CRUD actions for RefProgram model.
 */
class RefProgramController extends Controller
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
     * Lists all RefProgram models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefProgram model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefProgram #".$Kd_Urusan, $Kd_Bidang, $Kd_Prog,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan, $Kd_Bidang, $Kd_Prog'=>$Kd_Urusan, $Kd_Bidang, $Kd_Prog],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog),
            ]);
        }
    }

    /**
     * Creates a new RefProgram model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefProgram();
        
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
                    'title'=> "Create new RefProgram",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataUrusan' => $dataUrusan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new RefProgram",
                    'content'=>'<span class="text-success">Create RefProgram success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];
                      
            }else{           
                return [
                    'title'=> "Create new RefProgram",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataUrusan'=> $dataUrusan,
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataUrusan'=> $dataUrusan,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefProgram model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog);

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
                    'title'=> "Update RefProgram #".$Kd_Urusan, $Kd_Bidang, $Kd_Prog,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                          'dataUrusan'=> $dataUrusan,

                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefProgram #".$Kd_Urusan, $Kd_Bidang, $Kd_Prog,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                          'dataUrusan'=> $dataUrusan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Urusan, $Kd_Bidang, $Kd_Prog'=>$Kd_Urusan, $Kd_Bidang, $Kd_Prog],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update RefProgram #".$Kd_Urusan, $Kd_Bidang, $Kd_Prog,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                          'dataUrusan'=> $dataUrusan,
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
                return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                      'dataUrusan'=> $dataUrusan,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefProgram model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog)->delete();

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
     * Delete multiple existing RefProgram model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
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
     * Finds the RefProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return RefProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        if (($model = RefProgram::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
