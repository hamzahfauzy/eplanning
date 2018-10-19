<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
use common\models\RefStandardSatuan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Kegiatan', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <table class="table-hover">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.'
                        ],
						
						
                        [
                            'format' => 'text',
                            'label' => "Urusan",
							'attribute' => 'Kd_Urusan',
                            'value' => function($model) {
                                return @$model->Kd_Urusan . ":" . @$model->urusan->Nm_Urusan;
                            }
                        ],
                        [
                            'format' => 'text',
                            'label' => "Bidang",
							'attribute' => 'Kd_Bidang',
                            'value' => function($model) {
                                return @$model->Kd_Bidang . ":" . @$model->bidang->Nm_Bidang;
                            }
                        ],
						
						
                        [
                            'format' => 'text',
                            'label' => "Program",
							'attribute' => 'Kd_Prog',
                            'value' => function($model) {
                                return @$model->Kd_Prog . ":" . @$model->program->Ket_Program;
                            }
                        ],
						
						 
                        [
                            'attribute' => 'Ket_Kegiatan',
                            'format' => 'text',
                            'value' => function($model) {
                                return @$model->Kd_Keg . ":" . @$model->Ket_Kegiatan;
                            }
                        ],
						
						 [
                            'format' => 'text',
                            'label' => "Unit",
							'attribute' => 'Kd_Unit',
                            'value' => function($model) {
                                return @$model->Kd_Unit . ":" . @$model->unit->Nm_Unit;
                            }
                        ],
						[
                            'format' => 'text',
                            'label' => "Sub",
							'attribute' => 'Kd_Sub_Unit',
                            'value' => function($model) {
                                return @$model->Kd_Sub_Unit . ":" . @$model->sub->Nm_Sub_Unit;
                            }
                        ],
						[
                            'attribute' => 'Indikator',
                            'format' => 'text',
                            'value' => function($model) {
                                return  $model->Indikator;
                            }
                        ],
                 /*       [
                            'format' => 'text',
							'label' =>"Satuan",
                            'value' => function($model) {
								return $model->satuan['Uraian'];
							}
			],*/
			 [
                            'attribute'=>'Satuan0',
							'format' => 'text',
							
                            'value' => function($model) {
								return @$model->Satuan0;
							}
			],

                        [
                            'attribute' => 'Target0',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target0,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Pagu_Indikatif',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Pagu_Indikatif,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Target1',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target1,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Pertama',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Pertama,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Target2',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target2,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Kedua',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Kedua,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Target3',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target3,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Ketiga',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Ketiga,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Target4',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target4,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Keempat',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Keempat,"0", ",", ".");
                            }
                        ],
                        [
                            'attribute' => 'Target5',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target5,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Kelima',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Kelima,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Target6',
                            'format' => 'text',
                            'value' => function($model) {
                                return  number_format(@$model->Target6,"0", ",", ".");
                            }
                        ],

                        [
                            'attribute' => 'Tahun_Akhir',
                            'format' => 'text',
                            'value' => function($model) {
                                return number_format(@$model->Tahun_Akhir,"0", ",", ".");
                            }
                        ],
                        
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        ],
                    ],
                ]);
                ?>
                </table>
            </div>
        </div>            
    </div>
</div>