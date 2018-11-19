<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaHargaSatuanPokokKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-harga-satuan-pokok-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Benua') ?>

    <?= $form->field($model, 'Kd_Benua_Sub') ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?php // echo $form->field($model, 'Kd_Kab') ?>

    <?php // echo $form->field($model, 'Kd_Klasifikasi') ?>

    <?php // echo $form->field($model, 'Kd_Aset1') ?>

    <?php // echo $form->field($model, 'Kd_Aset2') ?>

    <?php // echo $form->field($model, 'Kd_Aset3') ?>

    <?php // echo $form->field($model, 'Kd_Aset4') ?>

    <?php // echo $form->field($model, 'Kd_Aset5') ?>

    <?php // echo $form->field($model, 'Kd_1') ?>

    <?php // echo $form->field($model, 'Kd_2') ?>

    <?php // echo $form->field($model, 'Kd_3') ?>

    <?php // echo $form->field($model, 'Kd_Satuan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
