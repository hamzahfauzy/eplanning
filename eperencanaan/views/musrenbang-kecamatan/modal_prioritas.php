<form id="form_prioritas">
	<!--<h3>Anda memilih prioritas "<?= $isi_pilihan ?>"</h3> -->

	<h3>Alasan menolak usulan ini :</h3>
	
		<div class="form-group">
	   <!-- <label>Alasan: </label> -->
	    <textarea class="form-control" rows="3" name="alasan" id="pilihan_alasan"></textarea>
	  </div>
	
	<br/>
	<br/>
	<div <?php if($rpjmd != 0) echo 'style="display:none"' ?>>
	*)PENTING! <br/>
	- Usulan akan diubah menjadi NON PRIORITAS dan tidak akan dikirim ke OPD. <br/>
	</div>

	<input type="hidden" name="id" value="<?= $id ?>" id="pilihan_id">
	<input type="hidden" name="rpjmd" value="<?= '0' ?>" id="pilihan_rpjmd"> 
	<input type="hidden" name="skor" value="<?= '0' ?>" id="isi_skor">
</form>