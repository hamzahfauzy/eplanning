<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Ta;
$ta=new Ta();
$misi=$ta->getNoMisi();

/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */
/* @var $form yii\widgets\ActiveForm */
$js="
$('#misi').change(function(){
    misi=$('#misi').val();
    $.post('index.php?r=ajax/getnouruttatujuan&nomisi='+misi, function(data, success){
        $('#notujuan').val(data);
    })
});
";
$this->registerJs($js, 4, 'My');
?>

<div class="ta-tujuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'No_Misi')->dropDownList($misi, ['prompt'=>'Pilih Misi', 'id'=>'misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->textInput(['id'=>'notujuan']) ?>

    <?= $form->field($model, 'Ur_Tujuan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
