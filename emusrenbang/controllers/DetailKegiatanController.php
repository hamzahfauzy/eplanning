<?php

namespace backend\controllers;

use Yii;
use emusrenbang\models\DetailKegiatan;
use emusrenbang\models\DetailKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\Formusulan;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\UraianKegiatan;
use emusrenbang\models\Programs;
use emusrenbang\models\Savelog;
use emusrenbang\models\Urusan;
use emusrenbang\models\Misi;
use emusrenbang\models\Sumber;

/**
 * DetailKegiatanController implements the CRUD actions for DetailKegiatan model.
 */
class DetailKegiatanController extends Controller
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
     * Lists all DetailKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailKegiatan model.
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
     * Creates a new DetailKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate($id)
    {
        $model = new DetailKegiatan();
        //tampilkan nama kegiatan di form
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
            ]);
        }
    }*/
    
    public function kegiatan($id)
    {
        $model = Kegiatans::find()->where(['kode_kegiatan'=>$id])->all();
        if($model !== null){
            foreach($model as $data){
                $d[$data['id']]=$data['nama_kegiatan'];
            }
            return $d;
        }else{
            return false;
        }
    }

    public function actionCreate($id)
    {
        $model = new DetailKegiatan();

        if ($model->load(Yii::$app->request->post())) {
            $model->username=Yii::$app->user->username;
            $model->kode_skpd=Yii::$app->user->skpd;
            if($model->save()){
                
                $post=Yii::$app->request->post();
                $p=serialize($post);
                
                $log= new Savelog();
        		$log->save('detail-kegiatan', 'create', $p);
                
                return $this->redirect(['usulan', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
            ]);
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
            foreach($model as $data){
                $d[$data['id']]=$data['misi'];
            }
            return $d;
        }else{
            return false;
        }
    }
    
    public function getAllSumber(){
        $model=Sumber::find()->all();
        $d=array();
        if($model!==null){
            foreach($model as $data){
                $d[$data['sumber']]=$data['sumber'];
            }
            return $d;
        }else{
            return false;
        }
    }
    
    public function actionListdetail($kode_kegiatan)
    { 
        $cookies = Yii::$app->response->cookies;
        //if(isset($cookies['kode_kegiatan'])){
            $cookies->remove('kode_kegiatan');   
        //}
        unset($cookies['kode_kegiatan']);
        Yii::$app->response->cookies->remove('kode_kegiatan');
        $cookies->add(new \yii\web\Cookie([
            'name' => 'kode_kegiatan',
            'value' => $kode_kegiatan,
        ]));
        
        $this->layout='blank';
        $searchModel = new DetailKegiatanSearch();
        $dataProvider = DetailKegiatan::find()->select(['kegiatans.nama_kegiatan', 'detail_kegiatan.*'])
            ->where(['detail_kegiatan.kode_kegiatan'=>$kode_kegiatan])
            ->leftJoin('kegiatans', 'kegiatans.id=detail_kegiatan.kode_kegiatan')->all();
        

        return $this->render('listdetail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function getUraian($kode_kegiatan)
    {
            $dataUraian = UraianKegiatan::find()->where(['kode_kegiatan'=>$kode_kegiatan])->all();  
            return $dataUraian; 
    }
    
    public function actionUsulan()
    {
        $model = new Formusulan();
        $param=Yii::$app->request->queryParams;
        if(isset($param['d'])){
            $program = Programs::findAll(['id_prioritas'=>'','aktif'=>'1']);
            $d=array();
            foreach($program as $data)
            {
                $d[$data['id']]=$data['nama_program'];
            }
            
            return $this->render('formusulanrutin', [
                'model' =>$model,
                'dataprogram' =>$d,
            ]);
        }else{
            $prioritas = PrioritasNasional::find()->all();
            foreach($prioritas as $data){
                $dataprioritas[$data['id']]=$data['prioritas_nasional'];
            }
            return $this->render('formusulan', [
                'model' => $model,
                'dataprioritas' => $dataprioritas,
            ]);
        }
    }
    
    public function actionUsulanrutin()
    {
        $model = new Formusulanrutin();
        $program = Programs::findAll(['id_prioritas'=>'','aktif'=>'1']);
        foreach($program as $data)
        {
            $d[$data['id']]=$data['nama_program'];
        }
        return $this->render('formusulanrutin', [
            'model' =>$model,
            'dataprogram' =>$d,
            ]);
    }
        
    public function getProgram($id)
    {
        $model = Programs::find()->where(['id_prioritas'=>$id])->all();
        if($model !== null){
            foreach($model as $data){
                $d[$data['id']]=$data['nama_program'];
            }
            return $d;
        }else{
            return false;
        }
    }



    /**
     * Updates an existing DetailKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $post=Yii::$app->request->post();
                $p=serialize($post);
                
                $log= new Savelog();
        		$log->save('detail-kegiatan', 'update', $p);
            return $this->redirect(['usulan', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id' => $id,
            ]);
        }
    }

    /**
     * Deletes an existing DetailKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
            $model = $this->findModel($id);
            $model->delete();
            $this->findModels($id);
            
            $p=serialize($model);
                
            $log= new Savelog();
        	$log->save('detail-kegiatan', 'delete', $p);
        return $this->redirect(['usulan']);
    }

    /**
     * Finds the DetailKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModels($id)
    {
            $model = UraianKegiatan::find()->where(['kode_kegiatan'=>$id])->one();
            if($model !== null)
            {
                $model->delete();   
            }else{
                return false;
            }
    }
    
    protected function findModel($id)
    {
        if (($model = DetailKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
