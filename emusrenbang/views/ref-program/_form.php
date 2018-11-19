<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */
$referensi=new Referensi;
$data=$referensi->autoProgram();
$js="
$(function(){
   data=[".$data."];
   $('#prog').autocomplete(
   {
    source: data
   });
});

$('#prog').blur(function(){
   prog=$('#prog').val();
   $.post('index.php?r=ref-program/getid&name='+prog, function(data, status){
        $('#Kd_Prog').val(data);
    })
});
";
$this->registerJs($js, 4, 'prog');
?>

<div class="ref-program-form">
    <div class="box box-success"> 
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
  
            <?= $form->field($model, 'Kd_Prog')->textInput(['value'=>$kp, 'id'=>'Kd_Prog', 'readOnly'=>true]) ?>

            <?= $form->field($model, 'Ket_Program')->textInput(['maxlength' => true, 'id'=>'prog']) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>