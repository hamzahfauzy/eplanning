<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatan */

$this->title = 'Ubah Detail Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="detail-kegiatan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
