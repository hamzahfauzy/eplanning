<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;

$ref=new Referensi();
$indikator=$ref->getIndikator();

/* @var $this yii\web\View */
/* @var $model app\models\TaIndikator */
/* @var $form yii\widgets\ActiveForm */
$js="
$('#tooltip').tooltip({
	content:'referensi yang disesuaikan dengan<br> RPJMD'
});
";
//$this->registerJs($js, 4, 'tool');
?>

<div class="ta-indikator-form">

<a href="#" class="tooltips" data-container="body" data-placement="right" data-align="left" data-html="true" data-original-title="<table><tr><td>No</td></tr><tr><td>referensi yang disesuaikan dengan<br> RPJMD</td></tr></table>">?</a>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Indikator')->dropDownList($indikator, ['prompt'=>'Pilih Indikator']) ?>

    <?= $form->field($model, 'Tolak_Ukur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Target_Angka')->textInput() ?>

    <?= $form->field($model, 'Target_Uraian')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
