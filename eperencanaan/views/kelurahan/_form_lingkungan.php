<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\TaForumLingkungan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-forum-lingkungan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nm_Permasalahan')->textInput(['maxlength' => true]) ?>

    
	
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	<div>
	
 
	
</div>

</div>
