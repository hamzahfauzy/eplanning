<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use eperencanaan\assets\MapAsset;

$this->title = 'Cetak Usulan Kelurahan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
MapAsset::register($this);
$this->registerJsFile(
        '@web/js/sistem/musrenbangkec.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="alert alert-info">
    <strong>Silahkan melakukan Skoring pada usulan Desa/Kelurahan.</strong><br>
    <i>Pastikan semua usulan Desa/Kelurahan sudah diskoring untuk menentukan prioritas.</i>          
</div>
<div class="col-md-12">
    <div class="box-widget widget-module">
        <div class="widget-container">
            <div class=" widget-block">
                <div class="control-wrap">
                    <?php
                    $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                                'action' => ['ta-musrenbang-kecamatan-report/cetak'], 'options' => ['target' => '_blank']])
                    ?>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="col-sm-6 control-label">Desa/Kelurahan</label>
                            <?= $form->field($model, 'kelurahan')->dropDownList($Kelurahan)->label(false); ?>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-6 control-label">Bidang Pembangungan</label>
                            <?= $form->field($model, 'bid_pem')->dropDownList($ZUL_bid_pem)->label(false); ?>
                        </div>
						<div class="col-sm-4">
						<label class="col-sm-10 control-label">Prioritas Bidang Pembangungan</label>
                            <select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
							<option value="0">-Pilih Semua-</option>
							<?php
								foreach ($rpjmd as $prioritas):
								?>
								<option value="<?= $prioritas->Kd_Prioritas_Pembangunan_Kota ?>"><?= $prioritas->Nm_Prioritas_Pembangunan_Kota ?></option>
								<?php
								endforeach;
							?>
						</select>
                        </div>

                        <div class="col-sm-2">

                            <br>
                            <?= Html::button('&nbsp;Cari&nbsp;', ['id' => 'cari-button', 'class' => 'btn btn-primary btn-lg']); ?>
                            <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>

                        </div>
                    </div>
                    <?php \yii\bootstrap\ActiveForm::end() ?>
                </div>
                <table class="table table-bordered data-table tabel-data">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>

                            <th>
                                Kegiatan Prioritas
                            </th>

                            <th>
                                Prioritas Daerah
                            </th>
<!--
                            <th>
                                Alamat
                            </th>-->
							
							<th>
                                Lokasi Detail
                            </th> 

                            <th>
                                Jumlah/vol
                            </th>
                            <!-- <th>
                                Biaya (Rp)
                            </th> -->

                            <th>
                                Pagu (Rp)
                            </th>

                            <th>
                                OPD Penanggung Jawab
                            </th> 
							
                            <th>
                                Dokumen
                            </th>
							<!--
                            <th>

                                Alasan
                            </th>-->



                        </tr>
                    </thead>
                    <tbody id="body-tabel"></tbody>
                </table>
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

<div class="modal fade" id="modal_dokumen" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Dokumen</h4>
            </div>
			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="modal-body">
                <form>
                    <div class="form-group">
					<?php echo $form->field($models, 'imageFile[]')->widget(FileInput::className(), ['options' => ['multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])?>
                    </div>
                    <div class="form-group">
					<?php echo $form->field($models, 'videoFile[]')->widget(FileInput::className(), ['options' => ['multiple' => true], 'pluginOptions' => ['maxFileCount' => 5]])?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->field($models, 'id')->hiddenInput(['id' => 'id'])->label(false) ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
			<?php ActiveForm::end() ?>
        </div>
    </div>
</div>

<div id="modaldokumen" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
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

<script>
	function showmodallokasi(kd){
		if(kd !== ""){
			$("#modallokasi").modal();
			$("#lat").html(kd[0]);
			$("#lng").html(kd[1]);	
			if(kd[0] == "" && kd[1] == ""){
				kd[0] = 2.985388;
				kd[1] = 99.6150731;
			}
			var sumber = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=600&hl=ru&coord="+kd[0]+","+kd[1]+"&ie=UTF8&t=&z=14&iwloc=B&output=embed";
			$("#frame").attr("src", sumber);
		}
	}
	function setID(id){
		if(id !== ""){
			$("#id").val(id);
			$("#modal_dokumen").modal();
		}
		//alert($("#id").val());
	}
	function showmodaldokumen(kd){
		$.get("index.php?r=dashboard/media-kelurahan&Kd="+kd, function(response){
			$("#response-modal").html(response);
			$("#modaldokumen").modal();
		});
	}
</script>