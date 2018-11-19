<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaKalender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kalender-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Kd_Kalender') ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Waktu_Mulai') ?>

    <?= $form->field($model, 'Waktu_Selesai') ?>

    <?= $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
