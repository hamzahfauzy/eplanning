<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\Programs;
use emusrenbang\models\ProgramsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\Nawacita;
use emusrenbang\models\Urusan;
use emusrenbang\models\Misi;

/**
 * ProgramsController implements the CRUD actions for Programs model.
 */
class ProgramsController extends Controller
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
     * Lists all Programs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Programs model.
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
     * Creates a new Programs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Programs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionListnawacita($id){
    	$this->layout="blank";
    	$cookies = Yii::$app->response->cookies;
        unset($cookies['kode_kegiatan']);
         $cookies->remove('kode_kegiatan');
         Yii::$app->response->cookies->remove('kode_kegiatan');
        $cookies->add(new \yii\web\Cookie([
            'name' => 'id_prioritas',
            'value' => $id,
        ]));
    	$model = Nawacita::find()->leftJoin('prioritas_nasional', 'prioritas_nasional.id_nawacita=nawacita.id')->where(['prioritas_nasional.id'=>$id])->one();
    	return $this->render('listnawacita',[
    		'model' => $model,
    		]);
    }

    public function actionIdnawacita($id){
    	$this->layout="blank";
    	$cookies = Yii::$app->response->cookies;
        unset($cookies['kode_kegiatan']);
         $cookies->remove('kode_kegiatan');
         Yii::$app->response->cookies->remove('kode_kegiatan');
        $cookies->add(new \yii\web\Cookie([
            'name' => 'id_prioritas',
            'value' => $id,
        ]));
    	$model = Nawacita::find()->leftJoin('prioritas_nasional', 'prioritas_nasional.id_nawacita=nawacita.id')->where(['prioritas_nasional.id'=>$id])->one();
    	return $this->render('idnawacita',[
    		'model' => $model,
    		]);
    }


    public function actionListprogram($id)
    {
        $model = Programs::find()->where(['id_prioritas'=>$id])->all();
        if($model !== null){
            $d="<option>Pilih Program Prioritas</option>";
            foreach($model as $data){
                $d.="<option value=$data[id]>$data[nama_program]</option>";
            }
           echo $d;
        }
    }

    public function actionCreaterutin()
    {
        $model = new Programs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create_rutin', [
                'model' => $model,
            ]);
        }
    }

    public function getAllPrioritas(){
    		$model = PrioritasNasional::find()->orderBy(['prioritas_nasional'=>'ASC'])->all();
    		if($model!== null){
    			foreach($model as $data){
    				$d[$data['id']]=$data['prioritas_nasional'];
    			}
    			return $d;
    		}
    }

    public function getAllUrusan(){
        $model = Urusan::find()->all();
        $d=array();
        if($model !== null){
            foreach ($model as $data){
                $d[$data['id']]=$data['urusan'];
            }
            return $d;
        }else{
            return false;
        }
    }

    public function getAllMisi(){
        $model = Misi::find()->all();
        $d=array();
        if($model !== null){
            foreach ($model as $data){
                $d[$data['id']]=$data['misi'];
            }
            return $d;
        }else{
            return false;
        }
    }

    /**
     * Updates an existing Programs model.
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
     * Deletes an existing Programs model.
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
     * Finds the Programs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Programs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Programs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
