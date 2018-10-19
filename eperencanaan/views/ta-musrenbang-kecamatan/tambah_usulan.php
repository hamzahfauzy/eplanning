<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 
use common\models\RefRPJMD;
use eperencanaan\assets\MapAsset;

//$user=Yii::$app->levelcomponent->getKelompok();


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\Lingkungan */
/* @var $form yii\widgets\ActiveForm */
/*
$this->registerJsFile(
    '@web/js/sistem/jquery.number.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/jquery.priceformat.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
*/
MapAsset::register($this);
$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Tambah Usulan';
$this->params['subtitle'] = 'Usulan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['lingkungan/usulan']];
$this->params['breadcrumbs'][] = $this->title;

//$pesan = $request->get('pesan');
?>
<div class="alert alert-info">
  <strong>Silahkan menambahkan USULAN DESA/KELURAHAN
  </strong><br>
    <i>Usulan ini adalah usulan yang berasal dari kelurahan dan tidak mewakili usulan lingkungan.</i>          
        </div>
<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <?php 
                        //'Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 
                        //'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 
                        //'Kd_Keg', 'Nm_Permasalahan', 'Kd_Klasifikasi', 'Jenis_Usulan', 
                        //'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Kd_Sasaran', 'Tanggal' 
                    ?>
                    <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>

                   
                    <?= $form->field($model, 'Kd_Ta_Forum_Lingkungan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>

                    <?= $form->field($model, 'Kd_Ta_Musrenbang_Kelurahan', ['options' => ['class' => 'form-group-hide']])->textInput([])->label(false); ?>

                    <?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Kd_Bidang', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Kd_Prog', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Kd_Keg', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Kd_Klasifikasi', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Kd_Sasaran', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Status_Usulan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?= $form->field($model, 'Status_Pembahasan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?php echo $form->field($model, 'Kd_Lingkungan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                    <?php echo $form->field($model, 'Nilai', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
 <?= $form->field($model, 'Kd_Lingkungan')->dropDownList($ZULRefLingkungan,
                            ['id' => 'link',
                            'prompt' => 'Pilih Dusun/Lingkungan',
                            'onchange' => '(function (){'
                                . ' var value = $("#link").val();
                                    $.ajax({
                                    url: "' . Yii::$app->urlManager->createUrl('ajax/zul-jalan') . '",
                                    data: {value: value},
                                    type: "GET",
                                    success: function(data) {
                                    $("#jalan").html(data);
									 
									$("#tamusrenbangkelurahan-jenis_usulan").attr("readonly","true"); // Add by RIpin
                                    }
    });                         })()'])->label('Dusun/Lingkungan'); ?>
                    <?php
					$dl_jalan = Yii::$app->levelcomponent->getKelompok();
					$dl_jalan->Kd_Kel = $model->Kd_Kel;
					$dl_jalan->Kd_Urut_Kel = $model->Kd_Urut_Kel;
					$dl_jalan->Kd_Lingkungan = $model->Kd_Lingkungan;
					
                    echo $form->field($model, 'Kd_Jalan')->dropdownList(
                            ArrayHelper::map(RefJalan::find()->orderBy('Nm_Jalan')->where(
                                            [ 'Kd_Prov' => $dl_jalan->Kd_Prov,
                                                'Kd_Kab' => $dl_jalan->Kd_Kab,
                                                'Kd_Kec' => $dl_jalan->Kd_Kec,
                                                'Kd_Kel' => $dl_jalan->Kd_Kel,
                                                'Kd_Urut_Kel' => $dl_jalan->Kd_Urut_Kel,
											    'Kd_Lingkungan' => $dl_jalan->Kd_Lingkungan, 
											]
                                    )->all(), 'Kd_Jalan', 'Nm_Jalan'), ['prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
                    ?>
					<?= $form->field($model, 'Detail_Lokasi')->textarea(['maxlength' => true]) ?>
			
			
		
			
                    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true])->label("Nama Permasalahan"); ?>
                    <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true, 'readonly'=>true]) ?>
					
					<div class="form-group required">
                        <label class="control-label col-sm-3" for="total"></label>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary" title="Buka Kamus Usulan" data-toggle="modal" data-target="#modal_kamus">Buka Kamus Usulan</button>
                        </div>
                    </div>
					
					
                    <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>

                     <?= 
                        $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
                           $NASrpjmd,
                            ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah");
                    ?>

                    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?>
                    <?= 
                        $form->field($model, 'Kd_Satuan')->dropdownList(
                           $NASsatuan,
                            ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear'])->label("Satuan");
                    ?>

                    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>
					
					
					
					<div class="col-md-offset-3 col-md-6" id="peta" style="height: 300px;"></div>
                        <div class="clearfix"></div><br>

                        <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true, 'id'=>'lat','readonly'=>true]) ?> 
                        <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true, 'id'=>'lng','readonly'=>true]) ?>
 


                    <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>
                   


                    <!--
                    <input type="text" name="" value="<?= $dl_jalan->Kd_Prov.",".
                                                            $dl_jalan->Kd_Kab.",".
                                                            $dl_jalan->Kd_Kec.",".
                                                            $dl_jalan->Kd_Kel.",".
                                                            $dl_jalan->Kd_Urut_Kel.",".
                                                            $dl_jalan->Kd_Lingkungan 
                                                        ?>">
                    -->
                    <!--
                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <?= Html::submitButton('Tambah', ['class' =>  'btn btn-primary']) ?>
                    </div>
                    -->
                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <?php
                        /*
                        'Tahun' => 'Tahun',
                        'Kd_Ta_Forum_Lingkungan' => 'Kd  Ta  Forum  Lingkungan',
                        'Kd_Prov' => 'Kd  Prov',
                        'Kd_Kab' => 'Kd  Kab',
                        'Kd_Kec' => 'Kd  Kec',
                        'Kd_Kel' => 'Kd  Kel',
                        'Kd_Urut_Kel' => 'Kd  Urut  Kel',
                        'Kd_Lingkungan' => 'Kd  Lingkungan',
                        'Kd_Jalan' => 'Jalan',
                        'Kd_Urusan' => 'Kd  Urusan',
                        'Kd_Bidang' => 'Kd  Bidang',
                        'Kd_Prog' => 'Kd  Prog',
                        'Kd_Keg' => 'Kd  Keg',
                        'Nm_Permasalahan' => ' Permasalahan',
                        'Kd_Klasifikasi' => 'Kd  Klasifikasi',
                        'Jenis_Usulan' => 'Jenis  Usulan',
                        'Jumlah' => 'Jumlah',
                        'Kd_Satuan' => 'Satuan',
                        'Harga_Satuan' => 'Harga  Satuan',
                        'Harga_Total' => 'Harga  Total',
                        'Kd_Sasaran' => 'Kd  Sasaran',
                        */
                    ?>
                </div>
            </div>
        </div>
       
    </div>

</div>


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_jalan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['ta-musrenbang-kelurahan/tambahjalan'],
                        ]) 
          ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Jalan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="kd_usulan" id="kd_usulan_input">
                <div class="form-group">
                  <label >Nama Jalan</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama Jalan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
          <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->

<!-- Ditambah Oleh Ripin -->
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
    @media screen and (min-width: 868px) {
        .modal-dialog {
          width: 800px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>



<div class="modal fade" id="modal_kamus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Kamus Usulan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="kd_usulan" id="kd_usulan_input">
                <div class="form-group">
                  <label >Cari : </label>
                  <input type="text" id="nama" class="form-control" placeholder="Nama Kamus Usulan"><br>
				  <div id="response"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnTutup" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="/kamususulan/views/js/jquery.js"></script>
<script>
$("#nama").keyup(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers
	if(code==13){
		$("#response").html("Loading...");
		var url = "index.php?r=ta-musrenbang-kecamatan/kamus&param="+$("#nama").val();
		$.get(url,function(data){
			$("#response").html(data);
		});
	}
});

function btnPilih(data){
	//alert(id);
	//$("#harga").val(id);
	//console.log(data);
	$("#harga").val(data.harga);
	if($("#jumlah").val()==0)
		$("#jumlah").val(1);
	$("#total").val(data.harga*$("#jumlah").val());
	$('#tamusrenbangkelurahan-kd_satuan option[value='+data.satuan+']').attr('selected','selected');
	$("#tamusrenbangkelurahan-jenis_usulan").val(data.nama);
	$("#tamusrenbangkelurahan-kd_urusan").val(data.urusan);
	$("#tamusrenbangkelurahan-kd_bidang").val(data.bidang);
	$("#btnTutup").trigger("click");
}
</script>