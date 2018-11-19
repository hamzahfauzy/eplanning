<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdMisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-rpjmd-misi-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'No_Misi')->textInput() ?>

    <?= $form->field($model, 'Misi')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>