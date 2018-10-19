<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->dropDownList($users) ?>

    <?= $form->field($model, 'id_menu')->dropDownList($menus) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
