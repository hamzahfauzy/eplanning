<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 

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
$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/usulankec.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Sub = array();
$Kd_Bidang = array();
$Kd_Asal = array();
$dataSH = array();
$Kd_1 = array();
$Kd_2 = array();
$Kd_3 = array();
$Kd_4 = array();
$Kd_5 = array();
$Kd_6 = array();

$this->title = 'Tambah Usulan Kecamatan';
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
                    <?= $form->field($model, 'Status_Usulan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>

                    <?= $form->field($model, 'Kd_Unit')->dropdownList($NASunit,
                    ['prompt'=>'Pilih Unit', 'class' => 'form-control select2-allow-clear', 'id'=> 'Kd_Unit']); ?>
                     <?= $form->field($model, 'Kd_Sub')->dropDownList($Kd_Sub, ['prompt'=>'Pilih Sub Unit', 'id'=>'Kd_Sub']); ?>

                    <!--  <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Bidang', 'id'=>'Kd_Bidang']); ?> -->

                    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($model, 'Kd_Klasifikasi')->radioList(['1' => 'Fisik', '2' => 'Non Fisik']); ?>

                    <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>

                    <?= 
                    $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
                       $NASrpjmd,
                        ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah"); ?>

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

                 <!--    <?= $form->field($model, 'Kd_Asal_Usulan')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', ], ['prompt' => '']) ?> -->

                    <div class="form-group">
                    <label class="control-label col-sm-3"></label>
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
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