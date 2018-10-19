<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaProgramApbn */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Program Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-program-apbn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog], [
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
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'Ket_Prog',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
            'Kd_Urusan1',
            'Kd_Bidang1',
        ],
    ]) ?>

</div>
