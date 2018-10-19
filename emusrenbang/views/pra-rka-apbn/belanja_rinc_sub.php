<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Rincian Obyek Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Program OPD', 'url' => ['program']];
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 
                                  'url' => ['pra-rka-apbn/kegiatan', 
                                              'Tahun'=>$data->Tahun,
                                              'Kd_Urusan'=>$data->Kd_Urusan,
                                              'Kd_Bidang'=>$data->Kd_Bidang,
                                              'Kd_Unit'=>$data->Kd_Unit,
                                              'Kd_Sub'=>$data->Kd_Sub,
                                              'Kd_Prog'=>$data->Kd_Prog,
                                            ]
                                  ];
$this->params['breadcrumbs'][] = ['label' => 'Rincian Kegiatan', 
                                  'url' => ['pra-rka-apbn/belanja', 
                                              'Tahun'=>$data->Tahun,
                                              'Kd_Urusan'=>$data->Kd_Urusan,
                                              'Kd_Bidang'=>$data->Kd_Bidang,
                                              'Kd_Unit'=>$data->Kd_Unit,
                                              'Kd_Sub'=>$data->Kd_Sub,
                                              'Kd_Prog'=>$data->Kd_Prog,
                                              'Kd_Keg'=>$data->Kd_Keg,
                                            ]
                                  ];
$this->params['breadcrumbs'][] = ['label' => 'Rincian Sub Kegiatan', 
                                  'url' => ['pra-rka-apbn/belanja-rinc', 
                                              'Tahun'=>$data->Tahun,
                                              'Kd_Urusan'=>$data->Kd_Urusan,
                                              'Kd_Bidang'=>$data->Kd_Bidang,
                                              'Kd_Unit'=>$data->Kd_Unit,
                                              'Kd_Sub'=>$data->Kd_Sub,
                                              'Kd_Prog'=>$data->Kd_Prog,
                                              'Kd_Keg'=>$data->Kd_Keg,
                                              'Kd_Rek_1'=>$data->Kd_Rek_1,
                                              'Kd_Rek_2'=>$data->Kd_Rek_2,
                                              'Kd_Rek_3'=>$data->Kd_Rek_3,
                                              'Kd_Rek_4'=>$data->Kd_Rek_4,
                                              'Kd_Rek_5'=>$data->Kd_Rek_5,
                                            ]
                                  ];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/pra_rka.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/plugins/select2/select2.css'
);

$this->registerCssFile(
        '@web/plugins/select2/select2-bootstrap.css'
);

$this->registerJsFile(
        '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="ref-kegiatan-index"> 
    <div class="box box-success">
        <div class="box-body">
          <div class="col-md-7">
            <table id="" class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td class="col-md-2">Urusan</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td ><?= $data->Kd_Urusan; ?></td>
                        <td><?= $data->urusan->Nm_Urusan; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Bidang</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang; ?></td>
                        <td><?= $data->bidang->Nm_Bidang; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Unit</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td> <?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit; ?></td>
                        <td><?= $data->unit->Nm_Unit; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Sub Unit</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub; ?></td>
                        <td><?= $data->sub->Nm_Sub_Unit; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Program</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub . "." . $data->Kd_Prog; ?></td>
                        <td><?= $data->program->Ket_Program; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Kegiatan</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub . "." . $data->Kd_Prog . "." . $data->Kd_Keg; ?></td>
                        <td><?= $data->kegiatan->Ket_Kegiatan; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Rekening</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Rek_1.".".$data->Kd_Rek_2.".".$data->Kd_Rek_3.".".$data->Kd_Rek_4.".".$data->Kd_Rek_5 ?></td>
                        <td><?= $data->kdRek5->Nm_Rek_5; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Sub Kegiatan</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Rek_1.".".$data->Kd_Rek_2.".".$data->Kd_Rek_3.".".$data->Kd_Rek_4.".".$data->Kd_Rek_5.".".$data->No_Rinc ?></td>
                        <td><?= $data->Keterangan; ?></td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="col-md-5">
          </div>
          <div class="col-md-12">
            <div class="clearfix"></div>
            <hr/>
             <?php
            if (Helper::checkRoute('pra-rka-apbn/tambah-rincian-obyek')) : ?>
            <button type="button" class="btn btn-success pull-right" id="btn_tambah_rincian_obyek" 
                value="<?= Url::to(['pra-rka-apbn/tambah-rincian-obyek',
                        'Tahun' => $data->Tahun,
                        'Kd_Urusan' => $data->Kd_Urusan,
                        'Kd_Bidang' => $data->Kd_Bidang,
                        'Kd_Unit' => $data->Kd_Unit,
                        'Kd_Sub' => $data->Kd_Sub,
                        'Kd_Prog' => $data->Kd_Prog,
                        'Kd_Keg' => $data->Kd_Keg,
                        'Kd_Rek_1' => $data->Kd_Rek_1,
                        'Kd_Rek_2' => $data->Kd_Rek_2,
                        'Kd_Rek_3' => $data->Kd_Rek_3,
                        'Kd_Rek_4' => $data->Kd_Rek_4,
                        'Kd_Rek_5' => $data->Kd_Rek_5,
                        'No_Rinc' => $data->No_Rinc,
                        ]) ?>"
                <?php
                  // if($sisa_skpd<=0){
                  //   echo ' disabled="disabled" ';
                  //   echo ' title="Pagu Tidak Mecukupi" ';
                  // }
                ?>
                >
                Tambah Rincian Obyek
            </button>
          <?php endif; ?>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No Rekening</th>
                  <th>Nama Rincian Sub Kegiatan</th>
                  <th>Sat1</th>
                  <th>Sat2</th>
                  <th>Sat3</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $total_obyek = 0;
                    foreach ($data_belanja as $key => $value):
                    $url = ['pra-rka-apbn/belanja-rinc-sub', 
                              'Tahun' => $value['Tahun'],
                              'Kd_Urusan' => $value['Kd_Urusan'],
                              'Kd_Bidang' => $value['Kd_Bidang'],
                              'Kd_Unit' => $value['Kd_Unit'],
                              'Kd_Sub' => $value['Kd_Sub'],
                              'Kd_Prog' => $value['Kd_Prog'],
                              'Kd_Keg' => $value['Kd_Keg'],
                              'Kd_Rek_1' => $value['Kd_Rek_1'],
                              'Kd_Rek_2' => $value['Kd_Rek_2'],
                              'Kd_Rek_3' => $value['Kd_Rek_3'],
                              'Kd_Rek_4' => $value['Kd_Rek_4'],
                              'Kd_Rek_5' => $value['Kd_Rek_5'],
                              'No_Rinc' => $value['No_Rinc'],
                              'No_ID' => $value['No_ID'],
                            ];
                        $total_obyek += $value->Total;
                    ?>
                        <tr>
                            <td><?= $value->Kd_Rek_1.".".$value->Kd_Rek_2.".".$value->Kd_Rek_3.".".$value->Kd_Rek_4.".".$value->Kd_Rek_5.".".$value->No_Rinc.".".$value->No_ID ?></td>
                            <td>
                              <?= $value->Keterangan ?>
                            </td>
                            <td><?= $value->Nilai_1." ".$value->Sat_1 ?></td>
                            <td><?= $value->Nilai_2." ".$value->Sat_2 ?></td>
                            <td><?= $value->Nilai_3." ".$value->Sat_3 ?></td>
                            <td align="right">
                              <?= number_format($value->Total,0,',','.') ?>
                            </td>
                            <td>
                             <?php
                            if (Helper::checkRoute('pra-rka-apbn/hapus-rincian-obyek')) : ?>
                              <a href="#" title="Hapus" class="hapus_obyek" data-tujuan="<?= Url::to(['pra-rka-apbn/hapus-rincian-obyek',
                                                                  'Tahun' => $value->Tahun,
                                                                  'Kd_Urusan' => $value->Kd_Urusan,
                                                                  'Kd_Bidang' => $value->Kd_Bidang,
                                                                  'Kd_Unit' => $value->Kd_Unit,
                                                                  'Kd_Sub' => $value->Kd_Sub,
                                                                  'Kd_Prog' => $value->Kd_Prog,
                                                                  'Kd_Keg' => $value->Kd_Keg,
                                                                  'Kd_Rek_1' => $value->Kd_Rek_1,
                                                                  'Kd_Rek_2' => $value->Kd_Rek_2,
                                                                  'Kd_Rek_3' => $value->Kd_Rek_3,
                                                                  'Kd_Rek_4' => $value->Kd_Rek_4,
                                                                  'Kd_Rek_5' => $value->Kd_Rek_5,
                                                                  'No_Rinc' => $value->No_Rinc,
                                                                  'No_ID' => $value->No_ID,
                                                                  ]) ?>">
                                                                  <i class="fa fa-trash"></i>
                              </a>
                              <?php endif;?>
                               <?php if (Helper::checkRoute('pra-rka-apbn/ubah-rincian-obyek')) : ?>
                              <a href="#" title="Ubah" class="ubah_obyek" value="<?= Url::to(['pra-rka-apbn/ubah-rincian-obyek',
                                                                  'Tahun' => $value->Tahun,
                                                                  'Kd_Urusan' => $value->Kd_Urusan,
                                                                  'Kd_Bidang' => $value->Kd_Bidang,
                                                                  'Kd_Unit' => $value->Kd_Unit,
                                                                  'Kd_Sub' => $value->Kd_Sub,
                                                                  'Kd_Prog' => $value->Kd_Prog,
                                                                  'Kd_Keg' => $value->Kd_Keg,
                                                                  'Kd_Rek_1' => $value->Kd_Rek_1,
                                                                  'Kd_Rek_2' => $value->Kd_Rek_2,
                                                                  'Kd_Rek_3' => $value->Kd_Rek_3,
                                                                  'Kd_Rek_4' => $value->Kd_Rek_4,
                                                                  'Kd_Rek_5' => $value->Kd_Rek_5,
                                                                  'No_Rinc' => $value->No_Rinc,
                                                                  'No_ID' => $value->No_ID,
                                                                  ]) ?>">
                                                                  <i class="fa fa-pencil"></i>
                              </a>
                            <?php endif; ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                ?>
                <tr>
                    <td></td>
                    <td colspan="4"><b>Total</b></td>
                    <td align="right"><b><?= number_format($total_obyek,0,',','.') ?></b></td>
                    <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>



<!-- Ditambah Oleh Ripin -->
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
    @media screen and (min-width: 1000px) {
        .modal-dialog {
          width: 950px; /* New width for default modal */
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

<?php
Modal::begin([
    'header' => '<h4>Tambah Rincian Obyek</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"tambahRincianObyekSave"]),
    "id"=>"tambahRincianObyekModal",
]);
echo "<div id='tambahRincianObyekContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Pilih SSH</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]),
    "id"=>"pilihSshModal"
]);
echo "<div id='pilihSshContent' class='isi-modal'></div>";
Modal::end();
?>


<?php
Modal::begin([
    'header' => '<h4>Pilih ASB</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]),
    "id"=>"pilihAsbModal"
]);
echo "<div id='pilihAsbContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Hapus Obyek</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Hapus',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"hapusObyekSave"]),
    "id"=>"hapusObyekModel",
]);
echo "<div id='hapusObyekContent' class='isi-modal'>Anda Yakin Ingin Menghapus Rincian Objek Kegiatan ?</div>";
Modal::end();
?>
