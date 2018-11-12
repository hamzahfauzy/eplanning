<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use eperencanaan\assets\MapAsset;


$this->registerJsFile(
    '@web/js/musrenbang/skoring.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);



$this->title = 'Skoring Usulan Desa/Kelurahan';



?>
<div class="container">
	<div class="row">
		<form id="form_cari">
			<div class="col-md-2">
				<div class="form-group">
					<label >Asal Usulan</label>
					<select class="form-control" name="Kd_Asal_Usulan">
						<option value="0">-Pilih Semua-</option>
						<option value="2">Desa/Kelurahan</option>
						<option value="3">Kecamatan</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label >Desa/Kelurahan</label>
					<select class="form-control" name="Kd_Kel" id="kelurahan">
						<option value="0">-Pilih Semua-</option>
						<?php
							foreach ($kelurahan as $kel):
							?>
							<option value="<?= @$kel->Kd_Urut ?>"><?= @$kel->Nm_Kel ?></option>
							<?php
							endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				<label >Dusun/Lingkungan</label>
				<select class="form-control" name="Kd_Lingkungan" id="lingkungan">
					<option value="0">-Pilih Semua-</option>
				</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Bidang Pembangunan</label>
					<select class="form-control" name="Kd_Pem">
						<option value="0">-Pilih Semua-</option>
						<?php
						foreach ($bid_pem as $pem):
							?>
							<option value="<?= @$pem->Kd_Pem ?>"><?= @$pem->Bidang_Pembangunan ?></option>
							<?php
						endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				<label >Prioritas Pembangunan</label>
				<select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
					<option value="0">-Pilih Semua-</option>
					<?php
						foreach ($rpjmd as $prioritas):
						?>
						<option value="<?= @$prioritas->Kd_Prioritas_Pembangunan_Kota ?>"><?= @$prioritas->Nm_Prioritas_Pembangunan_Kota ?></option>
						<?php
						endforeach;
					?>
				</select>
				</div>
			</div>
		</form>
		<div class="col-md-1">
			<div class="form-group">
				<label >&nbsp;</label>
				<button type="button" class="form-control btn btn-primary" id="btn-lihat">Lihat</button>
			</div>
		</div>
	</div>
</div>
	
<div class="col-md-12 table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Asal Usulan</th>
				<th>Kegiatan Prioritas</th>
				<th>Lokasi Detail</th>
				<th>Jumlah/vol</th>
				<th>Pagu (Rp)</th>
				<!--<th>Program</th>
				<th>Kegiatan</th> 
				<th>Prioritas Pembangunan</th>-->
				<th>OPD Penanggung Jawab</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="isi-wrap">
			<!--
			<tr>
				<td>
					<b>Permasalahan:</b><br/>
	        <p>isi masalah</p>
	        <b>Usulan:</b>
	        <p>isi usulan</p>
	        (isi bidang)
				</td>
				<td>4 meter</td>
				<td>4.000.000</td>
				<td>jl. lokasi</td>
				<td>
					<select class="form-control">
	        	<option>-Pilih Prioritas-</option>
	        	<option>0. Non Prioritas</option>
	        	<option>1. Infrastruktur</option>
	        </select>
				</td>
				<td align="center">
					<p>0.00</p>
					<button class="btn btn-success btn-xs">Hitung</button>
				</td>
			</tr>
			-->
		</tbody>
	</table>
</div>




<?php
Modal::begin([
    'header' => '<h4>Skoring</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Save',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"btn_skoring_simpan"]),
    "id"=>"skoringModal",
]);
echo "<div id='skoringContent' class='isi-modal'>Loading...</div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Prioritas Pembangunan</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Save',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"btn_prioritas_simpan"]),
    "id"=>"prioritasModal",
]);
echo "<div id='prioritasContent' class='isi-modal'>Loading...</div>";
Modal::end();
?>


<div id="modaldokumen" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Musrenbang</h4>
      </div>
      <div class="modal-body">
        <span id="response-modal"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

