<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\search\TaProgramSearch;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefSubUnit;
use common\models\TaRpjmdProgramPrioritas;
use kartik\mpdf\Pdf;
use eperencanaan\models\TaMusrenbang;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaBelanjaRincSubRancangan;
use emusrenbang\models\TaBelanjaRancangan;
use common\models\TaKegiatanRancanganAwal;
/**
 * LaporanController implements the CRUD actions for Countdown model.
 */
class LaporanBappedaController extends Controller {

	public function getKota($wil=null) {
        if ($wil) return [
                "Kab" => Yii::$app->pengaturan->Kolom('Nm_Pemda'),
                "Prov" => Yii::$app->pengaturan->nmProvinsi(),
            ];
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    public function actionBappeda() {
        $RefSubUnit = RefSubUnit::find()->all();

        return $this->render('bappeda', [
                    'RefSubUnit' => $RefSubUnit,
        ]);
    }

    public function actionVisi($urusan, $bidang, $unit, $sub) {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $model = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->all();

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();

        return $this->render('visi', ['model' => $model, 'skpd' => $skpd]);
    }

    public function actionTvc74($urusan, $bidang, $unit, $sub) {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $model = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->all();

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();

        return $this->render('tvc74', [
                    'model' => $model,
                    'skpd' => $skpd,
        ]);
    }

    public function actionCetakTvc74($urusan, $bidang, $unit, $sub) {

        $model = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->all();

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc74', ['model' => $model, 'skpd' => $skpd]),
            'options' => [
                'title' => 'Cetak Tvc1c1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
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

        $data = TaRpjmdProgramPrioritas::find()->all();

        return $this->render('tvc75', ['data' => $data]);
    }

    public function actionCetakTvc75($urusan, $bidang, $unit, $sub) {

        $model = TaRpjmdProgramPrioritas::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                ])
                ->orderBy(['No_Prioritas' => SORT_ASC])
                ->all();

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc75', ['model' => $model, 'skpd' => $skpd]),
            'options' => [
                'title' => 'Cetak Tvc74',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvic10($urusan, $bidang, $unit, $sub) {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();


        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        return $this->render('Tvic10', [
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'dataKeteranganKeg' => $dataKeteranganKeg
        ]);
    }

    public function actionCetakTvic10($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10', [
                'tahun' => $tahun,
                'subunit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan,
                'dataKeteranganKeg' => $dataKeteranganKeg
                    // 'dataUrusBidang'=>$dataUrusBidang
            ]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc66($urusan, $bidang, $unit, $sub) {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();


        return $this->render('Tvc66', [
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan]);
    }

    public function actionCetakTvc66($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();



        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvc66', [
                'tahun' => $tahun,
                'subunit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan,
                'dataKeteranganKeg' => $dataKeteranganKeg
                    // 'dataUrusBidang'=>$dataUrusBidang
            ]),
            'options' => [
                'title' => 'Berita Acara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTv1c13($urusan, $bidang, $unit, $sub) {
        
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $kelompok = $this->getKota(true);

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();
        return $this->render('tv1c13', [
                    'skpd' => $skpd,
                    'kelompok' => $kelompok,
        ]);
    }

    public function actionCetakTv1c13($urusan, $bidang, $unit, $sub) {
        $kelompok = $this->getKota(true);
        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tv1c13', [
                'skpd' => $skpd,
                'kelompok' => $kelompok,
            ]),
            'options' => [
                'title' => 'Kajian Usulan Program dan Kegiatan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTv1c1($urusan, $bidang, $unit, $sub) {


        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $kelompok = $this->getKota(1);

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();


        return $this->render('tv1c1', [
                    'kelompok' => $kelompok,
                    'TaSubUnit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'dataKeteranganKeg' => $dataKeteranganKeg
        ]);
    }

    public function actionTv1c1Cetak($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $kelompok = $this->getKota(1);

        $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])->one();

        $dataKegiatan = TaProgram::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun' => $TaSubUnit->Tahun, 'Kd_Urusan' => $TaSubUnit->Kd_Urusan, 'Kd_Bidang' => $TaSubUnit->Kd_Bidang, 'Kd_Unit' => $TaSubUnit->Kd_Unit, 'Kd_Sub' => $TaSubUnit->Kd_Sub])->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('tv1c1-cetak', [
                'kelompok' => $kelompok,
                'TaSubUnit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan,
                'dataKeteranganKeg' => $dataKeteranganKeg]),
            'options' => [
                'title' => 'Cetak Tvc1c1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionVerifikasiRenja($urusan, $bidang, $unit, $sub) {

        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub])
                ->one();

        $dataKegiatan = TaProgram::find()
                ->where([
                    'Tahun' => $TaSubUnit->Tahun,
                    'Kd_Urusan' => $TaSubUnit->Kd_Urusan,
                    'Kd_Bidang' => $TaSubUnit->Kd_Bidang,
                    'Kd_Unit' => $TaSubUnit->Kd_Unit,
                    'Kd_Sub' => $TaSubUnit->Kd_Sub])
                ->all();

        return $this->render('verifikasi-renja', [
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
        ]);
    }

    public function actionCetakVerifikasiRenja($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $TaSubUnit = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub])
                ->one();

        $dataKegiatan = TaProgram::find()
                ->where([
                    'Tahun' => $TaSubUnit->Tahun,
                    'Kd_Urusan' => $TaSubUnit->Kd_Urusan,
                    'Kd_Bidang' => $TaSubUnit->Kd_Bidang,
                    'Kd_Unit' => $TaSubUnit->Kd_Unit,
                    'Kd_Sub' => $TaSubUnit->Kd_Sub])
                ->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-verifikasi-renja', [
                'tahun' => $tahun,
                'subunit' => $TaSubUnit,
                'dataKegiatan' => $dataKegiatan
            ]),
            'options' => [
                'title' => 'Cetak Tvc1c1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvic10all() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();

        $pagu = (new \yii\db\Query())
                ->from('Ta_Belanja_Rinc_Sub');
				//->where ('Kd_Urusan'==3 and 'Kd_Bidang'==4 and 'Kd_Unit'==1);

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Total');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
		

        return $this->render('Tvic10all', [
                    'refurusan' => $RefUrusan,
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'total' => $total,
                    'totalpagu' => $totalpagu
        ]);
    }

	public function actionCetakTvic10all() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		$RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();
		 $pagu = (new \yii\db\Query())
                ->from('Ta_Belanja_Rinc_Sub');

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Total');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
    

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all', [
                'tahun' => $tahun,
					'refurusan'=>$RefUrusan,
					'unitsub'=> $TaSubUnit,
					'dataKegiatan'=>$dataKegiatan,
					'total' => $total,
                    'totalpagu' => $totalpagu
            ]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                   // Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    //Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    'Kamis, 21 Juni 2018'.'/'.
					(date('H:i:s'))
					
                ],
               
				'SetFooter' => ['RKPD Kabupaten Asahan'.'|Halaman {PAGENO}|Tvic10all'],
            ]
        ]);
        return $pdf->render();
    }
	
//Rancangan Awal
public function actionTvic10all1() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();

        $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan_Awal');
				//->where ('Kd_Urusan'==3 and 'Kd_Bidang'==4 and 'Kd_Unit'==1);

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
		

        return $this->render('Tvic10all1', [
                    'refurusan' => $RefUrusan,
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'total' => $total,
                    'totalpagu' => $totalpagu
        ]);
    }

	public function actionCetakTvic10all1() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		$RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();
		 $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan_Awal');

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all1', [
                'tahun' => $tahun,
 					'refurusan'=>$RefUrusan,
					'unitsub'=> $TaSubUnit,
					'dataKegiatan'=>$dataKegiatan,
					'total' => $total,
                    'totalpagu' => $totalpagu
            ]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
					//  "Jumat, 23 Maret 2018/12:10:10"
                ],
				
               
				'SetFooter' => ['Rancangan Awal RKPD Kabupaten Asahan'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	
	
	
    //Laporan RKPD (Lampiran 3)
public function actionTvic10test()
{
        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun;

        $belanja_rancangan = TaBelanjaRancangan::find()->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])->count();

        $model = $belanja_rancangan ? TaBelanjaRincSubRancangan::find()->where(["Tahun" => $tahun])->all() : TaBelanjaRincSub::find()->where(["Tahun" => $tahun])->all();
        // $model = !empty(TaBelanjaRancangan::find()->where(["Tahun" => $tahun])->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])->all()) ? TaBelanjaRincSubRancangan::find()->where(["Tahun" => $tahun])->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])->all() : TaBelanjaRincSub::find()->where(["Tahun" => $tahun])->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])->all();
        $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan');
				//->where ('Kd_Urusan'==3 and 'Kd_Bidang'==4 and 'Kd_Unit'==1);

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');
        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');	
        return $this->render("tvic-test",[
            "model"=>$model,
            "tahun"=>$tahun,
            'total' => $total,
            'totalpagu' => $totalpagu
        ]);
}
public function actionTvic10all2() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();

        $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan');
				//->where ('Kd_Urusan'==3 and 'Kd_Bidang'==4 and 'Kd_Unit'==1);

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');		

        return $this->render('Tvic10all2', [
                    'refurusan' => $RefUrusan,
                    'tahun' => $tahun,
                    'subunit' => $TaSubUnit,
                    'dataKegiatan' => $dataKegiatan,
                    'total' => $total,
                    'totalpagu' => $totalpagu
        ]);
    }

	public function actionCetakTvic10all2() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		$RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();
		 $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan');

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
  
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all2', [
                'tahun' => $tahun,
 				'refurusan'=>$RefUrusan,
					'unitsub'=> $TaSubUnit,
					'dataKegiatan'=>$dataKegiatan,
					'total' => $total,
                    'totalpagu' => $totalpagu
            ]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
					//  "Rabu, 28 Maret 2018/17:45:19"
                ],
               
				'SetFooter' => ['Berita Acara Hasil Kesepakatan Musrenbang RKPD'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	
	
	
		//Laporan RKPD (Lampiran 2)
public function actionTvic10all3() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        return $this->render('Tvic10all3', [
                   
                    'tahun' => $tahun,
                  
        ]);
    }

	public function actionCetakTvic10all3() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		$RefUrusan = RefUrusan::find()->all();
        $TaSubUnit = TaSubUnit::find()->all();
        $dataKegiatan = TaProgram::find()->all();
		 $pagu = (new \yii\db\Query())
                ->from('Ta_Kegiatan_Rancangan');

        $pagun1 = (new \yii\db\Query())
                ->from('Ta_Kegiatan');

        $total = $pagu->sum('Pagu_Anggaran');
        $totalpagu = $pagun1->sum('Pagu_Anggaran_Nt1');
  
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all3', []),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
				 //  "Rabu, 28 Maret 2018/17:41:43"
                ],
               
				'SetFooter' => ['Berita Acara Hasil Kesepakatan Musrenbang RKPD'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	
	
	
	
	
		//Laporan RKPD (Lampiran 4)
public function actionTvic10all4() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;


        return $this->render('Tvic10all4', [
                   
                    'tahun' => $tahun,
                   
        ]);
    }

	public function actionCetakTvic10all4() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		
  
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all4', [
              ]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
					//  "Rabu, 28 Maret 2018/17:50:10"
                ],
               
				'SetFooter' => ['Berita Acara Hasil Kesepakatan Musrenbang RKPD'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	

public function actionCetakTvic10all5() {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		
  
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all5', [
              ]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
          //  'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
               
				'SetFooter' => ['Berita Acara Hasil Kesepakatan Musrenbang RKPD'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	

public function actionCetakTvic10all6() {

       $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;
		$RefUrusan = RefUrusan::find()->all();
		
  
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('laporan_Tvic10all6', ['tahun' => $tahun,'refurusan'=>$RefUrusan]),
            'options' => [
                'title' => 'Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
          //  'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
				// "Rabu, 28 Maret 2018/17:41:43"
                ],
               
				'SetFooter' => ['Berita Acara Hasil Kesepakatan Musrenbang RKPD'.'|Halaman {PAGENO}|Tvic10all1'],
            ]
        ]);
        return $pdf->render();
    }
//------------	


    public function actionTvic16($urusan, $bidang, $unit, $sub) {
        
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $kelompok = $this->getKota(true);

        $datausulan = TaMusrenbang::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        return $this->render('tvic16', [
                    'datausulan' => $datausulan,
                    'subunit' => $subunit,
                    'kelompok' => $kelompok,
                    'tahun' => $tahun
        ]);
    }

    public function actionCetakTvic16($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $kelompok = $this->getKota(true);

        $datausulan = TaMusrenbang::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();



        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvic16', [
                'tahun' => $tahun,
                'subunit' => $subunit,
                'kelompok' => $kelompok,
                'datausulan' => $datausulan
            ]),
            'options' => [
                'title' => 'Cetak Tvic16',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
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
        $model = TaRpjmdProgramPrioritas::find()
                ->all();

        return $this->render('tvc76', [
                    'model' => $model,
        ]);
    }

    public function actionLampiran41T1() {
        return $this->render('lampiran41-t1');
    }

    public function actionCetakLampiran41T1() {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-lampiran41-t1'),
            'options' => [
                'title' => 'Cetak Lampiran 41, Tabel 1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionLampiran41T2() {
        return $this->render('lampiran41-t2');
    }

    public function actionCetakLampiran41T2() {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-lampiran41-t2'),
            'options' => [
                'title' => 'Cetak Lampiran 41, Tabel 2',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionProgkegPrioritas($urusan, $bidang, $unit, $sub) {
        
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        $kelompok = $this->getKota(1);
      
        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();


        $dataKegiatan = TaKegiatan::find()->where(['Kd_Urusan' => $skpd->Kd_Urusan, 'Kd_Bidang' => $skpd->Kd_Bidang, 'Kd_Unit' => $skpd->Kd_Unit, 'Kd_Sub' => $skpd->Kd_Sub])->all(); 


        return $this->render('progkeg-prioritas', [
                    'skpd' => $skpd,
                    'kelompok' => $kelompok,
                    'TaKegiatan'=> $dataKegiatan
        ]);
    }


     public function actionProgkegPrioritasCetak($urusan, $bidang, $unit, $sub) {

        $Tahun = Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun + 1;

        $skpd = RefSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();


        $dataKegiatan = TaKegiatan::find()->where(['Kd_Urusan' => $skpd->Kd_Urusan, 'Kd_Bidang' => $skpd->Kd_Bidang, 'Kd_Unit' => $skpd->Kd_Unit, 'Kd_Sub' => $skpd->Kd_Sub])->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('progkeg-prioritas-cetak', [
                'skpd' => $skpd,
                'TaKegiatan'=> $dataKegiatan]),
            'options' => [
                'title' => 'Cetak Tvc1c1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionLaporanRkpd($urusan, $bidang, $unit, $sub) {
        $data = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();
        return $this->render('/laporan-skpd/laporan-rkpd', ['data' => $data]);
    }

    public function actionCetakLaporanRkpd($urusan, $bidang, $unit, $sub) {
        $data = TaSubUnit::find()
                ->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub
                ])
                ->one();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('/laporan-skpd/cetak-laporan-rkpd', ['data' => $data]),
            'options' => [
                'title' => 'Cetak Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionMppk() {
        $data = TaRpjmdProgramPrioritas::find()
                ->groupBy('No_Prioritas')
                ->orderBy('No_Prioritas')
                ->all();

        return $this->render('mppk', ['data' => $data]);
    }

    public function actionCetakMppk() {
        $data = TaRpjmdProgramPrioritas::find()
                ->groupBy('No_Prioritas')
                ->orderBy('No_Prioritas')
                ->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-mppk', ['data' => $data]),
            'options' => [
                'title' => 'Prioritas Pembangunan Daerah',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }


    public function actionMppkp($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();
        $TaProgram = TaProgram::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $data1 = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $data7 = [];
        foreach ($TaProgram as $key => $value1) {
            if (isset($value1->taRpjmdProgramPrioritas->No_Prioritas)) {
                $data1[$value1->taRpjmdProgramPrioritas->No_Prioritas] = @$value1->taRpjmdProgramPrioritas->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah;
                $data2[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdSasaran->Sasaran;
                $data3[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->Ket_Prog;
                $data4[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->refSubUnit->Nm_Sub_Unit;
                $data5[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->getBelanjaRincSubs()->sum('Total');
                $data6[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
                $data7[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
            }
        }

        return $this->render('mppkp', [
                'subunit' => $subunit,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
            ]);
    }

    public function actionCetakMppkp($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();
        $TaProgram = TaProgram::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $data1 = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $data7 = [];
        foreach ($TaProgram as $key => $value1) {
            if (isset($value1->taRpjmdProgramPrioritas->No_Prioritas)) {
                $data1[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah;
                $data2[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdSasaran->Sasaran;
                $data3[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->Ket_Prog;
                $data4[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->refSubUnit->Nm_Sub_Unit;
                $data5[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->getBelanjaRincSubs()->sum('Total');
                $data6[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
                $data7[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
            }
        }

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-mppkp', [
                'subunit' => $subunit,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
                ]),
            'options' => [
                'title' => 'Prioritas Pembangunan Daerah',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }


//Add by RG
    public function actionMppkp1($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();
        $TaProgram = TaProgram::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $data1 = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $data7 = [];
        foreach ($TaProgram as $key => $value1) {
            if (isset($value1->taRpjmdProgramPrioritas->No_Prioritas)) {
                $data1[$value1->taRpjmdProgramPrioritas->No_Prioritas] = @$value1->taRpjmdProgramPrioritas->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah;
                $data2[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdSasaran->Sasaran;
                $data3[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->Ket_Prog;
                $data4[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->refSubUnit->Nm_Sub_Unit;
                $data5[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->getBelanjaRincSubs()->sum('Total');
                $data6[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
                $data7[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
            }
        }

        return $this->render('mppkp1', [
                'subunit' => $subunit,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
            ]);
    }

    public function actionCetakMppkp1($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();
        $TaProgram = TaProgram::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->all();

        $data1 = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $data7 = [];
        foreach ($TaProgram as $key => $value1) {
            if (isset($value1->taRpjmdProgramPrioritas->No_Prioritas)) {
                $data1[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah;
                $data2[$value1->taRpjmdProgramPrioritas->No_Prioritas] = $value1->taRpjmdProgramPrioritas->taRpjmdSasaran->Sasaran;
                $data3[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->Ket_Prog;
                $data4[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->refSubUnit->Nm_Sub_Unit;
                $data5[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = $value1->getBelanjaRincSubs()->sum('Total');
                $data6[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
                $data7[$value1->taRpjmdProgramPrioritas->No_Prioritas][] = 0;
            }
        }
		return $this->renderPartial('cetak-mppkp1', [
                'subunit' => $subunit,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
                ]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-mppkp1', [
                'subunit' => $subunit,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
                ]),
            'options' => [
                'title' => 'Prioritas Pembangunan Daerah',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPaspbpk($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        $TaProgram = TaProgram::findAll(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub]);

        return $this->render('paspbpk', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
        ]);
    }
	public function actionPaspbpk1($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        $TaProgram = TaProgram::findAll(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub]);

        return $this->render('paspbpk1', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
        ]);
    }

    public function actionCetakPaspbpk($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        $TaProgram = TaProgram::findAll(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-paspbpk', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
                ]),
            'options' => [
                'title' => 'Plafon Anggaran Sementara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
	
	public function actionCetakPaspbpk1($urusan, $bidang, $unit, $sub) {
        $subunit = RefSubUnit::find()
                ->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub])
                ->one();

        $TaProgram = TaProgram::findAll(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Unit' => $unit, 'Kd_Sub' => $sub]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-paspbpk1', [
                'subunit' => $subunit,
                'TaProgram' => $TaProgram,
                ]),
            'options' => [
                'title' => 'Plafon Anggaran Sementara',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }


    public function actionLaporanRka($urusan, $bidang, $unit, $sub) {
        $subunit = [$urusan, $bidang, $unit, $sub];
        $data = TaProgram::findAll([
            'Tahun' => date('Y'),
            'Kd_Urusan' => $subunit[0],
            'Kd_Bidang' => $subunit[1],
            'Kd_Unit' => $subunit[2],
            'Kd_Sub' => $subunit[3],
        ]);

        return $this->render('laporan-rka',['data' => $data, 'subunit' => $subunit]);
    }

    public function actionLaporanRkaTampil() {
        if ($post = Yii::$app->request->post()) {
            $post = explode(' ', $post['Kd_Keg']);
            $Kegiatan = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
                'Kd_Prog' => $post[4],
                'Kd_Keg' => $post[5],
            ];
            $data = TaKegiatan::findOne($Kegiatan);
            // print_r($data);
            // die();
            return $this->renderPartial('laporan-rka-tampil', ['data' => $data, 'Kegiatan' => $Kegiatan]);
        }

    }

    public function actionLaporanRkaCetak($urusan, $bidang, $unit, $sub, $program, $kegiatan) {
        $unit = [$urusan, $bidang, $unit, $sub, $program, $kegiatan];
        $Kegiatan = [
            'Tahun' => date('Y'),
            'Kd_Urusan' => $unit[0],
            'Kd_Bidang' => $unit[1],
            'Kd_Unit' => $unit[2],
            'Kd_Sub' => $unit[3],
            'Kd_Prog' => $unit[4],
            'Kd_Keg' => $unit[5],
        ];
        $data = TaKegiatan::findOne($Kegiatan);
        $pdf = new Pdf([
                      'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                      'format' => Pdf::FORMAT_FOLIO,
                      'content' => $this->renderPartial('laporan-rka-cetak', ['data' => $data]),
                      'options' => [
                          'title' => 'Laporan RKA',
                      //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                      ],
                      'orientation' => Pdf::ORIENT_LANDSCAPE,
                      'methods' => [
                          'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                              Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                              Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                      (date('H:i:s'))
                              ],
                          'SetFooter' => ['|Halaman {PAGENO}|'],
                      ]
                  ]);
        return $pdf->render();

    }

    public function actionGetKegiatan() {

        if ($post = Yii::$app->request->post()) {
            $post = explode(' ', $post['Kd_Prog']);
            $program = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
                'Kd_Prog' => $post[4],
            ];
            $data = TaKegiatan::findAll($program);
            echo "<option value=\"\" disabled selected>Pilih Kegiatan</option>";
            foreach($data as $e){
                echo "<option value=\"".$e['Kd_Urusan']." ".$e['Kd_Bidang']." ".$e['Kd_Unit']." ".$e['Kd_Sub']." ".$e['Kd_Prog']." ".$e['Kd_Keg']."\"> ".$e['Ket_Kegiatan']."</option>";
            }
        }
    }

    public function actionKompilasiProgram($urusan, $bidang, $unit, $sub) {
        $skpd = [
            'Kd_Urusan' => $urusan,
            'Kd_Bidang' => $bidang,
            'Kd_Unit' => $unit,
            'Kd_Sub' => $sub,
        ];
        $searchModel = new TaProgramSearch();
        $dataProvider = $searchModel->searchPraRka(Yii::$app->request->queryParams, $skpd);

        $refsubunit = RefSubUnit::find()->all();

        return $this->render('/laporan-pra-rka/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'refsubunit' => $refsubunit,
        ]);
    }


    public function actionCetakKompilasiProgram($urusan, $bidang, $unit, $sub) {
        $skpd = [
            'Kd_Urusan' => $urusan,
            'Kd_Bidang' => $bidang,
            'Kd_Unit' => $unit,
            'Kd_Sub' => $sub,
        ];
        $model = TaProgram::find()
                ->where($skpd)
                ->orderBy([
                    'Kd_Urusan' => SORT_ASC,
                    'Kd_Bidang' => SORT_ASC,
                    'Kd_Unit' => SORT_ASC,
                    'Kd_Prog' => SORT_ASC
                ])
                ->all();

        return $this->renderPartial('/laporan-pra-rka/laporan_pra_rka_cetak', ['model' => $model]);
    }

}
