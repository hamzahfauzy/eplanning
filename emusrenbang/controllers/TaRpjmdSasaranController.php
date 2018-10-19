<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaRpjmdSasaran;
use common\models\TaRpjmdTujuan;
use common\models\search\TaRpjmdSasaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\TaRpjmdMisi;

/**
 * TaRpjmdSasaranController implements the CRUD actions for TaRpjmdSasaran model.
 */
class TaRpjmdSasaranController extends Controller
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
     * Lists all TaRpjmdSasaran models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaRpjmdSasaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaRpjmdSasaran model.
     * @param string $Tahun
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionView($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran),
            ]);
        }
    }

    /**
     * Creates a new TaRpjmdSasaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaRpjmdSasaran(); 

        $dataMisi = ArrayHelper::map(TaRpjmdMisi::find()
                ->all()
        ,'No_Misi', 'Misi'); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())) {
                $model->Tahun = date('Y');

                if ($model->save()) {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Sasaran Pemerintah Daerah",
                        'content'=>'<span class="text-success">Tambah Sasaran Pemerintah Daerah berhasil</span>',
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Tambah lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];  
                }       
            }else{           
                return [
                    'title'=> "Tambah Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataMisi' => $dataMisi,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaRpjmdSasaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionUpdate($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran); 

        $dataMisi = ArrayHelper::map(TaRpjmdMisi::find()
                ->all()
        ,'No_Misi', 'Misi');  

        $dataTujuan = ArrayHelper::map(TaRpjmdTujuan::find()
                ->all()
        ,'No_Tujuan', 'Tujuan');     
      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit Sasaran Pemerintah Daerah",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataMisi' => $dataMisi,
                        'dataTujuan' => $dataTujuan,
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataMisi' => $dataMisi,
                    'dataTujuan' => $dataTujuan,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaRpjmdSasaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionDelete($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran)->delete();

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
     * Delete multiple existing TaRpjmdSasaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
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
     * Finds the TaRpjmdSasaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return TaRpjmdSasaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        if (($model = TaRpjmdSasaran::findOne(['Tahun' => $Tahun, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
