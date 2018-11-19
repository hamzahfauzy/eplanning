<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRek1 */

$this->title = 'Referensi Rekening Akun: ' . $model->Nm_Rek_1;
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Rek_1, 'url' => ['view', 'id' => $model->Kd_Rek_1]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-rek1-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
