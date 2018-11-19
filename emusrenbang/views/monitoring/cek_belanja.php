<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Monitoring Belanja';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-md-6"> 
    <div class="box box-success ">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'Nm_Rek_1')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $Nm_Rek_1, 'disabled'=>true]) ?>
                <?= $form->field($model, 'Nm_Rek_2')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $Nm_Rek_2, 'disabled'=>true]) ?>
                <?= $form->field($model, 'Kd_Rek_3')->dropDownList($Data_Rek_3, ['prompt'=>'Pilih Status', 'class'=>'form-control input-sm', 'id'=>'Kd_Rek_3']) ?>
        
                <?php echo Html::submitButton('Lihat' , ['class' => 'btn btn-success' ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="col-md-6"> 
    <div class="box box-success ">
        <div class="box-body">
            <h1>Nilai </h1>
            <h2>Rp. <?= number_format($data,0,',','.') ?></h2>
        </div>
    </div>
</div>
