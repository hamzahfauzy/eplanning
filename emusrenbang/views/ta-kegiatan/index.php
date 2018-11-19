<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?= Html::a('Create Ta Kegiatan', ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                    // 'ID_Prog',
                    // 'Kd_Keg',
                    // 'Ket_Kegiatan',
                    // 'Lokasi',
                    // 'Kelompok_Sasaran',
                    // 'Status_Kegiatan',
                    // 'Pagu_Anggaran',
                    // 'Waktu_Pelaksanaan',
                    // 'Kd_Sumber',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>