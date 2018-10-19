<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi; // sebelumnya use app\models\Referensi;

$referensi=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */
$urusan=$referensi->getUrusan();
$js="
$('#kdurusan').change(function(){
    id=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listbidang&urusan='+id, function(data, status){
        $('#kdbidang').html(data);
       // alert(data);
    })
});

$('#kdbidang').change(function(){
    id=$('#kdbidang').val();
    urusan=$('#kdurusan').val();

    $.post('index.php?r=ref-program/listunit&urusan='+urusan+'&bidang='+id, function(data, status){
        $('#kdunit').html(data);
    })
});

";
$this->registerJs($js, 4, 'urusan');
$model->pagu=(int) $model->pagu;

?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang'])->label('Sektor') ?>

     <?= $form->field($model, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit', 'id'=>'kdunit'])->label('Unit'); ?>

    <?= $form->field($model, 'pagu')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div style="margin-bottom:100px"></div>
