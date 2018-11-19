<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\RefJalan */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ref-jalan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
        $form->field($model, 'Kd_Prov')
        ->dropDownList(
            $dataProv,           // Flat array ('id'=>'label')
            ['prompt'=>'-Pilih Provinsi-']    // options
        );
    ?>
    
    <?=
        $form->field($model, 'Kd_Prov')->dropDownList($dataProv, ['id'=>'prov-id']);
    ?>

    <?=
        $form->field($model, 'subcat')->widget(DepDrop::classname(), [
            'options'=>['id'=>'kab-id'],
            'pluginOptions'=>[
                'depends'=>['prov-id'],
                'placeholder'=>'-Pilih Kabupaten-',
                'url'=>Url::to(['/ajax/subcat'])
            ]
        ]);
    ?>

    <?=
        $form->field($model, 'Kd_Kec')
        ->dropDownList(     // Flat array ('id'=>'label')
            ['prompt'=>'-Pilih Kecamatan-']    // options
        );
    ?>

    <?= $form->field($model, 'Kd_Kel')->textInput() ?>

    <?=
        $form->field($model, 'Kd_Urut_Kel')
        ->dropDownList(     // Flat array ('id'=>'label')
            ['prompt'=>'-Pilih Kecamatan-']    // options
        );
    ?>

    <?=
        $form->field($model, 'Kd_Lingkungan')
        ->dropDownList(     // Flat array ('id'=>'label')
            ['prompt'=>'-Pilih Kecamatan-']    // options
        );
    ?>

    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>

    <?= $form->field($model, 'Nm_Jalan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
