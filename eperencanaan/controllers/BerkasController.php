<?php

namespace eperencanaan\controllers;

use Yii;
use common\models\TaMusrenbangKelurahanMedia;
use common\models\search\TaMusrenbangKelurahanMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use eperencanaan\models\UploadForm;


/**
 * BerkasController implements the CRUD actions for TaMusrenbangKelurahanMedia model.
 */
class BerkasController extends Controller
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
     * Lists all TaMusrenbangKelurahanMedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaMusrenbangKelurahanMediaSearch();
		$id = Yii::$app->request->get('id');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
		$model = new UploadForm();
		if (Yii::$app->request->isPost) {
			//if ($model->validate()) 
			//{
				//$id = Yii::$app->request->get('id');
				$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
				$model->upload($id);
				if (isset($_POST['selesai']))
					return $this->redirect(["lihat-usulan"]);	
			//}
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKelurahanMedia model.
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
     * Creates a new TaMusrenbangKelurahanMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaMusrenbangKelurahanMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Kd_Media]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKelurahanMedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Kd_Media]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbangKelurahanMedia model.
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
     * Finds the TaMusrenbangKelurahanMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaMusrenbangKelurahanMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaMusrenbangKelurahanMedia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionSampleDownload($filename)
	{
		ob_clean();
		\Yii::$app->response->sendFile($filename)->send();
	}
}
