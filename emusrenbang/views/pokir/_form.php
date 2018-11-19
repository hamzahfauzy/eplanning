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
    '@web/js/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

MapAsset::register($this);
$this->registerJsFile(
    '@web/js/tambah_pokir_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/pokir_dapil.js', ['depends' => [\yii\web\JqueryAsset::className()]]
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

$this->title = 'Tambah Usulan Pokir';
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

?>
<div class="ta-musrenbang-form">
      <div class="box box-success"> 
        <div class="box-body">
                   
               
                <?php $form = ActiveForm::begin(['layout' => 'horizontal',     
                                            'options' => [
                                            'validateOnSubmit' => true,
                                            'class' => 'form'
                ],]) ?>

                <?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->hiddenInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Prog', ['options' => ['class' => 'form-group-hide']])->hiddenInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Keg', ['options' => ['class' => 'form-group-hide']])->hiddenInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Sasaran', ['options' => ['class' => 'form-group-hide']])->hiddenInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Status_Usulan', ['options' => ['class' => 'form-group-hide']])->hiddenInput(['value'=>'0'])->label(false); ?>
                <?= $form->field($model, 'Kd_Klasifikasi')->hiddenInput(['value'=>'0'])->label(false); ?>

                <!-- Unit -->
                

                <!-- Bidang -->


                <?= $form->field($model, 'Kd_Dapil')->dropdownList($dapil,['prompt'=>'Pilih Daerah Pemilihan', 'id'=>'dapil']);
                    ?>

                <?= $form->field($model, 'Kd_Dewan')->dropdownList($Kd_Dewan,['prompt'=>'Pilih Dewan', 'id'=>'Kd_Dewan']);
                    ?>

                <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true]) ?>
                <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true]) ?>
    
                <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>

                <?= 
                    $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
                       $NASrpjmd,
                        ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah"); ?>
                
                <div class="form-group ">
                    <label class="control-label col-sm-3">SKPD Penanggungjawab</label>
                    <div class="col-sm-6">
                        <?= Html::dropDownList('skpd', null, $dataunit, ['class' => 'form-control']) ?>
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
                    <!-- <?php //$form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>  --> 

                    <?= $form->field($model, 'Harga_Satuan')->hiddenInput(['value'=>'0'])->label(false) ?> 

                    <!-- <?php // $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?> -->

                    <?= $form->field($model, 'Harga_Total')->hiddenInput(['value' => '0'])->label(false) ?>
                    
                 <!--    <?= $form->field($model, 'Kd_Asal_Usulan')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', ], ['prompt' => '']) ?> -->

                    <?= $form->field($model, 'Detail_Lokasi')->textarea(['maxlength' => true]) ?>
                    
                    <div class="col-md-offset-3 col-md-6" id="peta" style="height: 300px;"></div>
                    <div class="clearfix"></div>
                    <br>
                    <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true, 'id'=>'lat']) ?> 
                    <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true, 'id'=>'lng']) ?> 

                    <div class="form-group">
                    <label class="control-label col-sm-3"></label>
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>    

<!-- modal musrenbang kelurahan -->
<!-- /.modal form -->

