<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-rek-aset2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Aset1')->textInput() ?>

    <?= $form->field($model, 'Kd_Aset2')->textInput() ?>

    <?= $form->field($model, 'Nm_Aset2')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
