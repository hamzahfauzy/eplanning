<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Satuan */

$this->title = 'Ubah Satuan: ' . $model->satuan;
$this->params['breadcrumbs'][] = ['label' => 'Satuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->satuan, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="satuan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
