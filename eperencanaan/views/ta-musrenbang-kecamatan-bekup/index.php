<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaMusrenbangKecamatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Musrenbang Kecamatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kecamatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Musrenbang Kecamatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Musrenbang_Kecamatan',
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            // 'Kd_Prov',
            // 'Kd_Kab',
            // 'Kd_Kec',
            // 'Kd_Kel',
            // 'Kd_Urut_kel',
            // 'Kd_Lingkungan',
            // 'Kd_Jalan',
            // 'Kd_Usulan',
            // 'Kd_Urusan',
            // 'Kd_Bidang',
            // 'Kd_Prog',
            // 'Kd_Keg',
            // 'Kd_Klasifikasi',
            // 'Nm_Permasalahan',
            // 'Volume',
            // 'Kd_Satuan',
            // 'Kd_Sasaran',
            // 'Kd_Status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
