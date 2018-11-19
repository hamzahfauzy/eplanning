<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
$this->registerCssFile(
        '@web/plugins/select2/select2.css'
);

$this->registerCssFile(
        '@web/plugins/select2/select2-bootstrap.css'
);

$this->registerJsFile(
        '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/tambah_program.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);



$this->title = ($model->isNewRecord ? 'Tambah' : 'Edit').' Program Pilihan';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Program Pilihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-create">
	<div class="ref-program-form">
    <div class="box box-success"> 
        <div class="box-body">
			    <?php $form = ActiveForm::begin(); ?>
			    	<?= $form->field($model, 'Kd_Urusan')->dropDownList($data_urusan,['prompt'=>'Pilih Urusan', 'id'=>'kd_urusan'])->label('Urusan') ?>
    				<?= $form->field($model, 'Kd_Bidang')->dropDownList($model->isNewRecord ? [] : $data_bidang, ['prompt'=>'Pilih Bidang', 'id'=>'kd_bidang','class'=>'form-control select2'])->label('Bidang') ?>
                    <?= $form->field($model, 'Kd_Unit')->dropDownList($model->isNewRecord ? [] : $data_unit, ['prompt'=>'Pilih Unit', 'id'=>'kd_unit','class'=>'form-control'])->label('Unit') ?>
                    <?= $form->field($model, 'Kd_Sub_Unit')->dropDownList($model->isNewRecord ? [] : $data_sub, ['prompt'=>'Pilih Sub Unit', 'id'=>'kd_sub_unit','class'=>'form-control'])->label('Sub Unit') ?>
					<?= $form->field($model, 'Ket_Program')->hiddenInput(['maxlength' => true, 'id'=>'ket_prog'])->label(false) ?>
					
					<?= $form->field($model, 'Kd_Prog')->dropDownList($kamus_program,['prompt'=>'Pilih Kamus', 'class'=>'form-control selects' , 'id'=>'kd_prog' ])->label('Nama Program') ?>
					<?php // $form->field($model, 'Ket_Program')->textInput(['maxlength' => true])->label('Nama Program') ?>
			<div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
			    <?php ActiveForm::end(); ?>
        </div>
    </div>
	</div>
</div>