<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdTujuan */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ta-rpjmd-tujuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'No_Misi')->label('Misi')->dropDownList($dataMisi, ['prompt'=>'Pilih Misi', 'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->textInput(['id'=>'No_Tujuan']) ?>

    <?= $form->field($model, 'Tujuan')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
    // $('#No_Misi').change(function(){
    //     var No_Misi=$(this).val();
    //     $.post('index.php?r=ta-rpjmd-tujuan/get-nomor-tujuan&No_Misi='+No_Misi, function(data){
    //         $('#No_Tujuan').val(data);
    //     })
    // })
</script>