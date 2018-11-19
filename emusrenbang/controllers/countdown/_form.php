<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Countdown */
/* @var $form yii\widgets\ActiveForm */
$tahun=date('Y');
?>

<div class="countdown-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['value'=>$tahun]) ?>

    <?= $form->field($model, 'start')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd'])->textinput(['class'=>'form-control']) ?>

    <?= $form->field($model, 'finish')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd'])->textinput(['class'=>'form-control']) ?>

	<?= $form->field($model, 'keterangan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
