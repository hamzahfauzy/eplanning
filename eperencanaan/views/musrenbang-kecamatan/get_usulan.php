<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use common\models\RefRPJMD;
$no=0;
foreach ($data as $val) :
	/*
	echo "<pre>";
	print_r($val->);
	echo "</pre>";
	echo "<br>";*/
	$id = $val->id;
	$rpjmd = RefRPJMD::find()
			->where(['Kd_Prioritas_Pembangunan_Kota' => @$val->Kd_Prioritas_Pembangunan_Daerah])
            ->all();
	$no++;
	if ($val->Kd_Jalan != '' || $val->Kd_Jalan != 0){
		if (isset($val->kdJalan->Nm_Jalan)) {
			@$jalan = @$val->kdJalan->Nm_Jalan;
		}else{

		@$jalan = '';
		}
	}
	else{
		@$jalan = '';
	}
	/*
	echo "<pre>";
	print_r($rpjmd[0]->getAttributes()['Nm_Prioritas_Pembangunan_Kota']);
	echo "</pre>";
	*/
	if($val->Kd_Prioritas_Pembangunan_Daerah)
		$rpjmd_pilih = $rpjmd[0]->getAttributes()['Nm_Prioritas_Pembangunan_Kota']; //$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota
	else
		$rpjmd_pilih = 'Non Prioritas';

	if ($val->Kd_Asal_Usulan == 1) {
		$asal_usulan = "Dusun/ Lingkungan";
	}
	else if ($val->Kd_Asal_Usulan == 2) {
		$asal_usulan = "Desa/ Kelurahan";
	}
	else if ($val->Kd_Asal_Usulan == 3) {
		$asal_usulan = "Kecamatan";
	}
	else {
		$asal_usulan = "Tidak Ditemukan";
	}

	//$val->Status_Penerimaan_Kecamatan
	
	?>
	<tr>
		<td>
			<?= $no ?>
		</td>
		
		<td align="center">
			<?= $asal_usulan ?>
			<br><br><b>
			<?= $id?>
			</b>
		</td>
		
		<td>
			<b>Permasalahan:</b><br/>
	    <p><?= $val->Nm_Permasalahan ?></p>
	    <b>Usulan:</b>
	    <p><?= $val->Jenis_Usulan ?></p>
	    (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
		</td>
	  <td>
	  <?= @$val->Detail_Lokasi ?>
	  <?php if (empty(@$jalan)) { 
	 
	  }
	  else
	  {
		 echo  @$jalan .",";
	  }
	  ?>
	  
	  <?php if(@$val->Kd_Lingkungan) echo @$val->lingkungan->Nm_Lingkungan ?>,
	  <?php if(@$val->Kd_Kel) echo @$val->kelurahan->Nm_Kel ?>
	  </td>
		<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
		<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
	  <td>
	  	<select class="form-control btn-program" id="slc-program<?= $id ?>" data-id="<?= $id ?>">
	    	<option>-Pilih Program-</option>
	    	<?php
			
      		foreach ($val->programs as $program):
	      		?>
	      			<option value="<?= @$program['Kd_Prog'] ?>" ><?= @$program['Ket_Prog'] ?></option>
	      		<?php
      		endforeach;
      	?>
	    </select>
		    
	    <br/>
	    <span id="pilihprogram-<?= $id ?>">
	    	<?=@$val->program['Ket_Prog']; ?>
	    </span>	
	  </td>
	  <td>
	  	 <select class="form-control btn-kegiatan" id="slc-kegiatan<?= $id ?>" data-id="<?= $id ?>">
	    	<option>-Pilih Kegiatan-</option>
	    	<?php
			
      		foreach ($val->kegiatans as $kegiatan):
	      		?>
	      			<option value="<?= $kegiatan['Kd_Keg'] ?>" ><?= $kegiatan['Ket_Kegiatan'] ?></option>
	      		<?php
      		endforeach;
      	?>
	    </select>
		    
	    <br/>
	    <span id="pilihkegiatan-<?= $id ?>">
	    	<?= $val->kegiatan['Ket_Kegiatan'] ?>
	    </span>	
	  </td>
	  <!--
		<td align="center">
			<select class="form-control btn-prioritas" id="slc-prioritas<?= $id ?>" data-id="<?= $id ?>">
	    	<option>-Pilih Prioritas-</option>
	    	<option value="0" >0. Non Prioritas</option>
	    	<?php
      		foreach ($rpjmd as $prioritas):
	      		?>
	      			<option value="<?= $prioritas->Kd_Prioritas_Pembangunan_Kota ?>" ><?= $prioritas->Kd_Prioritas_Pembangunan_Kota ?>. <?= $prioritas->Nm_Prioritas_Pembangunan_Kota ?></option>
	      		<?php
      		endforeach;
      	?>
	    </select>
		    
	    <br/>
		<?= @$prioritas->Kd_Prioritas_Pembangunan_Kota ;?>
	    <span id="pilihprioritas-<?= $id ?>">
	    	<?= $rpjmd_pilih ?>
	    </span>	
		</td> -->
		<!--
		<td align='center'>
			<select class="form-control btn-skpd" id="skpd-<?= $id ?>" data-id="<?= $id ?>">
	    	<option value="0">-Pilih OPD-</option>
	    	<?php
      		foreach ($skpd as $pil):
      			$val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
	      		?>
	      			<option value="<?= @$val_skpd ?>" ><?= @$pil->Nm_Sub_Unit ?></option> 
	      		<?php
      		endforeach;
      	?>
	    </select> 
		-->
		<td align='center'>
	    <br/>
	    <?php //if($val->Kd_Sub) echo $val->refSubUnit->Nm_Sub_Unit ?>
	    <?php //if($val->Kd_Sub != 0 || $val->Kd_Sub != null)  ?>
		<?php //print_r($val->refSubUnit); ?>
	    <span id="pilihskpd-<?= $id ?>">
	    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo @$val->refSubUnit->Nm_Sub_Unit ?>
			</span>
			<br><b>
			Skor:
			<span id="pilih-skor<?= $id ?>">
				<?php if($val->Skor != null) echo  $val->Skor ?>
			</span>
			</b>
			</td>
		<td align="center">
			<button class="btn btn-success btn-hitung" data-id="<?= $id ?>" id="btn-hitung<?= $id ?>" >Hitung</button> 
			
							<a href='index.php?r=musrenbang-kecamatan/update&id=<?=$id;?>&forum=0'><button class="btn btn-warning">Revisi</button></a> 
							<button class="btn btn-danger btn-prioritas1" data-id="<?= $id ?>" id="btn-prioritas1<?= $id ?>" >Tolak</button></a> 
							<br><br>
							<button class="btn btn-success" onclick="showmodaldokumen(<?=@$val->taMusrenbangKelurahan["Kd_Ta_Musrenbang_Kelurahan"];?>);"><span class="glyphicon glyphicon-folder-close"></span> </button></td>
					<!--		<a href='index.php?r=musrenbang-kecamatan/hapus&id=<?=$id;?>'><button class="btn btn-danger">Hapus</button></a>-->
					
		</td>
	</tr>
	<?php
endforeach;
?>
<script type="text/javascript">

					function showmodaldokumen(kd){
						$.get("index.php?r=dashboard/media-kelurahan&Kd="+kd, function(response){
							$("#response-modal").html(response);
							$("#modaldokumen").modal();
						});
					}

</script>
<script type="text/javascript">
	/*
	$(".btn-prioritas").change(function(){
		$(this).attr('disabled', true);
		var id = $(this).data('id');
		var rpjmd = $(this).val();
		//var id_select = $(this).prop('id');
		//alert(id_select);
		//alert(id+' '+rpjmd);
		$.ajax({ 
	    type: "GET",
    	url:'index.php?r=musrenbang-kecamatan/set-prioritas',
	    data:{ id:id , rpjmd:rpjmd},
	    success: function(isi){
	      alert(isi);
	      if(rpjmd!=0){
	      	$("#btn-hitung"+id).attr('disabled', false);
	      }
	      else{
	      	//$("#btn-lihat").trigger('click');
	      }
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
	*/

	//=========modal skoring==========//

	$('.btn-hitung').on('click', function () {
		//alert('index.php?r=musrenbang-kecamatan/modal-skoring');
		var id = $(this).data('id');
	  $('#skoringModal').modal('show')
	          .find('#skoringContent')
	          .load('index.php?r=musrenbang-kecamatan/modal-skoring&id='+id);
	  $('#btn_skoring_simpan').attr('disabled', false);
	});

	$("#btn_skoring_simpan").click(function(){
		//alert($("#skoring_form").serialize());
		var id = $("#id_skoring").val();
		var isi_skor = $("#isi_skor").val();

	  $('#btn_skoring_simpan').attr('disabled', true);
		$.ajax({ 
	    type: "POST",
	    url:'index.php?r=musrenbang-kecamatan/skoring-simpan',
	    data:$("#skoring_form").serialize(),
	    success: function(isi){
	    	$('#skoringContent').html(isi);
	    	$("#pilih-skor"+id).html(isi_skor);
	    	//$("#btn-lihat").trigger('click');
	    	//alert(isi);
	    	//$("#btn-hitung"+id).attr('disabled', true);
	    	//$("#slc-prioritas"+id).attr('disabled', true);
				//$("#skpd-"+id).attr('disabled', true);
				
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
//=========modal prioritas==========//
	$('.btn-prioritas1').on('click', function () {
		var id = $(this).data('id');
		var rpjmd = $(this).val();
		var isi_skor = $("#isi_skor").val();
	  var isi_prioritas = $('#slc-prioritas'+id).find('option:selected').text();
		$('#prioritasModal').modal('show');
		$('#btn_prioritas_simpan').attr('disabled', false);
		$.ajax({ 
	    type: "GET",
	    url: 'index.php?r=musrenbang-kecamatan/modal-prioritas',
	    data: {id:id, rpjmd:rpjmd},
	    success: function(isi){
	      $("#prioritasContent").html(isi);
		  $("#pilih-skor"+id).html(0);
		 
	  		//$('#btn_prioritas_simpan').attr('disabled', false);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });

	});
	//=========modal prioritas==========//
	$('.btn-prioritas').on('change', function () {
		var id = $(this).data('id');
		var rpjmd = $(this).val();
	  var isi_prioritas = $('#slc-prioritas'+id).find('option:selected').text();

		//$("#pilihprioritas-"+id).html(isi_prioritas);

		$('#prioritasModal').modal('show');
		$('#btn_prioritas_simpan').attr('disabled', false);
		$.ajax({ 
	    type: "GET",
	    url: 'index.php?r=musrenbang-kecamatan/modal-prioritas',
	    data: {id:id, rpjmd:rpjmd},
	    success: function(isi){
	      $("#prioritasContent").html(isi);
	  		//$('#btn_prioritas_simpan').attr('disabled', false);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });

	});
	
	

	$(".btn-program").change(function(){
		var id = $(this).data('id');
		var kode = $(this).val();
		var isi_program = $('#slc-program'+id).find('option:selected').text();
		//alert(id+" "+skpd);

		$.ajax({ 
	    type: "GET",
    	url: 'index.php?r=musrenbang-kecamatan/set-program',
	    data: {id:id,kd:kode},
	    success: function(isi){
				$("#pilihprogram-"+id).html(isi_program);
				$('#slc-kegiatan'+id).empty();
				$('#slc-kegiatan'+id).append("<option>-Pilih Kegiatan-</option>");
				$('#slc-kegiatan'+id).append(isi);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
	
	$(".btn-kegiatan").change(function(){
		var id = $(this).data('id');
		var kode = $(this).val();
		var isi_kegiatan = $('#slc-kegiatan'+id).find('option:selected').text();
		//alert(id+" "+skpd);

		$.ajax({ 
	    type: "GET",
    	url: 'index.php?r=musrenbang-kecamatan/set-kegiatan',
	    data: {id:id,kd:kode},
	    success: function(isi){
				$("#pilihkegiatan-"+id).html(isi_kegiatan);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});

	$("#btn_prioritas_simpan").click(function(){
		var id = $("#pilihan_id").val();
		var rpjmd = $("#pilihan_rpjmd").val();
		var alasan = $("#pilihan_alasan").val();

		if (rpjmd == 0 && alasan=='') {
			alert('Alasan Harus Diisi!');
		}
		else{
			$('#btn_prioritas_simpan').attr('disabled', true);
			//$('#slc-prioritas'+id).attr('disabled', true);
			//alert('index.php?r=musrenbang-kecamatan/set-prioritas&'+$('#form_prioritas').serialize());
			$.ajax({ 
		    type: "GET",
	    	url: 'index.php?r=musrenbang-kecamatan/set-prioritas',
		    data: $('#form_prioritas').serialize(),
		    success: function(isi){
		    	$('#prioritasContent').html(isi);
		    	var isi_prioritas = $('#slc-prioritas'+id).find('option:selected').text();
					$("#pilihprioritas-"+id).html(isi_prioritas);
		      if(rpjmd!=0){
		      	$("#btn-hitung"+id).attr('disabled', false);
		      }
		      else{
		      	//$("#btn-lihat").trigger('click');
		      }
		    },
		    error: function(){
		      alert("failure");
		    }
		  });
		}
	});


	//===========skpd===========//
	$(".btn-skpd").change(function(){
		var skpd = $(this).val();
		var id = $(this).data('id');

		var isi_skpd = $('#skpd-'+id).find('option:selected').text();
		//alert(id+" "+skpd);

		$.ajax({ 
	    type: "GET",
    	url: 'index.php?r=musrenbang-kecamatan/set-skpd',
	    data: {id:id, skpd:skpd},
	    success: function(isi){
				$("#pilihskpd-"+id).html(isi_skpd);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
	
</script> 

