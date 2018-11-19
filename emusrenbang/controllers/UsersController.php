<?php

namespace emusrenbang\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Skpds;
use app\models\RefUnit;
use app\models\Levels;
use app\models\RefJabatan;
use app\models\AuthAssignment;
use app\models\RefUrusan;
use app\models\RefBidang;
use app\models\RefSubUnit;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	  'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'view', 'update', 'delete', 'listbidang', 'listunit', 'listsubunit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
        		$password=$model->password_hash;
        		$model->password_hash=Yii::$app->security->generatePasswordHash($password);
        		$model->auth_key = Yii::$app->security->generateRandomString();
        		$model->created_at=time();
        		$model->updated_at=time();
        		//$model->id_subunit=$model->id_subunit;
        		//print_r($model);
        		if($model->save()){

        			$idlevel=$model->id_level;
        			$level = $this->getNamaLevel($idlevel);

        			$sql="insert into auth_assignment (item_name, user_id) values ('$level', '$model->id')";
        			$db=Yii::$app->db;
        			$db->createCommand($sql)->execute();
        			return $this->redirect(['view', 'id' => $model->id]);
        		}else{
        		    return $this->render('create', [
                        'model' => $model,
                    ]);
        		}

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    private function getNamalevel($idlevel)
    {
    		$modul=Levels::findOne($idlevel);
    		$level=$modul->level;
    		return $level;
    }

    public function actionListbidang($urusan)
    {
        $this->layout='blank';
        $model=RefBidang::find()->where(['Kd_Urusan'=>$urusan])->all();
        echo "<option>Pilih Sektor</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Bidang]'>$d[Nm_Bidang]</option>";
        }

    }

    public function actionListsubunit($urusan, $bidang, $skpd)
    {
        $this->layout='blank';
        $model=RefSubUnit::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Unit'=>$skpd])->all();
        echo "<option>Pilih Sub Unit</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Sub]'>$d[Nm_Sub_Unit]</option>";
        }
    }

    public function actionListunit($bidang)
    {
        $this->layout='blank';
        $model=RefUnit::find()->where(['Kd_Bidang'=>$bidang])->all();
        echo "<option>Pilih SKPD</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Unit]'>$d[Nm_Unit]</option>";
        }
    }

    public function getUrusan(){
        $model=RefUrusan::find()->all();
        foreach($model as $d){
            $data[$d['Kd_Urusan']]=$d['Nm_Urusan'];
        }
        return $data;
    }

    public function getSkpd() {
    		$dataSkpd=RefUnit::find()->select('*')->all();
    		foreach($dataSkpd as $data){
    			$d[$data['Kd_Unit']]=$data['Nm_Unit'];
    		}
    		return $d;
    }

    public function getLevel() {
    		$dataLevel=Levels::find()->all();
    		foreach($dataLevel as $data){
    			$d[$data['id']]=$data['level'];
    		}
    		return $d;
    }

    public function getJabatan(){
    		$dataJabatan=RefJabatan::find()->all();
    		$d=array();
    		foreach($dataJabatan as $data){
    			$d[$data['Kd_Jab']]=$data['Nm_Jab'];
    		}
    		return $d;
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
        	$model->id_subunit=$model->id_subunit;
        	if($model->password_hash!==$model->password_hash1){
        		$password=$model->password_hash;
        		$model->password_hash=Yii::$app->security->generatePasswordHash($password);
        		$model->auth_key = Yii::$app->security->generateRandomString();
        	}
        	if($model->save()) {
        		$idlevel=$model->id_level;
        		$level = $this->getNamaLevel($idlevel);
        		$sql="update auth_assignment set item_name='$level' where user_id='$model->id'";
        		$db=Yii::$app->db;
        		$db->createCommand($sql)->execute();

            	return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
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
}
