<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefKegiatan;
use emusrenbang\models\KegiatanSkpd;
use common\models\search\RefKegiatanSearch;
use common\models\RefUrusan;
use common\models\RefProgram;
use common\models\RefStandardSatuan;

/**
 * RefKegiatanController implements the CRUD actions for RefKegiatan model.
 */
class RefKegiatanController extends Controller
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
     * Lists all RefKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefKegiatan model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new RefKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefKegiatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatekegiatan()
    {
        $model = new RefKegiatan();
        $modelkegiatan = new KegiatanSkpd();

        $username=Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            $created_at=date('Y-m-d h:i:s');
            $updated_at=date('Y-m-d h:i:s');
            $Kd_Kegiatan=$model->Kd_Keg;
            $Kd_Unit=Yii::$app->user->identity->id_skpd;
           $query="insert into kegiatan_skpd (Kd_Unit, Kd_Kegiatan, created_at, updated_at, username) values ('$Kd_Unit', '$Kd_Kegiatan', '$created_at', '$updated_at', '$username')";
           $db=Yii::$app->db->createCommand($query)->execute();
            if($db){
                return $this->redirect(['kegiatan-skpd/index']);
            }
        } else {
            return $this->render('createkegiatan', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing RefKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
   // public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Unit,$Kd_Sub_Unit,$Kd_Prog, $Kd_Keg)//Edit by RG
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg)//Edit by RG
    {
       // $model = $this->findModel($Kd_Urusan, $Kd_Bidang,  $Kd_Unit,$Kd_Sub_Unit,$Kd_Prog, $Kd_Keg);
	    $model = $this->findModel($Kd_Urusan, $Kd_Bidang,  $Kd_Prog, $Kd_Keg);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang,  'Kd_Unit'=>$model->Kd_Unit,'Kd_Sub_Unit'=>$model->Kd_Sub_Unit,'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);//Edit By RG
			return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]); //Koment By RG
        } else {
            return $this->render('update', [
                'model' => $model, 
            ]);
        }
    }

    public function getUrusan()
    {
        $model=RefUrusan::find()->all();
        $data=array();
        foreach($model as $d){
               $data[$d['Kd_Urusan']]=$d['Nm_Urusan'];
              }
        return $data;
    }

//Ripin G
    public function getSatuan()
    {
        $model=RefStandardSatuan::find()->all();
        $data=array();
        foreach($model as $d){
               $data[$d['Kd_Satuan']]=$d['Uraian'];
              }
        return $data;
    }

//

    public function actionListprogram($urusan)
    {
        $this->layout='blank';
        $id_skpd=Yii::$app->user->identity->id_skpd;
        $i=explode(".", $id_skpd);
        $model=RefProgram::find()->select('*')->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$i[1]])->all();
        echo "<option>Pilih Program</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Prog]'>$d[Ket_Program]</option>";
        }
    }

    public function actionListkegiatan($prog, $urusan)
    {
        $this->layout='blank';
        $id_skpd=Yii::$app->user->identity->id_skpd;
        $i=explode(".", $id_skpd);
        $model=RefKegiatan::find()->select('*')->where(['Kd_Prog'=>$prog, 'Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$i[1]])->all();
        echo "<option>Pilih Kegiatan</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Urusan].$d[Kd_Bidang].$d[Kd_Prog].$d[Kd_Keg]'>$d[Ket_Kegiatan]</option>";
        }
    }

    /**
     * Deletes an existing RefKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg)
    {
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return RefKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg)
    {
        if (($model = RefKegiatan::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 public function actionGetKeg($Kd_Urusan, $Kd_Bidang, $Kd_Prog,$Kd_Keg,$Kd_Unit,$Kd_Sub_Unit){
$model1=TaKegiatan1::find()
     ->where (['Kd_Urusan'=>$Kd_Urusan])
	->andwhere (['Kd_Bidang'=>$Kd_Bidang])
	->andwhere (['Kd_Prog'=>$Kd_Prog])
	->andwhere (['Kd_Keg'=>$Kd_Keg])
	->andwhere (['Kd_Unit'=>$Kd_Unit])
	->andwhere (['Kd_Sub'=>$Kd_Sub_Unit])
	->all();
	return $model1->Kd_Keg;	
	 }
    public function actionGetKode($Kd_Urusan, $Kd_Bidang, $Kd_Prog){
        //$model = RefKegiatan::find()->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog])->select('max(Kd_Prog)')->scalar();
        $max_kd=RefKegiatan::find()
                ->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog])
                ->max('Kd_Keg');
				$kode = $max_kd+1;
        return $kode;
    }

     public function actionGetBidang($Kd_Urusan){
        $tag = ['prompt' => 'Pilih Bidang'];
        $model = \common\models\RefBidang::find()->where(['Kd_Urusan' => $Kd_Urusan])->all();
        return \yii\helpers\Html::renderSelectOptions(null,\yii\helpers\ArrayHelper::map($model, 'Kd_Bidang', 'Nm_Bidang'),$tag);
    }

    public function actionGetUnit($Kd_Urusan,$Kd_Bidang){
        $tag = ['prompt' => 'Pilih Unit'];
        $model = \common\models\RefUnit::find()->where(['Kd_Urusan' => $Kd_Urusan,'Kd_Bidang'=>$Kd_Bidang])->all();
        return \yii\helpers\Html::renderSelectOptions(null,\yii\helpers\ArrayHelper::map($model, 'Kd_Unit', 'Nm_Unit'),$tag);
    }

    public function actionGetSub($Kd_Urusan,$Kd_Bidang,$Kd_Unit){
        $tag = ['prompt' => 'Pilih Sub Unit'];
        $model = \common\models\RefSubUnit::find()->where(['Kd_Urusan' => $Kd_Urusan,'Kd_Bidang'=>$Kd_Bidang,'Kd_Unit'=>$Kd_Unit])->all();
        return \yii\helpers\Html::renderSelectOptions(null,\yii\helpers\ArrayHelper::map($model, 'Kd_Sub', 'Nm_Sub_Unit'),$tag);
    }

     public function actionGetProgram($Kd_Urusan, $Kd_Bidang,$Kd_Unit,$Kd_Sub){
        $tag = ['prompt' => 'Pilih Program'];
         $model = \common\models\RefProgram::find()->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang,'Kd_Unit'=>$Kd_Unit,'Kd_Sub_Unit'=>$Kd_Sub])->all();
        // print_r($model);exit;
        return \yii\helpers\Html::renderSelectOptions(null,\yii\helpers\ArrayHelper::map($model, 'Kd_Prog', 'Ket_Program'),$tag);
    }
}
