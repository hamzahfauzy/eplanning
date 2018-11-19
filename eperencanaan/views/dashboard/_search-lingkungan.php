<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaMusrenbangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-search">

    <?php $form = ActiveForm::begin([   
        'action' => ['usulan-lingkungan'],
        'method' => 'get',
    ]); ?>
    
    <div class="row">
        <div class="col-md-8">
            <?php 
                echo $form->field($model, 'globalSearch', ['inputOptions' => ['placeholder' => 'Masukkan kata kunci', 'class' => 'form-control', 'autocomplete' => 'off']])->label(false) 
            ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <!-- <div class="form-group">
        <?php //Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?php //Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
