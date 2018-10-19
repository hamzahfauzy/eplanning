<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;
$ref=new Referensi();
$jabatan=$ref->getJabatan();

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnitJab */
/* @var $form yii\widgets\ActiveForm */
$js="
$('#jabatan').change(function(){
    jab=$('#jabatan').val();
    $.post('index.php?r=ajax/getnourutunitjabatan&kdjab='+jab, function(data, success){
        $('#nourut').val(data);
    })
})
";
$this->registerJs($js, 4, 'My');
?>

<div class="ta-sub-unit-jab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Jab')->dropDownList($jabatan, ['prompt'=>'Pilih Jabatan', 'id'=>'jabatan']) ?>

    <?= $form->field($model, 'Nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'No_Urut')->hiddenInput(['id'=>'nourut'])->label(''); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
