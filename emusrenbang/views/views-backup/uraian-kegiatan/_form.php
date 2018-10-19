<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UraianKegiatan */
/* @var $form yii\widgets\ActiveForm */
$js="
$('#harga').blur(function(){
    volume=$('#volume').val();
    harga=$('#harga').val();
    total=volume*harga;
    $('#total').val(total);
    //alert(volume);
});
";
$this->registerJs($js, 4, 'uraian');
$satuan=$this->context->getAllSatuan();
?>

<div class="uraian-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uraian')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => true, 'id'=>'volume']) ?>

    <?= $form->field($model, 'satuan')->dropDownList($satuan, ['prompt'=>'Pilih Satuan']); ?>

    <?= $form->field($model, 'harga')->textInput(['id'=>'harga'])->label('Harga') ?>

    <?= $form->field($model, 'total')->textInput(['id'=>'total'])->label('Total Harga') ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
