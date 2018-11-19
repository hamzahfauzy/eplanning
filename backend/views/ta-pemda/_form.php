<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaPemda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pemda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'Nm_Pemda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_PimpDaerah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jab_PimpDaerah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_Keu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_Keu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_Keu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_Anggaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_Anggaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_Anggaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_Verifikasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_Verifikasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_Verifikasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_Perbendaharaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_Perbendaharaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_Perbendaharaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NPWP_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Ka_Pembukuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Ka_Pembukuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Ka_Pembukuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Atasan_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Atasan_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Atasan_BUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ibukota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
