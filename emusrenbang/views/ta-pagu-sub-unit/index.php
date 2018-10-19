<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaPaguSubUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Sub Unit';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
$xTahun=Date('Y')+1;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
             <!--   <?php
                if (Helper::checkRoute('list')) {
                    echo Html::a('Pagu Indikatif Sub Unit', ['list'], ['class' => 'btn btn-warning pull-right']);
                }
                ?>
-->
                <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Pagu Sub Unit', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>

                <?php $form = \yii\bootstrap\ActiveForm::begin([
                            'id' => 'search-usulan',
                            'action' => ['ta-pagu-sub-unit/cetak'], 
                            'options' => ['target' => '_blank']
                ]) ?>
                <div class="form-group">
                    <div class="col-sm-2">
                        <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-md']); ?>
                    </div>
                </div>
                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
            <!-- /.box-header -->
            <div class="table-responsive">
                <div class="box-body">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'options' =>[
                            'class' => 'table table-bordered',
                        ],       
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'Tahun',
                            [
                                'attribute' => 'Kd_Urusan',
                                'value' => 'urusan.Nm_Urusan',
                                'filter'=> $urusan,
                            ],
                            [
                                'attribute' => 'Kd_Bidang',
                                'value' => 'bidang.Nm_Bidang',
                                'filter'=> $bidang,
                            ],
                            [
                                'attribute' => 'Kd_Unit',
                                'value' => 'unit.Nm_Unit',
                                'filter'=> $unit,
                            ],
                            [
                                'attribute' => 'Kd_Sub',
                                'value' => 'sub_unit.Nm_Sub_Unit',
                                'filter'=> $subunit,
                            ],
                            [
                                'label' => 'Pagu',
                                'value' => 'pagu',
                                'format' => ['decimal', 2],
                                'contentOptions' => ['class' => 'text-right']
                            ],
                            [
                                'label' => 'Pagu Serapan',
                                'format' => ['decimal', 2],
                                'contentOptions' => ['class' => 'text-right'],
                                'value' => function($model) {return $model->getTaBelanjaRincSubs()->sum('Total');},

                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                            ],
                        ],
                    ]);
                    ?>
                    
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
