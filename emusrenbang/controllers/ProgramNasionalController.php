<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\ProgramNasional;
use emusrenbang\models\ProgramNasionalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\Urusan;
use emusrenbang\models\Misi;
use common\models\RefUrusan;
use common\models\RefProgram;
use common\models\RefBidang;
use common\models\RefUnit;
use yii\filters\AccessControl;

/**
 * ProgramNasionalController implements the CRUD actions for ProgramNasional model.
 */
class ProgramNasionalController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProgramNasional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramNasionalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getPrioritas()
    {
        $model = PrioritasNasional::find()->all();
        $data=array();
        foreach($model as $d){
            $data[$d['id']]=$d['prioritas_nasional'];
        }
        return $data;
    }

    public function getKdurusan(){
        $model = RefUrusan::find()->all();
        $data=array();
        foreach($model as $d){
            $data[$d['Kd_Urusan']]=$d['Nm_Urusan'];
        }
        return $data;
    }

    public function getUrusan()
    {
        $model = Urusan::find()->all();
        $data=array();
        foreach($model as $d){
            $data[$d['id']]=$d['urusan'];
        }
        return $data;
    }

    public function actionListmisi($id)
    {
        $this->layout="blank";
        $model=Urusan::find()->select('*')->where(['id'=>$id])->one();
        $idmisi=$model->idMisi;
        $modelMisi=Misi::find()->select('*')->where(['id'=>$idmisi])->one();
        echo $modelMisi->misi;
    }

    public function actionListbidang($id)
    {
        $this->layout="blank";
        $model=RefBidang::find()->select('*')->where(['Kd_Urusan'=>$id])->all();
        echo "<option>Pilih Sektor</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Bidang]'>$d[Nm_Bidang]</option>";
        }
    }

    public function actionListunit($id, $id1)
    {
        $this->layout="blank";
        $model=RefUnit::find()->select('*')->where(['Kd_Urusan'=>$id, 'Kd_Bidang'=>$id1])->all();
        echo "<option>Pilih Unit</option>";
        foreach($model as $d){
            echo "<option value='$id.$id1.$d[Kd_Unit]'>$d[Nm_Unit]</option>";
        }
    }

    public function actionListprogram($id, $id1)
    {
        $this->layout="blank";
        $model=RefProgram::find()->select('*')->where(['Kd_Urusan'=>$id, 'Kd_Bidang'=>$id1])->all();
        echo "<option>Pilih Unit</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Prog]'>$d[Ket_Program]</option>";
        }
    }

    public function getProgram($id, $id1, $id2)
    {
        $model=RefProgram::find()->select('*')->where(['Kd_Urusan'=>$id, 'Kd_Bidang'=>$id1, 'Kd_Prog'=>$id2])->one();
        return isset($model->Ket_Program) ? $model->Ket_Program : "";
    }

    public function actionIdmisi($id)
    {
        $this->layout="blank";
        $model=Urusan::find()->select('*')->where(['id'=>$id])->one();
        $idmisi=$model->idMisi;

        echo $idmisi;
    }

    /**
     * Displays a single ProgramNasional model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($tahun, $id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program)
    {
        return $this->render('view', [
            'model' => $this->findModel($tahun, $id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program),
        ]);
    }

    /**
     * Creates a new ProgramNasional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProgramNasional();

        $date=date('Y-m-d h:i:s');
        $model->created_at=$date;
        $model->updated_at=$date;
        $model->username=Yii::$app->user->identity->username;
        $model->tahun=date('Y')+1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'id_prioritas'=>$model->id_prioritas, 'id_nawacita'=>$model->id_nawacita, 'id_urusan'=>$model->id_urusan, 'id_misi'=>$model->id_misi, 'urusan'=>$model->urusan, 'bidang'=>$model->bidang, 'id_program'=>$model->id_program]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProgramNasional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProgramNasional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($tahun, $id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program)
    {
        $this->findModel($tahun, $id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProgramNasional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramNasional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program)
    {
        if (($model = ProgramNasional::findOne($id_prioritas, $id_nawacita, $id_urusan, $id_misi, $urusan, $bidang, $id_program, $tahun)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
