<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
    <div class="box-body">
        <div class="ta-pagu-kegiatan-form">

            <?php $form = ActiveForm::begin(); ?>
		
            <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

            <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

            <?= $form->field($model, 'Kd_Unit')->textInput() ?>

            <?= $form->field($model, 'Kd_Sub')->textInput() ?>

            <?= $form->field($model, 'Kd_Prog')->textInput() ?>
			
			<?= $form->field($model, 'Kd_Keg')->textInput() ?>

            <?= $form->field($model, 'pagu')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


