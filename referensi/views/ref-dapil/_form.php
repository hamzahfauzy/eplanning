<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefDapil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-dapil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Dapil')->textInput() ?>

    <?= $form->field($model, 'Nm_Dapil')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
