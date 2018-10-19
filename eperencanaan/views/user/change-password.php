<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\widgets\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Ubah Password';
$this->params['breadcrumbs'][] = ['label' => yii::$app->user->identity->username, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title . ' ' . yii::$app->user->identity->username ?></h3>
    </div>

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
    <?= $form->field($model, 'currentPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPasswordConfirm')->passwordInput() ?>
    
    <div class="box-footer">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>