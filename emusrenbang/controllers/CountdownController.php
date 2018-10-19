<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\Countdown;
use emusrenbang\models\CountdownSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CountdownController implements the CRUD actions for Countdown model.
 */
class CountdownController extends Controller
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
     * Lists all Countdown models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CountdownSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Countdown model.
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
     * Creates a new Countdown model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Countdown();

        $model->created_at=date('Y-m-d h:i:s');
        $model->updated_at=date('Y-m-d h:i:s');
        $model->username=Yii::$app->user->identity->username;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Countdown model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at=date('Y-m-d h:i:s');
        $model->username=Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Countdown model.
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
     * Finds the Countdown model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Countdown the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Countdown::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionCountajax()
    {
        $model = countdown::find()->all();
        $color=array('#8775a7','#44b6ae','#e35b5a','#578ebe');
        $result=array();
        $i=0;
        foreach ($model as $key => $value) {
            $tmp=array();
            $dateS=new \ DateTime($value->start);
            $dateE=new \ DateTime($value->finish);
            $tmp['title']=$value->keterangan;
            $tmp['start']=$dateS->format('Y-m-d');
            $tmp['end']=$dateE->format('Y-m-d');
            if($i>=count($color)){
                $i=0;
            }
            $tmp['color']=$color[$i];
            $result[]=$tmp;
            $i++;
        }

        return json_encode($result);
    }
}
