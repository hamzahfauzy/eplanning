<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\TaBelanjaApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Belanja Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Belanja Apbn', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'Kd_Keg',
            // 'Kd_Rek_1',
            // 'Kd_Rek_2',
            // 'Kd_Rek_3',
            // 'Kd_Rek_4',
            // 'Kd_Rek_5',
            // 'Kd_Ap_Pub',
            // 'Kd_Sumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
