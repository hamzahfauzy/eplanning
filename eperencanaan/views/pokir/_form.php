<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 
use eperencanaan\assets\MapAsset;

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

$this->title = ($model->isNewRecord ? 'Tambah' : 'Edit').' Usulan';
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
/*
$this->registerJs('
$("#nama").keyup(function(e){ 
    var code = e.which;
	if(code==13){
		$("#response").html("Loading1...");
		var url = "/kamususulan/Data/API/"+$("#nama").val();
		$.get(url,function(data){
			$("#response").html(data);
		});
	}
})
');
*/
?>
<div class="ta-musrenbang-form">
<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                   
               
                <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>

                    <?= $form->field($model, 'Kd_Kec')->dropdownList($data_kec,
                            ['prompt'=>'Pilih Kecamatan', 'class' => 'form-control select2-allow-clear']);
							
                        ?>
						
					<?= $form->field($model, 'Detail_Lokasi')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true]) ?>
					
                    <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true,'readonly'=>true]) ?>
					
					
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
                            ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah"); ?>
                
                    <div class="form-group-hide">
                        <label class="control-label col-sm-3">OPD Penanggungjawab</label>
                        <div class="col-sm-6">
                             
							<?= Html::dropDownList('skpd', $SubUnit, $dataunit, ['class' => 'form-group-hide','id'=>'skpd']) ?>
							
                        </div>
                    </div>

                        <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off'])->label("Jumlah/Vol") ?>
                     
                        <?= $form->field($model, 'Kd_Satuan')->dropdownList($NASsatuan,
                            ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear']);
                        ?>
						
						<?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'readonly' => true]) ?>

 
						<?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>

                         
                        
                        <div class="col-md-offset-3 col-md-6" id="peta" style="height: 300px;"></div>
                        <div class="clearfix"></div><br>

                        <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true, 'id'=>'lat']) ?> 
                        <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true, 'id'=>'lng']) ?>

                        <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <?= Html::submitButton('Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
		var url = "index.php?r=pokir/kamus&param="+$("#nama").val();
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
	$("#tamusrenbang-kd_satuan").val(data.satuan).change();
	$("#tamusrenbang-jenis_usulan").val(data.nama);
	$("#skpd").val(data.opd).change();
	$("#btnTutup").trigger("click");
}
</script>