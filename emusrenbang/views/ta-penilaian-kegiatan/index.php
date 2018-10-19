<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaPenilaianKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Penilaian Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-penilaian-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Penilaian Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'ID_Penilaian',
            // 'created_at',
            // 'updated_at',
            // 'username',
            // 'status',
            // 'created_status',
            // 'updated_status',
            // 'status_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
