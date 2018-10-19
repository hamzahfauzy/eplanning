<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaPemdaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pemda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Nm_Pemda') ?>

    <?= $form->field($model, 'Nm_PimpDaerah') ?>

    <?= $form->field($model, 'Jab_PimpDaerah') ?>

    <?= $form->field($model, 'Nm_Sekda') ?>

    <?php // echo $form->field($model, 'Nip_Sekda') ?>

    <?php // echo $form->field($model, 'Jbt_Sekda') ?>

    <?php // echo $form->field($model, 'Nm_Ka_Keu') ?>

    <?php // echo $form->field($model, 'Nip_Ka_Keu') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_Keu') ?>

    <?php // echo $form->field($model, 'Nm_Ka_Anggaran') ?>

    <?php // echo $form->field($model, 'Nip_Ka_Anggaran') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_Anggaran') ?>

    <?php // echo $form->field($model, 'Nm_Ka_Verifikasi') ?>

    <?php // echo $form->field($model, 'Nip_Ka_Verifikasi') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_Verifikasi') ?>

    <?php // echo $form->field($model, 'Nm_Ka_Perbendaharaan') ?>

    <?php // echo $form->field($model, 'Nip_Ka_Perbendaharaan') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_Perbendaharaan') ?>

    <?php // echo $form->field($model, 'Nm_Ka_BUD') ?>

    <?php // echo $form->field($model, 'Nip_Ka_BUD') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_BUD') ?>

    <?php // echo $form->field($model, 'NPWP_BUD') ?>

    <?php // echo $form->field($model, 'K1') ?>

    <?php // echo $form->field($model, 'K2') ?>

    <?php // echo $form->field($model, 'K3') ?>

    <?php // echo $form->field($model, 'K4') ?>

    <?php // echo $form->field($model, 'Nm_Ka_Pembukuan') ?>

    <?php // echo $form->field($model, 'Nip_Ka_Pembukuan') ?>

    <?php // echo $form->field($model, 'Jbt_Ka_Pembukuan') ?>

    <?php // echo $form->field($model, 'Nm_Atasan_BUD') ?>

    <?php // echo $form->field($model, 'Nip_Atasan_BUD') ?>

    <?php // echo $form->field($model, 'Jbt_Atasan_BUD') ?>

    <?php // echo $form->field($model, 'Ibukota') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Logo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
