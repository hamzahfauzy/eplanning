<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaProgram;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\search\TaProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\RefProgram;
use common\models\RefKamusProgram;
use yii\helpers\ArrayHelper;

/**
 * TaProgramController implements the CRUD actions for TaProgram model.
 */
class TaProgramController extends Controller
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
     * Lists all TaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         $urusan = ArrayHelper::map(RefUrusan::find()->all(),
                          'Kd_Urusan',
                          'Nm_Urusan'
                        );

        $bidang = ArrayHelper::map(RefBidang::find()
                    ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                    ->all(),
                    'Kd_Bidang',
                    'Nm_Bidang'
                );

        $unit = ArrayHelper::map(RefUnit::find()
                ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                ->all(),
                'Kd_Unit',
                'Nm_Unit'
            );

        $subunit = ArrayHelper::map(RefSubUnit::find()
                        ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                        ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                        ->andwhere(['Kd_Unit' => $searchModel->Kd_Unit])
                        ->all(),
                          'Kd_Sub',
                          'Nm_Sub_Unit'
                        );

        $program = ArrayHelper::map(RefProgram::find()
                        ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                        ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
						 ->andwhere(['Kd_Unit' => $searchModel->Kd_Unit])
						  ->andwhere(['Kd_Sub_Unit' => $searchModel->Kd_Sub])
                        ->all(),
                            'Kd_Prog',
                            'Ket_Program'
                        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bidang' => $bidang,
            'urusan' => $urusan,
            'unit' => $unit,
            'subunit' => $subunit,
            'program' => $program,
        ]);
    }


    /**
     * Displays a single TaProgram model.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> 'Tambah Program',
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan , 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog'=> $Kd_Prog ],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog),
            ]);
        }
    }

    /**
     * Creates a new TaProgram model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TaProgram(); 

        $dataUrusan = ArrayHelper::map(RefUrusan::find()
                ->all() , 'Kd_Urusan', 'Nm_Urusan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Program",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dataUrusan' => $dataUrusan
                  
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save(false)){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Program",
                    'content'=>'<span class="text-success">Create TaProgram success</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah Program ",
                    'content'=>$this->renderAjax('create', [
						'model' => $model,
                        'dataUrusan' => $dataUrusan
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save(false)) {
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataUrusan' => $dataUrusan
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TaProgram model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog);  
		
		$dataUrusan = ArrayHelper::map(RefUrusan::find()
                ->all() , 'Kd_Urusan', 'Nm_Urusan');
		
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Program",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
						'dataUrusan' => $dataUrusan
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save(false)){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Program",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
						'dataUrusan' => $dataUrusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan , 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog'=> $Kd_Prog ],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Edit Program",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
						'dataUrusan' => $dataUrusan
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save(false)) {
                return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog]);
            } else {
                return $this->render('update', [
                    'model' => $model,
					'dataUrusan' => $dataUrusan
                ]);
            }
        }
    }

    /**
     * Delete an existing TaProgram model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        $request = Yii::$app->request;
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)->delete();

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
     * Delete multiple existing TaProgram model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
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
     * Finds the TaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return TaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        if (($model = TaProgram::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAmbil()
    {
        $query = new \yii\db\Query;
        $query->select('*')
                ->from('Ref_Program')
                ->leftJoin('Ref_Kamus_Program', 'Ref_Program.Ket_Program = Ref_Kamus_Program.Nm_Program')  
                ->where(['is', 'Ref_Kamus_Program.Kd_Program', null])
                ->groupby('Ref_Program.Ket_Program');

        // SELECT * FROM Ref_Program 
        // LEFT JOIN Ref_Kamus_Program
        //     ON Ref_Program.Ket_Program = Ref_Kamus_Program.Nm_Program
        // WHERE Kd_Program is null 
        // GROUP BY Ket_Program
        $command = $query->createCommand();
        $resp = $command->queryAll();
        //print_r($resp);
        //die();

        $max_kd=RefKamusProgram::find()
                ->max('Kd_Program');
        $Kd_Prog = $max_kd + 1;

        foreach ($resp as $key => $value) {
            // $model = new RefKamusProgram();
            // $model->Kd_Program = $Kd_Prog;
            // $model->Nm_Program = $value['Ket_Program'];
            // $model->Status = 1;
            // $model->save();
            echo $Kd_Prog.". ";
            echo $value['Ket_Program'];
            echo "<br/>";
            $Kd_Prog++;
        }
    }

    public function actionUrutkan()
    {
        $kamus=RefKamusProgram::find()->orderby(['Kd_Program' => SORT_DESC])->all();

        echo "<table>";
        foreach ($kamus as $value) {
            //$program = RefProgram::findOne(['Ket_Program' => $value['Nm_Program']]);
            $program = RefProgram::find()->where(['Ket_Program' => $value['Nm_Program']])->all();
            foreach ($program as $prog) {
                
                ?>
                    <tr>
                        <td> <?= $value['Nm_Program']; ?> </td>
                        <td> <?= $value['Kd_Program']; ?> </td>
                        <td> <?= $prog['Kd_Urusan']; ?> </td>
                        <td> <?= $prog['Kd_Bidang']; ?> </td>
                        <td> <?= $prog['Kd_Prog']; ?> </td>
                        <td> <?= $prog['Ket_Program']; ?> </td>
                    <?php
                    //$model = RefProgram::findone(['Ket_Program' => $value['Nm_Program']]);
                    $prog->Kd_Prog = $value['Kd_Program'];
                    $prog->save();
                    ?>
                        <td> <?= $prog->Kd_Prog; ?> </td>
                    </tr>
                    <?php
            }
        }
        echo "</table>";
    }

}
