<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RefKecamatanKriteriaPembobotan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-forum-kriteria-pembobotan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Kriteria') ?>

    <?= $form->field($model, 'Kriteria') ?>

    <?= $form->field($model, 'Bobot') ?>

    <?= $form->field($model, 'Keterangan_Kriteria') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
