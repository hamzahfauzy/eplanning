<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\RefSubUnit;
use emusrenbang\models\TaSubUnit;

$this->title = 'Pra RKA';

//$this->params['breadcrumbs'][] ='';
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//     '@web/js/musrenbang/usulan_prioritas.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
?>


<div class="box box-success">
    <div class="box-header">
        <div class="control-wrap">
            <?php
            $form = \yii\bootstrap\ActiveForm::begin([
                        'id' => 'search-usulan',
                        'action' => ['laporan-pra-rka/cetak'],
                        'options' => ['target' => '_blank']
                    ])
            ?>
            <div class="form-group">
                <div class="col-sm-2">
                    <br>
                    <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
                </div>
            </div>
            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>

    <div class="box-body">

        <div class="table-responsive">

            <?=
            GridView::widget([
                'filterModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'Perangkat Daerah',
                        'value' => function ($model) {
                            return $model->refSubUnit->Nm_Sub_Unit;
                        },
                    // 'filter' => ArrayHelper::map(RefSubUnit::find()->all(),'Kd_Sub', 'Nm_Sub_Unit'),
                    ],
                    [
                        'attribute' => 'Program',
                        'value' => function ($model) {
                            return @$model->refProgram->Ket_Program;
                        },
                    ],
                    [
                        'label' => 'Indikator Kinerja',
                    ],
                    [
                        'label' => 'Target Kinerja',
                    ],
                    [
                        'attribute' => 'pagu',
                        'value' => function ($model) {
                            
                            return @$model->pagu['pagu'];

                           
                        },
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>