<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\TaPaguProgram;
use emusrenbang\models\TaPaguProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefProgram;
use common\models\TaPaguUnit;
use common\models\LevelComponent;
use common\models\TaPaguSubUnit;
use yii\helpers\ArrayHelper;

/**
 * TaPaguProgramController implements the CRUD actions for TaPaguProgram model.
 */
class TaPaguProgramController extends Controller
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
     * Lists all TaPaguProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPaguProgramSearch();
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

        $program = ArrayHelper::map(RefProgram::find()
                ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                ->all(),
                    'Kd_Prog',
                    'Ket_Program'
                );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'urusan' => $urusan,
            'bidang' => $bidang,
            'unit' => $unit,
            'program' => $program,
        ]);
    }

    /**
     * Displays a single TaPaguProgram model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog)
    {
		$subunit = RefUnit::find()
					->where(['Kd_Urusan'=>$Kd_Urusan])
					->andwhere(['Kd_Bidang'=>$Kd_Bidang])
					->andwhere(['Kd_Unit'=>$Kd_Unit])
					->one();
					
		$program = RefProgram::find()
					->where(['Kd_Urusan'=>$Kd_Urusan])
					->andwhere(['Kd_Bidang'=>$Kd_Bidang])
					->andwhere(['Kd_Prog'=>$Kd_Prog])
					->one();
					
        return $this->render('view', [
			'program'=>$program,
			'subunit'=>$subunit,
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog),
        ]);
    }

    /**
     * Creates a new TaPaguProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPaguProgram();
        $model->Tahun=date('Y')+1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function Posisi()
    {
        $kelompok     = Yii::$app->levelcomponent->getUnit();
        return [
            'Kd_Urusan'=>$kelompok->Kd_Urusan, 
            'Kd_Bidang'=>$kelompok->Kd_Bidang,
            'Kd_Unit'=>$kelompok->Kd_Unit,
            'Kd_Sub'=>$kelompok->Kd_Sub_Unit,
        ];
    }

    /**
     * Updates an existing TaPaguProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionList2()
    {
        $model=new TaPaguProgram;
        $urusan=Yii::$app->user->identity->id_urusan;
        $bidang=Yii::$app->user->identity->id_bidang;
        $unit=Yii::$app->user->identity->id_skpd;

        $unit=isset($unit) ? $unit : 0;
        // $tahun=date('Y');

        $modelProgram=RefProgram::find()->select(['Ref_Program.*', 'Ta_Pagu_Program.pagu'])->where(['Ref_Program.Kd_Urusan'=>$urusan, 'Ref_Program.Kd_Bidang'=>$bidang])
        ->leftJoin('Ta_Pagu_Program', "Ta_Pagu_Program.Kd_Urusan=Ref_Program.Kd_Urusan and Ta_Pagu_Program.Kd_Bidang=Ref_Program.Kd_Bidang and Ta_Pagu_Program.Kd_Prog=Ref_Program.Kd_Prog
            and Ta_Pagu_Program.Kd_Unit=$unit
        ")->all();

        $modelPaguUnit=TaPaguUnit::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Unit'=>$unit])->one();

        $pagu=$modelPaguUnit['pagu'];

        $Tahun=date('Y');

        $model->Tahun=$Tahun;
        if ($post=Yii::$app->request->post()){
            foreach($post['pagu'] as $k=>$v){
                $value=str_replace(".","",$v);
                $sqlCek="SELECT pagu FROM Ta_Pagu_Program WHERE Tahun='$Tahun' and Kd_Urusan='$urusan' and Kd_Bidang='$bidang' and Kd_Unit='$unit' and Kd_Prog='$k'";
                $query=Yii::$app->db->createCommand($sqlCek)->queryOne();
                if(!isset($query['pagu'])){
                    $sql="INSERT INTO Ta_Pagu_Program(Tahun, Kd_Urusan, Kd_Bidang, Kd_Unit, Kd_Prog, pagu) values ('$Tahun', '$urusan', '$bidang', '$unit', '$k', '$value')";
                }else{
                    $sql="UPDATE Ta_Pagu_Program SET pagu='$value' WHERE Tahun='$Tahun' and Kd_Urusan='$urusan' and Kd_Bidang='$bidang' and Kd_Unit='$unit' and Kd_Prog='$k'";
                }
                Yii::$app->db->createCommand($sql)->execute();
            }
             return $this->redirect(['list']);
        }
        return $this->render('list', [
                'model' => $model,
                'modelProgram' => $modelProgram,
                'pagu' => $pagu,
        ]);
    }

    public function actionList()
    {
        $Posisi = $this->Posisi();

        $tahun = date('Y');

        $pagusubunit = TaPaguSubUnit::find()
                    ->where($Posisi)
                    ->andWhere(['Tahun'=>$tahun])
                    ->all();

        $jlh_pagu = TaPaguSubUnit::find()
                    ->where($Posisi)
                    ->andWhere(['Tahun'=>$tahun])
                    ->sum('pagu');

        return $this->render('list', [
            'pagusubunit' => $pagusubunit,
            'jlh_pagu' => $jlh_pagu,
            ]);
    }

    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPaguProgram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaPaguProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @return TaPaguProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog)
    {
        if (($model = TaPaguProgram::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Prog' => $Kd_Prog])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}