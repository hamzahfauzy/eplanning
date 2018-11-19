<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\TaMisi;

// $ta=new TaMisi();
// if($model->No_Misi){
//     $nomisi=$model->No_Misi;
// }else{
//     $nomisi=$ta->getNoTaMisi();
// }

/* @var $this yii\web\View */
/* @var $model app\models\TaMisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-misi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'No_Misi')->textInput(['readOnly'=>false]) ?>

    <?= $form->field($model, 'Ur_Misi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>