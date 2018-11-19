<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile(
    '@web/css/style_explorer.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/script_explorer.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="row">
	<div class="col-md-2">
		<div class="ruang-data ruang1">
			<h3>Kecamatan</h3>
			<table class="daftar-data">
				<?php
					foreach ($dataKec as $key => $value) {
						$Kd_Prov= $value['Kd_Prov'];
						$Kd_Kab= $value['Kd_Kab'];
						$Kd_Kec= $value['Kd_Kec'];
						$Nm_Kec= $value['Nm_Kec'];
						echo "<tr>
											<td data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' class='data-kec'>$Nm_Kec</td>
											<td></td>
									</tr>";
					}
				?>
			</table>
		</div>
	</div>
	<div class="col-md-2">
		<div class="ruang-data ruang1">
			<h3>Kelurahan</h3>
			<table class="daftar-data" id="list-kel"></table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="ruang-data ruang1">
			<h3>Lingkungan</h3>
			<table class="daftar-data" id="list-ling"></table>
		</div>
	</div>
	<div class="col-md-3">
		<div class="ruang-data ruang1">
			<h3>Usulan</h3>
			<table class="daftar-data" id="list-usulan"></table>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Hapus Lingkungan</h4>
	      </div>
	      <div class="modal-body">
	        <h3>Apakah anda yakin ingin menghapus Lingkungan</h3>
	        <p>*) Lingkungan yang dihapus akan menghapus usulan</p>
	        <form id="form_lingkungan_hapus">
		        <input type="hidden" id="form_prov" name="prov" class="form-control" >
						<input type="hidden" id="form_kab" name="kab" class="form-control" >
						<input type="hidden" id="form_kec" name="kec" class="form-control" >
						<input type="hidden" id="form_kel" name="kel" class="form-control" >
						<input type="hidden" id="form_urut" name="urutkel" class="form-control" >
						<input type="hidden" id="form_lingkungan" name="lingkungan" class="form-control" >
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="btn_hapus_lingkungan">Hapus</button>
	      </div>
    </div>
  </div>
</div>