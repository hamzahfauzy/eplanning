<?php

namespace satuanharga\controllers;

use Yii;
use common\models\TaHargaSatuanPokokKegiatan;
use common\models\search\TaHargaSatuanPokokKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefRekAset1;
use common\models\RefStandardHarga1;

/**
 * TaHargaSatuanPokokKegiatanController implements the CRUD actions for TaHargaSatuanPokokKegiatan model.
 */
class TaHargaSatuanPokokKegiatanController extends Controller
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
     * Lists all TaHargaSatuanPokokKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaHargaSatuanPokokKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaHargaSatuanPokokKegiatan model.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @param integer $Kd_Aset4
     * @param integer $Kd_Aset5
     * @param integer $Kd_1
     * @param integer $Kd_2
     * @param integer $Kd_3
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionView($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan),
        ]);
    }

    /**
     * Creates a new TaHargaSatuanPokokKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaHargaSatuanPokokKegiatan();
        $modelAset1=RefRekAset1::find()->all();
        foreach($modelAset1 as $d){
            $data[$d['Kd_Aset1']]=$d['Nm_Aset1']; 
        }
        
        $model = new TaHargaSatuanPokokKegiatan();
        $modelKd1=RefStandardHarga1::find()->all();
        foreach($modelKd1 as $e){
            $data[$e['Kd_1']]=$e['Uraian']; 
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3, 'Kd_Aset4' => $model->Kd_Aset4, 'Kd_Aset5' => $model->Kd_Aset5, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3, 'Kd_Satuan' => $model->Kd_Satuan]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'Kd_Aset1' => $data,
                'Kd_1' => $data,
            
            ]);
        }
    }

    /**
     * Updates an existing TaHargaSatuanPokokKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @param integer $Kd_Aset4
     * @param integer $Kd_Aset5
     * @param integer $Kd_1
     * @param integer $Kd_2
     * @param integer $Kd_3
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionUpdate($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan)
    {
        $model = $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3, 'Kd_Aset4' => $model->Kd_Aset4, 'Kd_Aset5' => $model->Kd_Aset5, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3, 'Kd_Satuan' => $model->Kd_Satuan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaHargaSatuanPokokKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @param integer $Kd_Aset4
     * @param integer $Kd_Aset5
     * @param integer $Kd_1
     * @param integer $Kd_2
     * @param integer $Kd_3
     * @param integer $Kd_Satuan
     * @return mixed
     */
    public function actionDelete($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan)
    {
        $this->findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaHargaSatuanPokokKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Benua
     * @param integer $Kd_Benua_Sub
     * @param integer $Kd_Benua_Sub_Negara
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Aset1
     * @param integer $Kd_Aset2
     * @param integer $Kd_Aset3
     * @param integer $Kd_Aset4
     * @param integer $Kd_Aset5
     * @param integer $Kd_1
     * @param integer $Kd_2
     * @param integer $Kd_3
     * @param integer $Kd_Satuan
     * @return TaHargaSatuanPokokKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Benua, $Kd_Benua_Sub, $Kd_Benua_Sub_Negara, $Kd_Prov, $Kd_Kab, $Kd_Klasifikasi, $Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4, $Kd_Aset5, $Kd_1, $Kd_2, $Kd_3, $Kd_Satuan)
    {
        if (($model = TaHargaSatuanPokokKegiatan::findOne(['Kd_Benua' => $Kd_Benua, 'Kd_Benua_Sub' => $Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $Kd_Benua_Sub_Negara, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Aset1' => $Kd_Aset1, 'Kd_Aset2' => $Kd_Aset2, 'Kd_Aset3' => $Kd_Aset3, 'Kd_Aset4' => $Kd_Aset4, 'Kd_Aset5' => $Kd_Aset5, 'Kd_1' => $Kd_1, 'Kd_2' => $Kd_2, 'Kd_3' => $Kd_3, 'Kd_Satuan' => $Kd_Satuan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    



}
