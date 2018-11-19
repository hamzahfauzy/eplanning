<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\TaKalender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kalender-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->dropDownList(['2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018']) ?>

    <?= $form->field($model, 'Waktu_Mulai')->widget(DateTimePicker::className(), ['pluginOptions' => ['format' => 'yyyy-m-dd H:i:s']]) ?>

    <?= $form->field($model, 'Waktu_Selesai')->widget(DateTimePicker::className(), ['pluginOptions' => ['format' => 'yyyy-m-dd H:i:s']]) ?>

    <?= $form->field($model, 'Keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
