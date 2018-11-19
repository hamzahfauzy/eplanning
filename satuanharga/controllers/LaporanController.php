<?php

namespace satuanharga\controllers;

use Yii;
use common\models\RefSsh1;
use common\models\RefHspk1;
use common\models\RefRekAset1;
use common\models\RefAsb1;
use kartik\mpdf\Pdf;

class LaporanController extends \yii\web\Controller {

    public function actionAsb() {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $dataSatus = RefAsb1::find()->all();

        return $this->render('asb', [
                    'dataSatus' => $dataSatus,
        ]);
    }

    public function actionCetakAsb() {
        $request = Yii::$app->request;
        $kode = $request->post('pilih_kode');

        if ($kode) {
            $kode = $request->post('pilih_kode');
        } else {
            $kode = 1;
        }

        $data1 = RefAsb1::findOne($kode);
        $data1Duas = $data1->refAsb2s;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_FOLIO,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('cetak_asb', [
                'data1' => $data1,
                'data1Duas' => $data1Duas,
            ]),
            'options' => [
                'title' => 'Chart Akun ASB',
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
                    \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);

        return $pdf->render();
    }

    public function actionHspk() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $dataHspks = RefHspk1::find()->all();

        return $this->render('hspk', [
                    'dataHspks' => $dataHspks,
        ]);
    }

    public function actionHspkCetak($Kd_Hspk1) {
        $data = RefHspk1::find();

        if ($Kd_Hspk1 != 0) {
            $data->where(['Kd_Hspk1' => $Kd_Hspk1]);
        }

        $dataHspk = $data->all();
        return $this->renderpartial('hspk_cetak', [
                    'dataHspk' => $dataHspk
        ]);
    }

    public function actionCetakHspk() {
        $request = Yii::$app->request;
        $kode = $request->post('pilih_kode');

        if ($kode) {
            $kode = $request->post('pilih_kode');
        } else {
            $kode = 1;
        }

        $data1 = RefHspk1::findOne($kode);
        $data1Duas = $data1->refHspk2s;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_FOLIO,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('cetak_hspk', [
                'data1' => $data1,
                'data1Duas' => $data1Duas,
            ]),
            'options' => [
                'title' => 'Chart Akun HSPK',
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
                    \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);

        return $pdf->render();
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionSsh() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $dataSatus = RefSsh1::find()->all();

        return $this->render('ssh', [
                    'dataSatus' => $dataSatus,
        ]);
    }

    public function actionCetakSsh() {
        
        $request = Yii::$app->request;
        if(isset($_POST['cetak'])) { 
            $kode = $request->post('pilih_kode');
            if ($kode) {
                $kode = $request->post('pilih_kode');
            } else {
                $kode = 1;
            }
            $data1 = RefSsh1::findOne($kode);
            $data1Duas = $data1->refSsh2s;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                'format' => Pdf::FORMAT_FOLIO,
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('cetak_ssh', [
                    'data1' => $data1,
                    'data1Duas' => $data1Duas,
                ]),
                'options' => [
                    'title' => 'Chart Akun SSH',
                ],
                'methods' => [
                    'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
                        \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                        \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                        (date('H:i:s'))],
                    'SetFooter' => ['|Halaman {PAGENO}|'],
                ]
            ]);
            return $pdf->render();
        } else {

            $kode = $request->post('pilih_kode');
            if ($kode) {
                 $kode = $request->post('pilih_kode');
             } else {
                 $kode = 1;
            }
            $data1 = RefSsh1::findOne($kode);
            $data1Duas = $data1->refSsh2s;


            // $pdf = new Pdf([
            //     'mode' => Pdf::MODE_UTF8,
            //     'format' => Pdf::FORMAT_FOLIO,
            //     'orientation' => Pdf::ORIENT_PORTRAIT,
            //     'destination' => Pdf::DEST_BROWSER,
            //     'content' => $this->renderPartial('cetak_ssh_kosong', [
            //         'data1' => $data1,
            //         'data1Duas' => $data1Duas,
            //     ]),
            //     'options' => [
            //         'title' => 'Chart Akun SSH',
            //     ],
            //     'methods' => [
            //         'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
            //             \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
            //             \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
            //             (date('H:i:s'))],
            //         'SetFooter' => ['|Halaman {PAGENO}|'],
            //     ]
            // ]);
            // return $pdf->render();

             return $this->renderPartial('cetak_ssh_excel', [
                'data1' => $data1,
                'data1Duas' => $data1Duas
                ]);
        }    
    }

    public function actionAsset() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $dataRekAsets = RefRekAset1::find()->all();

        return $this->render('asset', [
                    'dataRekAsets' => $dataRekAsets,
        ]);
    }

    public function actionCetakAset() {
        $request = Yii::$app->request;
        $kode = $request->post('pilih_kode');

        if ($kode) {
            $kode = $request->post('pilih_kode');
        } else {
            $kode = 1;
        }

        $data1 = RefRekAset1::findOne($kode);
        $data1Duas = $data1->refRekAset2s;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_FOLIO,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('cetak_asset', [
                'data1' => $data1,
                'data1Duas' => $data1Duas,
            ]),
            'options' => [
                'title' => 'Chart Akun Aset',
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
                    \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);

        return $pdf->render();
    }


    public function actionCetakSshKosong() {
        $request = Yii::$app->request;
        $kode = $request->post('pilih_kode');

        if ($kode) {
            $kode = $request->post('pilih_kode');
        } else {
            $kode = 2;
        }

        $data1 = RefSsh1::findOne($kode);
        
        $data1Duas = $data1->refSsh2s;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_FOLIO,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('cetak_ssh_kosong', [
                'data1' => $data1,
                'data1Duas' => $data1Duas,
            ]),
            'options' => [
                'title' => 'Chart Akun SSH',
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem Standar Satuan Harga Kota Medan||Dicetak tanggal: ' .
                    \Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render(); 
    }
}
