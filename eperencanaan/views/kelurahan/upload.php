<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefMedia */
/* @var $form ActiveForm */
?>
<div class="kelurahan-upload">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>
       
    
        <div class="form-group">
			<?= Html::submitButton('Selesai', ['class' => 'btn btn-primary', 'name' => 'selesai']) ?>
            <?= Html::submitButton('Tambah', ['class' => 'btn btn-primary', 'name' => 'tambah']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- kelurahan-upload -->
