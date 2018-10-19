<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefAsb;
use common\models\search\RefAsbSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefAsb1;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan;
use common\models\RefSsh1;
use common\models\RefHspk1;
use common\models\TaHspkAsb;
use common\models\RefKategoriPekerjaanAsb;
use yii\helpers\Json;
use yii\web\Cookie;
use common\models\RefAsb2;
use common\models\RefAsb3;
use common\models\RefAsb4;
/**
 * RefAsbController implements the CRUD actions for RefAsb model.
 */
class RefAsbController extends Controller
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
     * Lists all RefAsb models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefAsbSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefAsb model.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @param integer $Kd_Asb5
     * @return mixed
     */
    public function actionView($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode ASB #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2, 'Kd_Asb3' => $Kd_Asb3, 'Kd_Asb4' => $Kd_Asb4, 'Kd_Asb5' => $Kd_Asb5],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5),
            ]);
        }
    }

    /**
     * Creates a new RefAsb model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefAsb();

        $dataAsb = ArrayHelper::map(RefAsb1::find()->all(), 'Kd_Asb1', 'Nm_Asb1');
        $Data_Asb2 = [];
        $Data_Asb3 = [];
        $Data_Asb4 = [];
        $Kd_Satuan = ArrayHelper::map(RefStandardSatuan::find()->all(), 'Kd_Satuan', 'Uraian');

        $dataSsh = ArrayHelper::map(RefSsh1::find()->all(), 'Kd_Ssh1', 'Nm_Ssh1');
        $Kategori_Pekerjaan = ArrayHelper::map(RefKategoriPekerjaanAsb::find()->all(), 'Kd_Pekerjaan', 'Uraian');
        
        //$model2 = new \yii\base\DynamicModel(compact('Kategori_Pekerjaan', 'Asal'));
        $model2 = new \yii\base\DynamicModel([
          'Kategori_Pekerjaan', 
          'Asal'
        ]);
        //$model2->addRule(['Kategori_Pekerjaan','Asal'], 'required');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode ASB",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
            else if($model->load($request->post())){
              $connection = \Yii::$app->db;
              $transaction = $connection->beginTransaction();
              try {
                  $Kd_Asb1 = $model->Kd_Asb1;
                  $Kd_Asb2 = $model->Kd_Asb2;
                  $Kd_Asb3 = $model->Kd_Asb3;
                  $Kd_Asb4 = $model->Kd_Asb4;
                  $Kd_Asb5 = $model->Kd_Asb5;
                  //$data = $this->dataUsulanPilih(); //mengambil data dari session
                  $data = $this->dataCookie('asb');

                  foreach ($data as $key => $value) {
                      $modelHspkAsb = new TaHspkAsb();
                      $modelHspkAsb->Kd_Asb1 = $Kd_Asb1;
                      $modelHspkAsb->Kd_Asb2 = $Kd_Asb2;
                      $modelHspkAsb->Kd_Asb3 = $Kd_Asb3;
                      $modelHspkAsb->Kd_Asb4 = $Kd_Asb4;
                      $modelHspkAsb->Kd_Asb5 = $Kd_Asb5;
                      $modelHspkAsb->Kd_Hspk_Ssh1 = $value['Kd1'];
                      $modelHspkAsb->Kd_Hspk_Ssh2 = $value['Kd2'];
                      $modelHspkAsb->Kd_Hspk_Ssh3 = $value['Kd3'];
                      $modelHspkAsb->Kd_Hspk_Ssh4 = $value['Kd4'];
                      $modelHspkAsb->Kd_Ssh5 = $value['Kd5'];
                      $modelHspkAsb->Kd_Ssh6 = $value['Kd6'];
                      $modelHspkAsb->Asal = $value['Asal'];
                      $modelHspkAsb->Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
                      $modelHspkAsb->Koefisien = $value['Koefisien'];
                      $modelHspkAsb->Kd_Satuan = $value['Kd_Satuan'];
                      $modelHspkAsb->Harga_Satuan = $value['Harga_Satuan'];
                      $modelHspkAsb->Jumlah_Harga = $value['Harga'];

                      $modelHspkAsb->save();
                  }
                  $this->actionResetCookie();
                  $model->save();
                  $transaction->commit();
              } catch (\Exception $e) {
                  $transaction->rollBack();
                  throw $e;
              } catch (\Throwable $e) {
                  $transaction->rollBack();
                  throw $e;
              }
              return [
                  'forceReload'=>'#crud-datatable-pjax',
                  'title'=> "Tambah Kode ASB",
                  'content'=>'<span class="text-success">Berhasil Tambah Kode ASB</span>',
                  'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                          Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

              ];
            }
            else{
                return [
                    'title'=> "Tambah Kode ASB",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,

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
                if($model->save()) {

                    $Kd_Asb1 = $model->Kd_Asb1;
                    $Kd_Asb2 = $model->Kd_Asb2;
                    $Kd_Asb3 = $model->Kd_Asb3;
                    $Kd_Asb4 = $model->Kd_Asb4;
                    $Kd_Asb5 = $model->Kd_Asb5;

                    //$data = $this->dataUsulanPilih(); //mengambil data dari session
                    $data = $this->dataCookie('asb');

                    foreach ($data as $key => $value) {
                        $modelHspkAsb = new TaHspkAsb();
                        $modelHspkAsb->Kd_Asb1 = $Kd_Asb1;
                        $modelHspkAsb->Kd_Asb2 = $Kd_Asb2;
                        $modelHspkAsb->Kd_Asb3 = $Kd_Asb3;
                        $modelHspkAsb->Kd_Asb4 = $Kd_Asb4;
                        $modelHspkAsb->Kd_Asb5 = $Kd_Asb5;
                        $modelHspkAsb->Kd_Hspk_Ssh1 = $value['Kd1'];
                        $modelHspkAsb->Kd_Hspk_Ssh2 = $value['Kd2'];
                        $modelHspkAsb->Kd_Hspk_Ssh3 = $value['Kd3'];
                        $modelHspkAsb->Kd_Hspk_Ssh4 = $value['Kd4'];
                        $modelHspkAsb->Kd_Ssh5 = $value['Kd5'];
                        $modelHspkAsb->Kd_Ssh6 = $value['Kd6'];
                        $modelHspkAsb->Asal = $value['Asal'];
                        $modelHspkAsb->Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
                        $modelHspkAsb->Koefisien = $value['Koefisien'];
                        $modelHspkAsb->Kd_Satuan = $value['Kd_Satuan'];
                        $modelHspkAsb->Harga_Satuan = $value['Harga_Satuan'];
                        $modelHspkAsb->Jumlah_Harga = $value['Harga'];

                        $modelHspkAsb->save();
                    }
                    $this->actionResetCookie();

                }
                    //  return [
                    //     'content' => '<span class="text-success">berhasil</span>',
                    //     'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    //     Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    // ];


                return $this->redirect(['view', 'Kd_Asb1' => $model->Kd_Asb1, 'Kd_Asb2' => $model->Kd_Asb2, 'Kd_Asb3' => $model->Kd_Asb3, 'Kd_Asb4' => $model->Kd_Asb4, 'Kd_Asb5' => $model->Kd_Asb5]);
            } else {
                return $this->render('create', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                ]);
            }
        }

    }
    //akhir actionCreate

    /**
     * Updates an existing RefAsb model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @param integer $Kd_Asb5
     * @return mixed
     */
    public function actionUpdate($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5);

        $dataAsb = ArrayHelper::map(RefAsb1::find()->all(), 'Kd_Asb1', 'Nm_Asb1');
        $Data_Asb2 = ArrayHelper::map(RefAsb2::find()->where(['Kd_Asb1' => $Kd_Asb1])->all(), 'Kd_Asb2', 'Nm_Asb2');
        $Data_Asb3 = ArrayHelper::map(RefAsb3::find()->where(['Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2])->all(), 'Kd_Asb3', 'Nm_Asb3');
        $Data_Asb4 = ArrayHelper::map(RefAsb4::find()->where(['Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2, 'Kd_Asb3' => $Kd_Asb3])->all(), 'Kd_Asb4', 'Nm_Asb4');

        $Kd_Satuan = ArrayHelper::map(RefStandardSatuan::find()->all(), 'Kd_Satuan', 'Uraian');

        $dataSsh = ArrayHelper::map(RefSsh1::find()->all(), 'Kd_Ssh1', 'Nm_Ssh1');
        $Kategori_Pekerjaan = ArrayHelper::map(RefKategoriPekerjaanAsb::find()->all(), 'Kd_Pekerjaan', 'Uraian');
        
        $model2 = new \yii\base\DynamicModel([
          'Kategori_Pekerjaan', 
          'Asal'
        ]);

        $data=[];
        $datarincian = $model->getTaHspkAsbs()->all();
        foreach ($datarincian as $value) {
            $Asal = $value['Asal'];
            $Kd1 = $value['Kd_Hspk_Ssh1'];
            $Kd2 = $value['Kd_Hspk_Ssh2'];
            $Kd3 = $value['Kd_Hspk_Ssh3'];
            $Kd4 = $value['Kd_Hspk_Ssh4'];
            $Kd5 = $value['Kd_Ssh5'];
            $Kd6 = $value['Kd_Ssh6'];

            $Kategori_Pekerjaans = $value->Kategori_Pekerjaan;
            $Kategori_Pekerjaan_Nama = $value->kategoriPekerjaan->Uraian;
            $Satuan = $value->kdSatuan->Uraian;
            $Harga_Satuan = $value->Harga_Satuan;
            $Koefisien = $value->Koefisien;
            $Harga = $value->Jumlah_Harga;
            $Kd_Satuans = $value->Kd_Satuan;

            $Uraian='';
            if ($Asal == 1) {
                $Uraian = $value->kdSsh2->Nama_Barang;
            }
            else if ($Asal == 2) {
                $Uraian = $value->kdHspk2->Uraian_Kegiatan;
            }
            else if ($Asal == 3) {
                $Uraian = $value->kdAsb2->Jenis_Pekerjaan;
            }

            $key = $Asal.$Kd1.$Kd2.$Kd3.$Kd4.$Kd5.$Kd6;
            $data[$key]['Kd1'] = $Kd1;//
            $data[$key]['Kd2'] = $Kd2;//
            $data[$key]['Kd3'] = $Kd3;//
            $data[$key]['Kd4'] = $Kd4;//
            $data[$key]['Kd5'] = $Kd5;//
            $data[$key]['Kd6'] = $Kd6;//
            $data[$key]['Asal'] = $Asal;//
            $data[$key]['Kategori_Pekerjaan'] = $Kategori_Pekerjaans;//
            $data[$key]['Nama_Pekerjaan'] = $Kategori_Pekerjaan_Nama;//
            $data[$key]['Satuan'] = $Satuan;//
            $data[$key]['Harga_Satuan'] = $Harga_Satuan; //
            $data[$key]['Koefisien'] = $Koefisien;//
            $data[$key]['Harga'] = $Harga;//
            $data[$key]['Uraian'] = $Uraian;
            $data[$key]['Kd_Satuan'] = $Kd_Satuans;//
        }

        $this->isiCookie($data, 'ssh_pilih');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode ASB #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){

                    $Kd_Asb1 = $model->Kd_Asb1;
                    $Kd_Asb2 = $model->Kd_Asb2;
                    $Kd_Asb3 = $model->Kd_Asb3;
                    $Kd_Asb4 = $model->Kd_Asb4;
                    $Kd_Asb5 = $model->Kd_Asb5;

                    // RefHspkAsb::find()->where(['Kd_Hspk_Ssh1' => $Kd_Hspk_Ssh1, 'Kd_Hspk_Ssh2' => $Kd_Hspk_Ssh2, 'Kd_Hspk_Ssh3' => $Kd_Hspk_Ssh3, 'Kd_Hspk_Ssh4' => $Kd_Hspk_Ssh4, 'Kd_Ssh5' => $Kd_Ssh5])->all()->delete();

                    //$data = $this->dataUsulanPilih(); //mengambil data dari session
                    $data = $this->dataCookie('asb_pilih');
                    $data = $data ? $data : [];

                    foreach ($data as $key => $value) {
                        $modelHspkAsb = new TaHspkAsb();
                        $modelHspkAsb->Kd_Asb1 = $Kd_Asb1;
                        $modelHspkAsb->Kd_Asb2 = $Kd_Asb2;
                        $modelHspkAsb->Kd_Asb3 = $Kd_Asb3;
                        $modelHspkAsb->Kd_Asb4 = $Kd_Asb4;
                        $modelHspkAsb->Kd_Asb5 = $Kd_Asb5;
                        $modelHspkAsb->Kd_Hspk_Ssh1 = $value['Kd_Hspk_Ssh1'];
                        $modelHspkAsb->Kd_Hspk_Ssh2 = $value['Kd_Hspk_Ssh2'];
                        $modelHspkAsb->Kd_Hspk_Ssh3 = $value['Kd_Hspk_Ssh3'];
                        $modelHspkAsb->Kd_Hspk_Ssh4 = $value['Kd_Hspk_Ssh4'];
                        $modelHspkAsb->Kd_Ssh5 = $value['Kd_Ssh5'];
                        $modelHspkAsb->Kd_Ssh6 = $value['Kd_Ssh6'];
                        $modelHspkAsb->Asal = $value['Asal'];
                        $modelHspkAsb->Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
                        $modelHspkAsb->Koefisien = $value['Koefisien'];
                        $modelHspkAsb->Kd_Satuan = $value['Kd_Satuan'];
                        $modelHspkAsb->Harga_Satuan = $value['Harga_Satuan'];
                        $modelHspkAsb->Jumlah_Harga = $value['Jumlah_Harga'];
                        $modelHspkAsb->save();
                    }
                     $this->actionResetCookie();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode ASB #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2, 'Kd_Asb3' => $Kd_Asb3, 'Kd_Asb4' => $Kd_Asb4, 'Kd_Asb5' => $Kd_Asb5],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode ASB #".$Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                        
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
                $Kd_Asb1 = $model->Kd_Asb1;
                    $Kd_Asb2 = $model->Kd_Asb2;
                    $Kd_Asb3 = $model->Kd_Asb3;
                    $Kd_Asb4 = $model->Kd_Asb4;
                    $Kd_Asb5 = $model->Kd_Asb5;

                    
                    //$data = $this->dataUsulanPilih(); //mengambil data dari session
                    $data = $this->dataCookie('asb_pilih');
                    $data = $data ? $data : [];

                    foreach ($data as $key => $value) {
                        $modelHspkAsb = new TaHspkAsb();
                        $modelHspkAsb->Kd_Asb1 = $Kd_Asb1;
                        $modelHspkAsb->Kd_Asb2 = $Kd_Asb2;
                        $modelHspkAsb->Kd_Asb3 = $Kd_Asb3;
                        $modelHspkAsb->Kd_Asb4 = $Kd_Asb4;
                        $modelHspkAsb->Kd_Asb5 = $Kd_Asb5;
                        $modelHspkAsb->Kd_Hspk_Ssh1 = $value['Kd_Hspk_Ssh1'];
                        $modelHspkAsb->Kd_Hspk_Ssh2 = $value['Kd_Hspk_Ssh2'];
                        $modelHspkAsb->Kd_Hspk_Ssh3 = $value['Kd_Hspk_Ssh3'];
                        $modelHspkAsb->Kd_Hspk_Ssh4 = $value['Kd_Hspk_Ssh4'];
                        $modelHspkAsb->Kd_Ssh5 = $value['Kd_Ssh5'];
                        $modelHspkAsb->Kd_Ssh6 = $value['Kd_Ssh6'];
                        $modelHspkAsb->Asal = $value['Asal'];
                        $modelHspkAsb->Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
                        $modelHspkAsb->Koefisien = $value['Koefisien'];
                        $modelHspkAsb->Kd_Satuan = $value['Kd_Satuan'];
                        $modelHspkAsb->Harga_Satuan = $value['Harga_Satuan'];
                        $modelHspkAsb->Jumlah_Harga = $value['Jumlah_Harga'];
                        
                        $modelHspkAsb->save();
                    }
                     $this->actionResetCookie();


                return $this->redirect(['view', 'Kd_Asb1' => $model->Kd_Asb1, 'Kd_Asb2' => $model->Kd_Asb2, 'Kd_Asb3' => $model->Kd_Asb3, 'Kd_Asb4' => $model->Kd_Asb4, 'Kd_Asb5' => $model->Kd_Asb5]);
            } else {
                return $this->render('update', [
                        'model' => $model,
                        'dataAsb' => $dataAsb,
                        'model2' => $model2,
                        'Kd_Satuan' => $Kd_Satuan,
                        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
                        'Data_Asb2' => $Data_Asb2,
                        'Data_Asb3' => $Data_Asb3,
                        'Data_Asb4' => $Data_Asb4,
                        
                    ]);
            }
        }
    }

    /**
     * Delete an existing RefAsb model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @param integer $Kd_Asb5
     * @return mixed
     */
    public function actionDelete($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)
    {
        $request = Yii::$app->request;
        $this->findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)->delete();

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
     * Delete multiple existing RefAsb model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @param integer $Kd_Asb5
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
     * Finds the RefAsb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Asb1
     * @param integer $Kd_Asb2
     * @param integer $Kd_Asb3
     * @param integer $Kd_Asb4
     * @param integer $Kd_Asb5
     * @return RefAsb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)
    {
        if (($model = RefAsb::findOne(['Kd_Asb1' => $Kd_Asb1, 'Kd_Asb2' => $Kd_Asb2, 'Kd_Asb3' => $Kd_Asb3, 'Kd_Asb4' => $Kd_Asb4, 'Kd_Asb5' => $Kd_Asb5])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
  /*
  public function actionSetCookie() {
        $request = Yii::$app->request;
        $TaHspkAsb = $request->post('TaHspkAsb');

        $Kd_Hspk_Ssh1 = $TaHspkAsb['Kd_Hspk_Ssh1'];
        $Kd_Hspk_Ssh2 = $TaHspkAsb['Kd_Hspk_Ssh2'];
        $Kd_Hspk_Ssh3 = $TaHspkAsb['Kd_Hspk_Ssh3'];
        $Kd_Hspk_Ssh4 = $TaHspkAsb['Kd_Hspk_Ssh4'];
        $Kd_Ssh5 = $TaHspkAsb['Kd_Ssh5'];
        $Kd_Ssh6 = $TaHspkAsb['Kd_Ssh6'];
        $Asal = $TaHspkAsb['Asal'];
        $Harga_Satuan = $TaHspkAsb['Harga_Satuan'];
        $Kd_Satuan = $TaHspkAsb['Kd_Satuan'];
        $Koefisien = $TaHspkAsb['Koefisien'];
        $Jumlah_Harga = $TaHspkAsb['Jumlah_Harga'];
        $Kategori_Pekerjaan = $TaHspkAsb['Kategori_Pekerjaan'];
        $Uraian_ss = $request->post('uraian_ss');
        $Satuan_ss = $request->post('satuan_ss');

        $key =$Kd_Hspk_Ssh1.$Kd_Hspk_Ssh2.$Kd_Hspk_Ssh3.$Kd_Hspk_Ssh4.$Kd_Ssh5.$Kd_Ssh6;

        $data = $this->dataCookie('asb_pilih');

        $data[$key]['Kd_Hspk_Ssh1'] = $Kd_Hspk_Ssh1;
        $data[$key]['Kd_Hspk_Ssh2'] = $Kd_Hspk_Ssh2;
        $data[$key]['Kd_Hspk_Ssh3'] = $Kd_Hspk_Ssh3;
        $data[$key]['Kd_Hspk_Ssh4'] = $Kd_Hspk_Ssh4;
        $data[$key]['Kd_Ssh5'] = $Kd_Ssh5;
        $data[$key]['Kd_Ssh6'] = $Kd_Ssh6;
        $data[$key]['Asal'] = $Asal;
        $data[$key]['Harga_Satuan'] = $Harga_Satuan;
        $data[$key]['Kd_Satuan'] = $Kd_Satuan;
        $data[$key]['Koefisien'] = $Koefisien;
        $data[$key]['Jumlah_Harga'] = $Jumlah_Harga;
        $data[$key]['Kategori_Pekerjaan'] = $Kategori_Pekerjaan;
        $data[$key]['Uraian_ss'] = $Uraian_ss;
        $data[$key]['Satuan_ss'] = $Satuan_ss;
        // echo $data[$key]['KdSatuan_ss'];die();
        $this->isiCookie($data, 'asb_pilih');
        echo "Berhasil";
    }
    */
  
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
       // print_r($cookies);exit();
        $isi = $cookies[$nama];
        $data = Json::decode($isi);

        return $data;
    }
    /*
    public function actionGetCookie() {
        $data = $this->dataCookie('asb_pilih');
        //print_r($data);exit();
        return $this->renderpartial('get_cookie_ssh', [
                    'data' => $data,
        ]);
    }
    */
    public function actionResetCookie() {
        $data = $this->dataCookie('asb');
        $data=[];
        $this->isiCookie($data, 'asb');
    }
    /*
    public function actionDelCookie($key) {
        $data = $this->dataCookie('asb_pilih');
        unset($data[$key]);
        $this->isiCookie($data, 'asb_pilih');
    }
    */
    public function actionGetForm($Asal) {
      if ($Asal == 1) {
        $data = ArrayHelper::map(RefSsh1::find()->all(), 'Kd_Ssh1', 'Nm_Ssh1');
        $tujuan = 'get_isian_ssh';
      }
      else if ($Asal == 2) {
        $data = ArrayHelper::map(RefHspk1::find()->all(), 'Kd_Hspk1', 'Nm_Hspk1');
        $tujuan = 'get_isian_hspk';
      }
      else if ($Asal == 3) {
        $data = ArrayHelper::map(RefAsb1::find()->all(), 'Kd_Asb1', 'Nm_Asb1');
        $tujuan = 'get_isian_asb';
      }
      return $this->renderpartial($tujuan, [
          'data' => $data
      ]);
    }
 }
