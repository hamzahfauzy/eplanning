<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

   <div class="form-group">
		<?php echo Html::submitButton('Selesai', [ 'class' => 'btn btn-primary', 'name' => 'selesai' ]); ?>
		<?php echo Html::submitButton('Lanjut', ['class' => 'btn btn-primary', 'name' => 'lanjut']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
