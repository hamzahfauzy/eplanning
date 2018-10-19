<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Countdown */

$this->title = 'Update Jadwal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="countdown-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
