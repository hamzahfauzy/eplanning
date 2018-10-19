<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSumberDana */

$this->title = 'Ubah Ref Sumber Dana: ' . $model->Kd_Sumber;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sumber Danas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Sumber, 'url' => ['view', 'id' => $model->Kd_Sumber]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-sumber-dana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
