<?php

use yii\helpers\Html;

$this->title = 'Rekapitulasi Musrenbang Kecamatan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//     '@web/js/musrenbang/usulan_prioritas.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
/*
echo "<pre>";
print_r($modelBelanja);
echo "</pre>";*/
?>

	<div class="box box-success">
        <div class="box-header">
			<?php $form = \yii\bootstrap\ActiveForm::begin([
						  	'id' => 'search-usulan',
			          		'action' => ['laporan-skpd/cetak-rekapkec'], 
			          		'options' => ['target' => '_blank']
			]) ?>
			<div class="form-group">
				<div class="col-sm-2">
					<?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-md']); ?>
				</div>
			</div>
			<?php \yii\bootstrap\ActiveForm::end() ?>
		</div>
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="vcenter text-center">No</th>
						<th class="vcenter text-center">Program</th>
						<th class="vcenter text-center">Kegiatan</th>
						<th class="vcenter text-center">Rincian Obyek</th>
						<th class="vcenter text-center">Volume</th>
						<th class="vcenter text-center">Satuan</th>
						<th class="vcenter text-center">Biaya</th>
						<!-- <th class="vcenter text-center">Asal Usulan</th> -->
					</tr>
				</thead>
				<tbody id="isi-wrap">
					<?php 

						$no=1;
						foreach ($modelBelanja as $value) : 
					?>

					<?php 

					if ($value['Ref_Usulan_Rincian'] == 1) {
						
						$asal = "Musrenbang Kecamatan";
					}
					?>

					<tr>
						<td><?= $no++ ?></td>
						<td><?= $value->refProgram['Ket_Program']; ?></td>
						<td><?= $value->kegiatan['Ket_Kegiatan']; ?></td>
						<td><?= $value['Keterangan'] ?></td>
						<td><?= $value['Jml_Satuan']?></td>
						<td><?= $value['Satuan123']?></td>
						<td><?= number_format($value['Total'],0, ',', '.')?>
						<td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>