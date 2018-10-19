<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaSubUnit;
use common\models\TaKegiatan;
use common\models\RefSubUnit;
use kartik\mpdf\Pdf;
use common\models\TaRpjmdProgramPrioritas;
use common\models\TaRpjmdPrioritasPembangunanDaerah;
use common\models\TaProgram;

class LaporanRkpdController extends \yii\web\Controller
{
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    public function getPosisi() {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $Posisi = [
            'Tahun' => $Tahun,
            'Kd_Urusan' => $unit['Kd_Urusan'],
            'Kd_Bidang' => $unit['Kd_Bidang'],
            'Kd_Unit' => $unit['Kd_Unit'],
            'Kd_Sub' => $unit['Kd_Sub_Unit'],
        ];

        return $Posisi;
    }

	    public function getPosisi1() {

        $Tahun = Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $Posisi1 = [
            'Tahun' => $Tahun,
            /*'Kd_Urusan' => $unit['Kd_Urusan'],
            'Kd_Bidang' => $unit['Kd_Bidang'],
            'Kd_Unit' => $unit['Kd_Unit'],
            'Kd_Sub' => $unit['Kd_Sub_Unit'],*/
        ];

        return $Posisi1;
    }


	
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLampiran1($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Lampiran 1
        // Daftar Hadir Peserta Musrenbang RKPD 
        return $this->render('lampiran1');
    }
    public function actionLampiran2($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Lampiran 2
        // Rencana Program dan Kegiatan Prioritas Daerah 
        return $this->render('lampiran2');
    }
    public function actionLampiran3($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Lampiran 3
        // daftar Usulan yang Belum Disetujui Musrenbang Skpd
        return $this->render('lampiran3');
    }
    
    public function actionTve311($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Daftar Rencana Kegiatan Prioritas Kecamatan -> sesuai Sub Unit (SKPD )
        return $this->render('tve311');
    }
    
    public function actionTve312($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Daftar Prioritas Desa Menurut SKPD -> sesuai Sub Unit (SKPD )
        return $this->render('tve312');
    }
    public function actionTve313($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Prioritas Kegiatan berdasarkan Kriteria -> sesuai Sub Unit (SKPD )
        return $this->render('tve313');
    }
    public function actionTve314($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Prioritas Kegiatan berdasarkan Kriteria -> sesuai Sub Unit (SKPD )
        return $this->render('tve314');
    }
    public function actionTve315($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        // Daftar Kegiatan yang Belum Di Sepakati -> sesuai Sub Unit (SKPD )
        return $this->render('tve315');
    }

    public function actionTv1c1()
    {
        return $this->render('tv1c1');
    }

    public function actionTv1c1Cetak()
    {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('tv1c1-cetak'),
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

    public function actionTv1c13()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        $kelompok = Yii::$app->levelcomponent->getKelompok();

        return $this->render('tv1c13',[
            'kelompok' => $kelompok,
            'unit' => $unit,
            'Tahun' => $Tahun,
            ]);
    }

    public function actionTv1c14()
    {
        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        $kelompok = Yii::$app->levelcomponent->getKelompok();

        return $this->render('tv1c14',[
            'kelompok' => $kelompok,
            'unit' => $unit,
            ]);
    }

    public function actionTv1c15()
    {
        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        $kelompok = Yii::$app->levelcomponent->getKelompok();

        return $this->render('tv1c15',[
            'kelompok' => $kelompok,
            'unit' => $unit,
            ]);
    }

    public function actionTv1c16()
    {
        return $this->render('tv1c16');
    }

    public function actionTv1c17()
    {
        return $this->render('tv1c17');
    }

    public function actionTvc74()
    {
        $data = TaSubUnit::findAll($this->getPosisi());
        return $this->render('tvc74',['data' => $data]);
    }

    public function actionTvc75()
    {

        $model = TaRpjmdPrioritasPembangunanDaerah::find()

                ->orderBy(['No_Prioritas' => SORT_ASC])
                ->all();
        

        $unit = Yii::$app->levelcomponent->getUnit();
        $model = TaProgram::findAll(['Tahun' => date('Y'), 'Kd_Urusan'=>@$unit->Kd_Urusan, 'Kd_Bidang'=>@$unit->Kd_Bidang, 'Kd_Unit'=>@$unit->Kd_Unit, 'Kd_Sub'=>@$unit->Kd_Sub_Unit]);
        // $model = TaRpjmdPrioritasPembangunanDaerah::find()
        //         ->orderBy(['No_Prioritas' => SORT_ASC])
        //         ->all();

        return $this->render('tvc75', 
                    [
                        'model'=> $model
                    ]);
    }

    public function actionTvc76()
    {
        return $this->render('tvc76');
    }

    public function actionRencanaProgramDaerah()
    {
        $data = RefSubUnit::find()->all();
        return $this->render('rencana-program-daerah',['data' => $data]);
    }

    public function actionRencanaProgramDaerahSkpd()
    {
        return $this->render('rencana-program-daerah');
    }

    public function actionRencanaProgramDaerahTampil()
    {
        if ($post = Yii::$app->request->post()) {
			
            $post = explode(' ', $post['Kd_Sub']);
			
				$sub_unit = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
            ];
			if ($post[3]=="0"){
				$TaSubUnit = TaSubUnit::findAll($this->getPosisi1());
            }
			else
			{
				$TaSubUnit = TaSubUnit::findAll($sub_unit);
			}
			return $this->renderpartial('rencana-program-daerah-tampil',['TaSubUnit' => $TaSubUnit]);
        }

        $TaSubUnit = TaSubUnit::findAll($this->getPosisi1());
        return $this->renderpartial('rencana-program-daerah-tampil',['TaSubUnit' => $TaSubUnit]);

    }
public function actionCetakLampiran3() {

       if ($post = Yii::$app->request->post()) {
            $post = explode(' ', $post['Kd_Sub']);
            $sub_unit = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
            ];
            if ($post[3]=="0"){
				$TaSubUnit = TaSubUnit::findAll($this->getPosisi1());
            }
			else
			{
				$TaSubUnit = TaSubUnit::findAll($sub_unit);
			}
		//	return $this->renderpartial('rencana-program-daerah-tampil',['TaSubUnit' => $TaSubUnit]);
        }

        $TaSubUnit = TaSubUnit::findAll($this->getPosisi1());
       // return $this->renderpartial('rencana-program-daerah-tampil',['TaSubUnit' => $TaSubUnit]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-lampiran3', [
                'TaSubUnit' => $TaSubUnit,
            ]),
            'options' => [
                'title' => 'Berita Hasil Kesepakatan Musrenbang RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
               
				'SetFooter' => ['Musrenbang RKPD Kabupaten Asahan'.'|Halaman {PAGENO}|CetakLampiran3'],
            ]
        ]);
        return $pdf->render();
    }	
	
    public function actionCetakTv1c13()
    {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tv1c13'),
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

    public function actionCetakTv1c14()
    {
        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        $kelompok = Yii::$app->levelcomponent->getKelompok();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c14',['unit' => $unit, 'kelompok' => $kelompok]),
            'options' => [
                'title' => 'Pemeringkatan Prioritas Program dan Kegiatan',
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

    public function actionCetakTv1c15()
    {
        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
        $kelompok = Yii::$app->levelcomponent->getKelompok();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c15',['unit' => $unit, 'kelompok' => $kelompok]),
            'options' => [
                'title' => 'Penggabungan Prioritas',
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

    public function actionCetakTv1c16()
    {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c16'),
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


    public function actionCetakTv1c17()
    {
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c17'),
            'options' => [
                'title' => 'Pemeringkatan Prioritas Program dan Kegiatan',
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

    public function actionCetakTvc74()
    {
        $data = TaSubUnit::findAll($this->getPosisi());

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc74', ['data' => $data]),
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

    public function actionCetakTvc75()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $model = TaProgram::findAll([
                'Tahun' => $Tahun, 
                'Kd_Urusan'=>$unit->Kd_Urusan, 
                'Kd_Bidang'=>$unit->Kd_Bidang, 
                'Kd_Unit'=>$unit->Kd_Unit, 
                'Kd_Sub'=>$unit->Kd_Sub_Unit]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc75', ['model'=>$model]),
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

    public function actionCetakTvc76()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc76'),
            'options' => [
                'title' => 'Cetak Tvc76',
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

    public function actionTv1c1Hal8()
    {
        return $this->render('tv1c1-hal8');
    }

    public function actionCetakTv1c1Hal8()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c1-hal8'),
            'options' => [
                'title' => 'Cetak Tvc1c1 Hal 8',
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

    public function actionTv1c2Hal17()
    {
        return $this->render('tv1c2-hal17');
    }

    public function actionCetakTv1c2Hal17()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c2-hal17'),
            'options' => [
                'title' => 'Cetak Tvc1c2 Hal 17',
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

    public function actionTv1c3Hal18()
    {
        return $this->render('tv1c3-hal18');
    }

    public function actionCetakTv1c3Hal18()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c3-hal18'),
            'options' => [
                'title' => 'Cetak Tvc1c3 Hal 18',
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


    public function actionTv1c4Hal19()
    {
        return $this->render('tv1c4-hal19');
    }

    public function actionCetakTv1c4Hal19()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c4-hal19'),
            'options' => [
                'title' => 'Cetak Tvc1c4 Hal 19',
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

    public function actionTv1c5Hal22()
    {
        return $this->render('tv1c5-hal22');
    }

    public function actionCetakTv1c5Hal22()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c5-hal22'),
            'options' => [
                'title' => 'Cetak Tvc1c5 Hal 22',
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

    public function actionTv1c6Hal23()
    {
        return $this->render('tv1c6-hal23');
    }

    public function actionCetakTv1c6Hal23()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tv1c6-hal23'),
            'options' => [
                'title' => 'Cetak Tvc1c6 Hal 23',
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



     public function actionTvic7Hal28()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $tahun = $Tahun + 1;

        return $this->render('tvic7-hal28',[
            'tahun'=>$tahun]);
    }

    public function actionCetakTvic7Hal28()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $tahun = $Tahun + 1;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvic7-hal28',[
                            'tahun'=>$tahun]),
            'options' => [
                'title' => 'Cetak Tvcic7 Hal 28',
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


      public function actionTvic8Hal28()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $tahun = $Tahun;

        return $this->render('tvic8-hal28',[
            'tahun'=>$tahun]);
    }

    public function actionCetakTvic8Hal28()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $tahun = $Tahun + 1;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvic8-hal28',[
                            'tahun'=>$tahun]),
            'options' => [
                'title' => 'Cetak Tvic8 Hal 28',
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

    public function actionTvic9Hal32()
    {
        return $this->render('tvic9-hal32');
    }

    public function actionCetakTvic9Hal32()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvic9-hal32'),
            'options' => [
                'title' => 'Kajian Usulan Program dan Kegiatan dari Masyarakat ',
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
    
    public function actionTvic11Hal36()
    {
        return $this->render('tvic11-hal36');
    }

    public function actionCetakTvic11Hal36()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvic11-hal36'),
            'options' => [
                'title' => 'Identifikasi Kebijakan Nasional',
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
    
    public function actionTvic12Hal37()
    {
        return $this->render('tvic12-hal37');
    }

    public function actionCetakTvic12Hal37()
    {

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak-tvic12-hal37'),
            'options' => [
                'title' => 'Identifikasi Kebijakan Nasional dan Provinsi',
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


}
