<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefHspk;
use common\models\search\RefHspkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefHspk1;
use common\models\RefHspk2;
use common\models\RefHspk3;
use common\models\RefSsh1;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan;
use common\models\TaSshHspk;
use yii\web\Cookie;
use yii\helpers\Json;

/**
 * RefHspkController implements the CRUD actions for RefHspk model.
 */
class RefHspkController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all RefHspk models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RefHspkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefHspk model.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @param integer $Kd_Hspk4
     * @return mixed
     */
    public function actionView($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Kode HSPK #" . $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4),
                ]),
                // 'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                // Html::a('Edit', ['update', 'Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4' => $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])

            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4),
            ]);
        }
    }

    /**
     * Creates a new RefHspk model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->actionResetCookie();
        $request = Yii::$app->request;
        $model = new RefHspk();
        $modelanak = new TaSshHspk();
        $dataHspk = ArrayHelper::map(RefHspk1::find()
                                ->all()
                        , 'Kd_Hspk1', 'Nm_Hspk1');
        $dataHspk2 = []; 

        $dataHspk3 = []; 

        $harga = 0;

        $dataSatuan = ArrayHelper::map(RefStandardSatuan::find()
                ->all()
        , 'Kd_Satuan', 'Uraian');

        $dataSsh = ArrayHelper::map(RefSsh1::find()
                ->all()
        , 'Kd_Ssh1', 'Nm_Ssh1');

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tambah Kode HSPK",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                        'dataHspk2' => $dataHspk2,
                        'dataHspk3' => $dataHspk3,
                        'dataSatuan' => $dataSatuan,
                        'modelanak' => $modelanak,
                        'dataSsh' => $dataSsh,
                        'harga' => $harga,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->validate()) {

                try {

                    if($model->save()){

                        $Kd_Hspk1 = $model->Kd_Hspk1;
                        $Kd_Hspk2 = $model->Kd_Hspk2;
                        $Kd_Hspk3 = $model->Kd_Hspk3;
                        $Kd_Hspk4 = $model->Kd_Hspk4;

                        //$data = $this->dataUsulanPilih(); //mengambil data dari session
                        $data = $this->dataCookie('ssh_pilih');
                        foreach ($data as $key => $value) {
                            $modelSshHspk = new TaSshHspk();

                            $modelSshHspk->Kd_Hspk1 = $Kd_Hspk1;
                            $modelSshHspk->Kd_Hspk2 = $Kd_Hspk2;
                            $modelSshHspk->Kd_Hspk3 = $Kd_Hspk3;
                            $modelSshHspk->Kd_Hspk4 = $Kd_Hspk4;
                            $modelSshHspk->Kd_Ssh1 = $value['Kd_Ssh1'];
                            $modelSshHspk->Kd_Ssh2 = $value['Kd_Ssh2'];
                            $modelSshHspk->Kd_Ssh3 = $value['Kd_Ssh3'];
                            $modelSshHspk->Kd_Ssh4 = $value['Kd_Ssh4'];
                            $modelSshHspk->Kd_Ssh5 = $value['Kd_Ssh5'];
                            $modelSshHspk->Kd_Ssh6 = $value['Kd_Ssh6'];
                            $modelSshHspk->Kategori = $value['Kategori'];
                            $modelSshHspk->Koefisien = $value['Koefisien'];
                            $modelSshHspk->Kd_Satuan = $value['Kd_Satuan'];
                            $modelSshHspk->Harga_Satuan = $value['Harga_Satuan'];
                            $modelSshHspk->Harga = $value['Harga'];

                            $modelSshHspk->save();
                        }
                        $this->actionResetCookie();
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Tambah Kode HSPK 4",
                            'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 4</span>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                        /*
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Kode HSPK",
                            'content' => '<span class="text-success">Berhasil Tambah Kode HSPK</span>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                        */
                    }
                    
                } catch (\Exception $e) {
                    
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kode HSPK 4",
                        'content'=>'<span class="text-success">Berhasil Tambah Kode HSPK 4</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];

                }

            
            } else {
                return [
                    'title' => "Tambah Kode HSPK",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'dataHspk' => $dataHspk,
                        'dataHspk2' => $dataHspk2,
                        'dataHspk3' => $dataHspk3,
                        'dataSatuan' => $dataSatuan,
                        'modelanak' => $modelanak,
                        'dataSsh' => $dataSsh,
                        'harga' => $harga,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post())) {
                if ($model->save()) {
                    $Kd_Hspk1 = $model->Kd_Hspk1;
                    $Kd_Hspk2 = $model->Kd_Hspk2;
                    $Kd_Hspk3 = $model->Kd_Hspk3;
                    $Kd_Hspk4 = $model->Kd_Hspk4;

                    //$data = $this->dataUsulanPilih(); //mengambil data dari session
                    $data = $this->dataCookie('ssh_pilih');
                    foreach ($data as $key => $value) {
                        $modelSshHspk = new TaSshHspk();

                        $modelSshHspk->Kd_Hspk1 = $Kd_Hspk1;
                        $modelSshHspk->Kd_Hspk2 = $Kd_Hspk2;
                        $modelSshHspk->Kd_Hspk3 = $Kd_Hspk3;
                        $modelSshHspk->Kd_Hspk4 = $Kd_Hspk4;
                        $modelSshHspk->Kd_Ssh1 = $value['Kd_Ssh1'];
                        $modelSshHspk->Kd_Ssh2 = $value['Kd_Ssh2'];
                        $modelSshHspk->Kd_Ssh3 = $value['Kd_Ssh3'];
                        $modelSshHspk->Kd_Ssh4 = $value['Kd_Ssh4'];
                        $modelSshHspk->Kd_Ssh5 = $value['Kd_Ssh5'];
                        $modelSshHspk->Kd_Ssh6 = $value['Kd_Ssh6'];
                        $modelSshHspk->Kategori = $value['Kategori'];
                        $modelSshHspk->Koefisien = $value['Koefisien'];
                        $modelSshHspk->Kd_Satuan = $value['Kd_Satuan'];
                        $modelSshHspk->Harga_Satuan = $value['Harga_Satuan'];
                        $modelSshHspk->Harga = $value['Harga'];

                        $modelSshHspk->save();
                    }
                }
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2, 'Kd_Hspk3' => $model->Kd_Hspk3, 'Kd_Hspk4' => $model->Kd_Hspk4]);
            } else {
                return $this->render('create', [

                    'model' => $model,
                    'dataHspk' => $dataHspk,
                    'dataHspk2' => $dataHspk2,
                    'dataHspk3' => $dataHspk3,
                    'dataSatuan' => $dataSatuan,
                    'modelanak' => $modelanak,
                    'dataSsh' => $dataSsh,
                    'harga' => $harga,
                ]);
            }
        }
    }

    /**
     * Updates an existing RefHspk model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @param integer $Kd_Hspk4
     * @return mixed
     */
    public function actionUpdate($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4) {
        //menghapus data cookie
        $this->actionResetCookie();

        //memlihat metode penarikan data
        $request = Yii::$app->request;

        //mencari data model
        $model = $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4);

        //$model->Kd_Hspk2 = $model->kdHspk1

        $modelanak = new TaSshHspk();

        $dataHspk = ArrayHelper::map(RefHspk1::find()
                                ->all()
                        , 'Kd_Hspk1', 'Nm_Hspk1'); 

        $dataHspk2 = ArrayHelper::map(RefHspk2::find()
                                ->all()
                        , 'Kd_Hspk2', 'Nm_Hspk2'); 

        $dataHspk3 = ArrayHelper::map(RefHspk3::find()
                                ->where(['Kd_Hspk1' => $Kd_Hspk1])
                                ->andwhere(['Kd_Hspk2' => $Kd_Hspk2])
                                ->all()
                        , 'Kd_Hspk3', 'Nm_Hspk3'); 

        $harga = $model->Harga;

        $dataSatuan = ArrayHelper::map(RefStandardSatuan::find()
                ->all()
        , 'Kd_Satuan', 'Uraian');

        $dataSsh = ArrayHelper::map(RefSsh1::find()
                ->all()
        , 'Kd_Ssh1', 'Nm_Ssh1');

        //mengambil data sshHspk
        //pengambilan detail hspk
        $data=[];
        $dataSshHspk = $model->getTaSshHspks()->all();
        foreach ($dataSshHspk as $value) {
            $key = $value->Kd_Ssh1;
            $key .= $value->Kd_Ssh2;
            $key .= $value->Kd_Ssh3;
            $key .= $value->Kd_Ssh4;
            $key .= $value->Kd_Ssh5;
            $key .= $value->Kd_Ssh6;

            $Kd_Ssh1 = $value->Kd_Ssh1;
            $Kd_Ssh2 = $value->Kd_Ssh2;
            $Kd_Ssh3 = $value->Kd_Ssh3;
            $Kd_Ssh4 = $value->Kd_Ssh4;
            $Kd_Ssh5 = $value->Kd_Ssh5;
            $Kd_Ssh6 = $value->Kd_Ssh6;

            $Harga_Satuan = $value->Harga_Satuan;
            $Kd_Satuan = $value->Kd_Satuan;
            $Koefisien = $value->Koefisien;
            $Harga = $value->Harga;
            $Kategori = $value->Kategori;
            $Uraian_ssh = $value->kdSsh1->Nama_Barang;
            $Satuan_ssh = $value->kdSsh1->kdSatuan->Uraian;

            $data[$key]['Kd_Ssh1'] = $Kd_Ssh1;
            $data[$key]['Kd_Ssh2'] = $Kd_Ssh2;
            $data[$key]['Kd_Ssh3'] = $Kd_Ssh3;
            $data[$key]['Kd_Ssh4'] = $Kd_Ssh4;
            $data[$key]['Kd_Ssh5'] = $Kd_Ssh5;
            $data[$key]['Kd_Ssh6'] = $Kd_Ssh6;
            $data[$key]['Harga_Satuan'] = $Harga_Satuan;
            $data[$key]['Kd_Satuan'] = $Kd_Satuan;
            $data[$key]['Koefisien'] = $Koefisien;
            $data[$key]['Harga'] = $Harga;
            $data[$key]['Kategori'] = $Kategori;
            $data[$key]['Uraian_ssh'] = $Uraian_ssh;
            $data[$key]['Satuan_ssh'] = $Satuan_ssh;

        }  
        $this->isiCookie($data, 'ssh_pilih');

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */

            try {
                
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($request->isGet) {
                    return [
                        'title' => "Perbarui Kode HSPK #" . $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                            'dataHspk' => $dataHspk,
                            'dataHspk2' => $dataHspk2,
                            'dataHspk3' => $dataHspk3,
                            'dataSatuan' => $dataSatuan,
                            'modelanak' => $modelanak,
                            'dataSsh' => $dataSsh,
                            'harga' => $harga,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                } else if ($model->load($request->post()) && $model->save()) {
                    $Kd_Hspk1 = $model->Kd_Hspk1;
                    $Kd_Hspk2 = $model->Kd_Hspk2;
                    $Kd_Hspk3 = $model->Kd_Hspk3;
                    $Kd_Hspk4 = $model->Kd_Hspk4;

                    $models = TaSshHspk::find()->where(['Kd_Hspk1' => $Kd_Hspk1, 'Kd_Hspk2' => $Kd_Hspk2, 'Kd_Hspk3' => $Kd_Hspk3, 'Kd_Hspk4' => $Kd_Hspk4])->all();
                    foreach($models as $modeli) {
                        $modeli->delete();
                    }
                    //$data = $this->dataUsulanPilih(); //mengambil data dari session
                    $data = $this->dataCookie('ssh_pilih');
                    foreach ($data as $key => $value) {
                        $modelSshHspk = new TaSshHspk();

                        $modelSshHspk->Kd_Hspk1 = $Kd_Hspk1;
                        $modelSshHspk->Kd_Hspk2 = $Kd_Hspk2;
                        $modelSshHspk->Kd_Hspk3 = $Kd_Hspk3;
                        $modelSshHspk->Kd_Hspk4 = $Kd_Hspk4;
                        $modelSshHspk->Kd_Ssh1 = $value['Kd_Ssh1'];
                        $modelSshHspk->Kd_Ssh2 = $value['Kd_Ssh2'];
                        $modelSshHspk->Kd_Ssh3 = $value['Kd_Ssh3'];
                        $modelSshHspk->Kd_Ssh4 = $value['Kd_Ssh4'];
                        $modelSshHspk->Kd_Ssh5 = $value['Kd_Ssh5'];
                        $modelSshHspk->Kd_Ssh6 = $value['Kd_Ssh6'];
                        $modelSshHspk->Kategori = $value['Kategori'];
                        $modelSshHspk->Koefisien = $value['Koefisien'];
                        $modelSshHspk->Kd_Satuan = $value['Kd_Satuan'];
                        $modelSshHspk->Harga_Satuan = $value['Harga_Satuan'];
                        $modelSshHspk->Harga = $value['Harga'];

                        $modelSshHspk->save();
                    }
                    $this->actionResetCookie();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Kode HSPK 4 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4'=>$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                    /*
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Kode HSPK #" . $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                            'dataHspk' => $dataHspk,
                            'dataHspk2' => $dataHspk2,
                            'dataHspk3' => $dataHspk3,
                            'dataSatuan' => $dataSatuan,
                            'modelanak' => $modelanak,
                            'dataSsh' => $dataSsh,
                            'harga' => $harga,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4' => $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                    */
                } else {
                    return [
                        'title' => "Perbarui Kode HSPK #" . $Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                            'dataHspk' => $dataHspk,
                            'dataHspk2' => $dataHspk2,
                            'dataHspk3' => $dataHspk3,
                            'dataSatuan' => $dataSatuan,
                            'modelanak' => $modelanak,
                            'dataSsh' => $dataSsh,
                            'harga' => $harga,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }

            } catch (\Exception $e) {
                
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode HSPK 4 #".$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4'=>$Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];

            }


        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                $Kd_Hspk1 = $model->Kd_Hspk1;
                $Kd_Hspk2 = $model->Kd_Hspk2;
                $Kd_Hspk3 = $model->Kd_Hspk3;
                $Kd_Hspk4 = $model->Kd_Hspk4;

                $models = TaSshHspk::find()->where(['Kd_Hspk1' => $Kd_Hspk1, 'Kd_Hspk2' => $Kd_Hspk2, 'Kd_Hspk3' => $Kd_Hspk3, 'Kd_Hspk4' => $Kd_Hspk4])->all();
                foreach($models as $modeli) {
                    $modeli->delete();
                }

                //$data = $this->dataUsulanPilih(); //mengambil data dari session
                $data = $this->dataCookie('ssh_pilih');
                foreach ($data as $key => $value) {
                    $modelSshHspk = new TaSshHspk();

                    $modelSshHspk->Kd_Hspk1 = $Kd_Hspk1;
                    $modelSshHspk->Kd_Hspk2 = $Kd_Hspk2;
                    $modelSshHspk->Kd_Hspk3 = $Kd_Hspk3;
                    $modelSshHspk->Kd_Hspk4 = $Kd_Hspk4;
                    $modelSshHspk->Kd_Ssh1 = $value['Kd_Ssh1'];
                    $modelSshHspk->Kd_Ssh2 = $value['Kd_Ssh2'];
                    $modelSshHspk->Kd_Ssh3 = $value['Kd_Ssh3'];
                    $modelSshHspk->Kd_Ssh4 = $value['Kd_Ssh4'];
                    $modelSshHspk->Kd_Ssh5 = $value['Kd_Ssh5'];
                    $modelSshHspk->Kd_Ssh6 = $value['Kd_Ssh6'];
                    $modelSshHspk->Kategori = $value['Kategori'];
                    $modelSshHspk->Koefisien = $value['Koefisien'];
                    $modelSshHspk->Kd_Satuan = $value['Kd_Satuan'];
                    $modelSshHspk->Harga_Satuan = $value['Harga_Satuan'];
                    $modelSshHspk->Harga = $value['Harga'];

                    $modelSshHspk->save();
                }
                $this->actionResetCookie();
                return $this->redirect(['view', 'Kd_Hspk1' => $model->Kd_Hspk1, 'Kd_Hspk2' => $model->Kd_Hspk2, 'Kd_Hspk3' => $model->Kd_Hspk3, 'Kd_Hspk4' => $model->Kd_Hspk4]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'dataHspk' => $dataHspk,
                            'dataHspk2' => $dataHspk2,
                            'dataHspk3' => $dataHspk3,
                            'dataSatuan' => $dataSatuan,
                            'modelanak' => $modelanak,
                            'dataSsh' => $dataSsh,
                            'harga' => $harga,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefHspk model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @param integer $Kd_Hspk4
     * @return mixed
     */
    public function actionDelete($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4) {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;

            try {
                $this->findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4)->delete();
                return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
            } catch (\Exception $e) {
                return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing RefHspk model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @param integer $Kd_Hspk4
     * @return mixed
     */
    public function actionBulkDelete() {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    public function actionGetNomor($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kode1='', $Kode2='') {
        $max_hspk = RefHspk::find()
                ->where(['Kd_Hspk1' => $Kd_Hspk1,
                    'Kd_Hspk2' => $Kd_Hspk2,
                    'Kd_Hspk3' => $Kd_Hspk3,
                ])
                ->max('Kd_Hspk4');
        $Kd_Hspk4 = $max_hspk + 1;
        echo ($Kode1 != $Kd_Hspk1.$Kd_Hspk2.$Kd_Hspk3) ? $Kd_Hspk4 : $Kode2;
    }

    /**
     * Finds the RefHspk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Hspk1
     * @param integer $Kd_Hspk2
     * @param integer $Kd_Hspk3
     * @param integer $Kd_Hspk4
     * @return RefHspk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4) {
        if (($model = RefHspk::findOne(['Kd_Hspk1' => $Kd_Hspk1, 'Kd_Hspk2' => $Kd_Hspk2, 'Kd_Hspk3' => $Kd_Hspk3, 'Kd_Hspk4' => $Kd_Hspk4])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetCookie() {
        $request = Yii::$app->request;
        $TaSshHspk = $request->post('TaSshHspk');
        $Kd_Ssh1 = $TaSshHspk['Kd_Ssh1'];
        $Kd_Ssh2 = $TaSshHspk['Kd_Ssh2'];
        $Kd_Ssh3 = $TaSshHspk['Kd_Ssh3'];
        $Kd_Ssh4 = $TaSshHspk['Kd_Ssh4'];
        $Kd_Ssh5 = $TaSshHspk['Kd_Ssh5'];
        $Kd_Ssh6 = $TaSshHspk['Kd_Ssh6'];
        $Harga_Satuan = $TaSshHspk['Harga_Satuan'];
        $Kd_Satuan = $TaSshHspk['Kd_Satuan'];
        $Koefisien = $TaSshHspk['Koefisien'];
        $Harga = $TaSshHspk['Harga'];
        $Kategori = $request->post('kategori');
        $Uraian_ssh = $request->post('uraian_ssh');
        $Satuan_ssh = $request->post('satuan_ssh');

        $key =$Kd_Ssh1.$Kd_Ssh2.$Kd_Ssh3.$Kd_Ssh4.$Kd_Ssh5.$Kd_Ssh6;

        $data = $this->dataCookie('ssh_pilih');

        $data[$key]['Kd_Ssh1'] = $Kd_Ssh1;
        $data[$key]['Kd_Ssh2'] = $Kd_Ssh2;
        $data[$key]['Kd_Ssh3'] = $Kd_Ssh3;
        $data[$key]['Kd_Ssh4'] = $Kd_Ssh4;
        $data[$key]['Kd_Ssh5'] = $Kd_Ssh5;
        $data[$key]['Kd_Ssh6'] = $Kd_Ssh6;
        $data[$key]['Harga_Satuan'] = $Harga_Satuan;
        $data[$key]['Kd_Satuan'] = $Kd_Satuan;
        $data[$key]['Koefisien'] = $Koefisien;
        $data[$key]['Harga'] = $Harga;
        $data[$key]['Kategori'] = $Kategori;
        $data[$key]['Uraian_ssh'] = $Uraian_ssh;
        $data[$key]['Satuan_ssh'] = $Satuan_ssh;

        $this->isiCookie($data, 'ssh_pilih');

        echo "Berhasil";
    }

    public function isiCookie($data, $nama) {
        $isi = Json::encode($data); //mengubah data array ke jason

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => $nama,
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));
    }

    public function dataCookie($nama) {
        $cookies = Yii::$app->request->cookies;
        $isi = $cookies[$nama];
        $data = Json::decode($isi);

        return $data;
    }

    public function actionGetCookie() {
        $data = $this->dataCookie('ssh_pilih');

        return $this->renderpartial('get_cookie_ssh', [
                    'data' => $data,
        ]);
    }

    public function actionResetCookie() {
        $data = $this->dataCookie('ssh_pilih');
        $data=[];
        $this->isiCookie($data, 'ssh_pilih');
    }

    public function actionDelCookie($key) {
        $data = $this->dataCookie('ssh_pilih');
        unset($data[$key]);
        $this->isiCookie($data, 'ssh_pilih');
    }
}
