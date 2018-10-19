<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKamusProgram */

$this->title = 'Ubah : ' . $model->Nm_Program;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Referensi Kamus Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Program, 'url' => ['view', 'id' => $model->Kd_Program]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-kamus-program-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
