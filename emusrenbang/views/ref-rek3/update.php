<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRek3 */

$this->title = 'Ubah Referensi Rekening Jenis: ' . $model->Nm_Rek_3;
$this->params['breadcrumbs'][] = ['label' => 'Referensi Rekening Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Rek_3, 'url' => ['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-rek3-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
