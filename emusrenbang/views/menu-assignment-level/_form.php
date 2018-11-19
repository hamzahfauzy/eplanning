<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignmentLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-assignment-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level')->dropDownList($level) ?>

    <?= $form->field($model, 'id_menu')->dropDownList($menus) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
