<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga3 */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Harga3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-standard-harga3-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Tahun' => $model->Tahun, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Tahun' => $model->Tahun, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3], [
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
            'Kd_1',
            'Kd_2',
            'Kd_3',
            'Uraian',
            'Harga',
            'Satuan',
            'Keterangan',
        ],
    ]) ?>

</div>
