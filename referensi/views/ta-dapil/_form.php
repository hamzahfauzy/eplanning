<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaDapil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-dapil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Dapil')->label('Daerah Pemilihan')->dropDownList($dataDapil, ['prompt'=>'Pilih Daerah Pemilihan', 'id'=>'Kd_Dapil']) ?>

    <?= $form->field($model, 'Kd_Prov')->label('Provinsi')->dropDownList($dataProvinsi, ['prompt'=>'Pilih Provinsi', 'id'=>'Kd_Prov']) ?>

    <?= $form->field($model, 'Kd_Kab')->label('Kabupaten/kota')->dropDownList(isset($dataKabupaten) ? $dataKabupaten : [], ['prompt'=>'Pilih Kabupaten/Kota', 'id'=>'Kd_Kab']) ?>

    <?= $form->field($model, 'Kd_Kec')->label('Kecamatan')->dropDownList(isset($dataKecamatan) ? $dataKecamatan : [], ['prompt'=>'Pilih Kecamatan', 'id'=>'Kd_Kec']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
    $('#Kd_Prov').change(function(){
        var Kd_Prov=$(this).val();
        $.post('index.php?r=ta-dapil/get-kab&Kd_Prov='+Kd_Prov, function(data){
            $('#Kd_Kab').html(data);
            $('#Kd_Kec').html("<option value=''>Pilih Kecamatan</option>");
        })
    });

    $('#Kd_Kab').change(function(){
        var Kd_Kab=$(this).val();
        var Kd_Prov=$('#Kd_Prov').val();
        $.post('index.php?r=ta-dapil/get-kec&Kd_Prov='+Kd_Prov+'&Kd_Kab='+Kd_Kab, function(data){
            $('#Kd_Kec').html(data);
        })
    });
</script>