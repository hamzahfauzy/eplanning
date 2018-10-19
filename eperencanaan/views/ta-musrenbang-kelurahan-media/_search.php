<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaMusrenbangKelurahanMediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-kelurahan-media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Musrenbang_Kelurahan') ?>

    <?= $form->field($model, 'Kd_Media') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
