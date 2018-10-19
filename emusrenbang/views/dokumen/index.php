<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Tambah/Upload Dokumen Musrenbang';
$this->params['subtitle'] = 'Dokumen';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="alert alert-info">
    <strong>Silahkan Unggah Berita Acara, Absensi, Foto - Foto dan dokumen pendukung lain Musrenbang Kecamatan.</strong><br>        
</div>

<div class="ta-forum-lingkungan-media-index">
<?php if (Yii::$app->request->get('pesan') == "berhasil"): ?>
	<div class="alert alert-success">
		Berhasil mengunggah data ke server!
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Unduh Ulang Absen Awal', ['#'], ['class' => 'btn btn-primary', 'target' => '_blank', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Unduh absen awal jika absen awal hilang']) ?>
            <?= Html::a('Cetak Berita Acara', ['#'], ['class' => 'btn btn-primary', 'target' => '_blank', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Lengkapi Absensi akhir pada berita acara ini kemudian unggah kembali']) ?>
            <?= Html::a('Unduh Semua Berkas Pendukung', ['#'], ['class' => 'btn btn-primary', 'target' => '_blank', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Jika sudah mengupload seluruh berkas diperlukan silahkan download']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-mid-6">
            <div class="widget-container">
                <div class=" widget-block">
                    <?php $form = ActiveForm::begin(['action'=>['#'],'options' => ['enctype' => 'multipart/form-data']]); ?>
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
