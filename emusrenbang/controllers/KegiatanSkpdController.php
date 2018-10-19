<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\KegiatanSkpd;
use app\models\KegiatanSkpdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\RefKegiatan;
use emusrenbang\models\TaKegiatan;
use emusrenbang\models\RefUnit;
use yii\helpers\ArrayHelper;

/**
 * KegiatanSkpdController implements the CRUD actions for KegiatanSkpd model.
 */
class KegiatanSkpdController extends Controller
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

	public function beforeAction($action)
    {
    	if(!parent::beforeAction($action)){
    		return false;
    	}

    	if(!Yii::$app->user->isGuest){
    		if(Yii::$app->session['userSessionTimeout'] < time()){
    			$cookies = Yii::$app->response->cookies;
    			unset($cookies['limit']);
    			$this->redirect(['site/lout']);
    			return false;
    		}else{
    			Yii::$app->session->set('userSessionTimeout', time() + (Yii::$app->params['sessionTimeoutSeconds']));

    			return true;
    		}
    	}else{
    		$this->redirect(['site/lout']);
    		return false;
    	}
    }

    /*public function init(){
    	if(!isset(Yii::$app->session['userSessionTimeout'])){
    		return $this->redirect(['site/lout']);
    	}
    }*/



    /**
     * Lists all KegiatanSkpd models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new KegiatanSkpdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        return $this->redirect(['create']);
    }

     public function actionLaporan()
	{
		$model = new RefUnit();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataSkpd=$model->find()->all();
        foreach($dataSkpd as $d){
            $urusan=$d['Kd_Urusan'];
            $bidang=$d['Kd_Bidang'];
            $unit=$d['Kd_Unit'];
            $data[$urusan.'-'.$bidang.'-'.$unit]=$d['Nm_Unit'];
        }
		$dataSkpd=ArrayHelper::map(RefUnit::find()->asArray()->all(), 'Kd_Unit', 'Nm_Unit');
		//$dataTahun=ArrayHelper::map(RefUnit::find()->asArray()->all(), 'tahun','tahun');
		$dataTahun=["1"=>'2016',"2"=>'2017'];
		$tahun=["tahun"=>"thn"];
        return $this->render('laporan', [
            'model' => $model,
			'dataSkpd'=>$data,
			'dataTahun'=>$dataTahun,
			'tahun'=>$tahun,
            //'dataProvider' => $dataProvider,
        ]);


	}

    public function actionMonitor()
    {
    	$this->layout="modal";
        $model=new TaKegiatan();
        $username=Yii::$app->user->identity->username;
        $modelUnit=RefUnit::find()->leftJoin('level_unit', 'level_unit.Kd_Urusan=Ref_Unit.Kd_Urusan and level_unit.Kd_Bidang=Ref_Unit.Kd_Bidang and level_unit.Kd_Unit=Ref_Unit.Kd_Unit')
            ->select(['Ref_Unit.*'])->where(['level_unit.username'=>$username])->all();
       if ($model->load(Yii::$app->request->post())){

            $d=explode("-", $model->Kd_Unit);
            $urusan=$d[0];
            $bidang=$d[1];
            $unit=$d[2];
            $tahun=date('Y');
            $modelTa=TaKegiatan::find()
                ->select(['*'])
                ->leftJoin('Ref_Urusan', 'Ref_Urusan.Kd_Urusan=Ta_Kegiatan.Kd_Urusan')
                ->leftJoin('Ref_Bidang', 'Ref_Bidang.Kd_Urusan=Ta_Kegiatan.Kd_Urusan and Ref_Bidang.Kd_Bidang=Ta_Kegiatan.Kd_Bidang')
                ->leftJoin('Ref_Program', 'Ref_Program.Kd_Urusan=Ta_Kegiatan.Kd_Urusan and Ref_Program.Kd_Bidang=Ta_Kegiatan.Kd_Bidang and Ref_Program.Kd_Prog=Ta_Kegiatan.Kd_Prog')
                ->leftJoin('Ref_Kegiatan', 'Ref_Kegiatan.Kd_Urusan=Ta_Kegiatan.Kd_Urusan and Ref_Kegiatan.Kd_Bidang=Ta_Kegiatan.Kd_Bidang and Ref_Kegiatan.Kd_Prog=Ta_Kegiatan.Kd_Prog and Ref_Kegiatan.Kd_Keg=Ta_Kegiatan.Kd_Keg')
                ->where(['Ta_Kegiatan.Kd_Urusan'=>$urusan, 'Ta_Kegiatan.Kd_Bidang'=>$bidang, 'Ta_Kegiatan.Kd_Unit'=>$unit])
                ->all();
                foreach($_POST as $post){
                    if(is_array($post)){
                        if(isset($post['verifikasi'])){
                            foreach($post['verifikasi'] as $prog=>$v1){
                                foreach($v1 as $keg=>$v2){
                                   $val=$v2[0];
                                    $sql="update Ta_Kegiatan set Status='$val' where Tahun='$tahun' and Kd_Urusan='$urusan' and Kd_Bidang='$bidang' and Kd_Unit='$unit' and Kd_Prog='$prog' and Kd_Keg='$keg'";
                                    Yii::$app->db->createCommand($sql)->execute();
                                  }
                                }
                        }
                    }
                }

        }else{
            $modelTa=0;
        }
        return $this->render('monitoring', [
            'model'=>$model,
            'modelUnit'=>$modelUnit,
            'modelTa' => $modelTa,
        ]);
    }

    /**
     * Displays a single KegiatanSkpd model.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @return mixed
     */
    public function actionView($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan)
    {
        return $this->render('view', [
            'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan),
        ]);
    }

    /**
     * Creates a new KegiatanSkpd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KegiatanSkpd();
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
          	return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan]);
    	} else {
    		return $this->render('create', [
            	'model' => $model,
            ]);
    	}
    }

    public function actionTambah($kdurusan, $kdbidang, $kdprog, $kdkeg)
    {
        $this->layout='blank';
        $model = new KegiatanSkpd();
        $tahun=date('Y');
        $model->tahun=date('Y');
        $model->Kd_Urusan=$kdurusan;
        $model->Kd_Bidang=$kdbidang;
        $model->Kd_Program=$kdprog;
        $model->Kd_Kegiatan=$kdkeg;
        $model->Kd_Unit=Yii::$app->user->identity->id_skpd;
        $dt=date('Y-m-d h:i:s');
        $model->created_at=$dt;
        $model->updated_at=$dt;
        $model->username=Yii::$app->user->identity->username;
        $cek=$model->find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang, 'Kd_Program'=>$kdprog, 'Kd_Kegiatan'=>$kdkeg, 'tahun'=>$tahun])->one();
        if(!isset($cek->Kd_Urusan)){
            if(!empty($kdurusan)){
                $model->save();
            }
        }
    }

    public function actionTambahref($kdurusan, $kdbidang, $kdprog)
    {
        $model=new RefKegiatan();
        $model->Kd_Urusan=$kdurusan;
        $model->Kd_Bidang=$kdbidang;
        $model->Kd_Prog=$kdprog;
        $kdunit=Yii::$app->user->identity->id_skpd;
        $username=Yii::$app->user->identity->username;
        $fk=$model->find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang, 'Kd_Prog'=>$kdprog])->orderBy(['Kd_Keg'=>SORT_DESC])->one();
        if(empty($fk->Kd_Keg)){
        	$kp=1;
        }else{
        	$kp=$fk->Kd_Keg+1;
        }
        //$kp=$fk->Kd_Keg+1;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tahun=date('Y');
            $kdunit=Yii::$app->user->identity->id_skpd;
            $username=Yii::$app->user->identity->username;
            $dt=date('Y-m-d h:i:s');
            $kdkeg=$model->Kd_Keg;
            $sql="insert into kegiatan_skpd(tahun, Kd_Urusan, Kd_Bidang, Kd_Unit, Kd_Program, Kd_Kegiatan, created_at, updated_at, username)values('$tahun', '$kdurusan', '$kdbidang', '$kdunit', '$kdprog', '$kdkeg', '$dt', '$dt', '$username')";
            $query=Yii::$app->db->createCommand($sql)->execute();
            return $this->redirect(['create']);
        } else {
            return $this->render('createrf', [
                'model' => $model,
                'kp' => $kp,
            ]);
        }
    }

    public function actionGetid($name)
    {
        $this->layout='blank';
        $model=RefKegiatan::find()->where(['Ket_Kegiatan'=>$name])->one();
        return $model->Kd_Keg;
    }

    public function actionListkegiatan($urusan, $bidang, $prog)
    {
        $this->layout='blank';
        $model=RefKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$prog])->all();
        echo "<option value=0>Pilih Kegiatan Pembangunan</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Keg]'>$d[Ket_Kegiatan]</option>";
        }
    }

    /**
     * Updates an existing KegiatanSkpd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @return mixed
     */
    public function actionUpdate($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan)
    {
        $model = $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KegiatanSkpd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan)
    {
        $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KegiatanSkpd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @return KegiatanSkpd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan)
    {
        if (($model = KegiatanSkpd::findOne(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Program' => $Kd_Program, 'Kd_Kegiatan' => $Kd_Kegiatan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
