<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$cookies = Yii::$app->request->cookies;

$this->title="Usulan Kegiatan";
$js="
	function prioritas(i){
    	$('body').addClass('loading');
       	$.post('index.php?r=programs/listnawacita&id='+i,
    		function(data, status){
        		$('#nawacita').val(data);
    		});
    	$.post('index.php?r=programs/listprogram&id='+i,
    		function(d, s){
    			$('#program').html(d);
        		$('body').removeClass('loading');	
        	});
	}
	
	function program(j){
		$('body').addClass('loading');
		$.post('index.php?r=kegiatans/listkegiatan&id='+j,
			function(d, s){
				$('#kegiatan').html(d);
				$('body').removeClass('loading');	
			});
	}
	
	id_prioritas=$('#id_prioritas').text();
	if(id_prioritas!=0){
		prioritas(id_prioritas);
		$('#prioritas').change(function(){
			i=$('#prioritas').val();
			prioritas(i);
		});
	}else{
		$('#prioritas').change(function(){
			i=$('#prioritas').val();
    		prioritas(i);
		});
	}
	
	id_program=$('#id_program').text();
	if(id_program!=0){
		program(id_program);
		$('#program').change(function(){
			j=$('#program').val();
			program(j);
		});
	}else{
		$('#program').change(function(){
			j=$('#program').val();
			program(j);
		});
	}
	
	function kegiatan(k){
		$('body').addClass('loading');
		ln='<a href=index.php?r=detail-kegiatan/create&id='+k+' class=\'btn btn-success\'>Tambah Usulan Kegiatan</a>';
		$('#tombol').html(ln);
		$.post('index.php?r=detail-kegiatan/listdetail&kode_kegiatan='+k,
			function(d, s){
				$('#loaddata').html(d);
				$('body').removeClass('loading');	
			});
	}
	
	kode=$('#kode_kegiatan').text();
	kode_kegiatan=kode.trim();
	if(kode_kegiatan!=0){
		kegiatan(kode_kegiatan);
		$('#kegiatan').change(function(){
			k=$('#kegiatan').val();
			kegiatan(k);
		});	
	}else{
		$('#kegiatan').change(function(){
			k=$('#kegiatan').val();
			kegiatan(k);
		});	
	}
	
";
$this->registerJs($js, 4, 'prioritas');
$dataProgram=array();
$dataKegiatan=array();
$urusan=$this->context->getAllUrusan();
$misi=$this->context->getAllMisi();
?>
<div class="modal"></div>
<div id='id_prioritas' style='display:none'>
	<?php 
		if (isset($cookies['id_prioritas'])) {
    		echo $id_prioritas = $cookies['id_prioritas']->value;
		}else{
			echo "0";
		}
	?>
</div>
<div id='id_program' style='display:none'>
	<?php 
		if (isset($cookies['id_program'])) {
    		$id_prioritas = $cookies['id_program']->value;
		}else{
			echo "0";
		}
	?>
</div>
<div id='kode_kegiatan' style='display:none'>
	<?php 
		if (isset($cookies['kode_kegiatan'])) {
    		echo $id_prioritas = $cookies['kode_kegiatan']->value;
		}else{
			echo "0";
		}
	?>
</div>

<div class="formusulan-form">
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'prioritas_nasional')->dropDownList($dataprioritas, ['prompt' => 'Pilih Prioritas Nasional', 'id' => 'prioritas']); ?>
		<?= $form->field($model, 'nawacita')->textInput(['readonly' => true, 'id' => 'nawacita']); ?>
		<?= $form->field($model, 'urusan')->dropDownList($urusan, ['prompt' => 'Pilih Urusan', 'id' => 'urusan']); ?>
		<?= $form->field($model, 'misi')->dropDownList($misi, ['prompt' => 'Pilih Misi', 'id' => 'misi']); ?>
		<?= $form->field($model, 'program')->dropDownList($dataProgram,['prompt' => 'Pilih Program Prioritas', 'id' => 'program']); ?>
		<?= $form->field($model, 'kegiatan')->dropDownList($dataKegiatan,['prompt' => 'Pilih Kegiatan Prioritas', 'id' => 'kegiatan']); ?>
	<?php ActiveForm::end(); ?>
	<div id="tombol"></div>
	<div id='loaddata'></div>
</div>