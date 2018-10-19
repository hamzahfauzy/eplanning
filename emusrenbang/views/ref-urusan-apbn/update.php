<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\RefUrusanApbn */

$this->title = 'Update Ref Urusan Apbn: ' . $model->Kd_Urusan;
$this->params['breadcrumbs'][] = ['label' => 'Ref Urusan Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Urusan, 'url' => ['view', 'id' => $model->Kd_Urusan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-urusan-apbn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
