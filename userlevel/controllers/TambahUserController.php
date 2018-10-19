<?php

namespace userlevel\controllers;

use Yii;
use userlevel\models\User;
use userlevel\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use userlevel\models\SignupForm;
use userlevel\models\RegistrasiForm;
use userlevel\models\TU3Form;
use userlevel\models\TU4Form;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use userlevel\models\TaUserKelompok;
use userlevel\models\TaUserLevel;
use userlevel\models\TaUserUnit;
use common\models\TaUserDapil;
use common\models\RefLevel;
use common\models\RefJenisUser;
use common\models\Referensi;
use common\models\AuthAssignment;
use common\models\RefUrusan;
use common\models\RefDapil;
use eperencanaan\models\RefFraksiDprd;
use common\models\RefKomisiDprd;
use yii\db\Query;

/**
 * TambahUserController implements the CRUD actions for User model.
 */
class TambahUserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$DNDataKelompok = Yii::$app->levelcomponent->getKelompok();
    	
    	$DNDataLevel = Yii::$app->levelcomponent->getLevel();
    	if($DNDataLevel['Kd_Level']!=3){
        	$searchModel = new \userlevel\models\searchs\User();
        	
        	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
					
        	return $this->render('index', [
            	'searchModel' => $searchModel,
            	'dataProvider' => $dataProvider,
        	]);
        }
		//print_r($DNDataLevel['Kd_Level']);exit;
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $kec = ArrayHelper::map(RefKecamatan::find()
	        	->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab])
	        	->orderBy(['Nm_Kec' => SORT_ASC])
	            ->all(),'Kd_Kec','Nm_Kec');

        $dapil 	= ArrayHelper::map(RefDapil::find()->all(),'Kd_Dapil', 'Nm_Dapil');
        $fraksi = ArrayHelper::map(RefFraksiDprd::find()->all(),'Kd_Fraksi', 'Nm_Fraksi');
        $komisi = ArrayHelper::map(RefKomisiDprd::find()->all(),'Kd_Komisi', 'Nm_Komisi');
        //$dewan = ArrayHelper::map(RefDewanDprd::find()->all(),'Kd_Dewan', 'Nm_Dewan');

        $jenis_user = ArrayHelper::map(RefJenisUser::find()->all(),'Kd_Jenis_User','Nm_Jenis_User');
        $level 		= ArrayHelper::map(RefLevel::find()->all(),'Kd_Level','Nm_Level');

        $connection = \Yii::$app->db;
        $sql 		= $connection ->createCommand('SELECT CONCAT(Kd_Urusan,".",Kd_Bidang,".",Kd_Unit,".",Kd_Sub) AS subunits, Nm_Sub_Unit FROM Ref_Sub_Unit');
				$query 		= $sql->queryAll();
        $dataSkpd 	= ArrayHelper::map($query, 'subunits', 'Nm_Sub_Unit');

        $Kd_Prov  = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab   = Yii::$app->pengaturan->Kolom('Kd_Kab');
        $Tahun    = Yii::$app->pengaturan->Kolom('Tahun');

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			if(isset($_POST['selesai'])) {
				Yii::$app->session->setFlash('contactFormSubmitted');
				if ($model->getAkses() == 'Operator_Skpd') {
					if (($skpd = TaUserUnit::findOne(['Kd_User' => $model->getId()])) == null) {
						$skpd = new TaUserUnit();
						$skpd->Kd_User = $model->getId();

						$arraySkpd = $model->getSkpd();
        				$var = explode(".", $arraySkpd);

						$skpd->Kd_Urusan = $var[0];
						$skpd->Kd_Bidang = $var[1];
						$skpd->Kd_Unit = $var[2];
						$skpd->Kd_Sub_Unit = $var[3];
						$skpd->save(false);
					}
				}
				else if ($model->getAkses() == 'Operator_Lingkungan' OR $model->getAkses() == 'Operator_Kelurahan' OR $model->getAkses() == 'Operator_Kecamatan') {
					if (($kelompok = TaUserKelompok::findOne(['Kd_User' => $model->getId()])) == null) {
			            $kelompok = new TaUserKelompok();
			            $kelompok->Kd_User = $model->getId();
			            $kelompok->Kd_Prov = $Kd_Prov;
			            $kelompok->Kd_Kab = $Kd_Kab;
			            $kelompok->Kd_Kec = $model->getKec();
			            $kelompok->Kd_Urut_Kel = $model->getUrutKel();

			            if (!empty($model->getUrutKel())) {
			            	$kelompok->Kd_Urut_Kel = $model->getUrutKel();
				            $modelKel = RefKelurahan::find()
				            			->where([
				            				'Kd_Prov'=>$Kd_Prov, 
				            				'Kd_Kab'=>$Kd_Kab,
														'Kd_Kec'=>$model->getKec(), 
														'Kd_Urut'=>$model->getUrutKel()])
				            			->one();

										$kelompok->Kd_Kel = $modelKel->Kd_Kel;
			            }
			            else {
			            	$kelompok->Kd_Urut_Kel = 0;
										$kelompok->Kd_Kel = 0;
			            }
			            
			            if (!empty($model->getLing())) {
			            	$kelompok->Kd_Lingkungan = $model->getLing();
			            }
			            else {
			            	$kelompok->Kd_Lingkungan = 0;
			            }
			            $kelompok->save(false);
			        }
				}
				else if ($model->getAkses() == 'Operator_Pokir') {
					if (($pokir = TaUserDapil::findOne(['Kd_User' => $model->getId()])) == null) {
						$pokir = new TaUserDapil();
						$pokir->Tahun 		= $Tahun;
						$pokir->Kd_User 	= $model->getId();
						$pokir->Kd_Dapil 	= $model->getDapil();
						$pokir->Kd_Dewan 	= $model->getDewan();
						$pokir->Kd_Komisi 	= $model->getKomisi();
						$pokir->Kd_Fraksi 	= $model->getFraksi();
						
						$pokir->save(false);
					}
				}

				$assign = AuthAssignment::find()->where(['user_id'=>$model->getId()])->one();
				if (($assign = AuthAssignment::findOne(['user_id' => $model->getId()])) == null) {
					$assign = new AuthAssignment();
					$assign->user_id 	= $model->getId();
					$assign->item_name 	= $model->getAkses();
					$assign->created_at = time();
					$assign->save(false);
				}
				
				return $this->redirect(['index']);
			} 
			else {
				return $this->redirect(['isi-asal', 'id' => $model->getId()]);
			}
        } 
        else {
            return $this->render('create', [
                'model' => $model,
                'kec' => $kec,
                'dapil' => $dapil,
                'fraksi' => $fraksi,
                'komisi' => $komisi,
                'jenis_user' => $jenis_user,
                'level' => $level,
                'dataSkpd' => $dataSkpd,
            ]);
        }
    }

    public function actionEdit()
    {
    	$model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signupedit()) {
			if(isset($_POST['selesai'])){
				Yii::$app->session->setFlash('contactFormSubmitted');
				return $this->redirect(['index']);
			}else{
				return $this->redirect(['isi-asal', 'id' => $model->getId()]);
			}
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $searchModel = \userlevel\models\searchs\User::findOne(['id' => $id]);
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('menu-edit', [
                'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $command = Yii::$app->db->createCommand();
        
        $command->delete('Ta_User_Aplikasi', 'Kd_User=:Kd_User', array(':Kd_User'=>$id))->execute();
	
		$command->delete('Ta_User_Kelompok', 'Kd_User=:Kd_User', array(':Kd_User'=>$id))->execute();
		
		$command->delete('Ta_User_Kota', 'Kd_User=:Kd_User', array(':Kd_User'=>$id))->execute();
		
		$command->delete('Ta_User_Level', 'Kd_User=:Kd_User', array(':Kd_User'=>$id))->execute();
		
		$command->delete('Ta_User_Unit', 'Kd_User=:Kd_User', array(':Kd_User'=>$id))->execute();
		
		$command->delete('auth_assignment', 'user_id=:Kd_User', array(':Kd_User'=>$id))->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionAsal()
	{
		$request = Yii::$app->request;
		$obj = $request->post('obj');
		$value = $request->post('value');
		$jenis = $request->post('jenis');
		switch ($obj) {
			case 'prov':
				$data = RefKabupaten::find()->where(['Kd_Prov' => $value[0]])->all();
				$idtable = 'Kd_Kab';
				$nama = 'Nm_Kab';
			break;
			case 'kab':
				$data = RefKecamatan::find()->where(['Kd_Prov' => $value[0]])->andWhere(['Kd_Kab' => $value[1]])->all();
				$idtable = 'Kd_Kec';
				$nama = 'Nm_Kec';
			break;
			case 'kec':
				$data = RefKelurahan::find()->where(['Kd_Prov' => $value[0]])->andWhere(['Kd_Kab' => $value[1]])->andWhere(['Kd_Kec' => $value[2]])
				->all();
				$idtable = 'Kd_Kel';
				$nama = 'Nm_Kel';
				//$data = Village::find()->where([$obj => $value])->all();
			break;
			case 'j_user':
				if ($jenis == 1){
					$data = RefLevel::find()->all();
				}else{
					$data = RefLevel::find()->where(['Kd_Level' => '3'])->all();
				}
				$idtable = 'Kd_Level';
				$nama = 'Nm_Level';
			break;
		}
		$tagOptions = ['prompt' => "=== Select ==="];
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
	}
	
	public function actionIsiAsal(){
		$model = new TU3Form();
		$id = Yii::$app->request->get('id');
		if (($ZULmodel = \userlevel\models\TaUserKelompok::findOne(['Kd_User' => $id])) == null){
			$ZULkec = "Belum diisi";
			$ZULkel = "Belum diisi";
			$ZULlin = "Belum diisi";
			
		}else{
			$ZULkec = isset($ZULmodel->kdKec->Nm_Kec) ? $ZULmodel->kdKec->Nm_Kec : "Belum diisi";
			$ZULkel = isset($ZULmodel->kdKel->Nm_Kel) ? $ZULmodel->kdKel->Nm_Kel : "Belum diisi";
			$ZULlin = isset($ZULmodel->kdKel->Nm_Lingkungan) ? $ZULmodel->kdKel->Nm_Lingkungan : "Belum diisi";;
		}
		if ($model->load(Yii::$app->request->post())) {
			
			
            if ($model->signup($id) == 1){
				if (isset($_POST['lanjut'])){
				//Yii::$app->session->setFlash('contactFormSubmitted');
					return $this->redirect(['isi-hak-akses', 'id' => $id, 'prov' => $model->opt, 'level' => $model->level ]);
					}

				elseif (isset($_POST['pokir'])){
				//Yii::$app->session->setFlash('contactFormSubmitted');
					return $this->redirect(['pokir', 'id' => $id, 'prov' => $model->opt, 'level' => $model->level ]);
					}

				else{
					Yii::$app->session->addFlash('success','Anda telah sukses memasukkan data asal user');
					$this->redirect(['index']);
				}
			}
		}
		
		return $this->render('IsiAsal', [
			'model' => $model,
			'ZULkec' => $ZULkec,
			'ZULkel' => $ZULkel,
			'ZULlin' => $ZULlin
    ]);

	}
	
	public function actionIsiHakAkses()
	{
		$model = new TU4Form();
		$prov = Yii::$app->request->get('prov');
		if ($model->load(Yii::$app->request->post())) {
			$id = Yii::$app->request->get('id');
			if ($model->signup($id)){
				if (isset($_POST['selesai'])){
					return $this->redirect(['index']);
				}else{
					$this->refresh();
				}
			}
				//$this->redirect(['isi-asal']);
				//return $this->refresh();
			
        }
		return $this->render('IsiHakAkses', [
			'model' => $model, 'prov' => $prov
		]);

	}
	
	public function actionSubUnit(){
		$request = Yii::$app->request;
		$value = $request->post('value');
		$refUnit=new RefUnit();
		$kd = $refUnit->getId($value);
		
		//$jenis = $request->post('jenis');
		$tagOptions = ['prompt' => "=== Select ==="];
		return Html::renderSelectOptions([], ArrayHelper::map(RefSubUnit::find()->where(['Kd_Urusan'=> $kd[0]])->
													andWhere(['Kd_Bidang'=> $kd[1]])->andWhere(['Kd_Unit'=> $kd[2]])->all(), 'Nm_Sub_Unit', 'Nm_Sub_Unit'), $tagOptions);
	}

	public function actionPokir(){

		$model = new TaUserDapil();
		$prov = Yii::$app->request->get('prov');

		if ($model->load(Yii::$app->request->post())) {
			$id = Yii::$app->request->get('id');
			if ($model->signup($id)){
				if (isset($_POST['selesai'])){
					return $this->redirect(['index']);
				}else{
					$this->refresh();
				}
			}
				//$this->redirect(['isi-asal']);
				//return $this->refresh();
			
        }
		return $this->render('IsiHakAkses', [
			'model' => $model, 'prov' => $prov
		]);
	}

}
