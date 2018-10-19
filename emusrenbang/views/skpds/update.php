<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Skpds */

$this->title = 'Ubah Skpd: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Skpd', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="skpds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
