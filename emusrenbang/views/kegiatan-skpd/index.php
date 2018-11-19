<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan Skpd';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-skpd-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kegiatan SKPD', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Program',
            // 'Kd_Kegiatan',
            // 'created_at',
            // 'updated_at',
            // 'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
