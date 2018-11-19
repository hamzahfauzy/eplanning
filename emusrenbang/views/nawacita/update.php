<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = 'Ubah Nawacita: ' . $model->nawacita;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Nawacita', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nawacita, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="nawacita-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
