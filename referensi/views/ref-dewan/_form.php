<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\RefDewan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-dewan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Dapil')->label('Daerah Pemilihan')->dropDownList($dataDapil, ['prompt'=>'Pilih Daerah Pemilihan', 'id'=>'Kd_Dapil']) ?>

    <?= $form->field($model, 'Kd_Dewan')->textInput() ?>

    <?= $form->field($model, 'Nm_Dewan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
