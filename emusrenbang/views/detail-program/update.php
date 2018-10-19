<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailProgram */

$this->title = 'Ubah Detail Program: ' . $model->kode_program;
$this->params['breadcrumbs'][] = ['label' => 'Detail Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_program, 'url' => ['view', 'id' => $model->kode_program]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="detail-program-update">

    <?= $this->render('_form', [
        'model' => $model,
        'kode_program' => $kode_program,
    ]) ?>

</div>
