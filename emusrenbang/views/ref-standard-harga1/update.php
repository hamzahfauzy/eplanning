<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga1 */

$this->title = 'Update Ref Standard Harga1: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Harga1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_1' => $model->Kd_1]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-standard-harga1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
