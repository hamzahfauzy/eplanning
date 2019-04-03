<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->registerJsFile(
        '@web/js/sistem/kecamatan-masuk.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->title = 'Usulan Kecamatan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan'];
$this->params['breadcrumbs'][] = $this->title;
/*
echo "<pre>";
print_r($modelkecamatan[0]);
echo "</pre>";
*/
?>
<div class="container">

<div class="container">
<div class="row">
	<div class="col-sm-3">
	<b>Pilih Kecamatan :</b>
		<select class="form-control" id="select-kecamatan">
		<option value="0">- Semua -</option>
		<?php foreach($modelkecamatan as $kecamatan){ ?>
		<option value="<?=$kecamatan["Kd_Kec"];?>"><?=$kecamatan["Nm_Kec"];?></option>
		<?php } ?>
		</select>
	</div>
	<div class="col-sm-3">
	<b>Status Usulan :</b>
		<select class="form-control" id="status-usulan">
			<option value="3">- Semua -</option>
			<option value="0">Belum Dibahas</option>
			<option value="1">Di Terima</option>
			<option value="2">Di Tolak</option>
		</select>
	</div>
	<div class="col-sm-3">
	<b>Prioritas Bidang Pembangunan :</b>
		<select class="form-control" id="prioritas-bid-pem">
			<option value="0">- Semua -</option>
			<?php foreach($rpjmd as $rpjmds): ?>
			<option value="<?=$rpjmds->Kd_Prioritas_Pembangunan_Kota;?>"><?=$rpjmds->Nm_Prioritas_Pembangunan_Kota;?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="col-sm-3">
	<b></b><br>
	<button class="btn btn-success" id="cari-usulan">Cari</button>
  <a href="#" targt="_blank" class="btn btn-primary" id="cetak-usulan">Cetak</a>
	</div>
</div>
</div>
<br>
<span id="jumlah-total-usulan"></span>
<table id="tbl_usulan_kecamatan" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>
                    No
                </th>
				
                <th>
                    Usulan
                </th>
				<th>
                    Alamat Usulan
                </th>
				<th>
                    Detail Lokasi
                </th>
				<th>
                    Permasalahan
                </th>
				<th>
                    Nama Usulan
                </th>
                <th>
                    Jumlah/vol
                </th>
                <th>
                    Biaya (Rp)
                </th>
                
               
				<?php if($acara['Waktu_Mulai'] != 0){ ?>
				<th>
                    Skor
                </th>
                <th>
                    Aksi
                </th>
                <th>
                    Status
                </th>
				<?php } ?>
				 <th>
                    Urutan Prioritas
                </th> 
            </tr>
		</thead>
		<tbody>
		</tbody>
    </table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Usulan Kecamatan</h4>
      </div>
      <div class="modal-body">
		<div id="res"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="modal_terima" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terima Usulan</h4>
      </div>
      <div class="modal-body">
		
		<div id="res_terima"></div>
		Prioritas Ke : 
		<br>
		<!--<input type="text" name="urutQ" size="80" maxlength="3" id="urutQ" onkeypress="return isNumberKey(event)"> -->
		<textarea class="form-control" rows="1" id="urutQ" ></textarea> 
		<br>
		Alasan1 :
		<textarea class="form-control" rows="7" id="alasan_terima" ></textarea>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" id="btnterima">Terima</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modal_tolak" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tolak Usulan</h4>
      </div>
      <div class="modal-body">
		<div id="res_tolak"></div>
		Alasan :
		<textarea class="form-control" rows="7" id="alasan_tolak"></textarea>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" id="btntolak">Tolak</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="modaldokumen" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title">Dokumen</h4>
      </div>
      <div class="modal-body">
        <span id="response-modal"></span> 
		<!--<img src="" id="img" alt="" class="img-responsive"> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modallokasi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lokasi Usulan</h4>
      </div>
      <div class="modal-body">
		<span>Latitute : <span id="lat"></span></span><br>
		<span>Longitude : <span id="lng"></span></span>
		<div style="width: 100%">
		<iframe id="frame" width="100%" height="600" src="" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             
                    </div>
                    <div class="modal-body" > 
				
						<img src="" id="img1" alt="" class="img-responsive">
						
                    <div class="modal-footer">

                    </div>
                    <?php ActiveForm::end(); ?>
        </div> 
    </div>
</div>
</div> 
<script language="Javascript">
<!--
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
//-->
</script>
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