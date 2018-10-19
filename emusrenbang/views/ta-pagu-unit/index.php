<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaPaguUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Unit';
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ta-pagu-unit-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Ta Pagu Unit', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'Tahun',
                    'Kd_Urusan',
                    'Kd_Bidang',
                    'Kd_Unit',
                    [
                        'attribute'=>'pagu',
                        'format'=>['decimal', 2],
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

<!--
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php
                if (Helper::checkRoute('list')) {
                    echo Html::a('Pagu Indikatif Unit', ['list'], ['class' => 'btn btn-warning pull-right']);
                }
                ?>
                
                <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Pagu Unit', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>
            </div>
            <!-- /.box-header -->
			<!--
            <div class="box-body">
                <table class="table-hover">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'Tahun',
                        'Kd_Urusan',
                        'Kd_Bidang',
                        'Kd_Unit',
                        [
                            'attribute' => 'pagu',
                            'format' => ['decimal', 2],
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
            <!-- /.box-body
        </div>
        <!-- /.box
    </div>
</div>
-->