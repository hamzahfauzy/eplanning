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
		$rpjmd_pilih = '';

	?>
	<tr>
		<td>
			<?= $no ?>
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
		<td><?= $val->Harga_Total ?></td>
		<td>
			<select class="form-control btn-skpd" id="skpd-<?= $id ?>" data-id="<?= $id ?>">
	    	<option>-Pilih SKPD-</option>
	    	<?php
      		foreach ($skpd as $pil):
	      		?>
	      			<option value="" ><?= $pil->Nm_Sub_Unit ?></option>
	      		<?php
      		endforeach;
      	?>
	    </select>
		</td>
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
	    <?= $rpjmd_pilih ?>
		</td>
		<td align="center">
			<p>0.00</p>
			<button class="btn btn-success btn-xs btn-hitung" data-id="<?= $id ?>" id="btn-hitung<?= $id ?>" disabled>Hitung</button>
		</td>
	</tr>
	<?php
endforeach;
?>


<script type="text/javascript">
	$(".btn-prioritas").change(function(){
		$(this).attr('disabled', true);
		var id = $(this).data('id');
		var rpjmd = $(this).val();
		//var id_select = $(this).prop('id');
		//alert(id_select);
		//alert(id+' '+rpjmd);
		$.ajax({ 
	    type: "GET",
    	url:'index.php?r=ta-musrenbang/set-prioritas',
	    data:{ id:id , rpjmd:rpjmd},
	    success: function(isi){
	      alert(isi);
	      if(rpjmd!=0){
	      	$("#btn-hitung"+id).attr('disabled', false);
	      }
	      else{
	      	$("#btn-lihat").trigger('click');
	      }
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});

	//=========modal==========//

	$('.btn-hitung').on('click', function () {
		//alert('index.php?r=ta-musrenbang/modal-skoring');
		var id = $(this).data('id');
	  $('#skoringModal').modal('show')
	          .find('#skoringContent')
	          .load('index.php?r=ta-musrenbang/modal-skoring&id='+id);
	  $('#btn_skoring_simpan').attr('disabled', false);
	});

	$("#btn_skoring_simpan").click(function(){
		//alert($("#skoring_form").serialize());
		$.ajax({ 
	    type: "POST",
	    url:'index.php?r=ta-musrenbang/skoring-simpan',
	    data:$("#skoring_form").serialize(),
	    success: function(isi){
	    	$('#skoringContent').html(isi);
	    	$('#btn_skoring_simpan').attr('disabled', true);
	    	$("#btn-lihat").trigger('click');
	    	//alert(isi);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
</script>