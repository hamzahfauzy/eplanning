<?php

use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<!-- page wrapper -->
        <div class="dev-page dev-page-login dev-page-login-v2">
                      
            <div class="dev-page-login-block">
                <a class="dev-page-login-block__logo">E-Planning</a>
                <div class="dev-page-login-block__form">
                    <div class="title"><strong>Selamat datang</strong>, Silahkan Masuk</div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

			                <?= $form->field($model, 'username', [
															    'inputOptions' => [
															        'placeholder' => $model->getAttributeLabel('Username'),
															    ],
															])->label(false); 
											?>
			                <?= $form->field($model, 'password', [
															    'inputOptions' => [
															        'placeholder' => $model->getAttributeLabel('Password'),
															    ],
															])->passwordInput()->label(false); 
											?>

		                <div class="form-group">
		                    <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
		                </div>

		                <?php ActiveForm::end(); ?>
                </div>
                <div class="dev-page-login-block__footer">
                    © 2017 <strong>BAPPEDA</strong> Kabupaten Asahan. All rights reserved
                </div>
            </div>
            
        </div>