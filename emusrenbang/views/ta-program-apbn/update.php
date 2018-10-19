<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaProgramApbn */

$this->title = 'Update Ta Program Apbn: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Program Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-program-apbn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
