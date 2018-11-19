<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kegiatan-index">
    <div class="box box-success">
        <div class="box-header">
            <h3><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.'
                    ],
                    [
                        'attribute' =>'Nm_Urusan',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Urusan.":".$model->Nm_Urusan; }
                    ],
                    [
                        'attribute' => 'Nm_Bidang',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Bidang.":".$model->Nm_Bidang; }
                    ],
                    [
                        'attribute' => 'Ket_Program',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Prog.":".$model->Ket_Program; }
                    ],
                    [
                        'attribute' => 'Ket_Kegiatan',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Keg.":".$model->Ket_Kegiatan; }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['class'=>'col-md-1']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>