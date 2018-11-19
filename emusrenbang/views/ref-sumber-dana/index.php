<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefSumberDanaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sumber Danas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sumber-dana-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ref Sumber Dana', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Sumber',
            'Nm_Sumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
