<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaForumLingkunganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-forum-lingkungan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Benua') ?>

    <?= $form->field($model, 'Kd_Benua_Sub') ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?php // echo $form->field($model, 'Kd_Kab') ?>

    <?php // echo $form->field($model, 'Kd_Kec') ?>

    <?php // echo $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Lingkungan') ?>

    <?php // echo $form->field($model, 'Kd_Jalan') ?>

    <?php // echo $form->field($model, 'Kd_Usulan') ?>

    <?php // echo $form->field($model, 'Kd_Klasifikasi') ?>

    <?php // echo $form->field($model, 'Nm_Permasalahan') ?>

    <?php // echo $form->field($model, 'Volume') ?>

    <?php // echo $form->field($model, 'Kd_Satuan') ?>

    <?php // echo $form->field($model, 'Kd_Sasaran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
