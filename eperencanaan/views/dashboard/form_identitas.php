<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaIdentitas */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
        '@web/js/sistem/dropdown.js',
         ['depends' => [\yii\web\JqueryAsset::className()]]
         );
$Kd_Kab =array();

?>


   <div class="dev-page-content">                    
        <!-- page content container -->
    <div class="container">
        <div class="page-title">
            <h1>Identitas Aplikasi</h1>
            <p>Silahkan lengkapi data di bawah ini untuk merubah secara otomatis Identitas pada Aplikasi. Nama Daerah dan seterusnya</p>
        </div> 
    <div class="wrapper wrapper-white">                

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'Kd_Prov')->dropDownList($modelProvinsi, ['prompt'=>'Pilih Provinsi', 'id'=>'Kd_Prov'])  ?>

   <?= $form->field($model, 'Kd_Kab')->dropDownList($Kd_Kab, ['prompt'=>'Pilih Kabupaten', 'id'=>'Kd_Kab'])  ?>
    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true, 'id'=>'logo']) ?>
    <?= $form->field($model, 'Email')->textInput(['maxlength' => true, 'id'=>'email']) ?>
    <?= $form->field($model, 'Alamat')->textInput(['maxlength'=> true, 'id'=>'alamat']) ?>

	  	<div class="form-group">
          <label class="control-label col-sm-3"></label>
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'kirim']) ?>
	    </div>
    <?php ActiveForm::end(); ?>

    
    </div>
   </div>
 </div>
