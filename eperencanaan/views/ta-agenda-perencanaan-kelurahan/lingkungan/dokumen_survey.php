<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\FileInput;

$this->registerCssFile(
        '@web/css/sistem/lingkungan_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Tambah Dokumen';
$this->params['subtitle'] = 'Dokumen';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;

$ZULjs = '$(document).click(function(event){
			var data = event.target.getAttribute("data");
			var ext = event.target.getAttribute("ext");
			var style = "width:550px;height:500px";
			var data2 = "";
			//if (ext == "mp4"){
				//alert(ext);
				//data2 = "<video src=" + data + " style= " + style + "></video>";
			//}else{
				data2 = "<iframe src="+ data + " style= " + style + "></iframe>";
			//}
			
			document.getElementById("isi").innerHTML = data2;
		});
	
';

$this->registerJs($ZULjs);
?>

<div class="ta-forum-lingkungan-media-index">
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Unduh Ulang Absen Awal', ['lingkungan/absensi', 'kode' => '2'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
            <?php if ($acara->Waktu_Selesai == 0) : ?>
                <?= Html::Button('Cetak Berita Acara', ['class' => 'btn btn-primary', 'target' => '_blank', 'disabled' => 'disabled']) ?>
            <?php elseif ($acara->Waktu_Unduh_Berita_Acara == 0) : ?>
                <?= Html::Button('Cetak Berita Acara', ['class' => 'btn btn-primary', 'target' => '_blank', 'data-toggle' => 'modal', 'data-target' => '#modal_info_rembuk']) ?>
            <?php else : ?>
                <?= Html::a('Cetak Berita Acara', ['lingkungan/berita-acara', 'kode' => '2', 'stat' => 'SELESAI'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
            <?php endif; ?>
            <?php if ($dataProvider->getTotalCount() !== 0) : ?>
                <?= Html::a('Unduh Semua Berkas Pendukung', ['lingkungan/himpun-semua', 'kode' => '2'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
            <?php endif; ?>
        </div>
        <div class="col-md-12">

            <!--<div class="form-group">
            <?php if ($acara->Waktu_Unduh_Absen == 0) : ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Absensi', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '1'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Berita Acara', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '2'], ['class' => 'btn btn-primary', 'disabled' => 'disabled']) ?>
            <?php elseif ($acara->Waktu_Unduh_Berita_Acara == 0) : ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Absensi', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '1'], ['class' => 'btn btn-primary', 'disabled' => 'disabled']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Berita Acara', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '2'], ['class' => 'btn btn-primary']) ?>
            <?php else : ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Absensi', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '1'], ['class' => 'btn btn-primary', 'disabled' => 'disabled']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Berita Acara', ['sample-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '2'], ['class' => 'btn btn-primary', 'disabled' => 'disabled']) ?>
            <?php endif; ?>
            </div>-->

        </div>


        <div class="col-md-6 col-mid-6">
            <div class="widget-container">
                <div class=" widget-block">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <div class="form-group">
                        <?=
                        $form->field($model, 'absenFile[]')->widget(FileInput::className(), ['options' => [
                                'multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])
                        ?>
                    </div>
                    <div class="form-group">   
                        <?php
                        echo $form->field($model, 'imageFile[]')->widget(FileInput::className(), ['options' => [
                                'multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo $form->field($model, 'videoFile[]')->widget(FileInput::className(), ['options' => [
                                'multiple' => true], 'pluginOptions' => ['maxFileCount' => 5]])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->field($model, 'beritaFile')->widget(FileInput::className()) ?>

                    </div>
                    <div class="form-group">
                        <?php echo $form->field($model, 'piFile')->widget(FileInput::className()) ?>

                    </div>
					<div class="form-group">
                        <?php echo $form->field($model, 'TandaTerimaFile')->widget(FileInput::className()) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php Pjax::begin(); ?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'Nama Berkas',
            'format' => 'raw',
            'value' => function($model, $key, $index) {
                return '<h5>' . $model->kdMedia->Judul_Media . '.' . $model->kdMedia->Type_Media . '</h5>';
            },
        ],
        ['attribute' => 'Kategori',
            'format' => 'raw',
            'value' => function($model, $key, $index) {
                return '<p>' . $model->Jenis_Dokumen . '</p>';
            },
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{edit1}{edit2}',
            'header' => 'Aksi',
            'buttons' => [
                'edit1' => function ($url, $model) {
                    return Html::a('Unduh', ['sample-download',
                                'filename' => realpath(dirname(dirname(dirname(__FILE__)))) . '/web/data/' . $model->kdMedia->Nm_Media], ['class' => 'btn btn-info btn-sm']);
                },
                        'edit2' => function ($url, $model) {
                    return Html::Button('Pratinjau', ['class' => 'btn btn-info btn-sm',
                                'id' => 'preview',
                                'ext' => $model->kdMedia->Type_Media,
                                'data' => 'data/' . $model->kdMedia->Nm_Media, //'http://docs.google.com/gview?url=http://writing.engr.psu.edu/workbooks/formal_report_template.doc&embedded=true',
                                'data-toggle' => 'modal',
                                'data-target' => '#modal_preview']);
                },
                    ],
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>

        </div>


        <!-- modal musrenbang kelurahan -->
        <div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Masukkan Jumlah Peserta</h4>
                    </div>
                    <div class="modal-body">
                        <?= $form->field($acara, 'Jumlah_Peserta')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
                        <?= Html::submitButton('Masukkan', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <!-- /.modal form -->

        <!-- modal musrenbang kelurahan -->
        <div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             
                    </div>
                    <div class="modal-body" id="isi">

                    </div>
                    <div class="modal-footer">

                    </div>
                    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->