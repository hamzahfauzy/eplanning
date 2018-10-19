<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaProgram;
use common\models\search\TaProgramSearch;
use common\models\RefSubUnit;

class LaporanPraRkaController extends \yii\web\Controller {

    public function Posisi() {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        return [
            'Kd_Urusan' => $kelompok->Kd_Urusan,
            'Kd_Bidang' => $kelompok->Kd_Bidang,
            'Kd_Unit' => $kelompok->Kd_Unit,
            'Kd_Sub' => $kelompok->Kd_Sub_Unit,
        ];
    }

    public function actionIndex() {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $searchModel = new TaProgramSearch();
        $dataProvider = $searchModel->searchPraRka(Yii::$app->request->queryParams);

        $refsubunit = RefSubUnit::find()->all();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'refsubunit' => $refsubunit,
        ]);
    }

    public function actionCetak() {

        $model = TaProgram::find()
                ->orderBy([
                    'Kd_Urusan' => SORT_ASC,
                    'Kd_Bidang' => SORT_ASC,
                    'Kd_Unit' => SORT_ASC,
                    'Kd_Prog' => SORT_ASC
                ])
                ->all();

        return $this->renderPartial('laporan_pra_rka_cetak', ['model' => $model]);
    }

}
