<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\RefUnitApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Unit Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-unit-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Unit Apbn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Nm_Unit',
            'Flag',
            // 'Token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
