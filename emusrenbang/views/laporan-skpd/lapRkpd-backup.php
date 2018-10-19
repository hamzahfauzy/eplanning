<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;
// $meIdUrusan=Yii::$app->user->identity->id_urusan;
// $meIdBidang=Yii::$app->user->identity->id_bidang;
// $meIdSkpd=Yii::$app->user->identity->id_skpd;

// $meDataUrusan=$ref->getUrusanOne($meIdUrusan);
// $meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
// $meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$this->title = "Laporan RKPD Tahun ".($tahun);
$this->params['breadcrumbs'][] = "Laporan";
$this->params['breadcrumbs'][] = $this->title;

$level = Yii::$app->user->level;
$namalengkap='';
if($level != "admin"){
    $namalengkap=Yii::$app->user->identity->nama_lengkap;
}


$js="Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//UIExtendedModals.init('index.php?r=ajax/modaltest&id=test');
TableAdvanced.init();

";
$this->registerJs($js, 4, 'My');

?>
<div>
    <div class="portlet-body form">
        <?php $form = ActiveForm::begin(); ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun</label>
                            <div>
                                <input type="text" name="tahun" value='<?= $tahun ?>' class="form-control" placeholder="Tahun Laporan">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label>Program</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Program">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue">Tampilkan</button>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="clearfix"></div>
    <br>
    <style type="text/css">
        .tanda{
            background: #578ebe !important;
            color: #fff !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <!-- <div class="caption">
                        <i class="fa fa-globe"></i>Datatable with TableTools
                    </div> -->
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered" id="sample_1">
                        <caption class="headerFox text-center">
                            <h2>Laporan RKPD Tahun <?= $tahun.' '.$namalengkap ?></h2>
                        </caption>
                        <thead>
                            <tr>
                                <th rowspan="2" class="vcenter text-center">Kode</th>
                                <th rowspan="2" class="vcenter text-center">
                                    Urusan/Bidang Urusan <br> Pemerintahan Daerah dan <br>Program/Kegiatan
                                </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Indikator Kinerja Program (Outcome)/ Kegiatan (Output)
                                </th>
                                <th colspan="4" class="vcenter text-center">Rencana Tahun <?= $tahun ?></th>
                                <th rowspan="2" class="vcenter text-center">Catatan Penting</th>
                                <!-- <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun <?= $tahun+1 ?></th> -->
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Lokasi</th>
                                <th class="vcenter text-center">Target Capaian</th>
                                <th class="text-right">Kebutuhan Dana/</th>
                                <th class="vcenter text-center">Sumber Dana</th>
                                <!-- <th class="vcenter text-center">Target Capaian Kinerja</th>
                                <th class="vcenter text-center">Kebutuhan Dana/ Pagu Indikatif</th> -->
                            </tr>

                            <tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                                <th class="text-center">(6)</th>
                                <th class="text-center">(7)</th>
                                <th class="text-center">(8)</th>
                                <!-- <td class="text-center">(9)</td>
                                <td class="text-center">(10)</td> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?= $html ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

