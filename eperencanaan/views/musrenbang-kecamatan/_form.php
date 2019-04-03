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
use common\models\RefKelurahan;
//$user=Yii::$app->levelcomponent->getKelompok();


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\Lingkungan */
/* @var $form yii\widgets\ActiveForm */

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
    '@web/js/sistem/tambah_pokir_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
// $this->registerJsFile(
//     '@web/js/sistem/usulankec.js',
//     ['depends' => [\yii\web\JqueryAsset::className()]]
// );

// $Kd_Sub = array();
// $Kd_Bidang = array();
// $Kd_Asal = array();
// $dataSH = array();
// $Kd_1 = array();
// $Kd_2 = array();
// $Kd_3 = array();
// $Kd_4 = array();
// $Kd_5 = array();
// $Kd_6 = array();

$this->title = 'Tambah/Edit Usulan';
$this->params['subtitle'] = 'Usulan';


$this->registerJs("
    $('#asalsatuan').on('click', function(e){
        e.preventDefault(); 
        $('#satuan').toggle();
    })
");

$this->registerJs("
    $('#asalmanual').on('click', function(e){
        e.preventDefault();
        $('#manual').toggle();
    })
");

$this->registerJs("$('#opd').attr('disabled','disable')");
$this->registerJs("$('#tamusrenbang-jenis_usulan').attr('disabled','disable')");
$this->registerJs("$('#tamusrenbang-kd_satuan').attr('disabled','disable')");

$this->registerJs("$('#btnsimpan').click(function(){
	$('#opd').removeAttr('disabled');
	$('#tamusrenbang-jenis_usulan').removeAttr('disabled');
	$('#tamusrenbang-kd_satuan').removeAttr('disabled');
})");
/*
$this->registerJs('
$("#nama").keyup(function(e){ 
    var code = e.which;
	if(code==13){
		$("#response").html("Loading...");
		var url = "/kamususulan/Data/API/"+$("#nama").val();
		$.get(url,function(data){
			$("#response").html(data);
		});
	}
})');
*/
$this->registerJs('
$("#aksi").change(function() {
    if(this.checked) {
		$("#opd").removeAttr("disabled");
		$("#tamusrenbang-jenis_usulan").removeAttr("disabled");
		$("#tamusrenbang-kd_satuan").removeAttr("disabled");
    }else{
        $("#opd").attr("disabled","disable");
		$("#tamusrenbang-jenis_usulan").attr("disabled","disable");
		$("#tamusrenbang-kd_satuan").attr("disabled","disable");
	}
})');

?>
<div class="ta-musrenbang-form">
<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                   
               
                <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>
               
			   <?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Prog', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Keg', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Sasaran', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
				<?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                <?= $form->field($model, 'Kd_Bidang', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                <?= $form->field($model, 'Kd_Unit', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
                <?= $form->field($model, 'Kd_Sub', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
				<?= $form->field($model, 'Kd_Kel', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
				<?= $form->field($model, 'Kd_Lingkungan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
				<?= $form->field($model, 'Kd_Jalan', ['options' => ['class' => 'form-group-hide']])->textInput()->label(false); ?>
				<?php //echo $form->field($model, 'Kd_Kec', ['options' => ['class' => 'form-group-show']])->textInput()->label(false); ?>
				<?php //echo  $form->field($model, 'Kd_Kel', ['options' => ['class' => 'form-group-show']])->textInput()->label(false); ?>
				<?php //echo  $form->field($model, 'Kd_Lingkungan', ['options' => ['class' => 'form-group-show']])->textInput()->label(false); ?>
                <?= $form->field($model, 'Status_Usulan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Klasifikasi', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>

                <!-- Unit -->
                <?php // $form->field($model, 'Kd_Sub')->dropDownList($dataunit, ['prompt'=>'Pilih Sub Unit', 'id'=>'Kd_Sub']) ?>
		<?php
					/*$dl_jalan = Yii::$app->levelcomponent->getKelompok();
					$dl_jalan->Kd_Kel = $model->Kd_Kel;
					$dl_jalan->Kd_Urut_Kel = $model->Kd_Urut_Kel;
					
					
                    echo $form->field($model, 'Kd_Kel')->dropdownList(
                            ArrayHelper::map(RefKelurahan::find()->orderBy('Nm_Kel')->where(
                                            [ 'Kd_Prov' => $dl_jalan->Kd_Prov,
                                                'Kd_Kab' => $dl_jalan->Kd_Kab,
                                                'Kd_Kec' => $dl_jalan->Kd_Kec,
                                                'Kd_Kel' => $dl_jalan->Kd_Kel,
                                                'Kd_Urut' => $dl_jalan->Kd_Urut_Kel,
											
											]
                                    )->all(), 'Kd_Kel', 'Nm_Kel'), ['prompt' => 'Desa/Kelurahan', 'class' => 'form-control select2-allow-clear'])->label("Desa/Kelurahan");
                    */?>
		
			
			<?php
			//	echo $model->Kd_Kec;
				if ($forum==101 || $forum==0)
				{
				if ($model->Kd_Kel!=""||empty($model->Kd_Kel)==FALSE)  { 
 					if($model->Kd_Kel!= ""){
						echo $form->field($model, 'Kd_Kel')->dropdownList($kel1
                                   , ['id'=>'kel1','prompt' => 'Pilih Desa/Kelurahan', 'class' => 'form-control select2-allow-clear'])->label("Desa/Kelurahan");
					}else{
						echo $form->field($model, 'Kd_Kel')->dropdownList($RefKelurahan
                                   , ['id'=>'kel1','prompt' => 'Pilih Desa/Kelurahan', 'class' => 'form-control select2-allow-clear'])->label("Desa/Kelurahan");
					}
					echo $form->field($model, 'Kd_Lingkungan')->dropDownList($ZULRefLingkungan,
                            ['id' => 'link',
                            'prompt' => 'Pilih Dusun/Lingkungan',
                            'onchange' => '(function (){'
                                . ' var value = $("#link").val();
                                    $.ajax({
                                    url: "' . Yii::$app->urlManager->createUrl('ajax/data-jalan') . '",
                                    data: {value: value},
                                    type: "GET",
                                    success: function(data) {
                                    $("#jalan").html("<option>Pilih Jalan</option>"+data);
                                    }
    });                         })()'])->label('Dusun/Lingkungan'); 
                    
 					
				/*	if($model->Kd_Lingkungan!= ""){
						echo $form->field($model, 'Kd_Lingkungan')->dropdownList($lingkungan
                                   , ['id'=>'lingkungan','prompt' => 'Pilih Dusun/Lingkungan', 'class' => 'form-control select2-allow-clear'])->label("Dusun/Lingkungan");
					}else{
						echo $form->field($model, 'Kd_Jalan')->dropdownList([]
                                   , ['id'=>'lingkungan','prompt' => 'Pilih Dusun/Lingkungan', 'class' => 'form-control select2-allow-clear'])->label("Dusun/Lingkungan");
					}*/
				
				if($model->Kd_Jalan != 0){
						echo $form->field($model, 'Kd_Jalan')->dropdownList($jalan
                                   , ['id'=>'jalan','prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
					}else{
						echo $form->field($model, 'Kd_Jalan')->dropdownList([]
                                   , ['id'=>'jalan','prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
					}
				}
				}
					?>
	
				
				<?php
				if ($forum==1  )
				{
				echo $form->field($model, 'Kd_Kel')->dropDownList($RefKelurahan,
                            ['id' => 'kel',
                            'prompt' => 'Pilih Desa/Kelurahan',
                            'onchange' => '(function (){'
                                . ' var value = $("#kel").val();
                                    $.ajax({
                                    url: "' . Yii::$app->urlManager->createUrl('ajax/data-lingkungan') . '",
                                    data: {value: value},
                                    type: "GET",
                                    success: function(data) {
                                    $("#link").html("<option>Pilih Dusun/Lingkungan</option>"+data);
                                    }
    });                         })()'])->label('Desa/Kelurahan'); 

                
					echo $form->field($model, 'Kd_Lingkungan')->dropDownList($ZULRefLingkungan,
                            ['id' => 'link',
                            'prompt' => 'Pilih Dusun/Lingkungan',
                            'onchange' => '(function (){'
                                . ' var value = $("#link").val();
                                    $.ajax({
                                    url: "' . Yii::$app->urlManager->createUrl('ajax/data-jalan') . '",
                                    data: {value: value},
                                    type: "GET",
                                    success: function(data) {
                                    $("#jalan").html("<option>Pilih Jalan</option>"+data);
                                    }
    });                         })()'])->label('Dusun/Lingkungan'); 
	
				
				if($model->Kd_Jalan != 0){
						echo $form->field($model, 'Kd_Jalan')->dropdownList($jalan
                                   , ['id'=>'jalan','prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
					}else{
						echo $form->field($model, 'Kd_Jalan')->dropdownList([]
                                   , ['id'=>'jalan','prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
					}
				
				}
	?>
                    <?php
                    //$dl_jalan = Yii::$app->levelcomponent->getKelompok();
                  //  echo $form->field($model, 'Kd_Jalan')->dropdownList([]
                  //                 , ['id'=>'jalan','prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
                   ?> 
 
					
			<?php //}?>
		        <!-- Bidang -->
				
				
				<?= $form->field($model, 'Detail_Lokasi')->textarea(['maxlength' => true]) ?>
                <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true]) ?>

				
					<div class="form-group required">
                        <label class="control-label col-sm-3" for="total"></label>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary" title="Buka Kamus Usulan" data-toggle="modal" data-target="#modal_kamus">Buka Kamus Usulan</button>
							<input type="checkbox" id="aksi" style="display:none;">
							<!--<label for="aksi" >Usulan Manual</label> -->
                        </div>
                    </div>	
                <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true,'readonly'=>true]) ?>	 
                <?= $form->field($model, 'Def_Operasional')->textarea(['maxlength' => true,'readonly'=>true])?>
				<!--<?= $form->field($model, 'Kd_Kamus_Usulan')->textarea(['maxlength' => true,'readonly'=>true])?> -->
				<?= $form->field($model, 'Kd_Kamus_Usulan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>
                <?= 
                    $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
                       $NASrpjmd,
                        ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah"); ?>
                
                <div class="form-group ">
                    <label class="control-label col-sm-3">OPD Penanggungjawab</label>
                    <div class="col-sm-6">
                        <?= Html::dropDownList('skpd', null, $dataunit, ['class' => 'form-control','id' => 'opd', 'options' => [ @$unitpilihan => ['selected'=>true]]]) ?>
                    </div>
                </div>
                  <!--   <label class="control-label col-sm-3">Satuan </label>
                    <a href="#" id="asalmanual" role="button" class="btn btn-success">Input Manual</a>
                     <label class="control-label col-sm-2"></label>
                    <a href="#" id="asalsatuan" role="button" class="btn btn-info">Input dari Standard </a> -->
                    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?>
                
                

                    <?= $form->field($model, 'Kd_Satuan')->dropdownList($NASsatuan,
                    ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear']);
                    ?>
                    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?> 

                    <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>

	
                        
                        <div class="col-md-offset-3 col-md-6" id="peta" style="height: 300px;"></div>
                        <div class="clearfix"></div><br>

                        <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true, 'id'=>'lat']) ?> 
                        <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true, 'id'=>'lng']) ?>

                 <!--    <?= $form->field($model, 'Kd_Asal_Usulan')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', ], ['prompt' => '']) ?> -->

                    <div class="form-group">
                    <label class="control-label col-sm-3"></label>
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success','id'=>'btnsimpan']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>

<!-- modal musrenbang kelurahan -->

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
		//var url = "index.php?r=ta-musrenbang-kelurahan/kamus&param="+$("#nama").val();
		$.get(url,function(data){
			$("#response").html(data);
		});
	}
});

function btnPilih(data){
		$("#harga").val(data.harga);
		$("#jumlah").val(1);
		$("#total").val(data.harga*1);
		$("#tamusrenbang-kd_satuan option[value="+data.satuan+"]").attr("selected","selected");
		$("#opd").val(data.opd).change();
		$("#tamusrenbang-jenis_usulan").val(data.nama);
		$("#tamusrenbang-def_operasional").val(data.defOP);
		$("#tamusrenbang-kd_kamus_usulan").val(data.kode);
		$("#tamusrenbang-kd_urusan").val(data.urusan);
		$("#tamusrenbang-kd_bidang").val(data.bidang);
		$("#tamusrenbang-kd_unit").val(data.bidang);
		$("#tamusrenbang-kd_sub").val(data.bidang);
		$("#btnTutup").trigger("click"); 
	}
</script>
