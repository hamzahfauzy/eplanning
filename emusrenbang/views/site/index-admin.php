<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

$this->title = 'E-Planning '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

?>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
               <h3><?= count($TaSubUnit);  ?></h3>
                <p>Jumlah Perangkat Daerah TA - <?= date('Y') ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            
			<a href="#" class="small-box-footer"><h1></h1></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= number_format($modelLingkungan,0, ',', '.'); ?></h3>
                <p>Usulan Dusun/Lingkungan</p>
				
            </div>
            <div class="icon">
                <i class="fa fa-balance-scale"></i>
            </div>
            
			<a href="<?= Url::toRoute(['ta-musrenbang/usulan-lingkungan']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?php echo $modelKelurahan ?></h3>
                <p>Usulan Desa/Kelurahan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            
			<a href="<?= Url::toRoute(['ta-musrenbang/usulan-kelurahan']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3><?php echo $modelKecamatan ?></h3>
                <p>Usulan Kecamatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-code-o"></i>
            </div>
            
			<a href="<?= Url::toRoute(['ta-musrenbang/usulan-kecamatan']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
				<h3><?php echo $modelPokir ?></h3>
                <p>Pokok Pikiran</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-archive-o"></i>
            </div>
            
			<a href="<?= Url::toRoute(['ta-musrenbang/usulan-pokir']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
				<h3><?= $modelForum; ?></h3>
                <p>Forum Perangkat Daerah</p>

            </div>
            <div class="icon">
                <i class="fa  fa-comments-o"></i>
            </div>
            
			<a href="<?= Url::toRoute(['ta-musrenbang/usulan-forum']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-folder-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pagu Indikatif OPD</span>
                <span class="info-box-number">
                    <?php 
                        echo number_format($TaPaguSubUnit,2,",","."); 
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-hourglass-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pemakaian Pagu Indikatif OPD</span>
                <span class="info-box-number">
                    <?= number_format($belanjarincsub,2,",",".") ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-12">
        <div class="box box-warning">
            <div class="box-body">
                <?php 
                    echo 
                    Highcharts::widget([
                        'scripts' => [
                            'modules/exporting',
                            'themes/grid-light',
                        ],
                        'options' => [
                            'title' => [
                                'text' => 'Jumlah Usulan Berdasarkan RPJMD dan Bidang Pembangunan',
                            ],
                            'xAxis' => [
                                'categories' => ['Jalan','Jembatan','Drainase','Irigasi','Prasarana Air Bersih','Pembangunan Bidang Kesehatan','Pembangunan Bidang Pendidikan','Pembangunan Bidang Pertanian','Pembangunan Bidang Lainnya',
                                                ],
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Jumlah Usulan']
                            ],
                            'series' => [
                                [
                                    'type' => 'column',
                                    'name' => 'Infrastruktur',
                                    'data' => $jumlahUsulan[0],
                                ],
                                [
                                    'type' => 'column',
                                    'name' => 'Kesehatan',
                                    'data' => $jumlahUsulan[1],
                                ],
                                [
                                    'type' => 'column',
                                    'name' => 'Pendidikan',
                                    'data' => $jumlahUsulan[2],
                                ],
 				[
                                    'type' => 'column',
                                    'name' => 'Pertanian',
                                    'data' => $jumlahUsulan[2],
                                ],
 				[
                                    'type' => 'column',
                                    'name' => 'Lainnya',
                                    'data' => $jumlahUsulan[2],
                                ],

                            ],
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-6">
        <div class="box box-danger">
            <div class="box-body">
                <?php

                    $arr = Json::encode($TaSubUnit);

                    echo
                    Highcharts::widget([
                        'scripts' => [
                            'modules/exporting',
                            'themes/grid-light',
                        ],
                        'options' => [
                            'title' => [
                                'text' => 'Jumlah Kegiatan Perangkat Daerah',
                            ],
                            'xAxis' => [
                                'categories' => ['Pembangunan Infrastruktur', 'Kesehatan','Pendidikan'],
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Jumlah Usulan']
                            ],
                            'series' => [
                                [
                                    'type' => 'column',
                                    'name' => 'Infrastruktur',
                                    'data' => [53, 72],
                                ],
                                [
                                    'type' => 'column',
                                    'name' => 'Kesehatan',
                                    'data' => [20, 34],
                                ],
                                [
                                    'type' => 'column',
                                    'name' => 'Pendidikan',
                                    'data' => [60, 70],
                                ],
                            ],
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div> -->
        
</div>