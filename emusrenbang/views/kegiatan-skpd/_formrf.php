<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;
$referensi=new Referensi;
$data=$referensi->autoKegiatan();

$js="
$(function(){
   data=[".$data."];
   $('#keg').autocomplete(
   {
    source: data
   });
});

$('#keg').blur(function(){
   keg=$('#keg').val();
   $.post('index.php?r=kegiatan-skpd/getid&name='+keg, function(data, status){
        $('#Kd_Keg').val(data);
    })
});
";

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs($js, 4, 'urusan');

?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Keg')->textInput(['value'=>$kp, 'id'=>'Kd_Keg']) ?>

    <?= $form->field($model, 'Ket_Kegiatan')->textInput(['id'=>'keg']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div style="margin-bottom:100px"></div>
