<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LevelUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Level Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-unit-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Level Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            [
                'attribute' => 'Nm_Urusan',
                'format' => 'text',
                'value' => function($model){ return $model->Kd_Urusan.":".$model->Nm_Urusan; }
            ],
            [
                 'attribute' => 'Nm_Bidang',
                'format' => 'text',
                'value' => function($model){ return $model->Kd_Bidang.":".$model->Nm_Bidang; }
            ],
            [
                 'attribute' => 'Nm_Unit',
                'format' => 'text',
                'value' => function($model){ return $model->Kd_Unit.":".$model->Nm_Unit; }
            ],
            [
                'attribute' => 'Nm_Sub_Unit',
                'format' => 'text',
                'value' => function($model){ return $model->Kd_Sub.":".$model->Nm_Sub_Unit; }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
