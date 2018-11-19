<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefUrusan */

$this->title = 'Ubah Urusan: ' . $model->Nm_Urusan;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Urusan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Urusan, 'url' => ['view', 'id' => $model->Kd_Urusan]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-urusan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
