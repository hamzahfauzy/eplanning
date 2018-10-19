<?php

use yii\helpers\Html;

$this->title = 'Rekapitulasi Forum Perangkat Daerah';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//     '@web/js/musrenbang/usulan_prioritas.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
?>

<div class="col-md-12">
	<div class="portlet box blue-hoki">
        <div class="portlet-title">
			<div class="control-wrap">
		     <?php $form = \yii\bootstrap\ActiveForm::begin([
		      			  'id' => 'search-usulan',
		                  'action' => ['laporan/cetak-rekap-forum'], 
		                  'options' => ['target' => '_blank']
		      ]) ?>
		       <div class="form-group">
		          <div class="col-sm-2">
		              <br>
		              <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-md']); ?>
		          </div>
		      </div>
		      <?php \yii\bootstrap\ActiveForm::end() ?>
		  		</div>
			  <div class="portlet-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="vcenter text-center">No</th>
							<th class="vcenter text-center">Program</th>
							<th class="vcenter text-center">Kegiatan</th>
							<th class="vcenter text-center">Rincian Obyek</th>
							<th class="vcenter text-center">Volume</th>
							<th class="vcenter text-center">Satuan</th>
							<th class="text-right">Biaya</th>
							
						</tr>

					   <tr>
                            <th class="text-center">(1)</th>
                            <th class="text-center">(2)</th>
                            <th class="text-center">(3)</th>
                            <th class="text-center">(4)</th>
                            <th class="text-center">(5)</th>
                            <th class="text-center">(6)</th>
                            <th class="text-center">(7)</th>
                        </tr>
					</thead>
					<tbody id="isi-wrap">

					
					<?php 

						$no=1;
						foreach ($modelBelanja as $value) : 
					?>

					<?php 

					if ($value['Ref_Usulan_Rincian'] == 2) {
						
						$asal = "Forum OPD";
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
	</div>	
</div>