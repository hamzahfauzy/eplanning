<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefFungsi */

$this->title = 'Ubah Data Fungsi: ' . $model->Kd_Fungsi;
$this->params['breadcrumbs'][] = ['label' => 'Data Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Fungsi, 'url' => ['view', 'id' => $model->Kd_Fungsi]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-fungsi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
