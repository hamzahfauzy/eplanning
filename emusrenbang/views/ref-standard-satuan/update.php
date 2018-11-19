<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardSatuan */

$this->title = 'Update Ref Standard Satuan: ' . $model->ID_Satuan;
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Satuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_Satuan, 'url' => ['view', 'id' => $model->ID_Satuan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-standard-satuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
