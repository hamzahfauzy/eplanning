<?php

use yii\helpers\Html;
use app\models\Referensi;

$this->title = "Beranda";
// $this->params['breadcrumbs'][] = 'Berita';
// Yii::$app->session->addFlash('success', "Data Berhasil Ubah");

$ref = new Referensi;
$subUnit = Yii::$app->levelcomponent->getUnit();
$level = Yii::$app->levelcomponent->isRoles('Admin_Bappeda');
$usulanKegiatan = $ref->getKegiatanCount($subUnit->Kd_Urusan, $subUnit->Kd_Bidang, $subUnit->Kd_Unit);
$usulanKegiatanAll = $ref->getKegiatanCount();
$usulanProgram = $ref->getProgramCountMusren($subUnit->Kd_Urusan, $subUnit->Kd_Unit);

$this->registerJsFile(Yii::getAlias('@web') . '/js/jquery.countdown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = "
        $('#calendar').fullCalendar({
            eventSources: [
                'index.php?r=countdown/countajax'
            ]
        });
    ";
$this->registerJs($js, 4, 'My');
?>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $usulanProgram ?></h3>
                <p>Program Perangkat Daerah</p>
            </div>
            <div class="icon">
                <i class="fa fa-paper-plane-o"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $usulanKegiatanAll ?></h3>
                <p>Usulan Seluruh Perangkat Daerah</p>
            </div>
            <div class="icon">
                <i class="fa fa-tag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col --> 

    <?php if ($level == "Admin_Bappeda") { ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>0</h3>
                    <p>Usulan Perangkat Daerah Disetujui</p>
                </div>
                <div class="icon">
                    <i class="fa  fa-check-square-o"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>
                    <p>Usulan Perangkat Daerah Ditolak</p>
                </div>
                <div class="icon">
                    <i class="fa fa-remove"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    <?php }
    ?>
</div>
<!--End Row-->

<!-- <div class="row gutter-xs">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-middle media-left">
                        <div class="media-chart">
                            <canvas data-chart="doughnut" data-animation="false" data-labels='["Resolved", "Unresolved"]' data-values='[{"backgroundColor": ["#0288d1", "#757575"], "data": [<?= $usulanProgram ?>, 15]}]' data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="66" width="66"></canvas>
                        </div>
                    </div>
                    <div class="media-middle media-body">
                        <h6 class="media-heading">Program Perangkat Daerah</h6>
                        <h3 class="media-heading">
                            <span class="fw-l"><?= $usulanProgram ?></span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="media-middle media-left">
                        <div class="media-chart">
<?php if ($level != "Admin_Bappeda") { ?>
                                                    <canvas data-chart="doughnut" data-animation="false" data-labels='["Resolved", "Unresolved"]' data-values='[{"backgroundColor": ["#0288d1", "#757575"], "data": [<?= $usulanKegiatan ?>, 500]}]' data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="66" width="66"></canvas>
<?php } else { ?>
                                                    <canvas data-chart="doughnut" data-animation="false" data-labels='["Resolved", "Unresolved"]' data-values='[{"backgroundColor": ["#0288d1", "#757575"], "data": [0, 500]}]' data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="66" width="66"></canvas>
<?php } ?>
                        </div>
                    </div>
                    <div class="media-middle media-body">
<?php if ($level != "Admin_Bappeda") { ?>
                                                <h6 class="media-heading">Kegiatan Perangkat Daerah</h6>
                                                <h3 class="media-heading">
                                                    <span class="fw-l"><?= $usulanKegiatan ?></span>
                                                </h3>
<?php } else { ?>
                                                <h6 class="media-heading">Usulan Perangkat Daerah Disetujui</h6>
                                                <h3 class="media-heading">
                                                    <span class="fw-l">0</span>
                                                </h3>
<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if ($level == "Admin_Bappeda") { ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-middle media-left">
                                                <div class="media-chart">
                                                    <canvas data-chart="doughnut" data-animation="false" data-labels='["Resolved", "Unresolved"]' data-values='[{"backgroundColor": ["#0288d1", "#757575"], "data": [<?= $usulanKegiatanAll ?>, 500]}]' data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="66" width="66"></canvas>
                                                </div>
                                            </div>
                                            <div class="media-middle media-body">
                                                <h6 class="media-heading">Usulan Seluruh Perangkat Daerah</h6>
                                                <h3 class="media-heading">
                                                    <span class="fw-l"><?= $usulanKegiatanAll ?></span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-middle media-left">
                                                <div class="media-chart">
                                                    <canvas data-chart="doughnut" data-animation="false" data-labels='["Resolved", "Unresolved"]' data-values='[{"backgroundColor": ["#0288d1", "#757575"], "data": [0, 500]}]' data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="66" width="66"></canvas>
                                                </div>
                                            </div>
                                            <div class="media-middle media-body">
                                                <h6 class="media-heading">Usulan Perangkat Daerah Ditolak</h6>
                                                <h3 class="media-heading">
                                                    <span class="fw-l">0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php } ?>