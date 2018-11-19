<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->registerJsFile(
    '@web/js/musrenbang/skoring.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Terima';
?>
<div class="col-md-12">
	<div class="row">
		<form id="form_cari">
			<div class="col-md-2">
				<div class="form-group">
	        <label >Kelurahan</label>
	        <select class="form-control" name="Kd_Kel" id="kelurahan">
	        	<option value="">-Pilih Kelurahan-</option>
	        	<?php
	        		foreach ($kelurahan as $kel):
	        		?>
	        			<option value="<?= $kel->Kd_Urut ?>"><?= $kel->Nm_Kel ?></option>
	        		<?php
	        		endforeach;
	        	?>
	        </select>
	      </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
	        <label >Lingkungan</label>
	        <select class="form-control" name="Kd_Lingkungan" id="lingkungan">
	        	<option value="">-Pilih Lingkungan-</option>
	        </select>
	      </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
	        <label >Bidang Pembangunan</label>
	        <select class="form-control" name="Kd_Pem">
	        	<option value="">-Pilih Bidang-</option>
	        	<?php
	        		foreach ($bid_pem as $pem):
	        		?>
	        			<option value="<?= $pem->Kd_Pem ?>"><?= $pem->Bidang_Pembangunan ?></option>
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
	        	<option value="">-Pilih Lingkungan-</option>
	        	<?php
	        		foreach ($rpjmd as $prioritas):
	        		?>
	        			<option value="<?= $prioritas->Kd_Prioritas_Pembangunan_Kota ?>"><?= $prioritas->Nm_Prioritas_Pembangunan_Kota ?></option>
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
<div class="col-md-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Kegiatan Prioritas</th>
				<th>Kelurahan</th>
				<th>Lingkungan</th>
				<th>Jalan</th>
				<th>Jumlah/vol</th>
				<th>Pagu (Rp)</th>
				<th>SKPD Penanggung Jawab</th>
				<th>Prioritas Pembangunan</th>
				<th>Bobot</th>
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
    "size"=>"modal-lg",
    'footer' => Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Save',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"btn_skoring_simpan"]),
    "id"=>"skoringModal",
]);
echo "<div id='skoringContent' class='isi-modal'></div>";
Modal::end();
?>
