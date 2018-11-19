<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\PrioritasNasionalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\Nawacita;

/**
 * PrioritasNasionalController implements the CRUD actions for PrioritasNasional model.
 */
class PrioritasNasionalController extends Controller
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
     * Lists all PrioritasNasional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrioritasNasionalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PrioritasNasional model.
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
     * Creates a new PrioritasNasional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PrioritasNasional();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function getAllNawacita()
    {
    		$model = Nawacita::find()->orderBy(['nawacita'=>'ASC'])->all();
    		if($model !== null)
    		{
    		    $d=array();
    			foreach($model as $data){
    				$d[$data['id']]=$data['nawacita'];
    			}
    			return $d;
    		}
    }

    public function getNameNawacita($id)
    {
    		$model = Nawacita::find()->where(['id'=>$id])->one();
    		if($model!== null)
    		{
    			return $model->nawacita;
    		}
    }

    /**
     * Updates an existing PrioritasNasional model.
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
     * Deletes an existing PrioritasNasional model.
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
     * Finds the PrioritasNasional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrioritasNasional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrioritasNasional::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList()
    {

        $sql = 'SELECT pn.prioritas_nasional,nawacita FROM prioritas_nasional pn INNER JOIN nawacita n ON n.id=pn.id_nawacita';
        $model=Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('list', [
            'model'   => $model
        ]);
    }
}