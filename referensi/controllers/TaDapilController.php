<?php

namespace referensi\controllers;

use Yii;
use eperencanaan\models\TaDapil;
use common\models\RefDapil;
use common\models\RefProvinsi;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use referensi\models\search\TaDapilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * TaDapilController implements the CRUD actions for TaDapil model.
 */
class TaDapilController extends Controller
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
     * Lists all TaDapil models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaDapilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TaDapil model.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Daerah Pemilihan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec),
            ]);
        }
    }

    /**
     * Creates a new TaDapil model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataDapil = ArrayHelper::map(RefDapil::find()->all(), 'Kd_Dapil', 'Nm_Dapil');
        $dataProvinsi = ArrayHelper::map(RefProvinsi::find()->all(), 'Kd_Prov', 'Nm_Prov');
        $request = Yii::$app->request;
        $model = new TaDapil();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Daerah Pemilihan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                        'dataProvinsi' => $dataProvinsi,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $model->Tahun = date('Y');
                if ($model->save())
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Daerah Pemilihan",
                        'content'=>'<span class="text-success">Tambah Daerah Pemilihan berhasil</span>',
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];         
            }else{           
                return [
                    'title'=> "Tamabh Daerah Pemilihan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                        'dataProvinsi' => $dataProvinsi,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $model->Tahun = date('Y');
                if ($model->save())
                    return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Dapil' => $model->Kd_Dapil, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                    'dataProvinsi' => $dataProvinsi,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaDapil model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $dataDapil = ArrayHelper::map(RefDapil::find()->all(), 'Kd_Dapil', 'Nm_Dapil');
        $dataProvinsi = ArrayHelper::map(RefProvinsi::find()->all(), 'Kd_Prov', 'Nm_Prov');
        $dataKabupaten = ArrayHelper::map(RefKabupaten::findAll(['Kd_Prov' => $Kd_Prov]), 'Kd_Kab', 'Nm_Kab');
        $dataKecamatan = ArrayHelper::map(RefKecamatan::findAll(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab]), 'Kd_Kec', 'Nm_Kec');
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Daerah Pemilihan",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                        'dataProvinsi' => $dataProvinsi,
                        'dataKabupaten' => $dataKabupaten,
                        'dataKecamatan' => $dataKecamatan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Daerah Pemilihan",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                        'dataProvinsi' => $dataProvinsi,
                        'dataKabupaten' => $dataKabupaten,
                        'dataKecamatan' => $dataKecamatan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit Daerah Pemilihan",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataDapil' => $dataDapil,
                        'dataProvinsi' => $dataProvinsi,
                        'dataKabupaten' => $dataKabupaten,
                        'dataKecamatan' => $dataKecamatan,
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
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Dapil' => $model->Kd_Dapil, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataDapil' => $dataDapil,
                    'dataProvinsi' => $dataProvinsi,
                    'dataKabupaten' => $dataKabupaten,
                    'dataKecamatan' => $dataKecamatan,
                ]);
            }
        }
    }

    /**
     * Delete an existing TaDapil model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec)->delete();

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
     * Delete multiple existing TaDapil model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
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
     * Finds the TaDapil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Dapil
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return TaDapil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Dapil, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        if (($model = TaDapil::findOne(['Tahun' => $Tahun, 'Kd_Dapil' => $Kd_Dapil, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetKab($Kd_Prov) {
        $data = RefKabupaten::find()->where([
            'Kd_Prov' => $Kd_Prov,
            ])->all();
        echo "<option value=''>Pilih Kabupaten/Kota</option>";
        foreach ($data as $key => $value) {
            echo "<option value='".$value->Kd_Kab."'>".$value->Nm_Kab."</option>";
        }
    }

    public function actionGetKec($Kd_Prov, $Kd_Kab) {
        $data = RefKecamatan::find()->where([
            'Kd_Prov' => $Kd_Prov,
            'Kd_Kab' => $Kd_Kab,
            ])->all();
        echo "<option value=''>Pilih Kecamatan</option>";
        foreach ($data as $key => $value) {
            echo "<option value='".$value->Kd_Kec."'>".$value->Nm_Kec."</option>";
        }
    }
}
