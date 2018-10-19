<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga2 */

$this->title = 'Update Ref Standard Harga2: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Harga2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-standard-harga2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
