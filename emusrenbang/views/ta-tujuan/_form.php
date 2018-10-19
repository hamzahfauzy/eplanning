<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use common\models\TaTujuan;

// $ta     = new TaTujuan();
// $misi   = $ta->getMisi();

/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */
/* @var $form yii\widgets\ActiveForm */

// $js="
// $('#misi').change(function(){
//     misi=$('#misi').val();
//     $.post('index.php?r=ajax/getnouruttatujuan&nomisi='+misi, function(data, success){
//         $('#notujuan').val(data);
//     })
// });
// ";
// $this->registerJs($js, 4, 'My');

?>


<div class="ta-tujuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->hiddenInput(['readonly'=>true])->label(false) ?>

    <?= $form->field($model, 'Kd_Bidang')->hiddenInput(['readonly'=>true])->label(false) ?>

    <?= $form->field($model, 'Kd_Unit')->hiddenInput(['readonly'=>true])->label(false) ?>

    <?= $form->field($model, 'Kd_Sub')->hiddenInput(['readonly'=>true])->label(false) ?>

    <?= $form->field($model, 'No_Misi')->dropDownList($dataMisi, ['prompt'=>'Pilih Misi', 'id'=>'misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->textInput() ?>

    <?= $form->field($model, 'Ur_Tujuan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
