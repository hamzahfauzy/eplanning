<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnit */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Data Umum Unit Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-view">

    <p>
        <?= Html::a('Ubah', ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], [
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
            'Nm_Pimpinan',
            'Nip_Pimpinan',
            'Jbt_Pimpinan',
            'Alamat',
            'Ur_Visi',
        ],
    ]) ?>

</div>
