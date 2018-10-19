<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefIndikator */

$this->title = 'Ubah Ref Indikator: ' . $model->Kd_Indikator;
$this->params['breadcrumbs'][] = ['label' => 'Ref Indikators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Indikator, 'url' => ['view', 'id' => $model->Kd_Indikator]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-indikator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
