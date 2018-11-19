<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerJs(
    "$('#kec').change(function(){
        var prov=$('#prov').val();
        var kab=$('#kab').val();
        var kec=$(this).val();
        // alert('".Yii::$app->urlManager->createUrl('ajax/getkel')."&Kd_Kec='+kec);
        $.post('".Yii::$app->urlManager->createUrl('ajax/getkel')."&Kd_Kec='+kec,function(data){
            $('#kel').html(data);
        });
    });"
);

$this->registerJs(
    "$('#kel').change(function(){
        var prov=$('#prov').val();
        var kab=$('#kab').val();
        var kec=$('#kec').val();
        var kel=$(this).val();
        $.post('".Yii::$app->urlManager->createUrl('ajax/getling')."&Kd_Kec='+kec+'&Kd_Urut_Kel='+kel,function(data){
            $('#ling').html(data);
        });
    });"
);

$this->registerJs(
    "$('#dapil').change(function(){
        var dapil=$(this).val();
        $.post('".Yii::$app->urlManager->createUrl('ajax/getdewan')."&Kd_Dapil='+dapil,function(data){
            $('#dewan').html(data);
        });
    });"
);

$this->registerJs(
    "$('#jenis_user').change(function(){
        var jenis=$(this).val();
        $.post('".Yii::$app->urlManager->createUrl('ajax/setlevel')."&jenis='+jenis,function(data){
            $('#level').html(data);
        });
        
    });"
);

// $this->registerJs(
//     "$('#ling').change(function(){
//         alert($(this).val());
//     });"
// );

$this->registerJs(
    "$('#aks').change(function(){
        var aks = $(this).val();
        if (aks == 'Operator_Kecamatan') {
            $('#dropKec').show();
            $('#dropKel').hide();
            $('#dropLing').hide();
            $('#dropSkpd').hide();
            $('#dropDapil').hide();
            $('#dropDewan').hide();
        }
        else if (aks == 'Operator_Kelurahan') {
            $('#dropKec').show();
            $('#dropKel').show();
            $('#dropLing').hide();
            $('#dropSkpd').hide();
            $('#dropDapil').hide();
            $('#dropDewan').hide();
        }
        else if (aks == 'Operator_Lingkungan') {
            $('#dropKec').show();
            $('#dropKel').show(); 
            $('#dropLing').show();
            $('#dropSkpd').hide();
            $('#dropDapil').hide();
            $('#dropDewan').hide();
        }
        else if (aks == 'Operator_Skpd') {
            $('#dropKec').hide();
            $('#dropKel').hide(); 
            $('#dropLing').hide();
            $('#dropSkpd').show();
            $('#dropDapil').hide();
            $('#dropDewan').hide();
        }
        else if (aks == 'Operator_Bappeda') {
            $('#dropKec').hide();
            $('#dropKel').hide(); 
            $('#dropLing').hide();
            $('#dropSkpd').hide();
            $('#dropDapil').hide();
            $('#dropDewan').hide();
        }
        else if (aks == 'Operator_Pokir') {
            $('#dropDapil').show();
            $('#dropDewan').show();
            $('#dropKec').hide();
            $('#dropKel').hide(); 
            $('#dropLing').hide();
            $('#dropSkpd').hide();
        }
    });"
);

// use yii\helpers\ArrayHelper;
// use common\models\RefKecamatan;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'akses')->dropDownList(
            [
                // 'Admin_Sistem' => 'Admin',
                'Operator_Bappeda' => 'Operator Bappeda',
                'Operator_Skpd' => 'SKPD',
                'Operator_Pokir' => 'Pokir',
                'Operator_Kecamatan' => 'Kecamatan', 
                'Operator_Kelurahan' => 'Kelurahan', 
                'Operator_Lingkungan' => 'Lingkungan',
            ], 
            ['id'=>'aks', 'prompt' => 'Pilih Hak Akses']
        );?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-option" id="dropSkpd" style="padding-bottom: 10px; display: none">
            <?= $form->field($model, 'skpd')->dropdownlist($dataSkpd,
            [
                'prompt' => 'Pilih Skpd',
                'class' => 'dependent-input form-control',
                'id' => 'skpd'
            ]); ?>
        </div>

        <div class="form-option" id="dropDapil" style="padding-bottom: 10px;display: none">
            <?= $form->field($model, 'dapil')->dropdownlist($dapil,
            [
                'prompt' => 'Pilih Dapil',
                'class' => 'dependent-input form-control',
                'id' => 'dapil'
            ]); ?>
        </div>

        <div class="form-option" id="dropDewan" style="padding-bottom: 10px;display: none">
            <?= $form->field($model, 'dewan')->dropdownlist([],
            [
                'prompt' => 'Pilih Dewan',
                'class' => 'dependent-input form-control',
                'id' => 'dewan'
            ]); ?>
        </div>

        <div class="form-option" id="dropKec" style="padding-bottom: 10px;display: none">
            <?= $form->field($model, 'kec')->dropdownlist($kec,
            [
                'prompt' => 'Pilih Kecamatan',
                'class' => 'dependent-input form-control',
                'id' => 'kec'
            ]); ?>
        </div>

        <div class="form-option" id="dropKel" style="padding-bottom: 10px;display: none">
            <?= $form->field($model, 'urutkel')->dropdownlist([],
            [
                'prompt' => 'Pilih Kelurahan',
                'class' => 'dependent-input form-control',
                'id' => 'kel'
            ]); ?>
        </div>

        <div class="form-option" id="dropLing" style="padding-bottom: 10px;display: none">
            <?= $form->field($model, 'ling')->dropdownlist([],
            [
                'prompt' => 'Pilih Lingkungan',
                'class' => 'dependent-input form-control',
                'id' => 'ling'
            ]); ?>
        </div>

   <div class="form-group">
        <?php echo Html::submitButton('Selesai', [ 'class' => 'btn btn-primary', 'name' => 'selesai' ]); ?>
        <?php // echo Html::submitButton('Lanjut', ['class' => 'btn btn-primary', 'name' => 'lanjut']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
