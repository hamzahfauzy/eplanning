<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaPeraturan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-peraturan-form">
    <p>
      Peringatan!<br/>
      Posting Peraturan akan mengikat data laporan saat ini, pastikan data sudah tepat sebelum melakukan proses.
    </p>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'Kd_Tahapan')->dropDownList($RefTahapan, ['prompt'=>'Pilih Tahapan']) ?>
    
    <?= $form->field($model, 'Kd_Peraturan')->dropDownList($RefPeraturan, ['prompt'=>'Pilih Peraturan']) ?>

    <?= $form->field($model, 'No_Peraturan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tgl_Peraturan')->textInput(['class'=>'form-control datepicker']) ?>

    <?= $form->field($model, 'Uraian')->textArea() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
    $('.datepicker').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      language: "id"
    });
</script>