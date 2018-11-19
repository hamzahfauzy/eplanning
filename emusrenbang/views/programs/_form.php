<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Programs */
/* @var $form yii\widgets\ActiveForm */
$prioritas=$this->context->getAllPrioritas();
$urusan=$this->context->getAllUrusan();
$misi=$this->context->getAllMisi();

$js = "$('#prioritas').change(function(){
     i=$('#prioritas').val();
     $('body').addClass('loading');
       $.post('index.php?r=programs/listnawacita&id='+i,
    function(data, status){
        $('#naw').val(data);
        $('body').removeClass('loading');
    });
    });
    ";
    $this->registerJs($js, 4, 'prioritas');
?>
<div class="modal"></div>

<div class="programs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas Nasional', 'id'=>"prioritas"]) ?>

    <?= $form->field($model, 'nawacita')->textArea(['readonly' => true, 'id' => 'naw']); ?>

    <?= $form->field($model, 'urusan')->dropDownList($urusan, ['prompt' => 'Pilih Urusan', 'id' => 'urusan']) ?>

    <?= $form->field($model, 'misi')->dropDownList($misi, ['prompt' => 'Pilih Misi', 'id' => 'misi']) ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indikator_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Fisik' => 'Fisik', 'Non Fisik' => 'Non Fisik', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'aktif')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
