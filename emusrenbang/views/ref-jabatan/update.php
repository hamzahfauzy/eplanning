<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJabatan */

$this->title = 'Ubah Ref Jabatan: ' . $model->Kd_Jab;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Jab, 'url' => ['view', 'id' => $model->Kd_Jab]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-jabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
