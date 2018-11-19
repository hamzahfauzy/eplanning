<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\Kegiatans;
use emusrenbang\models\KegiatansSearch;
use emusrenbang\models\Programs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KegiatansController implements the CRUD actions for Kegiatans model.
 */
class KegiatansController extends Controller
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
     * Lists all Kegiatans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KegiatansSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kegiatans model.
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
     * Creates a new Kegiatans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kegiatans();
        //$kode_skpd="1.20.04";
        $dataProgram = $this->getProgram();
        if ($model->load(Yii::$app->request->post())) {
        		$timestamp=date('Y-m-d h:i:s');
        		$model->created_at=$timestamp;
        		$model->updated_at=0;
        		$model->deleted_at=0;
        		$model->aktif='1';
        		if($model->save()){
        			return $this->redirect(['view', 'id' => $model->id]);
        		}

        } else {
            return $this->render('create', [
                'model' => $model,
                'dataProgram' => $dataProgram,
            ]);
        }
    }

    public function getNamaProgram($id){
    		$model=Programs::find()->where(['id'=>$id])->one();
    		if($model !== null){
    			$program=$model->nama_program;
    		}else{
    			$program="";
    		}
    		return $program;
    }

    /**
    * Call active data Program
    * return array all data
    */
    private function getProgram() {
	    	$dataProgram = Programs::findAll(['aktif'=>'1']);
			$i=1;
	    	foreach($dataProgram as $data){
	    		$d[$data['id']]=$data['nama_program'];
	    		$i=$i+1;
	    	}
	    	return $d;
    }

    public function actionListkegiatan($id)
    {
        $cookies = Yii::$app->response->cookies;
        //if(isset($cookies['kode_kegiatan'])){
            $cookies->remove('kode_kegiatan');
        //}
        unset($cookies['kode_kegiatan']);
        Yii::$app->response->cookies->remove('kode_kegiatan');
        $cookies->add(new \yii\web\Cookie([
            'name' => 'id_program',
            'value' => $id,
        ]));
        $model = Kegiatans::find()->where(['kode_program'=>$id])->all();
        $d="<option>Pilih Kegiatan Prioritas</option>";
        if($model !== null){
            foreach($model as $data){
                $d.="<option value=$data[id]>$data[nama_kegiatan]</option>";
            }
        }
        echo $d;
    }

    /**
     * Updates an existing Kegiatans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $kode_skpd="1.20.04";
        $dataProgram = $this->getProgram($kode_skpd);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataProgram' => $dataProgram,
            ]);
        }
    }

    /**
     * Deletes an existing Kegiatans model.
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
     * Finds the Kegiatans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kegiatans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Kegiatans::find()->select('kegiatans.*, programs.nama_program')->where(['kegiatans.id'=>$id])->leftJoin('programs','programs.id=kegiatans.kode_program')->one();

        if ($model  !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
