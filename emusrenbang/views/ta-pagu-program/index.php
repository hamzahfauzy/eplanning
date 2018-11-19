<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaPaguProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Program';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ta-pagu-program-index">
    <div class="box box-success">
        <div class="box-header">
            <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Pagu Program', ['create'], ['class' => 'btn btn-success pull-right']);
                }
            ?>
            
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="table-responsive">
            <div class="box-body">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                            'attribute' => 'Kd_Prog',
                            'value' => 'program.Ket_Program',
                            'filter'=> $program,
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
                            'template' => Helper::filterActionColumn('{view}{update}{delete}')
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>