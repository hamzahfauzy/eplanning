<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$cookies = Yii::$app->request->cookies;

$this->title="Usulan Kegiatan";
$js="
	function program(j){
		$('body').addClass('loading');
		$.post('index.php?r=kegiatans/listkegiatan&id='+j,
			function(d, s){
				$('#kegiatan').html(d);
				$('body').removeClass('loading');	
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
$this->registerJs($js, 4, 'rutin');
$dataKegiatan=array();
?>
<div class="modal"></div>

<div id='id_program' style='display:none'>
	<?php 
		if (isset($cookies['id_program'])) {
    		echo $id_program = $cookies['id_program']->value;
		}else{
			echo "0";
		}
	?>
</div>
<div id='kode_kegiatan' style='display:none'>
	<?php 
		if (isset($cookies['kode_kegiatan'])) {
    		echo $kode_kegiatan = $cookies['kode_kegiatan']->value;
		}else{
			echo "0";
		}
	?>
</div>

<div class="formusulan-form">
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'program')->dropDownList($dataprogram,['prompt' => 'Pilih Program Prioritas', 'id' => 'program']); ?>
		<?= $form->field($model, 'kegiatan')->dropDownList($dataKegiatan,['prompt' => 'Pilih Kegiatan Prioritas', 'id' => 'kegiatan']); ?>
	<?php ActiveForm::end(); ?>
	<div id="tombol"></div>
	<div id='loaddata'></div>
</div>