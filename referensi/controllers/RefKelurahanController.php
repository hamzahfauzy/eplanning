<?php

namespace referensi\controllers;

use Yii;
use common\models\RefKelurahan;
use common\models\search\RefKelurahanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;

//include
use common\models\RefKecamatan;


/**
 * RefKelurahanController implements the CRUD actions for RefKelurahan model.
 */
class RefKelurahanController extends Controller
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
     * Lists all RefKelurahan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefKelurahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefKelurahan model.
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut
     * @return mixed
     */
    public function actionView($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Keterangan Kelurahan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut'=>$Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut),
            ]);
        }
    }

    /**
     * Creates a new RefKelurahan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefKelurahan();  

        $model->Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $model->Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
        $dataKec=ArrayHelper::map(RefKecamatan::find()
                                    ->where(['Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab])
                                    ->all()
                                    ,'Kd_Kec','Nm_Kec');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Desa/Kelurahan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataKec' => $dataKec,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                // $Kd_Kelurahan_Data = RefKelurahan::find()
                // ->where(['Kd_Prov' => $model->Kd_Prov, 
                //             'Kd_Kab' => $model->Kd_Kab, 
                //             'Kd_Kec' => $model->Kd_Kec])
                // ->max('Kd_Urut');
                // //->count(); 

                // $Kd_Urut = $Kd_Kelurahan_Data+1;
                // $model->Kd_Urut = $Kd_Urut;
                if($model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kelurahan",
                        'content'=>'<span class="text-success">Tambah Kelurahan Berhasil</span>',
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])//.
                                //Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ]; 
                }
                        
            }else{           
                return [
                    'title'=> "Tambah Kelurahan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataKec' => $dataKec,
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
                return $this->redirect(['view', 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut' => $model->Kd_Urut]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataKec' => $dataKec,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing RefKelurahan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut
     * @return mixed
     */
    public function actionUpdate($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut);       

        $dataKec=ArrayHelper::map(RefKecamatan::find()
                                    ->where(['Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab])
                                    ->all()
                                    ,'Kd_Kec','Nm_Kec');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Kelurahan",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataKec' => $dataKec,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Keterangan Kelurahan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataKec' => $dataKec,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut'=>$Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah Kelurahan",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataKec' => $dataKec,
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
                return $this->redirect(['view', 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut' => $model->Kd_Urut]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataKec' => $dataKec,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefKelurahan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut
     * @return mixed
     */
    public function actionDelete($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut)->delete();

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
     * Delete multiple existing RefKelurahan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut
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
     * Finds the RefKelurahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut
     * @return RefKelurahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut)
    {
        if (($model = RefKelurahan::findOne(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut' => $Kd_Urut])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
