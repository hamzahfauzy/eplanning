<?php

namespace emusrenbang\controllers;

use Yii;
use app\models\UraianKegiatan;
use app\models\UraianKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Savelog;
use app\models\Satuan;

/**
 * UraianKegiatanController implements the CRUD actions for UraianKegiatan model.
 */
class UraianKegiatanController extends Controller
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
     * Lists all UraianKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UraianKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UraianKegiatan model.
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
     * Creates a new UraianKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new UraianKegiatan();

        $model->username = Yii::$app->user->username;
        $model->kode_skpd = Yii::$app->user->skpd;
        $model->kode_kegiatan = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $post=Yii::$app->request->post();
                $p=serialize($post);

                $log= new Savelog();
        		$log->save('uraian-kegiatan', 'create', $p);

            return $this->redirect(['detail-kegiatan/usulan']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function getAllSatuan(){
        $model=Satuan::find()->all();
        $d=array();
        if($model!== null){
            foreach($model as $data){
                $d[$data['satuan']]=$data['satuan'];
            }
            return $d;
        }else{
            return false;
        }
    }

    /**
     * Updates an existing UraianKegiatan model.
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

            return $this->redirect(['detail-kegiatan/usulan']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UraianKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();
        $post=$model;
        $p=serialize($post);

        $log= new Savelog();
        $log->save('uraian-kegiatan', 'delete', $p);


        return $this->redirect(['detail-kegiatan/usulan']);
    }

    /**
     * Finds the UraianKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UraianKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UraianKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
