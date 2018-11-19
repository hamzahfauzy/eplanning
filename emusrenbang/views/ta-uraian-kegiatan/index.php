<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaUraianKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Uraian Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-uraian-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ta Uraian Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
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
            'Kd_Prog',
            // 'Kd_Keg',
            // 'lokasi_Kegiatan',
            // 'kelompok_sasaran',
            // 'waktu_pelaksanaan',
            // 'status_kegiatan',
            // 'pagu',
            // 'sumber_dana',
            // 'DAK',
            // 'created_at',
            // 'updated_at',
            // 'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
