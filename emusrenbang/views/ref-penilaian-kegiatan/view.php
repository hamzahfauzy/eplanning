<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianKegiatan */

$this->title = $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Penilaian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-kegiatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Program' => $model->Kd_Program, 'ID_Penilaian' => $model->ID_Penilaian], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Program' => $model->Kd_Program, 'ID_Penilaian' => $model->ID_Penilaian], [
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
            'Kd_Program',
            'Kd_Kegiatan',
            'ID_Penilaian',
            'created_at',
            'updated_at',
            'username',
        ],
    ]) ?>

</div>
