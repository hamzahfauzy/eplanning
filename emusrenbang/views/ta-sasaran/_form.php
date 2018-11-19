<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use common\models\Ta;
// $ta= new Ta();
// $misi=$ta->getNoMisi();
// $tujuan=$ta->getNoTujuan(0);

/* @var $this yii\web\View */
/* @var $model app\models\TaSasaran */
/* @var $form yii\widgets\ActiveForm */
$js="
    $('#No_Misi').change(function(){
        var No_Misi=$(this).val();
        $.post('index.php?r=ta-sasaran/get-tujuan&No_Misi='+No_Misi, function(data){
            $('#No_Tujuan').html(data);
        })
    });

    // $('#tujuan').change(function(){
    //     tujuan=$('#tujuan').val();
    //     misi=$('#misi').val();
    //     $.post('index.php?r=ajax/getnotasasaran&nomisi='+misi+'&notujuan='+tujuan, function(data, success){
    //         $('#nosasaran').val(data);
    //     })
    // });
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

    <?= $form->field($model, 'No_Misi')->dropDownList($dataMisi, ['prompt'=>'Pilih Misi', 'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->dropDownList($model->isNewRecord ? [] : $dataTujuan, ['prompt'=>'Pilih Tujuan', 'id'=>'No_Tujuan']) ?>

    <?= $form->field($model, 'No_Sasaran')->textInput(['id'=>'No_Sasaran']) ?>

    <?= $form->field($model, 'Ur_Sasaran')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


