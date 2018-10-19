<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'SistemKuitansi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StandardHarga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kontrol_Angg_SPD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kontrol_SPD_SPP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kontrol_SPP_SPM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Locked')->checkbox() ?>

    <?= $form->field($model, 'LastDBAplVer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DefaultPaper')->checkbox() ?>

    <?= $form->field($model, 'SPDKegiatan')->checkbox() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Pembayaran')->textInput() ?>

    <?= $form->field($model, 'PFK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Peny_SPJ')->checkbox() ?>

    <?= $form->field($model, 'SP2DPre')->checkbox() ?>

    <?= $form->field($model, 'SP2DFormat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KunciPagu')->checkbox() ?>

    <?= $form->field($model, 'Prognosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Akrual')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
