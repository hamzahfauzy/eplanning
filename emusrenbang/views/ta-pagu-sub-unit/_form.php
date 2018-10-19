<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use emusrenbang\models\Referensi;

/* @var $this yii\web\View */
/* @var $model common\models\TaPaguSubUnit */
/* @var $form yii\widgets\ActiveForm */
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
    // $.post('index.php?r=ajax/getidunit&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
    //     $('#kdunit').html(data);
    // });
});
";

$this->registerJs($js, 4, "My");

?>

<div class="ta-pagu-sub-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan, ['prompt' =>'Pilih Urusan', 'id' => 'kdurusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList([0], ['Prompt' => 'Pilih Sektor', 'id'=>  'kdbidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList([0], ['Prompt' => 'Pilih Unit', 'id'=>  'kdunit']) ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'pagu')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     
    </div>
	
	

    <?php ActiveForm::end(); ?>

</div>
