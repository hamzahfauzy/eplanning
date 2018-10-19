<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-penilaian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Penilaian')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

    <?php //$form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
