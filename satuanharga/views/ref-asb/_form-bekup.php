<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb */
/* @var $form yii\widgets\ActiveForm */
$this->registerCSSFile(
    '@web/css/tabel_style.css',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
);

$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Asb2=array();
$Kd_Asb3=array();
$Kd_Asb4=array();

$this->registerJsFile(
    '@web/js/form_hspk_asb.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/getasal.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
    $Asal=array();
    $dataSH=array();
    $Kd_Ssh2=array();
    $Kd_Ssh3=array();
    $Kd_Ssh4=array();
    $Kd_Ssh5=array();
    $Kd_Ssh6=array();

    $Kd_Hspk2=array();
    $Kd_Hspk3=array();
    $Kd_Hspk4=array();
    $dataHarga=array();
    $dataKdsatuan=array();
?>

<div class="ref-asb-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-2">
     <?= $form->field($model, 'Kd_Asb1')->dropDownList($dataAsb, ['prompt'=>'Pilih ASB1', 'id'=>'Kd_Asb1']) ?>
     </div>

     <div class="col-md-2">
    <?= $form->field($model, 'Kd_Asb2')->dropDownList($Kd_Asb2, ['prompt'=>'Pilih ASB2', 'id'=>'Kd_Asb2']) ?>
    </div>

     <div class="col-md-2">
     <?= $form->field($model, 'Kd_Asb3')->dropDownList($Kd_Asb3, ['prompt'=>'Pilih ASB3', 'id'=>'Kd_Asb3']) ?>
     </div>

     <div class="col-md-2">
      <?= $form->field($model, 'Kd_Asb4')->dropDownList($Kd_Asb4, ['prompt'=>'Pilih ASB4', 'id'=>'Kd_Asb4']) ?>
      </div>

    <div class="col-md-2">
    <?= $form->field($model, 'Kd_Asb5')->textInput(['readonly'=>false]) ?>
    </div>

    <div class="col-md-6">
      <?= $form->field($model, 'Jenis_Pekerjaan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
      </div>
    <div class="col-md-3">
        <?= $form->field($model, 'Kd_Satuan')->dropDownList($Kd_Satuan, ['prompt'=>'Pilih Satuan', 'id'=>'Kd_Satuan', 'class'=>'form-control input-sm']) ?>
      </div>

   <div class="col-md-3">
        <?= $form->field($model, 'Harga')->textInput(['id'=>'harga_asb', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>
    </div>

 <hr />
<div class="row">
    <div class="col-md-3">  
   <?= $form->field($modelanak, 'Kategori_Pekerjaan')->dropDownList($Kategori_Pekerjaan, ['prompt'=>'Kategori Pekerjaan', 'id'=>'Kategori_Pekerjaan']) ?>
   </div>

   <div class="col-md-3">  
   <?= $form->field($modelanak, 'Asal')->dropDownList(['1' => 'SSH', '2' => 'HSPK'], ['prompt'=>'Asal', 'id'=>'Asal']) ?>
   </div>
   </div>

     <div class="row">
      <div class="col-md-2">
      <?= $form->field($modelanak, 'Kd_Hspk_Ssh1')->dropDownList($dataSH, ['prompt'=>'Pilih Asal 1', 'id'=>'dataSH', 'class'=>'form-control input-sm']) ?>
      
     <!-- <?= $form->field($modelanak, 'Kd_Asb1')->hiddenInput(['id'=>'kdasb1'])->Label(''); ?> -->
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh2')->dropDownList([], ['prompt'=>'Pilih Asal 2', 'id'=>'Kd_Hspk_Ssh2', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh3')->dropDownList([], ['prompt'=>'Pilih Asal 3', 'id'=>'Kd_Hspk_Ssh3', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh4')->dropDownList([], ['prompt'=>'Pilih Asal 4', 'id'=>'Kd_Hspk_Ssh4', 'class'=>'form-control input-sm']) ?>
      </div>


      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Ssh5')->dropDownList([], ['prompt'=>'Pilih SSH5', 'id'=>'Kd_Ssh5', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Ssh6')->dropDownList([], ['prompt'=>'Pilih SSH6', 'id'=>'Kd_Ssh6', 'class'=>'form-control input-sm']) ?>
      </div>
    

    <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" >Satuan</label>
            <input class="form-control input-sm" name="satuan_ss" id="satuan" readonly>
          </div>
        </div>

  <div class="col-md-3">
        <?= $form->field($modelanak, 'Harga_Satuan')->textInput(['id'=>'harga-ss', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3" style="display: none">
        <?= $form->field($modelanak, 'Kd_Satuan')->textInput(['id'=>'kdsatuan-ss', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

  <input type="hidden" id="uraian" name="uraian_ss">
      <div class="col-md-3">
        <?= $form->field($modelanak, 'Koefisien')->textInput(['id'=>'koefisien', 'class'=>'form-control input-sm']) ?>
      </div>        
  
     <div class="col-md-3">
        <?= $form->field($modelanak, 'Jumlah_Harga')->textInput(['id'=>'jumlah', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">&nbsp;</label>
          <button type="button" id="btn-tambah-ssh" class="form-control btn btn-warning input-sm" >Tambah</button>
        </div>
      </div>
    </div>
</div>
    <!-- melihat data yang di tambah -->
    <div class="row">
      <div class="tabel-wrap" id="wrap-ssh">
        <table class="tabel-hasil">
          <thead>
            <tr>
              <th>NOMOR</th>
              <th>KATEGORI PEKERJAAN</th>
              <th>KOEF.</th>
              <th>SAT</th>
              <th>HARGA SATUAN</th>
              <th>HARGA</th>
            </tr>
          </thead>
          <tbody>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">I:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr><!-- jumlah ssh -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">II:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">III:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr><!-- jumlah ssh -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr class="akhir"> <!-- toal akhir semua jumlah -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Nilai HSPK</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <!-- akhir kegiatan -->
          </tbody>
        </table>
      </div>
    </div><!--akhir row-->


	<?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
  <?php ActiveForm::end(); ?>
