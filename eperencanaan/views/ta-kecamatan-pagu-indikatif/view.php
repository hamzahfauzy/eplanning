<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKecamatanPaguIndikatif */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kecamatan Pagu Indikatifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kecamatan-pagu-indikatif-view">
<p class="pull-right">
        <?= Html::a('Update', ['update', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec], [
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
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            'Pagu_Indikatif',
        ],
    ]) ?>

</div>
