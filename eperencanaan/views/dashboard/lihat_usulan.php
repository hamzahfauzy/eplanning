<?php

use yii\helpers\Html;
use kartik\widgets\Typeahead;

$this->title = 'Cetak Usulan Dusun/Lingkungan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- page wrapper -->
<div class="dev-page">

    <!-- page header -->
    <div class="dev-page-header">

        <div class="dph-logo">
            <img src="img/logo.png" height="40">
            <span class="judul-logo">E-Planning Kabupaten Asahan</span>
            <a class="dev-page-sidebar-collapse">
                <div class="dev-page-sidebar-collapse-icon">
                    <span class="line-one"></span>
                    <span class="line-two"></span>
                    <span class="line-three"></span>
                </div>
            </a>
        </div>


    </div>
    <!-- ./page header -->

    <!-- page container -->
    <div class="dev-page-container">   

        <!--sidebar-->
<?php include "leftpage.php"; ?>

        <!-- page content -->
        <div class="dev-page-content">



            <!-- page content container -->
            <div class="container">


                <!-- page title -->
                <div class="page-title" id="tour-step-4" style="text-align: center">
                    <h1><b>E-Planning Kabupaten Asahan</b></h1>
                    <img src="img/logo_medan.png" width="150px"/>

                </div>
                <div style="text-align: center"><h3>Daftar Usulan Warga Kabupaten Asahan Tahun 2018</h3></div>
                <?php if ($nm_kel != '') :?>
                <div style="text-align: center"><h3>Kelurahan <?= $nm_kel?></h3></div>
                <?php endif; ?>
                <!-- ./page title -->
                <hr>



                <div class="col-md-12">
                    <div class="box-widget widget-module">
                        <div class="widget-container">
                            <div class=" widget-block">
                                <div class="control-wrap">

                                    <div class="form-group form-group-lg">

                                        <div class="col-sm-12">

<?php $form = yii\bootstrap\ActiveForm::begin(['method' =>'get', 'action' => ['dashboard/lihat-usulan']]) ?>
<?=
$form->field($model, 'kelurahan')->widget(Typeahead::className(), [
    
    'pluginOptions' => ['highlight' => true],
    'dataset' => [['local' => $kelurahan, 'limit' => 10]],
    'options' => ['placeholder' => 'Cari Berdasarkan Kelurahan', 'id' => 'search-kelurahan', 'class' => 'form form-control input-lg']
])->label(false);
?>
                                             <?= Html::submitButton('Cari', ['class' => 'btn btn-primary', 'style' => 'display: none']); ?>
                                             <?php yii\bootstrap\ActiveForm::end() ?>
                                    </div>

                                </div>

                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Asal Pengusul
                                        </th>
                                        <th>
                                            Usulan
                                        </th>
                                        <th>
                                            Status Kelurahan
                                        </th>
                                        <th>
                                            Status Kecamatan
                                        </th>
                                        <th>
                                            Status SKPD
                                        </th>

                                    </tr>
                                </thead>
                                <tbody id="body-tabel"></tbody>
                                <?php foreach ($models as $model) : ?>

                                    <?php
                                    if ($model->statusKelurahan == null) {
                                        echo '<tr class="info"><td width="100px">' . ($model->kdKel->Nm_Kel . ' ' . $model->kdLink->Nm_Lingkungan) . '</td>
                                                  <td width="250px"><b>Permasalahan:</b><p>' . ($model->Nm_Permasalahan) . '</p>'
                                        . '<b>Usulan:</b><p>' . Html::a($model->Jenis_Usulan, 
                                                ['dashboard/lihat-usulan-spesifik', 'id' => hash('sha256', $model->Kd_Ta_Forum_Lingkungan)]) . '</p></td>'
                                        . '<td><h5><span class="label label-primary">Menunggu</span></h5></td>'
                                        . '<td> </td>'
                                        . '<td> </td></tr>';
                                    } else if ($model->statusKelurahan->Status_Penerimaan == 3) {
                                        echo '<tr class="danger"><td width="100px">' . ($model->kdKel->Nm_Kel . ' ' . $model->kdLink->Nm_Lingkungan) . '</td>
                                                 <td width="250px"><b>Permasalahan:</b><p>' . ($model->Nm_Permasalahan) . '</p>'
                                        . '<b>Usulan:</b><p>' . Html::a($model->Jenis_Usulan,
                                                ['dashboard/lihat-usulan-spesifik', 'id' => hash('sha256', $model->Kd_Ta_Forum_Lingkungan)]). '</p></td>'
                                        . '<td><h5><span class="label label-danger">Ditolak</span></h5>'
                                        . '<b>Alasan :</b><p>' . $model->statusKelurahan->Keterangan . '</p></td></td>'
                                        . '<td> </td>'
                                        . '<td> </td></tr>';
                                    } else if ($model->statusKelurahan->Status_Penerimaan == 2) {
                                        echo '<tr class="warning"><td width="100px">' . ($model->kdKel->Nm_Kel . ' ' . $model->kdLink->Nm_Lingkungan) . '</td>
                                                  <td width="250px"><b>Permasalahan:</b><p>' . ($model->Nm_Permasalahan) . '</p>'
                                        . '<b>Usulan:</b><p>' . Html::a($model->Jenis_Usulan,
                                                ['dashboard/lihat-usulan-spesifik', 'id' => hash('sha256', $model->Kd_Ta_Forum_Lingkungan)]). '</p></td>'
                                        . '<td><h5><span class="label label-warning">Diterima dengan revisi</span></h5>'
                                        . '<b>Alasan :</b><p>' . $model->statusKelurahan->Keterangan . '</p></td></td>'
                                        . '<td> </td>'
                                        . '<td> </td></tr>';
                                    } else if ($model->statusKelurahan->Status_Penerimaan == 1) {
                                        echo '<tr class="success"><td width="100px">' . ($model->kdKel->Nm_Kel . ' ' . $model->kdLink->Nm_Lingkungan) . '</td>
                                                  <td width="250px"><b>Permasalahan:</b><p>' . ($model->Nm_Permasalahan) . '</p>'
                                        . '<b>Usulan:</b><p>' . Html::a($model->Jenis_Usulan,
                                                ['dashboard/lihat-usulan-spesifik', 'id' => hash('sha256', $model->Kd_Ta_Forum_Lingkungan)]). '</p></td>'
                                        . '<td><h5><span class="label label-success">Diterima</span></h5>'
                                        . '<b>Alasan :</b><p>' . $model->statusKelurahan->Keterangan . '</p></td></td>'
                                        . '<td> </td>'
                                        . '<td> </td></tr>';
                                    }
                                    ?></td></tr>
<?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>


            <!-- Copyright -->
            <div class="copyright">
                <div class="pull-left">
                    &copy; 2017 <strong>BAPPEDA Kabupaten Asahan</strong>. All rights reserved.
                </div>
            </div>
            <!-- ./Copyright -->
        </div>
        <!-- ./page content container -->

    </div>
</div>
</div>

