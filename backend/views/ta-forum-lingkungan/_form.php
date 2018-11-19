<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaForumLingkungan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-forum-lingkungan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Forum_Lingkungan')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Lingkungan')->textInput() ?>

    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>

    <?= $form->field($model, 'Kd_Program')->textInput() ?>

    <?= $form->field($model, 'Kd_Kegiatan')->textInput() ?>

    <?= $form->field($model, 'Kd_Klasifikasi')->textInput() ?>

    <?= $form->field($model, 'Kd_Jenis_Usulan')->textInput() ?>

    <?= $form->field($model, 'Nm_Permasalahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Satuan')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
