<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefRek3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Rek3s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rek3-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ref Rek3', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Nm_Rek_3',
            'SaldoNorm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
