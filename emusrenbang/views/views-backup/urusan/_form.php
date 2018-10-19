<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Urusan */
/* @var $form yii\widgets\ActiveForm */
$misi=$this->context->getMisi();
?>

<div class="urusan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMisi')->dropDownList($misi,['prompt'=>'Pilih Misi']) ?>

    <?= $form->field($model, 'urusan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
