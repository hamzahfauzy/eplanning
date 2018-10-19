<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kegiatans */

$this->title = 'Ubah Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kegiatans-update">


    <?= $this->render('_form', [
        'model' => $model,
        'dataProgram' => $dataProgram,
    ]) ?>

</div>
