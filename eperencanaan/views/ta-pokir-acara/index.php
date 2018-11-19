<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaPokirAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Pokir Acaras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pokir-acara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Pokir Acara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_User',
            'Waktu_Unduh_Absen',
            'Waktu_Unduh_Berita_Acara',
            'Waktu_Mulai',
            // 'Waktu_Selesai',
            // 'Masa_Reses',
            // 'Nama_Tempat:ntext',
            // 'Nama_Tempat2:ntext',
            // 'Nama_Tempat3:ntext',
            // 'Alamat:ntext',
            // 'Jumlah_Peserta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
