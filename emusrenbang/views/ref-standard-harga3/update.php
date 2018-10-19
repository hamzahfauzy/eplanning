<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga3 */

$this->title = 'Update Ref Standard Harga3: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Harga3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-standard-harga3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
