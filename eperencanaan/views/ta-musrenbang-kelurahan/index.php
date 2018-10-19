<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaMusrenbangKelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Musrenbang Kelurahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Musrenbang Kelurahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Ta_Muserenbang_Kelurahan',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            // 'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Kd_Lingkungan',
            // 'Kd_Jalan',
            // 'Kd_Urusan',
            // 'Kd_Bidang',
            // 'Kd_Prog',
            // 'Kd_Keg',
            // 'Nm_Permasalahan:ntext',
            // 'Kd_Klasifikasi',
            // 'Jenis_Usulan:ntext',
            // 'Jumlah',
            // 'Kd_Satuan',
            // 'Harga_Satuan',
            // 'Harga_Total',
            // 'Kd_Sasaran',
            // 'Tanggal',
            // 'Kd_Status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
