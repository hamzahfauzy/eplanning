<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
 $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data']]);?>
 
                <?= $form->field($model, 'description')->textInput(['class'=>'form-control inline-input', 'placeholder'=>Yii::t('app', 'Description')])->label('')?>
 
                <?= $form->field($model, 'file')->fileInput()->label('')?>
 
                <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
 
<?php ActiveForm::end(); ?>