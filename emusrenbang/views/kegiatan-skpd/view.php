<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Skpd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-skpd-view">

    <p>
        <?= Html::a('Ubah', ['update', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Program',
            'Kd_Kegiatan',
            'created_at',
            'updated_at',
            'username',
        ],
    ]) ?>

</div>
