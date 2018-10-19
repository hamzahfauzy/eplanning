<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefKecamatan;
use common\models\RefJalan;

include"header.php";
?>
<div class="row">
        <div class="col-xs-12 col-sm-6">
          <!--
          -- Input Group adalah salah satu komponen yang disediakan bootstrap
          -- Untuk lebih jelasnya soal Input Group, silahkan buka link ini : http://viid.me/qb4Mup
          -->
          <div class="input-group">
            <!-- Buat sebuah textbox dan beri id keyword -->
            <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
            
            <span class="input-group-btn">
              <!-- Buat sebuah tombol search dan beri id btn-search -->
              <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
              <a href="" class="btn btn-warning">RESET</a>
            </span>
          </div>
        </div>
      </div>
      <br> 
	  <?php
	  $kec=RefKecamatan::find()
	      ->all()
	  ?>
	 
	
	<form method="POST" action="#" id="frm1">
 <select name="frKecamatan" id="frKecamatan" onClick="tampilKec()">
		  <option value="">Select...</option>
		  <?php foreach ($kec as $rows): ?>
		  
		  <option value=<?php $rows['Kd_Kec'];?>><?=$rows['Nm_Kec'];?></option>
		  <?php endforeach ?>
		</select>
	  <br/>
Kode Kecamatan : <input type="text" name="kota" value="" size="20"/>
</form>



<script type="text/javascript">
function tampilKec()
{
  var objfrm = document.getElementById("frm1");
  var idx_opsi = objfrm.frKecamatan.selectedIndex;
  //alert('idx ' + idx_opsi );
  objfrm.kota.value= objfrm.frKecamatan.options[idx_opsi].text; 
}
</script>
<div class="ref-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'Kd_Kec')->dropdownList (
        ArrayHelper::map(RefKecamatan::find()->all(),'Kd_Kec','Nm_Kec'),
        ['prompt' => 'Pilih Kecamatan', 'id' => 'kecamatan']
    ) ?>

       <?= $form->field($model, 'Kd_Kec')->dropDownList($model->isNewRecord ? [] : [], ['prompt'=>'Pilih Kec', 'id'=>'kec','class'=>'form-control'])->label('Kecamatan') ?>
	



</div> 	
 
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							<?php $u = ($untuk == "kelurahan") ? "Desa/Kelurahan" : "Kecamatan"; ?>
                                <h3>Informasi Usulan Musrenbang <?=$u;?></h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<th style="text-align:center">Status Usulan</th>
										<th style="text-align:center">Lokasi</th>
										<th style="text-align:center">Detail Lokasi</th>
										<th style="text-align:center">Permasalahan</th>
										<th style="text-align:center">Usulan</th>
										
										<th style="text-align:center">Jumlah/Vol</th>
										<th style="text-align:center">Perk. Biaya (Rp)</th>
										<th style="text-align:center">OPD Penanggung Jawab</th>
										<th style="text-align:center">Keterangan</th>
										<th style="text-align:center">Dokumen</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($data as $rows): 
									if($untuk == "kelurahan"){
										/*
										if($rows['Status_Penerimaan']==1)
											$status = "Diteruskan";
										else if($rows['Status_Penerimaan']==2)
											$status = "Diteruskan dengan revisi";
										else if($rows['Status_Penerimaan']==3)
											$status = "Ditolak";
										else*/
											$status = "Sedang Diproses";
									}else{
										if($rows['Kd_Asal_Usulan'] == 3)
											$status = "Diteruskan";
										else if($rows['Status_Penerimaan_Kecamatan'] == 1)
											$status = "Diteruskan";
										else if($rows['Status_Penerimaan_Kecamatan'] == 2)
											$status = "Diteruskan dengan revisi";
										else if($rows['Status_Penerimaan_Kecamatan'] == 3)
											$status = "Ditolak";
										else
											$status = "Belum Dibahas";
									}
								?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$status;?></td>
										<td>
										<?=@$nama_jalan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'],$rows['Kd_Jalan']);?>
										<br>
										<?=@$nama_lingkungan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan']).", Desa/Kel ".$nama_desa($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel']).", Kecamatan ".$nama_kec($rows['Kd_Kec']);?>
										</td>
										<td><?=$rows['Detail_Lokasi'];?></td>
										<td><?=$rows['Nm_Permasalahan'];?></td>
										<td><?=$rows['Jenis_Usulan'];?></td>
										<td align="center">
										<?=number_format($rows['Jumlah']);?>
										<?=@$satuan($rows['Kd_Satuan']);?>
										</td>
										<td align="right"><?=number_format($rows['Harga_Total']);?></td>
										<td><?=@$rows->refSubUnit->Nm_Sub_Unit;?></td>
										<td><?=@$rows['Alasan_Kecamatan'];?></td>
										<td>										
										<button class="btn btn-success" onclick="showmodaldokumen(<?=@$rows->taMusrenbangKelurahan["Kd_Ta_Musrenbang_Kelurahan"];?>);"><span class="glyphicon glyphicon-folder-close"></span> Dokumen</button></td>
									</tr>
								<?php $no++; endforeach; ?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
				<script>
					$('#example').DataTable();
					
					function showmodaldokumen(kd){
						$.get("index.php?r=dashboard/media-kelurahan&Kd="+kd, function(response){
							$("#response-modal").html(response);
							$("#modaldokumen").modal();
						});
					}
				</script>
                <?php include"footer.php"; ?>
				
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
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='isi_modal'></div>";
Modal::end();
?>