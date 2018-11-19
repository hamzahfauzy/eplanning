<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Ta;
$ta=new ta();
if(empty($model->No_Fungsi)){
	$no=$ta->getNoFungsi();
}else{
	$no=$model->No_Fungsi;
}

/* @var $this yii\web\View */
/* @var $model app\models\TaFungsi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-fungsi-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'No_Fungsi')->textInput(['value'=>$no]) ?>

    <?= $form->field($model, 'Ur_Fungsi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
