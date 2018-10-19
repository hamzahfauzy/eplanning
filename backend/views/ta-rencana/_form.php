<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaRencana */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-rencana-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'ID_Prog')->textInput() ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_1')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_2')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_3')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_4')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_5')->textInput() ?>

    <?= $form->field($model, 'Jan')->textInput() ?>

    <?= $form->field($model, 'Feb')->textInput() ?>

    <?= $form->field($model, 'Mar')->textInput() ?>

    <?= $form->field($model, 'Apr')->textInput() ?>

    <?= $form->field($model, 'Mei')->textInput() ?>

    <?= $form->field($model, 'Jun')->textInput() ?>

    <?= $form->field($model, 'Jul')->textInput() ?>

    <?= $form->field($model, 'Agt')->textInput() ?>

    <?= $form->field($model, 'Sep')->textInput() ?>

    <?= $form->field($model, 'Okt')->textInput() ?>

    <?= $form->field($model, 'Nop')->textInput() ?>

    <?= $form->field($model, 'Des')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
