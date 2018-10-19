<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UraianKegiatan */

$this->title = 'Update Uraian Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uraian Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="uraian-kegiatan-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
