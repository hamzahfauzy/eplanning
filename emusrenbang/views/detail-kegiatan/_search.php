<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_kegiatan') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'lokasi') ?>

    <?= $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'pagu') ?>

    <?php // echo $form->field($model, 'sumber') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'prakiraan_target') ?>

    <?php // echo $form->field($model, 'prakiraan_pagu') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'kode_skpd') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'save_status') ?>

    <?php // echo $form->field($model, 'kategori') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'map') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
