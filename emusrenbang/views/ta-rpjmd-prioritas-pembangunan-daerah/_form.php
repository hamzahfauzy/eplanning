<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdPrioritasPembangunanDaerah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-rpjmd-prioritas-pembangunan-daerah-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'No_Prioritas')->textInput() ?>

    <?= $form->field($model, 'Prioritas_Pembangunan_Daerah')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
