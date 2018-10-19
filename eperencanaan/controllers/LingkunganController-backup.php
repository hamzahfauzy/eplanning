<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\Lingkungan;
use eperencanaan\models\LingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use eperencanaan\models\TaForumLingkunganAcara;

/**
 * LingkunganController implements the CRUD actions for Lingkungan model.
 */
class LingkunganController extends Controller
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
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionIndex()
    {
		$session = Yii::$app->session;
		$session->open();
		//$session->set('Tahun', '2016');
		$session->set('id_prov', '12');
		$session->set('id_kab', '7');
		$session->set('id_kec', '1');
		$session->set('id_kel', '1');
		$session->set('id_urut_kel', '1');
		$session->set('id_link', '1');
		$session->set('Tahun', '2016');
		$session->close();

        return $this->render('dashboard');
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionTambah()
    {
        $model = new Lingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pesan' => 'berhasil']);
        } else {
            return $this->render('tambah_usulan', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionBank_usulan()
    {
        return $this->render('bank_usulan');
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionRekapitulasi()
    {
        return $this->render('rekapitulasi_usulan');
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionRiwayat()
    {
        return $this->render('riwayat_usulan');
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionPantau()
    {
        return $this->render('pantau_usulan');
    }

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionDokumen()
    {
		$session = Yii::$app->session;
		$session->open();
		//$session->set('Tahun', '2016');
		$prov = $session->get('id_prov');
		$kab = $session->get('id_kab');
		$kec = $session->get('id_kec');
		$kel = $session->get('id_kel');
		$urut_kel = $session->get('id_urut_kel');
		$link = $session->get('id_link');
		$session->close();
		$acara = TaForumLingkunganAcara::findOne(['Kd_Prov' => $prov, 'Kd_Kab' => $kab, 'Kd_Kec' => $kec, 
		'Kd_Kel' => $kel, 'Kd_Urut_Kel' => $urut_kel, 'Kd_Lingkungan' => $link]);
        return $this->render('dokumen',['acara' => $acara]);
    }

    //==============================

    /**
     * Lists all Lingkungan models.
     * @return mixed
     */
    public function actionAwal()
    {
        $searchModel = new LingkunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lingkungan model.
     * @param string $Tahun
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Usulan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran),
        ]);
    }

    /**
     * Creates a new Lingkungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lingkungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Usulan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        $model = $this->findModel($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lingkungan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Usulan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        $this->findModel($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lingkungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Usulan
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return Lingkungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Usulan, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        if (($model = Lingkungan::findOne(['Tahun' => $Tahun, 'Kd_Benua' => $Kd_Benua, 'Kd_Benua_Sub' => $Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $Kd_Benua_Sub_Negara, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Jalan' => $Kd_Jalan, 'Kd_Usulan' => $Kd_Usulan, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Satuan' => $Kd_Satuan, 'Kd_Sasaran' => $Kd_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionSampleDownload($filename, $kode)
	{
		$session = Yii::$app->session;
		$session->open();
		//$session->set('Tahun', '2016');
		$prov = $session->get('id_prov');
		$kab = $session->get('id_kab');
		$kec = $session->get('id_kec');
		$kel = $session->get('id_kel');
		$urut_kel = $session->get('id_urut_kel');
		$link = $session->get('id_link');
		$session->close();
		$acara = TaForumLingkunganAcara::findOne(['Kd_Prov' => $prov, 'Kd_Kab' => $kab, 'Kd_Kec' => $kec, 
		'Kd_Kel' => $kel, 'Kd_Urut_Kel' => $urut_kel, 'Kd_Lingkungan' => $link]);
		if ($kode == 1){
			$acara->Waktu_Unduh_Absen = time();
			$acara->update();
		}else{
			$acara->Waktu_Unduh_Berita_Acara = time();
			$acara->update();
		}
		ob_clean();
		\Yii::$app->response->sendFile(dirname(dirname(__FILE__)).'\\web\\data\\'.$filename)->send();
		$this->redirect(['dokumen']);
	}
}
