<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Referensi;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$js="
    $('#idUrusan').change(function(){
        $('#idUnit,#idSubUnit').empty();
        $.post('index.php?r=ajax/getbidang&KdUrusan='+$(this).val(), function(data, status){
            $('#idBidang').html(data);
        });
    });
    $('#idBidang').change(function(){
        $('#idSubUnit').empty();
        urusan=$('#idUrusan').val();
        $.post('index.php?r=ajax/getunit&KdUrusan='+urusan+'&KdBidang='+$(this).val(), function(data, status){
            $('#idUnit').html(data);
        });
    });
    $('#idUnit').change(function(){
        urusan=$('#idUrusan').val();
        bidang=$('#idBidang').val();
        $.post('index.php?r=ajax/getsubunit&KdUrusan='+urusan+'&KdBidang='+bidang+'&KdUnit='+$(this).val(), function(data, status){
            $('#idSubUnit').html(data);
        });
    });
";
$this->registerJs($js,4,'User Js');
$ref = new Referensi();
$dataUrusan=$ref->getUrusan();
$dataBidang=isset($modelTaUser) ? $ref->getBidang($modelTaUser->Kd_Urusan) : null;
$dataUnit  =isset($modelTaUser) ? $ref->getUnit($modelTaUser->Kd_Urusan,$modelTaUser->Kd_Bidang) : null;
$dataSubUnit=isset($modelTaUser) ? $ref->getUnit($modelTaUser->Kd_Urusan,$modelTaUser->Kd_Bidang,$modelTaUser->Kd_Unit) : null;

$dataBidang=isset($dataBidang) ? $dataBidang : array();
$dataUnit=isset($dataUnit) ? $dataUnit : array();
$dataSubUnit=isset($dataSubUnit) ? $dataSubUnit : array();
$disabled=false;
if(Yii::$app->user->identity){
    $disabled=true;
}

$status=array(0=>'Tidak Aktif', 10=>'Aktif');
?>

<div class="user-form">
    <?= Html::errorSummary($model)?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($modelTaUser, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'idUrusan','disabled'=>$disabled]); ?>
    <?= $form->field($modelTaUser, 'Kd_Bidang')->dropDownList($dataBidang, ['prompt'=>'Pilih Bidang', 'id'=>'idBidang','disabled'=>$disabled]); ?>
    <?= $form->field($modelTaUser, 'Kd_Unit')->dropDownList($dataUnit, ['prompt'=>'Pilih Unit', 'id'=>'idUnit','disabled'=>$disabled]); ?>
    <?= $form->field($modelTaUser, 'Kd_Sub_Unit')->dropDownList($dataSubUnit, ['prompt'=>'Pilih Sub Unit', 'id'=>'idSubUnit','disabled'=>$disabled]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    <?php
    if(isset($model->password_hash)){
        echo $form->field($model, 'password_hash1')->textInput(['value'=>$model->password_hash, 'readonly' => true]);
    }
    ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList($status, ['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
