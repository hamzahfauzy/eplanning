<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\MusrenbangSkpdMedia;
use eperencanaan\models\search\MusrenbangSkpdMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\RefMedia;
use eperencanaan\models\MusrenbangSkpdAcara;

/**
 * TaMusrenbangKecamatanMediaController implements the CRUD actions for TaMusrenbangKecamatanMedia model.
 */
class MusrenbangSkpdMediaController extends Controller
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

    public function ZULarraymap($data) {
        $Myarraymap = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
			'Kd_Sub_Unit' => $data['Kd_Sub_Unit']
        ];
 
        return $Myarraymap;
    }

    /**
     * Lists all TaMusrenbangKecamatanMedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MusrenbangSkpdMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaMusrenbangKecamatanMedia model.
     * @param integer $Kd_Musrenbang_Kecamatan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionView($Kd_Musrenbang_Kecamatan, $Kd_Media)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Musrenbang_Kecamatan, $Kd_Media),
        ]);
    }

    /**
     * Creates a new TaMusrenbangKecamatanMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MusrenbangSkpdMedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Musrenbang_Kecamatan' => $model->Kd_Musrenbang_Kecamatan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaMusrenbangKecamatanMedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Musrenbang_Kecamatan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionUpdate($Kd_Musrenbang_Kecamatan, $Kd_Media)
    {
        $model = $this->findModel($Kd_Musrenbang_Kecamatan, $Kd_Media);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Musrenbang_Kecamatan' => $model->Kd_Musrenbang_Kecamatan, 'Kd_Media' => $model->Kd_Media]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMusrenbangKecamatanMedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Musrenbang_Kecamatan
     * @param integer $Kd_Media
     * @return mixed
     */
    public function actionDelete($Kd_Musrenbang_Kecamatan, $Kd_Media)
    {
        $this->findModel($Kd_Musrenbang_Kecamatan, $Kd_Media)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMusrenbangKecamatanMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Musrenbang_Kecamatan
     * @param integer $Kd_Media
     * @return TaMusrenbangKecamatanMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Musrenbang_Kecamatan, $Kd_Media)
    {
        if (($model = TaMusrenbangKecamatanMedia::findOne(['Kd_Musrenbang_Kecamatan' => $Kd_Musrenbang_Kecamatan, 'Kd_Media' => $Kd_Media])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnduh() {
        //print ("a");exit;
        // $ZULketerangan = ["Absensi", "Foto", "Berita Acara", "Video"];
        $Posisi = $this->ZULarraymap(Yii::$app->levelcomponent->getUnit());
        $acara = MusrenbangSkpdAcara::findOne($Posisi);
        //print_r($acara);exit;
        // $searchModel = new \eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch();
        // $dataProvider = $searchModel->ZULsearch(Yii::$app->request->queryParams, $ZULUser);
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
				/*
				$id = 0;
                $user = RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
				echo "<pre>";
				print_r($user->Kd_Media);
				echo "</pre>";
				*/
				$id = 0;
                foreach ($model->imageFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $model->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
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
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Berita Acara";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->namePi]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Bukti Undangan";
                    if ($TaFLM->save(false)) {
                        
                    }
                }

                $user = RefMedia::findOne(['Nm_Media' => $model->nameTandaTerima]);
                if ($user !== null) {
                    $kd_media = $user->Kd_Media;
                    $TaFLM = new \eperencanaan\models\MusrenbangSkpdMedia();
                    $TaFLM->attributes = $acara->attributes; //massive assignment
                    $TaFLM->Kd_Media = $kd_media;
                    $TaFLM->Jenis_Dokumen = "Tanda Terima";
                    if ($TaFLM->save(false)) {
                        
                    }
                }
            }
        
        }
        
        return $this->redirect(['musrenbang-skpd/dokumen']);
    }

    public function actionHapusBerkas($id){
        

        // RefMedia::findOne(['Kd_Media' => $id])->delete();
        MusrenbangSkpdMedia::findOne(['Kd_Media' => $id])->delete();
        unlink(Yii::getAlias('@webroot').'/data/'.\common\models\RefMedia::findOne(['Kd_Media' => $id])->Nm_Media);
        return $this->redirect(['musrenbang-skpd/dokumen']);
    }
}
