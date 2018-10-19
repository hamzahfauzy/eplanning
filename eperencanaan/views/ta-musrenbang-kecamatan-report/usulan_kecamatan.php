<?php

use yii\helpers\Html;

$this->title = 'Usulan Kecamatan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//     '@web/js/musrenbang/usulan_prioritas.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
/*
echo "<pre>";
print_r($acara);
echo "</pre>";
*/
?>

<div class="col-md-12">
	
	<div class="control-wrap">
      <?php $form = \yii\bootstrap\ActiveForm::begin([
      						'id' => 'search-usulan',
                  'action' => ['ta-musrenbang-kecamatan-report/usulan-kecamatan-cetak'], 
                  'options' => ['target' => '_blank']
      ]) ?>
      <div class="form-group">
          <div class="col-sm-2">
              <br>
              <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
          </div>
      </div>
      <?php \yii\bootstrap\ActiveForm::end() ?>
  </div>
  
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Asal Usulan</th>
				<th>Kegiatan Prioritas</th>
				<th>Desa/Kelurahan</th>
				<th>Dusun/Lingkungan</th>
				<th>Jalan</th>
				<th>Jumlah/vol</th>
				<th>Pagu (Rp)</th>
				<th>OPD Penanggung Jawab</th>
				<th>Prioritas Pembangunan</th>
			</tr>
		</thead>
		<tbody id="isi-wrap">
			<!--insfrastruktur -->
			<?php
			foreach($bid_pem as $data_bid_pem){
			?>
			<tr>
				<td colspan="11">
					<h3><?=$data_bid_pem->Bidang_Pembangunan; ?></h3>
				</td>
			</tr>
			<?php
				$no=0;
				foreach ($data_usulan as $val) :
					if($val->Kd_Pem == $data_bid_pem->Kd_Pem){
						
						$id = $val->id;
						$no++;
						if ($val->Kd_Jalan)
							@$jalan = $val->kdJalan->Nm_Jalan;
						else
							@$jalan = '';
 
						if($val->Kd_Prioritas_Pembangunan_Daerah)
							$rpjmd_pilih = @$val->rpjmdx->Nm_Prioritas_Pembangunan_Kota;
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
							<td align="Center">
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
							<br>
							<?php if($acara->Waktu_Selesai == 0): ?>
							<a href='index.php?r=musrenbang-kecamatan/update&id=<?=$id;?>&forum=0&xkel=[]&xurut=[]'><button class="btn btn-warning">Edit</button></a>
							<a href='index.php?r=musrenbang-kecamatan/hapus&id=<?=$id;?>'><button class="btn btn-danger">Hapus</button></a>
							<?php endif; ?>
							</td>
						  <td>
							<?php if($val->Kd_Kel) echo @$val->kelurahan->Nm_Kel ?>
						  </td>
						  <td>
							<?php if($val->Kd_Lingkungan) echo @$val->lingkungan->Nm_Lingkungan ?>
						  </td>
						  <td>
							<?php if ($val->Kd_Jalan) echo @$val->kdJalan->Nm_Jalan ?> <br/>
							<?= @$val->Detail_Lokasi ?>
						  </td>
							<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
							<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
							<td align='center'>
								<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
							</td>
							<td align="center">
								<?= $rpjmd_pilih ?>
							</td>
						</tr>
						<?php
					}
				endforeach;
			?>
			<?php } ?>
		</tbody>
	</table>
</div>