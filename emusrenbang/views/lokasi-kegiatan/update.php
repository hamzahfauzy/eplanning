<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LokasiKegiatan */

$this->title = 'Ubah Lokasi Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="lokasi-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
