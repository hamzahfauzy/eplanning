<?php

namespace userlevel\controllers;

use Yii;
use common\models\TaProfile;
use userlevel\models\TaProfileUpload;
use common\models\search\TaProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TaProfileController implements the CRUD actions for TaProfile model.
 */
class TaProfileController extends Controller
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
     * Lists all TaProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaProfile model.
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
     * Creates a new TaProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        
        $model = $this->findModel($id);
        $modelUpload = new TaProfileUpload();

        if ($model->load(Yii::$app->request->post())) {
        	if (Yii::$app->request->isPost) {
            	$modelUpload->fileFoto = UploadedFile::getInstances($model, 'fileFoto');
                foreach ($modelUpload->fileFoto as $file) {
            		$name=$file->baseName .'_'.$id.'.' . $file->extension;
        			$file->saveAs('uploads/'.$name);
        			$model->Foto=$name;
        		}
                $model->Nip=$_POST['TaProfile']['Nip'];
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->Kd_User]);
                }
        	}
        	
        } else {
            return $this->render('create', [
            	'id' => $id,
                'model' => $model,
            ]);
        }
    }
    
    

    /**
     * Updates an existing TaProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Kd_User]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaProfile model.
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
     * Finds the TaProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaProfile::findOne($id)) !== null) {
            return $model;
        } else {
            return $model = new TaProfile();
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
