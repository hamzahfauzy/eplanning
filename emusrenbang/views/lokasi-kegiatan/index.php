<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lokasi Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Lokasi Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lokasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
