<?php

namespace emusrenbang\controllers;

use Yii;
use eperencanaan\models\TaMusrenbang;
use emusrenbang\models\TaMusrenbangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaMusrenbangController implements the CRUD actions for TaMusrenbang model.
 */
class TaMusrenbangController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all TaMusrenbang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaMusrenbang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing TaMusrenbang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaMusrenbang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TaMusrenbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function Posisi()
    {
        $kelompok     = Yii::$app->levelcomponent->getUnit();
        return [
            'Kd_Urusan'=>$kelompok->Kd_Urusan, 
            'Kd_Bidang'=>$kelompok->Kd_Bidang,
            'Kd_Unit'=>$kelompok->Kd_Unit,
            'Kd_Sub'=>$kelompok->Kd_Sub_Unit,
        ];
    }

    public function actionUsulanLingkungan() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchLingkungan(Yii::$app->request->queryParams);

        return $this->render('usulan-lingkungan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsulanKelurahan() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchKelurahan(Yii::$app->request->queryParams);

        return $this->render('usulan-kelurahan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsulanKecamatan() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchKecamatan(Yii::$app->request->queryParams);

        return $this->render('usulan-kelurahan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsulanPokir() {
        $searchModel = new TaMusrenbangSearch();
        $dataProvider = $searchModel->searchPokir(Yii::$app->request->queryParams);

        return $this->render('usulan-pokir', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKompilasiUsulan() {

        // Kompilasi usulan dan Nomenklatur redaksi usulan menjadi objek rincian belanja

        return $this->redirect(['kompilasi-usulan']);
    }

}
