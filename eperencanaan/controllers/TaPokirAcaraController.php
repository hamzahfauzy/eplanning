<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaPokirAcara;
use eperencanaan\models\search\TaPokirAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaPokirAcaraController implements the CRUD actions for TaPokirAcara model.
 */
class TaPokirAcaraController extends Controller
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
     * Lists all TaPokirAcara models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPokirAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPokirAcara model.
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
     * Creates a new TaPokirAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPokirAcara();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Kd_User]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPokirAcara model.
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

	public function actionBeritaAcara($kode) {

        $user = $this->Kd_User();
        $model = TaPokirAcara::findOne($user);
        $usulan = TaMusrenbang::find()->where(['Kd_Asal_Usulan' => 5])->andwhere(['Kd_User' => $user])->count();
		$data=TaPokirAcara::find()->where(['Kd_User' => $user])->all();
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('H:i:s', time());
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = $this->getKota();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('bap', [
                'model' => $model, 
                'usulan' => $usulan,
                'Nm_Pemda' => $Nm_Pemda,
                'Tahun' => $Tahun,
				'data'=>$data,
                ]),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$Nm_Pemda.'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.$waktu
                    ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
	
    /**
     * Deletes an existing TaPokirAcara model.
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
     * Finds the TaPokirAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaPokirAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaPokirAcara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
