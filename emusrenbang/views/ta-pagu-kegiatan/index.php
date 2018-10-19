<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaPaguKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="box box-success">
        <div class="box-header">
            <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Pagu Kegiatan', ['create'], ['class' => 'btn btn-success pull-right']);
                }
            ?>
            <h1 class="box-title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="box-body">
            <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' =>[
                    'class' => 'table table-bordered',
                ],       
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Tahun',
                    [
                        'attribute' => 'Kd_Urusan',
                        'value' => 'refUrusan.Nm_Urusan',
                        'filter'=> $urusan,
                    ],
                    [
                        'attribute' => 'Kd_Bidang',
                        'value' => 'refBidang.Nm_Bidang',
                        'filter'=> $bidang,
                    ],
                    [
                        'attribute' => 'Kd_Unit',
                        'value' => 'refUnit.Nm_Unit',
                        'filter'=> $unit,
                    ],
                    [
                        'attribute' => 'Kd_Sub',
                        'value' => 'refSubUnit.Nm_Sub_Unit',
                        'filter'=> $subunit,
                    ],
                    [
                        'attribute' => 'Kd_Prog',
                        'value' => 'refProgram.Ket_Program',
                        'filter'=> $program,
                    ],
                    [
                        'attribute' => 'Kd_Keg',
                        'value' => 'refKegiatan.Ket_Kegiatan',
                        'filter'=> $kegiatan,
                    ],
                    // 'refKegiatan.program.Ket_Program',
                    // 'refKegiatan.Ket_Kegiatan',
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
                        'template' => Helper::filterActionColumn('{view}{update}{delete}')
                    ],
                ],
            ]); ?>





            </div>
        </div>
    </div>