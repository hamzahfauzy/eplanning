<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Urusan */

$this->title = 'Ubah Urusan Provinsi: ' . $model->urusan;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Urusan Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->urusan, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="urusan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
