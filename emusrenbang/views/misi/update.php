<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Ubah Misi: ' . $model->misi;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Visi Misi Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->misi, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="misi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
