<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 
use kartik\money\MaskMoney;




$this->registerJs('$("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").keyup(function(){
    var jumlah = $("#jumlah").val();
    var harga = $("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").val();
    harga = harga.replace(/\./g, "");
    harga = harga.replace(/,/g, ".");
    var total = jumlah*harga*100;
    //alert(total);
    $("#takelurahanverifikasiusulanlingkungan-harga_total").val(total/100);
    $("#takelurahanverifikasiusulanlingkungan-harga_total-disp").val(total).trigger("mask.maskMoney");
    $("#takelurahanverifikasiusulanlingkungan-harga_satuan").val(harga);
    
    });$("#jumlah").keyup(function(){
    var jumlah = $("#jumlah").val();
    var harga = $("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").val();
    harga = harga.replace(/\./g, "");
    harga = harga.replace(/,/g, ".");
    var total = jumlah*harga*100;
    //alert(total);
     $("#takelurahanverifikasiusulanlingkungan-harga_total").val(total/100);
    $("#takelurahanverifikasiusulanlingkungan-harga_total-disp").val(total).trigger("mask.maskMoney");
    $("#takelurahanverifikasiusulanlingkungan-harga_satuan").val(harga);
   
    });');


?>

<table>
    <tr>
        <td><b>Nama Permasalahan</b></td>
        <td> : </td>
        <td><?= $model->Nm_Permasalahan ?></td>
    </tr>
    <tr>
        <td><b>Jenis usulan</b></td>
        <td> : </td>
        <td><?= $model->Jenis_Usulan ?></td>
    </tr>
    <tr>
        <td><b>Bidang Pembangunan</b></td>
        <td> : </td>
        <td><?= $model->kdPem->Bidang_Pembangunan ?></td>
    </tr>
    <tr>
        <td><b>Jalan</b></td>
        <td> : </td>
        <td><?= $model->kdJalan->Nm_Jalan ?></td>
    </tr>
    <tr>
        <td><b>Detail Lokasi</b></td>
        <td> : </td>
        <td><?= $model->Detail_Lokasi ?></td>
    </tr>

</table>
<hr/>
                    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'id' => 'revisi-form']) ?>
                    <?php  $form->field($model, 'Nm_Permasalahan')->hiddenInput() ?>
                    <?php  $form->field($model, 'Jenis_Usulan')->hiddenInput() ?>
                    <?= $form->field($model, 'Kd_Pem')->hiddenInput()->label(false); ?>

                    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?>
                    <?= 
                        $form->field($model, 'Kd_Satuan')->dropdownList(
                            $satuan,
                            ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear', 'disabled' => 'disabled']
                        )
                    ?>
                    
                    
                    <?= $form->field($model, 'Harga_Satuan')->widget(MaskMoney::className(), ['id' => 'harga','class' => 'form-control hitung']) ?>
                    
                    <?= $form->field($model, 'Harga_Total')->widget(MaskMoney::className(), ['id' => 'total','class' => 'form-control hitung', 'readonly' => true]) ?>

                    <?php
                    $dl_jalan = Yii::$app->levelcomponent->getKelompok();
                        echo $form->field($model, 'Kd_Jalan')->hiddenInput()->label(false);
                    ?>
                    <?= $form->field($model, 'Detail_Lokasi')->hiddenInput()->label(false); ?>
                  

                    <?php ActiveForm::end(); ?>


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_jalan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['lingkungan/tambahjalan'],
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
                <?= Html::Button('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
          <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->