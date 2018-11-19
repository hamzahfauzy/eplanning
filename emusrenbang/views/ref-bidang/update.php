<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBidang */

$this->title = 'Ubah Sektor: ' . $model->Nm_Bidang;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Sektor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Bidang, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-bidang-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
