<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'Rincian Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Program OPD', 'url' => ['program']];
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 
                                  'url' => ['pra-rka-prov/kegiatan', 
                                              'Tahun'=>$data->Tahun,
                                              'Kd_Urusan'=>$data->Kd_Urusan,
                                              'Kd_Bidang'=>$data->Kd_Bidang,
                                              'Kd_Unit'=>$data->Kd_Unit,
                                              'Kd_Sub'=>$data->Kd_Sub,
                                              'Kd_Prog'=>$data->Kd_Prog,
                                            ]
                                  ];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/pra_rka.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="ref-kegiatan-index"> 
    <div class="box box-success">
        <div class="box-body">
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
                        <td><?= $data->Ket_Kegiatan; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>
            <hr/>
            <?php
            if (Helper::checkRoute('pra-rka-prov/tambah-rincian')) : ?>
            <button type="button" class="btn btn-success pull-right" id="btn_tambah_rincian" 
                value="<?= Url::to(['pra-rka-prov/tambah-rincian',
                        'Tahun' => $data->Tahun,
                        'Kd_Urusan' => $data->Kd_Urusan,
                        'Kd_Bidang' => $data->Kd_Bidang,
                        'Kd_Unit' => $data->Kd_Unit,
                        'Kd_Sub' => $data->Kd_Sub,
                        'Kd_Prog' => $data->Kd_Prog,
                        'Kd_Keg' => $data->Kd_Keg,
                        ]) ?>">
                Tambah Rincian
            </button>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No Rekening</th>
                  <th>Nama Rincian</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($data_belanja as $key => $value):
                    $url = ['pra-rka-prov/belanja-rinc', 
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
                            ];
                    ?>
                      <tr>
                        <td><?= $value->Kd_Rek_1.".".$value->Kd_Rek_2.".".$value->Kd_Rek_3.".".$value->Kd_Rek_4.".".$value->Kd_Rek_5 ?></td>
                        <td>
                          <?= 
                            Html::a( 
                                $value->kdRek5->Nm_Rek_5, 
                                $url, 
                                $options = ['class' => 'btn btn-success'] 
                            )
                          ?>
                        </td>
                        <td>

                        <?php
                        if (Helper::checkRoute('pra-rka-prov/hapus-rincian')&&($xJum<=0)) : ?>
						
                          <a href="#" title="Hapus" class="hapus_rincian" data-tujuan="<?= Url::to(['pra-rka-prov/hapus-rincian',
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
                                                                  'Kd_Rek_5' => $value->Kd_Rek_5
                                                                  ]) ?>">
                                                                  <i class="fa fa-trash"></i>
                          </a>
                          <?php endif; ?>

                          <?php if (Helper::checkRoute('pra-rka-prov/ubah-rincian')) : ?>

                          <a href="#" title="ubah" class="ubah_rincian" value="<?= Url::to(['pra-rka-prov/ubah-rincian',
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
                                                                  'Kd_Rek_5' => $value->Kd_Rek_5
                                                                  ]) ?>">
                                                                  <i class="fa fa-pencil"></i>
                          </a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php
                    endforeach;
                ?>
              </tbody>
            </table>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'header' => '<h4>Tambah Rincian</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"tambahRincianSave"]),
    "id"=>"tambahRincianModal",
]);
echo "<div id='tambahRincianContent' class='isi-modal'></div>";
Modal::end();
?>
<?php
Modal::begin([
    'header' => '<h4>Hapus Rincian</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Hapus',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"hapusRincianSave"]),
    "id"=>"hapusRincianModel",
]);
echo "<div id='hapusRincianContent' class='isi-modal'>Anda Yakin Ingin Menghapus Rincian Kegiatan ?</div>";
Modal::end();
?>