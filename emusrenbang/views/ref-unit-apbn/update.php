<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\RefUnitApbn */

$this->title = 'Update Ref Unit Apbn: ' . $model->Kd_Urusan;
$this->params['breadcrumbs'][] = ['label' => 'Ref Unit Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Urusan, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-unit-apbn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
