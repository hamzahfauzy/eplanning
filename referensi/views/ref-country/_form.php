<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefCountry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Benua')->dropDownList(Yii::$app->runAction('ajax/benua'),[
        'id' => 'benua',
        
    ])->label('Benua') ?>

    <?= $form->field($model, 'Kd_Benua_Sub')->dropDownList([],['id' => 'benua-sub'])->label('Sub Benua') ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara')->hiddenInput(['value'=>$model->Kd_Benua_Sub_Negara])->label(false) ?>

    <?= $form->field($model, 'Nm_Negara')->textInput(['maxlength' => true])->label('Nama Negara') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
