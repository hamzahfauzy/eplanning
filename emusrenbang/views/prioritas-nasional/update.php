<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PrioritasNasional */

$this->title = 'Ubah Prioritas Nasional: ' . $model->prioritas_nasional;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Prioritas Nasional', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prioritas_nasional, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="prioritas-nasional-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
