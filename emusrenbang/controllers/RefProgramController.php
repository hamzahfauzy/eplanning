<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\RefProgram;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\search\RefProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\ProgramNasional;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefKamusProgram;
use yii\helpers\ArrayHelper;

/**
 * RefProgramController implements the CRUD actions for RefProgram model.
 */
class RefProgramController extends Controller
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
     * Lists all RefProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
		
        $data_urusan = ArrayHelper::map(
                                RefUrusan::find()
                                ->all(),
                              'Kd_Urusan',
                              'Nm_Urusan'
							  );

		//$ref_bidang = RefBidang::find()->all();
        $data_bidang = ArrayHelper::map(
                                RefBidang::find()
								//->where(["Kd_Urusan=>$Kd_Urusan])
                                ->all(),
								'Nm_Bidang','Kd_Bidang',
								'Kd_Urusan'
                            );
		
		 $data_bidang1 = ArrayHelper::map(
                                RefBidang::find()
								->andwhere(['IN', 'Kd_Urusan',['1','2','3','4']])
								//->Where (["Kd_Urusan"=>*.*])
                                ->all(),
								//$c='Kd_Urusan',
							  'Kd_Bidang',
                              'Nm_Bidang'
							 // 'Kd_Urusan'
                            ); 
			$data_unit = ArrayHelper::map(
                                RefUnit::find()
								//->andwhere(['IN', 'Kd_Urusan',['1','2','3','4']])
								//->Where (["Kd_Urusan"=>*.*])
                                ->all(),
								//$c='Kd_Urusan',
							  'Kd_Unit',
                              'Nm_Unit'
							 // 'Kd_Urusan'
                            );
				$data_sub = ArrayHelper::map(
                                RefSubUnit::find()
								//->andwhere(['IN', 'Kd_Urusan',['1','2','3','4']])
								//->Where (["Kd_Unit"=>*.*])
                                ->all(),
								//$c='Kd_Urusan',
							  'Kd_Sub',
                              'Nm_Sub_Unit'		);		
	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data_urusan' => $data_urusan,
            'data_bidang' => $data_bidang,
			'data_bidang1' => $data_bidang1,
			'data_unit' => $data_unit,
			'data_sub' => $data_sub,
        ]);
    }

    /**
     * Displays a single RefProgram model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog),
        ]);
    }

    /**
     * Creates a new RefProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new RefProgram();

    //     if ($model->load(Yii::$app->request->post())) {
    //     	$RefKamusProgram=RefKamusProgram::find()->where(['Kd_Program'=>$model->Kd_Prog])->one();
    //     	$model->Ket_Program=$RefKamusProgram->Nm_Program;
    //     	$cekProgram=RefProgram::find()->where(['Kd_urusan'=>$model->Kd_Urusan, 'Kd_Bidang'=>$model->Kd_Bidang,
    //     		'Kd_Prog' => $model->Kd_Prog])->one();
    //     	if(!empty($cekProgram['Kd_Prog'])){
    //     		return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang,
    //         			'Kd_Prog' => $model->Kd_Prog]);
    //     	}else{
    //     		$tahun=date('Y');
    //     		$dr=date('Y-m-d h:i:s');
    //     		$username=Yii::$app->user->identity->username;
    //     		if($model->save()) {
    //     			$sql="insert into program_nasional(id_prioritas, id_nawacita, id_urusan, id_misi, urusan, bidang,
    //     				id_program, created_at, updated_at, username, tahun)values('$model->id_prioritas',
    //     				'$model->id_nawacita', '$model->id_urusan', '$model->id_misi', '$model->Kd_Urusan',
    //     				'$model->Kd_Bidang', '$model->Kd_Prog', '$dr', '$dr', '$username', '$tahun')";
    //         Yii::$app->db->createCommand($sql)->execute();
    //         		return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang,
    //         			'Kd_Prog' => $model->Kd_Prog]);
    //    			}
    //    		}
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionCreate()
    {
        $model = new RefProgram();

        $data_urusan =  ArrayHelper::map(RefUrusan::find()->all(),'Kd_Urusan','Nm_Urusan');
        $kamus_program =  ArrayHelper::map(RefKamusProgram::find()->orderby('Nm_Program')->all(),'Kd_Program','Nm_Program');
        $data_bidang = [];
		$data_unit = [];
        $data_sub = [];
        if ($model->load(Yii::$app->request->post())) {
            if($model->save(false)){
                return $this->redirect(['index']);
            }
        }
        else{
            return $this->render('create_form', [
                'model' => $model,
                'data_urusan' => $data_urusan,
                'data_bidang' => $data_bidang,
                'data_sub' => $data_sub,
				'data_unit' => $data_unit,
                'kamus_program' => $kamus_program,
            ]);
        }

        
    }
	

    public function actionGetBidang($Kd_Urusan)
    {
        $model = RefBidang::findall(['Kd_Urusan' => $Kd_Urusan]);

        echo "
                <option value=''>-Pilih Bidang-</option>
            ";
        foreach ($model as $key => $value) {
            echo "
                <option value='".$value->Kd_Bidang."'>".$value->Nm_Bidang."</option>
            ";
        }
    }
    public function actionGetUnit($Kd_Urusan,$Kd_Bidang)
    {
        $model = RefUnit::findall(['Kd_Urusan' => $Kd_Urusan,'Kd_Bidang'=>$Kd_Bidang]);

        echo "
                <option value=''>-Pilih Unit-</option>
            ";
        foreach ($model as $key => $value) {
            echo "
                <option value='".$value->Kd_Unit."'>".$value->Nm_Unit."</option>
            ";
        }
    }

    public function actionGetSub($Kd_Urusan,$Kd_Bidang,$Kd_Unit)
    {
        $model = RefSubUnit::findall(['Kd_Urusan' => $Kd_Urusan,'Kd_Bidang'=>$Kd_Bidang,'Kd_Unit' => $Kd_Unit]);

        echo "
                <option value=''>-Pilih Sub Unit-</option>
            ";
        foreach ($model as $key => $value) {
            echo "
                <option value='".$value->Kd_Sub."'>".$value->Nm_Sub_Unit."</option>
            ";
        }
    }
	
    public function actionGetKdProg($Kd_Urusan, $Kd_Bidang)
    {
        $max_kd=RefProgram::find()
                ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
                ->max('Kd_Prog');
        $Kd_Prog = $max_kd + 1;

        echo $Kd_Prog;
    }

    public function actionCreatewajib()
    {
        $model = new RefProgram();

        if ($model->load(Yii::$app->request->post())){
        	$RefKamusProgram=RefKamusProgram::find()->where(['Kd_Program'=>$model->Kd_Prog])->one();
        	$model->Ket_Program=$RefKamusProgram->Nm_Program;
        	$cekProgram=RefProgram::find()->where(['Kd_urusan'=>$model->Kd_Urusan, 'Kd_Bidang'=>$model->Kd_Bidang,
        		'Kd_Prog' => $model->Kd_Prog])->one();
        	if(!empty($cekProgram['Kd_Prog'])){
        		return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang,
            			'Kd_Prog' => $model->Kd_Prog]);
        	}else{
        		if($model->save()) {
            		return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang,
            			'Kd_Prog' => $model->Kd_Prog]);
       			}
       		}
        } else {
            return $this->render('createwajib', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateskpd()
    {
        $model = new RefProgram();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]);
        } else {
            return $this->render('createskpd', [
                'model' => $model,
            ]);
        }
    }

    public function actionProgramnas($kdurusan, $kdbidang, $urusan, $prioritas, $nawacita, $misi, $kdprog){
        $this->layout='blank';
        $model=new ProgramNasional();
        $tahun=date('Y');
        $model->id_prioritas=$prioritas;
        $model->id_nawacita=$nawacita;
        $model->id_urusan=$urusan;
        $model->id_misi=$misi;
        $model->urusan=$kdurusan;
        $model->bidang=$kdbidang;
        $model->id_program=$kdprog;
        $model->tahun=$tahun;
        $model->created_at=date('Y-m-d h:i:s');
        $model->updated_at=date('Y-m-d h:i:s');
        $model->username=Yii::$app->user->identity->username;
        $cek=$model->find()->where(['id_prioritas'=>$prioritas, 'id_nawacita'=>$nawacita, 'id_urusan'=>$urusan, 'id_misi'=>$misi, 'urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog, 'tahun'=>$tahun])->one();
        if(!isset($cek->id_program)){
            $model->save();
        }
    }

    public function actionTambah($kdurusan, $kdbidang, $urusan, $prioritas, $nawacita, $misi)
    {
        $model = new RefProgram();

        $model->Kd_Urusan=$kdurusan;
        $model->Kd_Bidang=$kdbidang;
        $fk=$model->find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang])->orderBy(['Kd_Prog'=>SORT_DESC])->one();
        $kp=$fk->Kd_Prog+1;
        $tahun=date('Y');
        $dr=date('Y-m-d h:i:s');
        $username=Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $sql="insert into program_nasional(id_prioritas, id_nawacita, id_urusan, id_misi, urusan, bidang, id_program, created_at, updated_at, username, tahun)values('$prioritas', '$nawacita', '$urusan', '$misi', '$kdurusan', '$kdbidang', '$model->Kd_Prog', '$dr', '$dr', '$username', '$tahun')";
            Yii::$app->db->createCommand($sql)->execute();
            return $this->redirect(['index']);
        } else {
            return $this->render('createprogram', [
                'model' => $model,
                'kp' => $kp,
            ]);
        }
    }

    public function actionGetid($name){
        $this->layout='blank';
        $model=RefProgram::find()->where(['Ket_Program'=>$name])->one();
        return $model->Kd_Prog;
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

    public function actionListprogram($urusan, $bidang)
    {
        $this->layout='blank';
        $model=RefProgram::find()->select('*')->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang])->all();
        echo "<option value='0'>Pilih Program Lainnya</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Prog]'>$d[Ket_Program]</option>";
        }
    }

    public function actionListbidang($urusan)
    {
        $this->layout='blank';
        $model=RefBidang::find()->select('*')->where(['Kd_Urusan'=>$urusan])->all();
            echo "<option>Pilih Sektor</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Bidang]'>$d[Nm_Bidang]</option>";
        }
    }

    public function actionListunit($urusan, $bidang)
    {
        $this->layout='blank';
        $model=RefUnit::find()->select('*')->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang])->all();
            echo "<option>Pilih Unit</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Unit]'>$d[Nm_Unit]</option>";
        }
    }
	
	public function actionListsub($urusan, $bidang, $unit)
    {
        $this->layout='blank';
        $model=RefSubUnit::find()->select('*')->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Unit'=>$unit])->all();
            echo "<option>Pilih Sub Unit</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Sub]'>$d[Nm_Sub_Unit]</option>";
        }
    }

    /**
     * Updates an existing RefProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog);
        // $model = new RefProgram();

        $data_urusan =  ArrayHelper::map(RefUrusan::find()->all(),'Kd_Urusan','Nm_Urusan');
        $kamus_program =  ArrayHelper::map(RefKamusProgram::find()->orderby('Nm_Program')->all(),'Nm_Program','Nm_Program');
        $data_bidang = []; // ArrayHelper::map(RefBidang::find()->all(),'Kd_Bidang','Nm_Bidang');
        $data_unit =  []; // ArrayHelper::map(RefUnit::find()->all(),'Kd_Unit','Nm_Unit');
        $data_sub = []; // ArrayHelper::map(RefSubUnit::find()->all(),'Kd_Sub','Nm_Sub_Unit');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]);
        } else {
            return $this->render('create_form', [
                'model' => $model,
                'data_urusan' => $data_urusan,
                'data_bidang' => $data_bidang,
                'data_unit' => $data_unit,
                'data_sub' => $data_sub,
                'kamus_program' => $kamus_program,
            ]);
        }

        // $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog);


        // $kp=$model->Kd_Prog;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //         'kp' => $kp,
        //     ]);
        // }
    }

    /**
     * Deletes an existing RefProgram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @return RefProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog)
    {
        if (($model = RefProgram::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
