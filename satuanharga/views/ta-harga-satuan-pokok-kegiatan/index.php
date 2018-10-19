<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaHargaSatuanPokokKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Ta Harga Satuan Pokok Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-harga-satuan-pokok-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Harga Satuan Pokok Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Kd_Prov',
            // 'Kd_Kab',
            // 'Kd_Klasifikasi',
            // 'Kd_Aset1',
            // 'Kd_Aset2',
            // 'Kd_Aset3',
            // 'Kd_Aset4',
            // 'Kd_Aset5',
            // 'Kd_1',
            // 'Kd_2',
            // 'Kd_3',
            // 'Kd_Satuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
