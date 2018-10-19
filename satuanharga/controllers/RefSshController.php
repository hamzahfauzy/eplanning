<?php

namespace satuanharga\controllers;

use Yii;
use common\models\search\RefSshSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefSsh;
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use common\models\RefSsh4;
use common\models\RefSsh5;
use common\models\TaSshHspk;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan;


/**
 * RefSshController implements the CRUD actions for RefSsh model.
 */
class RefSshController extends Controller
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
     * Lists all RefSsh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSshSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefSsh model.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @param integer $Kd_Ssh5
     * @param integer $Kd_Ssh6
     * @return mixed
     */
    public function actionView($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Kode SSH #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6'=>$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6),
            ]);
        }
    }

    /**
     * Creates a new RefSsh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RefSsh();

        // $dataSsh = ArrayHelper::map(RefSsh1::find()
        //         ->all()
        // , 'Kd_Ssh1', 'Nm_Ssh1');

        $ssh=RefSsh1::find()
            ->all();
        $dataSsh =[];
        foreach($ssh as $key => $value){
            $dataSsh[$value['Kd_Ssh1']]=$value['Kd_Ssh1'].". ".$value['Nm_Ssh1'];
        }

        $dataSatuan = ArrayHelper::map(RefStandardSatuan::find()
                 ->orderBy('Uraian')
                ->all()
        , 'Kd_Satuan', 'Uraian');

        $Data_Ssh2=[];
        $Data_Ssh3=[];
        $Data_Ssh4=[];
        $Data_Ssh5=[];

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kode SSH",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate()){
				//$model->save(false);
				/*
				return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kode SSH",
                    'content'=>'<span class="text-success">Berhasil Tambah Kode SSH</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
				*/
         //         $NASKd_RefSsh6 = RefSsh::find()
									// ->where(['Kd_Ssh1' => $model->Kd_Ssh1,'Kd_Ssh2' => $model->Kd_Ssh2,'Kd_Ssh3' => $model->Kd_Ssh3,'Kd_Ssh4' => $model->Kd_Ssh4, 'Kd_Ssh5' => $model->Kd_Ssh5 ])
									// ->max('Kd_Ssh6');
									
         //         $Data_Ssh6 = $NASKd_RefSsh6+1;
         //         $model->Kd_Ssh6 = $Data_Ssh6;


				// if ($model->save()){
				// 	return [
				// 		'forceReload'=>'#crud-datatable-pjax',
				// 		'title'=> "Tambah Kode SSH",
				// 		'content'=>'<span class="text-success">Berhasil Tambah Kode SSH</span>',
				// 		'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
				// 				Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

				// 	];
				// }

    //         }

                try {
                    $model->save();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kode SSH",
                        'content'=>'<span class="text-success">Berhasil Tambah Kode SSH</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
                } catch (\Exception $e) {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tambah Kode SSH",
                        'content'=>'<span class="text-success">Berhasil Tambah Kode SSH</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                    ];
                }
                
            }else{
                return [
                    'title'=> "Tambah Kode SSH",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
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
                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2, 'Kd_Ssh3' => $model->Kd_Ssh3, 'Kd_Ssh4' => $model->Kd_Ssh4, 'Kd_Ssh5' => $model->Kd_Ssh5, 'Kd_Ssh6' => $model->Kd_Ssh6]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataSsh' => $dataSsh,
                    'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
                ]);
            }
        }

    }

    /**
     * Updates an existing RefSsh model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @param integer $Kd_Ssh5
     * @param integer $Kd_Ssh6
     * @return mixed
     */
   public function actionUpdate($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6);

        $dataSsh = ArrayHelper::map(RefSsh1::find()
                ->all()
                , 'Kd_Ssh1', 'Nm_Ssh1');

        $dataSatuan = ArrayHelper::map(RefStandardSatuan::find()
                ->all()
                , 'Kd_Satuan', 'Uraian');

        $Data_Ssh2=ArrayHelper::map(RefSsh2::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1])
                ->all()
                , 'Kd_Ssh2', 'Nm_Ssh2');

        $Data_Ssh3=ArrayHelper::map(RefSsh3::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2])
                ->all()
                , 'Kd_Ssh3', 'Nm_Ssh3');

        $Data_Ssh4=ArrayHelper::map(RefSsh4::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2, 'Kd_Ssh3'=>$Kd_Ssh3])
                ->all()
                , 'Kd_Ssh4', 'Nm_Ssh4');

        $Data_Ssh5=ArrayHelper::map(RefSsh5::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2, 'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4])
                ->all()
                , 'Kd_Ssh5', 'Nm_Ssh5');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Perbarui Kode SSH #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kode SSH #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2, 'Kd_Ssh3' => $model->Kd_Ssh3, 'Kd_Ssh4' => $model->Kd_Ssh4, 'Kd_Ssh5' => $model->Kd_Ssh5, 'Kd_Ssh6' => $model->Kd_Ssh6],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Perbarui Kode SSH #".$Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dataSsh' => $dataSsh,
                        'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
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

                return $this->redirect(['view', 'Kd_Ssh1' => $model->Kd_Ssh1, 'Kd_Ssh2' => $model->Kd_Ssh2, 'Kd_Ssh3' => $model->Kd_Ssh3, 'Kd_Ssh4' => $model->Kd_Ssh4, 'Kd_Ssh5' => $model->Kd_Ssh5, 'Kd_Ssh6' => $model->Kd_Ssh6]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataSsh' => $dataSsh,
                    'dataSatuan' => $dataSatuan,
                        'Data_Ssh2' => $Data_Ssh2,
                        'Data_Ssh3' => $Data_Ssh3,
                        'Data_Ssh4' => $Data_Ssh4,
                        'Data_Ssh5' => $Data_Ssh5,
                ]);
            }
        }
    }

    /**
     * Delete an existing RefSsh model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @param integer $Kd_Ssh5
     * @param integer $Kd_Ssh6
     * @return mixed
     */
    public function actionDelete($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        $request = Yii::$app->request;
        // $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            try {
                $this->findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)->delete();
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            } catch (\Exception $e) {
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing RefSsh model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @param integer $Kd_Ssh5
     * @param integer $Kd_Ssh6
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

    public function actionUbah()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand(
          " UPDATE Ta_Ssh_Hspk
            SET Harga_Satuan = 
            (SELECT Harga_Satuan FROM Ref_Ssh
            WHERE Ta_Ssh_Hspk.`Kd_Ssh1` = Ref_Ssh.`Kd_Ssh1`
            AND Ta_Ssh_Hspk.`Kd_Ssh2` = Ref_Ssh.`Kd_Ssh2`
            AND Ta_Ssh_Hspk.`Kd_Ssh3` = Ref_Ssh.`Kd_Ssh3`
            AND Ta_Ssh_Hspk.`Kd_Ssh4` = Ref_Ssh.`Kd_Ssh4`
            AND Ta_Ssh_Hspk.`Kd_Ssh5` = Ref_Ssh.`Kd_Ssh5`
            AND Ta_Ssh_Hspk.`Kd_Ssh6` = Ref_Ssh.`Kd_Ssh6`),
            Harga = Koefisien * Harga_Satuan;

            UPDATE Ref_Hspk
            SET Harga = 
            (SELECT SUM(Harga)
            FROM Ta_Ssh_Hspk 
            WHERE Ta_Ssh_Hspk.`Kd_Hspk1` = Ref_Hspk.`Kd_Hspk1`
            AND Ta_Ssh_Hspk.`Kd_Hspk2` = Ref_Hspk.`Kd_Hspk2`
            AND Ta_Ssh_Hspk.`Kd_Hspk3` = Ref_Hspk.`Kd_Hspk3`
            AND Ta_Ssh_Hspk.`Kd_Hspk4` = Ref_Hspk.`Kd_Hspk4`);

            UPDATE Ta_Hspk_Asb
            SET Harga_Satuan = 
            (
              if ( Ta_Hspk_Asb.`Asal` = 1, 
                (SELECT Harga_Satuan FROM Ref_Ssh
                WHERE Ta_Hspk_Asb.`Kd_Hspk_Ssh1` = Ref_Ssh.`Kd_Ssh1`
                AND Ta_Hspk_Asb.`Kd_Hspk_Ssh2` = Ref_Ssh.`Kd_Ssh2`
                AND Ta_Hspk_Asb.`Kd_Hspk_Ssh3` = Ref_Ssh.`Kd_Ssh3`
                AND Ta_Hspk_Asb.`Kd_Hspk_Ssh4` = Ref_Ssh.`Kd_Ssh4`
                AND Ta_Hspk_Asb.`Kd_Ssh5` = Ref_Ssh.`Kd_Ssh5`
                AND Ta_Hspk_Asb.`Kd_Ssh6` = Ref_Ssh.`Kd_Ssh6`),
                
                IF ( Ta_Hspk_Asb.`Asal` = 2,
                  (SELECT Harga FROM Ref_Hspk
                  WHERE Ta_Hspk_Asb.`Kd_Hspk_Ssh1` = Ref_Hspk.`Kd_Hspk1`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh2` = Ref_Hspk.`Kd_Hspk2`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh3` = Ref_Hspk.`Kd_Hspk3`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh4` = Ref_Hspk.`Kd_Hspk4`),
                  
                  (SELECT Harga FROM Ref_Asb
                  WHERE Ta_Hspk_Asb.`Kd_Hspk_Ssh1` = Ref_Asb.`Kd_Asb1`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh2` = Ref_Asb.`Kd_Asb2`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh3` = Ref_Asb.`Kd_Asb3`
                  AND Ta_Hspk_Asb.`Kd_Hspk_Ssh4` = Ref_Asb.`Kd_Asb4`
                  AND Ta_Hspk_Asb.`Kd_Ssh5` = Ref_Asb.`Kd_Asb5`)
                  
                )
              )
              
            ),
            Jumlah_Harga = Koefisien * Harga_Satuan; 
            
            UPDATE Ref_Asb
            SET Harga = 
            (SELECT SUM(Jumlah_Harga)
            FROM Ta_Hspk_Asb 
            WHERE Ta_Hspk_Asb.`Kd_Asb1` = Ref_Asb.`Kd_Asb1`
            AND Ta_Hspk_Asb.`Kd_Asb2` = Ref_Asb.`Kd_Asb2`
            AND Ta_Hspk_Asb.`Kd_Asb3` = Ref_Asb.`Kd_Asb3`
            AND Ta_Hspk_Asb.`Kd_Asb4` = Ref_Asb.`Kd_Asb4`
            AND Ta_Hspk_Asb.`Kd_Asb5` = Ref_Asb.`Kd_Asb5`);
        "
        );
        $result = $command->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefSsh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Ssh1
     * @param integer $Kd_Ssh2
     * @param integer $Kd_Ssh3
     * @param integer $Kd_Ssh4
     * @param integer $Kd_Ssh5
     * @param integer $Kd_Ssh6
     * @return RefSsh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        if (($model = RefSsh::findOne(['Kd_Ssh1' => $Kd_Ssh1, 'Kd_Ssh2' => $Kd_Ssh2, 'Kd_Ssh3' => $Kd_Ssh3, 'Kd_Ssh4' => $Kd_Ssh4, 'Kd_Ssh5' => $Kd_Ssh5, 'Kd_Ssh6' => $Kd_Ssh6])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
