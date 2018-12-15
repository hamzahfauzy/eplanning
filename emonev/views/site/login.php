<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'eMonev Kabupaten Asahan';
?>
 <?php //if ($_GET['pesan']=="coba") {?>

 
<div class="login-box">
    <div class="login-box-body">
        <center><img src='http://eplanning.asahankab.go.id/eperencanaan/lokasiimg/Logo1.png'></center>
        <hr>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="login-box-msg alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Username'])->label('') ?>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Password'])->label('') ?>
        <?php // $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), []) ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
		 
        <?php ActiveForm::end(); ?>
		
 
    </div>
    <div class="login-footer">
        <center><p>Bappeda Kabupaten Asahan 2017</p></center>
    </div>
</div>
