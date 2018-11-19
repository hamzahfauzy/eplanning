<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

$no=0;
foreach ($data as $val) :
	$id = $val->id;
	$no++;
	if ($val->Kd_Jalan)
		$jalan = $val->kdJalan->Nm_Jalan;
	else
		$jalan = '';

	if($val->Kd_Prioritas_Pembangunan_Daerah)
		$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
	else
		$rpjmd_pilih = 'Non Prioritas';

	if ($val->Kd_Asal_Usulan == 1) {
		$asal_usulan = "Lingkungan";
	}
	else if ($val->Kd_Asal_Usulan == 2) {
		$asal_usulan = "Kelurahan";
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
		<td>
			<?= $asal_usulan ?>
		</td>
		<td>
			<b>Permasalahan:</b><br/>
	    <p><?= $val->Nm_Permasalahan ?></p>
	    <b>Usulan:</b>
	    <p><?= $val->Jenis_Usulan ?></p>
	    (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
		</td>
	  <td>
	  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
	  </td>
	  <td>
	  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
	  </td>
	  <td>
	  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
	  	<?= $val->Detail_Lokasi ?>
	  </td>
		<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
		<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
		<td align="center">
			<?php
			if($val->Status_Penerimaan_Kecamatan == null):
				?>
				<select class="form-control btn-prioritas" id="slc-prioritas<?= $id ?>" data-id="<?= $id ?>" disabled>
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
		    <?php
		  endif;
		  ?>
	    <br/>
	    <span id="pilihprioritas-<?= $id ?>">
	    	<?= $rpjmd_pilih ?>
	    </span>	
		</td>
		<td align='center'>
			<?php
			if($val->Status_Penerimaan_Kecamatan == null):
				?>
				<select class="form-control btn-skpd" id="skpd-<?= $id ?>" data-id="<?= $id ?>">
		    	<option value="0">-Pilih SKPD-</option>
		    	<?php
	      		foreach ($skpd as $pil):
	      			$val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
		      		?>
		      			<option value="<?= $val_skpd ?>" ><?= $pil->Nm_Sub_Unit ?></option>
		      		<?php
	      		endforeach;
	      	?>
		    </select>
		    <?php
		  endif;
		  ?>
	    <br/>
	    <?php //if($val->Kd_Sub) echo $val->refSubUnit->Nm_Sub_Unit ?>
	    <?php //if($val->Kd_Sub != 0 || $val->Kd_Sub != null)  ?>
	    <span id="pilihskpd-<?= $id ?>">
	    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
			</span>
		</td>
		<td align="center">
			<?php
			if($val->Status_Penerimaan_Kecamatan == null):
				?>
				<button class="btn btn-success btn-hitung" data-id="<?= $id ?>" id="btn-hitung<?= $id ?>" disabled>Hitung</button>
				<?php
			endif;
			?>
			<br/>
			<br/>
			<span id="pilih-skor<?= $id ?>">
				<?php if($val->Skor != null) echo $val->Skor ?>
			</span>
		</td>
	</tr>
	<?php
endforeach;
?>


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
	    	$("#btn-hitung"+id).attr('disabled', true);
	    	$("#pilih-skor"+id).html(isi_skor);
	    	//$("#btn-lihat").trigger('click');
	    	//alert(isi);
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
		var skpd = $("#skpd-"+id).val();
		//alert('index.php?r=musrenbang-kecamatan/modal-prioritas&id='+id+'&rpjmd='+rpjmd+'&skpd='+skpd);

	  //         .find('#prioritasContent')
	  //         .load('index.php?r=musrenbang-kecamatan/modal-prioritas&id='+id+'&rpjmd='+rpjmd+'&skpd='+skpd);
	  // $('#btn_prioritas_simpan').attr('disabled', false);
	  var isi_prioritas = $('#slc-prioritas'+id).find('option:selected').text();
		//alert(isi_prioritas);
		$("#pilihprioritas-"+id).html(isi_prioritas);

		$('#prioritasModal').modal('show');
		$.ajax({ 
	    type: "GET",
	    url: 'index.php?r=musrenbang-kecamatan/modal-prioritas',
	    data: {id:id, rpjmd:rpjmd, skpd:skpd},
	    success: function(isi){
	      $("#prioritasContent").html(isi);
	  		//$('#btn_prioritas_simpan').attr('disabled', false);
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
			$('#slc-prioritas'+id).attr('disabled', true);
			//alert('index.php?r=musrenbang-kecamatan/set-prioritas&'+$('#form_prioritas').serialize());
			$.ajax({ 
		    type: "GET",
	    	url: 'index.php?r=musrenbang-kecamatan/set-prioritas',
		    data: $('#form_prioritas').serialize(),
		    success: function(isi){
		    	$('#prioritasContent').html(isi);
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
		//alert(isi_skpd);

		$("#pilihskpd-"+id).html(isi_skpd);

		if (skpd!=0) {
			$("#slc-prioritas"+id).attr('disabled', false);
			$("#skpd-"+id).attr('disabled', true);
		}
		else{
			$("#slc-prioritas"+id).attr('disabled', true);
			$("#skpd-"+id).attr('disabled', false);
		}
	});
</script> 