<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\TaProgramApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Program Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-program-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Program Apbn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            // 'Kd_Prog',
            // 'ID_Prog',
            // 'Ket_Prog',
            // 'Tolak_Ukur',
            // 'Target_Angka',
            // 'Target_Uraian',
            // 'Kd_Urusan1',
            // 'Kd_Bidang1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
