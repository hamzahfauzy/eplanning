<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UraianKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uraian Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uraian-kegiatan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Uraian Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_kegiatan',
            'kode_skpd',
            'tahun',
            'jenis',
            // 'uraian:ntext',
            // 'volume',
            // 'satuan',
            // 'harga',
            // 'jumlah',
            // 'total',
            // 'keterangan:ntext',
            // 'save_status',
            // 'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
