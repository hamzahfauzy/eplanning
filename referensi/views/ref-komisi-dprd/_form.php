<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKomisiDprd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-komisi-dprd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Komisi')->textInput() ?>

    <?= $form->field($model, 'Nm_Komisi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Keterangan')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
