<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

    <?php //$form->field($model, 'publish_at')->textInput() ?>

    <?php //$form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'view')->textInput() ?>

    <?php //$form->field($model, 'hit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
