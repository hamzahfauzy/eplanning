<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Kd_User') ?>

    <?= $form->field($model, 'Nm_Lengkap') ?>

    <?= $form->field($model, 'Tgl_Lahir') ?>

    <?= $form->field($model, 'Alamat') ?>

    <?= $form->field($model, 'Telp') ?>

    <?php // echo $form->field($model, 'Mobile') ?>

    <?php // echo $form->field($model, 'Foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
