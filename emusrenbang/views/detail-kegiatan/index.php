<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-kegiatan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Detail Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_kegiatan',
            'tahun',
            'lokasi',
            'target',
            // 'pagu',
            // 'sumber',
            // 'catatan',
            // 'prakiraan_target',
            // 'prakiraan_pagu',
            // 'username',
            // 'kode_skpd',
            // 'create_at',
            // 'save_status',
            // 'kategori',
            // 'file',
            // 'map',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
