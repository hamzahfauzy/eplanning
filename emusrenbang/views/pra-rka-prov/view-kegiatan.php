<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;

$this->title = 'Kegiatan OPD';
$this->params['breadcrumbs'][] = ['label' => $data->program->Ket_Program,
								'url' => ['program',
								 'Tahun' => $data->Tahun,
								 'Kd_Urusan' => $data->Kd_Urusan,
								 'Kd_Bidang' => $data->Kd_Bidang,
								 'Kd_Unit' => $data->Kd_Unit,
								 'Kd_Sub' => $data->Kd_Sub,
								 'Kd_Prog' => $data->Kd_Prog
								]];
$this->params['breadcrumbs'][] = $this->title;


?>



<div class="ref-kegiatan-index"> 
    <div class="box box-success">
        <div class="box-body">
			<?= Html::a("Tambah Kegiatan", 
					['tambah-kegiatan' ,
					 'Tahun' => $data->Tahun,
					 'Kd_Urusan' => $data->Kd_Urusan,
					 'Kd_Bidang' => $data->Kd_Bidang,
					 'Kd_Unit' => $data->Kd_Unit,
					 'Kd_Sub' => $data->Kd_Sub,
					 'Kd_Prog' => $data->Kd_Prog
					], 
					['class' => 'btn btn-success pull-right']);?>
            <table id="" class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td class="col-md-2">Urusan</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td ><?= $data->Kd_Urusan; ?></td>
                        <td><?= $data->urusan->Nm_Urusan; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Bidang</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang; ?></td>
                        <td><?= $data->bidang->Nm_Bidang; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Unit</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td> <?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit; ?></td>
                        <td><?= $data->unit->Nm_Unit; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Sub Unit</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub; ?></td>
                        <td><?= $data->sub->Nm_Sub_Unit; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Program</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub . "." . $data->Kd_Prog; ?></td>
                        <td><?= $data->program->Ket_Program; ?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-hover">
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
                        'attribute' => 'Ket_Kegiatan',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'Cari Nama Kegiatan'
                        ],
                        'format' => 'text',
                        'label' => 'Keterangan Kegiatan',
                        'value' => function($model) {return $model->Kd_Urusan . "." . $model->Kd_Bidang . "." . $model->Kd_Unit . "." . $model->Kd_Sub . "." . $model->Kd_Prog . "." . $model->Kd_Keg ." : ". $model->Ket_Kegiatan;}
                    ],
                    [
                        'label' => 'Pagu Kegiatan',
                        'value' => function($model) {return number_format($model->pagu['pagu'],0,'.','.');}
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'kegiatan' => function ($url, $model) {
                                return Html::a('<span class="fa fa-bar-chart"></span>', $url, [
                                            'title' => Yii::t('app', 'lead-view'),
                                ]);
                            },
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'kegiatan') {
                                    $url ='index.php?r=client-login/lead-view&id='.$model->id;
                                    return $url;
                                }
                            }
                        ],
                        'template' => Helper::filterActionColumn('{kegiatan}{view}{update}{delete}'),
                    ]
                ],
            ]);
            ?>
            </table>
        </div>
    </div>
</div>