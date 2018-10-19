<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 

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

<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>

                    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true]) ?>
		            <?= $form->field($model, 'Kd_Pem')->radioList($bidangpembangunan); ?>

                    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?>
                    <?= 
                        $form->field($model, 'Kd_Satuan')->dropdownList(
                            $satuan,
                            ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear']
                        )
                    ?>
                    
                    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>

                    <?php
                    $dl_jalan = Yii::$app->levelcomponent->getKelompok();
                        echo $form->field($model, 'Kd_Jalan')->dropdownList(
                            ArrayHelper::map(RefJalan::find()->orderBy('Nm_Jalan')->where(
                                            [ 'Kd_Prov' => $dl_jalan->Kd_Prov,
                                                'Kd_Kab' => $dl_jalan->Kd_Kab,
                                                'Kd_Kec' => $dl_jalan->Kd_Kec,
                                                'Kd_Kel' => $dl_jalan->Kd_Kel,
                                                'Kd_Urut_Kel' => $dl_jalan->Kd_Urut_Kel,
                                                'Kd_Lingkungan'=>$model->Kd_Lingkungan]
                                    )->all(), 'Kd_Jalan', 'Nm_Jalan'), ['prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])
                    ?>
                    <?= $form->field($model, 'Detail_Lokasi')->textarea(['maxlength' => true]) ?>
                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
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
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
          <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->