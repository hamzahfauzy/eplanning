<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaPokirMedia;
use eperencanaan\models\TaPokirAcara;
use eperencanaan\models\search\TaPokirMediaSearch;
use yii\web\Controller;	
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\RefMedia;


/**
 * TaPokirMediaController implements the CRUD actions for TaPokirMedia model.
 */
class TaPokirMediaController extends Controller
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


    public function Kd_User() {
        $user = Yii::$app->user->identity->id;
        return $user;
    }

    /**
     * Lists all TaPokirMedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPokirMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPokirMedia model.
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
     * Creates a new TaPokirMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPokirMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Kd_User]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPokirMedia model.
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
     * Deletes an existing TaPokirMedia model.
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
     * Finds the TaPokirMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaPokirMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaPokirMedia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnduh() {
        //print ("a");exit;
        // $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $Posisi['Kd_User'] = $this->Kd_User();
        $acara = TaPokirAcara::findOne($Posisi);
		//$Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        // print_r($acara);die();
        // $searchModel = new \eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch();
        // $dataProvider = $searchModel->ZULsearch(Yii::$app->request->queryParams, $ZULUser);
        if ($acara == null || $acara->Waktu_Mulai == 0)
            return $this->redirect(['pokir/index']);
			//return $this->redirect(['index']);

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

                    $user = RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaPokirMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Foto";
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $id = 0;
                foreach ($model->absenFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $model->nameAbsen[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaPokirMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Absensi";
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $id = 0;
                foreach ($model->videoFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $model->nameVideo[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaPokirMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Video";
                    if ($TaFLM->save(false)) {
                        
                    }
                    $id++;
                }
                $user = RefMedia::findOne(['Nm_Media' => $model->nameBerita]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaPokirMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Berita Acara";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->namePi]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaMusrenbangKecamatanMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Bukti Undangan";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->nameTandaTerima]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\TaPokirMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Tanda Terima";
                    if ($TaFLM->save(false)) {
                        
                    }
                }
            }
        
        }
        
        return $this->redirect(['pokir/dokumen']);
    }

    public function actionHapusBerkas($id){
        
        $model = TaPokirMedia::findOne(['Kd_Media' => $id])->delete();
        unlink(Yii::getAlias('@webroot').'/data/'.\common\models\RefMedia::findOne(['Kd_Media' => $id])->Nm_Media);
        return $this->redirect(['pokir/dokumen']);
    }
}
