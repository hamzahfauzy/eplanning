<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\RefUrusanApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Urusan Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-urusan-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Urusan Apbn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Urusan',
            'Nm_Urusan',
            'Flag',
            'Token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
