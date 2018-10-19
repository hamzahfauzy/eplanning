<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefStandardHarga2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Standard Harga2s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-standard-harga2-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Standard Harga2', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_1',
            'Kd_2',
            'Uraian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
