<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaKegiatanFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Kegiatan Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Kegiatan File', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'Kd_Keg',
            // 'Nama_File',
            // 'uploat_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
