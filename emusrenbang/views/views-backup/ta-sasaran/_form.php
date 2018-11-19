<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Ta;
$ta= new Ta();
$misi=$ta->getNoMisi();
$tujuan=$ta->getNoTujuan(0);

/* @var $this yii\web\View */
/* @var $model app\models\TaSasaran */
/* @var $form yii\widgets\ActiveForm */
$js="
    $('#misi').change(function(){
        misi=$('#misi').val();
        $.post('index.php?r=ajax/gettatujuan&nomisi='+misi, function(data, success){
            $('#tujuan').html(data);
        })
    });

    $('#tujuan').change(function(){
        tujuan=$('#tujuan').val();
        misi=$('#misi').val();
        $.post('index.php?r=ajax/getnotasasaran&nomisi='+misi+'&notujuan='+tujuan, function(data, success){
            $('#nosasaran').val(data);
        })
    });
";
$this->registerJs($js, 4, 'My');
?>

<div class="ta-sasaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'No_Misi')->dropDownList($misi, ['prompt'=>'Pilih Misi', 'id'=>'misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->dropDownList($tujuan, ['prompt'=>'Pilih Tujuan', 'id'=>'tujuan']) ?>

    <?= $form->field($model, 'No_Sasaran')->textInput(['id'=>'nosasaran']) ?>

    <?= $form->field($model, 'Ur_Sasaran')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
