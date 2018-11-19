<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaMusrenbangKelurahanAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Musrenbang Kelurahan Acaras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-acara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Musrenbang Kelurahan Acara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Waktu_Unduh_Absen',
            // 'Waktu_Unduh_Berita_Acara',
            // 'Waktu_Mulai',
            // 'Waktu_Selesai',
            // 'Nama_Tempat',
            // 'Alamat:ntext',
            // 'Nama_Pejabat',
            // 'Jumlah_Peserta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
