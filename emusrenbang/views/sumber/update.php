<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sumber */

$this->title = 'Ubah Sumber: ' . $model->sumber;
$this->params['breadcrumbs'][] = ['label' => 'Sumber', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sumber, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="sumber-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
