<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\TaIndikator */

$this->title = 'Tambah Indikator Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja Kegiatan', 'url' => ['kegiatan-skpd/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div class="ta-indikator-list">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
           // 'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'Kd_Keg',
            // 'Kd_Indikator',
            // 'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
