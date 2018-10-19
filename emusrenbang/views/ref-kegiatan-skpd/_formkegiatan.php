<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */
/* @var $form yii\widgets\ActiveForm */

$urusan=$this->context->getUrusan();
$js="
$('#kdurusan').change(function(){
    id=$('#kdurusan').val();
    $.post('index.php?r=ref-kegiatan/listprogram&urusan='+id, function(data, status){
        $('#kdprog').html(data);
       // alert(data);
    });
});

$('#kdprog').change(function(){
    id=$('#kdprog').val();
    id1=$('#kdurusan').val();
    $.post('index.php?r=ref-kegiatan/listkegiatan&prog='+id+'&urusan='+id1, function(data, status){
        $('#kdkeg').html(data);
       // alert(data);
    });
});

$('#tambah').click(function(){

});
";
 $this->registerJs($js, 4, 'urusan');
 $prog=array();
$keg=array();
?>

<div class="ref-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan, ['prompt'=>'Pilih Urusan', 'id'=>'kdurusan']) ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog']) ?>

    <?= $form->field($model, 'Kd_Keg')->dropDownList($keg, ['prompt'=>'Pilih Kegiatan', 'id'=>'kdkeg']) ?>

    <?php //$form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true])
    ?>
    <div class="form-group" id="">

    </div>

    <div class="form-group">
        <?php //Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <a href="#" id="tambah">Tambah Kegiatan</a>

    <?php ActiveForm::end(); ?>

</div>
