<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;
$ref=new Referensi;
$user=$ref->getUserBapeda();
$urusan=$ref->getUrusan();
$js="
$('#kdurusan').change(function(){
    kdurusan=$('#kdurusan').val();
    $.post('index.php?r=ajax/getbidang&kdurusan='+kdurusan, function(data, success){
        $('#kdbidang').html(data);
    });
});

$('#kdbidang').change(function(){
    kdurusan=$('#kdurusan').val();
    kdbidang=$('#kdbidang').val();
    $.post('index.php?r=ajax/getunit&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
        $('#kdunit').html(data);
    });
})

$('#kdunit').change(function(){
        idskpd=$('#kdunit').val();
        idurusan=$('#kdurusan').val();
        idbidang=$('#kdbidang').val();
        $.post('index.php?r=users/listsubunit&urusan='+idurusan+'&bidang='+idbidang+'&skpd='+idskpd, function (data, status){
            $('#kdsub').html(data);
        });
    });
";
if(!empty($model->Kd_Urusan)){
    $bidang=$ref->getBidangUrusan($model->Kd_Urusan);
    $unit=$ref->getUnitBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang);
    $sub=$ref->getSubUnitBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang, $model->Kd_Unit);
}else{
    $bidang=array();
    $unit=array();
    $sub=array();
}
$this->registerJs($js, 4, 'My');

/* @var $this yii\web\View */
/* @var $model app\models\LevelUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="level-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->dropDownList($user, ['prompt'=>'User Bapeda','class'=>'form-group select2']) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan, ['prompt' => 'Pilih Urusan', 'id'=>'kdurusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt' => 'Pilih Sektor', 'id'=>'kdbidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($unit, ['prompt' => 'Pilih SKPD', 'id'=>'kdunit']) ?>

    <?= $form->field($model, 'Kd_Sub')->dropDownList($sub, ['prompt' => 'Pilih UPT', 'id'=>'kdsub']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
