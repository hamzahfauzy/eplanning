<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\LevelAssignment;
use emusrenbang\models\LevelAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\LevelFungsi;
use emusrenbang\models\LevelAplikasi;
use emusrenbang\models\User;

/**
 * LevelAssignmentController implements the CRUD actions for LevelAssignment model.
 */
class LevelAssignmentController extends Controller
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
     * Lists all LevelAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LevelAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getLevelaplikasi(){
        $model=LevelAplikasi::find()->all();
        foreach($model as $d){
            $data[$d['id']]=$d['aplikasi'];
        }
        return $data;
    }

    public function getLevelFungsi(){
        $model=LevelFungsi::find()->all();
        foreach($model as $d){
            $data[$d['id']]=$d['fungsi'];
        }
        return $data;
    }

    /**
     * Displays a single LevelAssignment model.
     * @param string $username
     * @param integer $id_level_aplikasi
     * @param integer $id_level_fungsi
     * @return mixed
     */
    public function actionView($username, $id_level_aplikasi, $id_level_fungsi)
    {
        return $this->render('view', [
            'model' => $this->findModel($username, $id_level_aplikasi, $id_level_fungsi),
        ]);
    }

    /**
     * Creates a new LevelAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGetlevel($id)
    {
        $this->layout='blank';
        $model=LevelAssignment::find()->where(['username'=>$id])->all();
        $i=1;
        foreach($model as $d){
           $s[$i]="d".$d['id_level_aplikasi'].$d['id_level_fungsi'];
            $i=$i+1;
        }
        if(isset($s)){
            echo json_encode($s);
        }else{
            echo '';
        }
    }

    public function actionCreate()
    {
        $model = new LevelAssignment();

        if ($model->load(Yii::$app->request->post())) {
            $sd="delete from level_assignment where username='$model->username'";
            $qd=Yii::$app->db->createCommand($sd)->execute();
            foreach($_POST['LevelAssignment'] as $k=>$data){
                if($k!=='username'){
                    $dt=explode('.', $k);

                    $sql="insert into level_assignment(username, id_level_aplikasi, id_level_fungsi)values('$model->username', '$dt[1]', '$dt[2]')";
                    $query=Yii::$app->db->createCommand($sql)->execute();

                }
            }
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function getUser(){
        $model=User::find()->all();
        foreach($model as $d){
            $data[$d['username']]=$d['nama_lengkap'];
        }
        return $data;
    }

    /**
     * Updates an existing LevelAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $username
     * @param integer $id_level_aplikasi
     * @param integer $id_level_fungsi
     * @return mixed
     */
    public function actionUpdate($username, $id_level_aplikasi, $id_level_fungsi)
    {
        $model = $this->findModel($username, $id_level_aplikasi, $id_level_fungsi);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'username' => $model->username, 'id_level_aplikasi' => $model->id_level_aplikasi, 'id_level_fungsi' => $model->id_level_fungsi]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LevelAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $username
     * @param integer $id_level_aplikasi
     * @param integer $id_level_fungsi
     * @return mixed
     */
    public function actionDelete($username, $id_level_aplikasi, $id_level_fungsi)
    {
        $this->findModel($username, $id_level_aplikasi, $id_level_fungsi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LevelAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username
     * @param integer $id_level_aplikasi
     * @param integer $id_level_fungsi
     * @return LevelAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($username, $id_level_aplikasi, $id_level_fungsi)
    {
        if (($model = LevelAssignment::findOne(['username' => $username, 'id_level_aplikasi' => $id_level_aplikasi, 'id_level_fungsi' => $id_level_fungsi])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
