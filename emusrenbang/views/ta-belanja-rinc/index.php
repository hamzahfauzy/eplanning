<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaBelanjaRincSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Belanja Rincs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-rinc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Belanja Rinc', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'No_Rinc',
            // 'Keterangan',
            // 'Kd_Sumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
