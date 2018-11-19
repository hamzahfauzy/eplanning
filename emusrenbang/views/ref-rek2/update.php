<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRek2 */

$this->title = 'Ubah : ' . $model->Nm_Rek_2;
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Kelompok', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Rek_2, 'url' => ['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-rek2-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
