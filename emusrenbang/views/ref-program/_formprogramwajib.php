<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

$referensi=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */
$urusan=$this->context->getUrusan();
$js="
$('#kdurusan').change(function(){
    id=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listbidang&urusan='+id, function(data, status){
        $('#kdbidang').html(data);
       // alert(data);
    })
});

$('#kdbidang').change(function(){
    $.post('index.php?r=ajax/listkamusprogram', function(data, status){
        $('#kdprog').html(data);
    })
});

";
$this->registerJs($js, 4, 'urusan');
$prog=array();
$bidang=array();

?>

<div class="ref-program-form">
    <div class="box box-success">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

            <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang', 'class'=>'form-control select2'])->label('Sektor') ?>

            <?= $form->field($model, 'Kd_Prog')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog', 'class'=>'form-control select2'])->label('Program Pembangunan'); ?>

            <?php //$form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>