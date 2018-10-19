<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\models\Referensi;

//$ref=new Referensi();
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$js="
    $('#id_urusan').change(function(){
        id=$('#id_urusan').val();
        $.post('index.php?r=users/listbidang&urusan='+id, function(data, status){
            $('#id_bidang').html(data);
        });
    });
    $('#id_bidang').change(function(){
        id=$('#id_bidang').val();
        $.post('index.php?r=users/listunit&bidang='+id, function(data, status){
            $('#id_skpd').html(data);
        });
    });
    $('#id_skpd').change(function(){
        idskpd=$('#id_skpd').val();
        idurusan=$('#id_urusan').val();
        idbidang=$('#id_bidang').val();
        $.post('index.php?r=users/listsubunit&urusan='+idurusan+'&bidang='+idbidang+'&skpd='+idskpd, function (data, status){
            $('#id_subunit').html(data);
        });
    });
";
$this->registerJs($js,4,'User Js');
$dataUrusan=$this->context->getUrusan();
$dataLevel=$this->context->getLevel();
$dataJabatan=$this->context->getJabatan();
$datasubunit=array();

$status=array(0=>'Tidak Aktif', 10=>'Aktif');

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?php
    if(isset($model->password_hash)){
    	echo $form->field($model, 'password_hash1')->textInput(['value'=>$model->password_hash, 'readonly' => true]);
    }
    ?>

    <?php //$form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jabatan')->dropDownList($dataJabatan, ['prompt'=>'']) ?>

    <?= $form->field($model, 'id_urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'id_urusan']); ?>

    <?= $form->field($model, 'id_bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'id_bidang']); ?>

    <?= $form->field($model, 'id_skpd')->dropDownList($dataSkpd, ['prompt' =>'Pilih SKPD', 'id'=>'id_skpd']) ?>

    <?= $form->field($model, 'id_subunit')->dropDownList($datasubunit, ['prompt' => 'Pilih Sub Unit', 'id'=>'id_subunit']) ?>

    <?= $form->field($model, 'id_level')->dropDownList($dataLevel, ['prompt' => '']) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($status, ['prompt'=>'']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
