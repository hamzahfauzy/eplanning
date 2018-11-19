<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaMusrenbangKelurahanMedia;
use eperencanaan\models\search\TaMusrenbangKelurahanMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * TaMusrenbangKelurahanMediaController implements the CRUD actions for TaMusrenbangKelurahanMedia model.
 */
class TaMusrenbangKelurahanMediaController extends Controller {

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

    public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            'Kd_Kel' => $data['Kd_Kel'],
            'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
                //'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $ZULarray;
    }

    /**
     * Lists all TaMusrenbangKelurahanMedia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaMusrenbangKelurahanMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKelurahanMedia model.
     * @param integer $Kd_Musrenbang_Kelurahan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionView($Kd_Musrenbang_Kelurahan, $Kd_Media) {
        return $this->render('view', [
                    'model' => $this->findModel($Kd_Musrenbang_Kelurahan, $Kd_Media),
        ]);
    }

    /**
     * Creates a new TaMusrenbangKelurahanMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaMusrenbangKelurahanMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Musrenbang_Kelurahan' => $model->Kd_Musrenbang_Kelurahan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKelurahanMedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Musrenbang_Kelurahan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionUpdate($Kd_Musrenbang_Kelurahan, $Kd_Media) {
        $model = $this->findModel($Kd_Musrenbang_Kelurahan, $Kd_Media);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Musrenbang_Kelurahan' => $model->Kd_Musrenbang_Kelurahan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbangKelurahanMedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Musrenbang_Kelurahan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionDelete($Kd_Musrenbang_Kelurahan, $Kd_Media) {
        $this->findModel($Kd_Musrenbang_Kelurahan, $Kd_Media)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbangKelurahanMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Musrenbang_Kelurahan
     * @param integer $Kd_Media
     * @return TaMusrenbangKelurahanMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Musrenbang_Kelurahan, $Kd_Media) {
        if (($model = TaMusrenbangKelurahanMedia::findOne(['Kd_Musrenbang_Kelurahan' => $Kd_Musrenbang_Kelurahan, 'Kd_Media' => $Kd_Media])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnduh() {
        //print ("a");exit;
        $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $ZULUser = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $acara = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne($ZULUser);
        //print_r($acara);exit;
        $searchModel = new \eperencanaan\models\search\TaMusrenbangKelurahanMediaSearch();
        $dataProvider = $searchModel->ZULsearch(Yii::$app->request->queryParams, $ZULUser);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['index']);
        $model = new \eperencanaan\models\UploadForm();
        if (Yii::$app->request->isPost) {
            $model->absenFile = UploadedFile::getInstances($model, 'absenFile');
            $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
            $model->videoFile = UploadedFile::getInstances($model, 'videoFile');
            $model->beritaFile = UploadedFile::getInstance($model, 'beritaFile');
            $model->piFile = UploadedFile::getInstance($model, 'piFile');
            $model->TandaTerimaFile = UploadedFile::getInstance($model, 'TandaTerimaFile');
            if ($model->uploadFoto()) {
                $id = 0;
                foreach ($model->imageFile as $file) {

                    $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Foto";
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $id = 0;
                foreach ($model->absenFile as $file) {

                    $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->nameAbsen[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    //print_r($TaFLM->errors);exit;//print_r($TaFLM);exit;
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Absensi";
                    //print_r($TaFLM);exit;
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $id = 0;
                foreach ($model->videoFile as $file) {

                    $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->nameVideo[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Video";
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->nameBerita]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Berita Acara";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->namePi]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Bukti Undangan";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = \common\models\RefMedia::findOne(['Nm_Media' => $model->nameTandaTerima]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKelurahanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Tanda Terima";
                    if ($TaFLM->save(false)) {
                        
                    }
                }
            }
            
        }
        

        return $this->redirect(['ta-musrenbang-kelurahan/dokumen']);
    }
    
    public function actionHapusBerkas($id){
            unlink(Yii::getAlias('@webroot').'/data/'.\common\models\RefMedia::findOne(['Kd_Media' => $id])->Nm_Media);
		\common\models\RefMedia::findOne(['Kd_Media' => $id])->delete();
		\eperencanaan\models\TaMusrenbangKelurahanMedia::findOne(['Kd_Media' => $id])->delete();
		return $this->redirect(['ta-musrenbang-kelurahan/dokumen']); 
	}

}
