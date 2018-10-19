<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\RefSubUnitApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sub Unit Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-unit-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Sub Unit Apbn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Nm_Sub_Unit',
            // 'Flag',
            // 'Token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
