<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefAplikasi */

$this->title = 'Update Ref Aplikasi: ' . $model->Kd_Aplikasi;
$this->params['breadcrumbs'][] = ['label' => 'Ref Aplikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Aplikasi, 'url' => ['view', 'id' => $model->Kd_Aplikasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-aplikasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
