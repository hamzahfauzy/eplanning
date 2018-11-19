<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\RefRPJMD;
use common\models\TaPemda;
use common\models\TaRpjmdMisi;
use common\models\TaRpjmdProgramPrioritas;
use common\models\TaRpjmdPrioritasPembangunanDaerah;
use kartik\mpdf\Pdf;

class RpjmdController extends \yii\web\Controller {

	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTvc74() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $Tahun = TaPemda::find()
                ->select('Tahun')
                ->one();

        $data = TaRpjmdMisi::findAll(['Tahun' => $Tahun->Tahun]);
        return $this->render('tvc74', ['data' => $data]);
    }

    public function actionTvc74Cetak() {
        $Tahun = TaPemda::find()
                ->select('Tahun')
                ->one();
        $data = TaRpjmdMisi::findAll(['Tahun' => $Tahun->Tahun]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('tvc74', ['data' => $data]),
            'options' => [
                'title' => 'Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc75() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $Tahun = TaPemda::find()
                ->select('Tahun')
                ->one();
        $data = TaRpjmdProgramPrioritas::findAll(['Tahun' => $Tahun->Tahun]);
        // echo "<pre>";
        // print_r($data);
        // die();
        return $this->render('tvc75', ['data' => $data]);
    }

    public function actionTvc75Cetak() {
        $Tahun = TaPemda::find()
                ->select('Tahun')
                ->one();
        $data = TaRpjmdProgramPrioritas::findAll(['Tahun' => $Tahun->Tahun]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('tvc75', ['data' => $data]),
            'options' => [
                'title' => 'Prioritas Pembangunan Daerah',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc76() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        // $model = TaRpjmdProgramPrioritas::find()
        //         ->all();

        $model = TaRpjmdPrioritasPembangunanDaerah::find()
                ->all();

        return $this->render('tvc76', [
                    'model' => $model,
        ]);
    }

    public function actionTvc76Cetak() {
        // $model = TaRpjmdProgramPrioritas::find()
        //         ->all();

        $model = TaRpjmdPrioritasPembangunanDaerah::find()
                ->all();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('tvc76', ['model' => $model]),
            'options' => [
                'title' => 'Penjelasan Program Pembangunan Daerah Kota',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc63() {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $tahun = (date('Y') + 1);

        $PrioritasPem = TaRpjmdPrioritasPembangunanDaerah::find()->All();


        return $this->render('Tvc63', ['tahun' => $tahun,
                    'PrioritasPem' => $PrioritasPem]);
    }

    public function actionCetakTvc63() {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $tahun = (date('Y') + 1);

        $PrioritasPem = TaRpjmdPrioritasPembangunanDaerah::find()->All();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('Cetak_Tvc63', ['PrioritasPem' => $PrioritasPem, 'tahun' => $tahun]),
            'options' => [
                'title' => 'Prioritas dan Sasaran Pembangunan Daerah Tahun 2018',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc64() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $tahun = (date('Y') + 1);


        return $this->render('Tvc64', ['tahun' => $tahun]);
    }

    public function actionCetakTvc64() {

        $tahun = (date('Y') + 1);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('Cetak_Tvc64', ['tahun' => $tahun]),
            'options' => [
                'title' => 'Penetapan Proporsi Alokasi Dana Pagu Indikatif 2018',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

}
