<?php
use yii\helpers\Html;
?>

<div id="modal_ambil_isi" >
	<h3 style="color:#007daa; font-weight: bold">Setelah Proses ini dilakukan, lingkungan, kelurahan dan kecamatan tidak dapat lagi menambah/mengubah/menghapus usulannya. </h3>
	<br/>
	<div style="color:#E64637; font-weight: bold">
	PENTING!! <br/>
	- Pastikan Seluruh kelurahan sudah menyelesaikan input data usulan.<br/>
	- Pihak Kecamatan bertanggungjawab sepenuhnya jika masih ada usulan desa/kelurahan yang belum masuk setelah proses ambil (Load Data) ini dilakukan.<br/>
	- Pastikan sudah berkoordinasi dengan kepala desa/lurah di wilayah masing-masing.<br/>
	</div>
	<br/>
	<h3>Kelurahan Yang Belum Mengiput Data dan Mengirimkan</h3>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Nama Kecamatan</th>
				<th>Status Penyelenggaraan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($data as $key => $value) :
				?>
					<tr>
						<td>Kecamatan</td>
						<td></td>
					</tr>
				<?php
				endforeach;
			?>
		</tbody>
	</table>
	<input type="hidden" id='jlh_belum' value="<?= count($data) ?>">
</div>

<div id="modal_ambil_loading" style="text-align: center; display: none;">
<?= Html::img('@web/img/loading.gif', ['alt'=>'Loading...', 'class'=>'thing']);?>
<h3 align="center">Jangan Tutup atau Refresh Browser sampai proses selesai!</h3>
</div>

<script type="text/javascript">
	$('#btn_ambil_simpan').attr('disabled', true); //mematikan tombol download

	setTimeout(function(){
		var jlh_belum = $('#jlh_belum').val();
		if (jlh_belum == 0) {
			$('#btn_ambil_simpan').attr('disabled', false);
		}
	}, 1000);
</script>