<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;

$ref = new Referensi();
$sumber=$ref->dropRefSumberDana();

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatan */
/* @var $form yii\widgets\ActiveForm */
$status=array('1'=>'Baru', '2'=>'Lanjutan');
$js="
function currency(v){
    value=v.replace(/\./g,'');
    length=value.length;
    if(length>12){
        if(length==13){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            f4=value.substr(7,3);
            f5=value.substr(10,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }else if(length==14){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            f4=value.substr(8,3);
            f5=value.substr(11,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }else if(length==15){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            f4=value.substr(9,3);
            f5=value.substr(12,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }
    }else if(length>9){
        if(length==10){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            f4=value.substr(7,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }else if(length==11){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            f4=value.substr(8,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }else if(length==12){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            f4=value.substr(9,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }
    }else if(length>6){
        if(length==7){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }else if(length==8){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }else if(length==9){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }
    }else if(length>3){
        if(length==4){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            fn= f1 + '.' + f2;
        }else if(length==5){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            fn= f1 + '.' + f2;
        }else if(length==6){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            fn= f1 + '.' + f2;
        }
    }else{
        fn=value;
    }
    return fn;
}


    v=$('#pagu').val();
    fn=currency(v);
    $('#pagu').val(fn);
    //console.log(fn);


$('#pagu').keyup(function(){
    v=$(this).val();
    fn=currency(v);
    $(this).val(fn);
})

";
$this->registerJs($js, 4, 'My');
?>

<div id="responsive" class="modal fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Map</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div id='data'>
					<?= $this->render('_map', [
        				'model' => $model,
    				]) ?>
				</div>
			</div>

		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
	</div>
</div>

<div class="ta-kegiatan-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?php //$form->field($model, 'Kd_Prog')->textInput() ?>

    <?php //$form->field($model, 'ID_Prog')->textInput() ?>

    <?php //$form->field($model, 'Kd_Keg')->textInput() ?>

    <?php //$form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lokasi')->textInput(['maxlength' => true, 'id'=>'lokasi']) ?>
    <a class="btn default" data-toggle="modal" href="#responsive">Map</a>

    <?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status_Kegiatan')->dropDownList($status, ['prompt'=>'Pilih Status Kegiatan']) ?>

    <?= $form->field($model, 'Pagu_Anggaran')->textInput(['id'=>'pagu']) ?>

    <?= $form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Sumber')->dropDownList($sumber, ['prompt'=>'Pilih Sumber Dana']) ?>

    <?= $form->field($model, 'filedata')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
