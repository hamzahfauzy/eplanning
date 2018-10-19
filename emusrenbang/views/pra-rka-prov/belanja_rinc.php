<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Rincian Sub Kegiatan';
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
$this->params['breadcrumbs'][] = ['label' => 'Rincian Kegiatan', 
                                  'url' => ['pra-rka-prov/belanja', 
                                              'Tahun'=>$data->Tahun,
                                              'Kd_Urusan'=>$data->Kd_Urusan,
                                              'Kd_Bidang'=>$data->Kd_Bidang,
                                              'Kd_Unit'=>$data->Kd_Unit,
                                              'Kd_Sub'=>$data->Kd_Sub,
                                              'Kd_Prog'=>$data->Kd_Prog,
                                              'Kd_Keg'=>$data->Kd_Keg,
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
                        <td><?= $data->kegiatan->Ket_Kegiatan; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Rekening</td>
                        <td class="col-md-0 padding-edge">:</td>
                        <td><?= $data->Kd_Rek_1.".".$data->Kd_Rek_2.".".$data->Kd_Rek_3.".".$data->Kd_Rek_4.".".$data->Kd_Rek_5 ?></td>
                        <td><?= $data->kdRek5->Nm_Rek_5; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>
            <hr/>
            <button type="button" class="btn btn-success pull-right" id="btn_tambah_rincian_sub" 
                value="<?= Url::to(['pra-rka-prov/tambah-rincian-sub',
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
                        ]) ?>">
                Tambah Rincian Sub Kegiatan
            </button>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No Rekening</th>
                  <th>Nama Rincian Sub Kegiatan</th>
                  <th>Jumlah Obyek Rincian</th>
                  <th>Pagu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($data_belanja as $key => $value):
                    $url = ['pra-rka-prov/belanja-rinc-sub', 
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
                            ];
                    ?>
                      <tr>
                        <td><?= $value->Kd_Rek_1.".".$value->Kd_Rek_2.".".$value->Kd_Rek_3.".".$value->Kd_Rek_4.".".$value->Kd_Rek_5.".".$value->No_Rinc ?></td>
                        <td>
                          <?= 
                            Html::a( 
                                $value->Keterangan, 
                                $url, 
                                $options = ['class' => 'btn btn-success'] 
                            )
                          ?>
                        </td>
                        <td><?= $value->getTaBelanjaRincSubs()->count() ?></td>
                        <td><?= number_format($value->getTaBelanjaRincSubs()->sum('Total'), 0, ',', '.') ?></td>  
                        <td>
						 <?php if (Helper::checkRoute('pra-rka/hapus-rincian-sub') && $value->getTaBelanjaRincSubs()->count()<=0) : ?>
                          <a href="#" title="Hapus" class="hapus_rincian_sub" data-tujuan="<?= Url::to(['pra-rka-prov/hapus-rincian-sub',
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
                                                                  'No_Rinc' => $value->No_Rinc
                                                                  ]) ?>">
                                                                  <i class="fa fa-trash"></i>
                              </a>
							  <?php endif; ?> 
                          <a href="#" title="Ubah" class="ubah_rincian_sub" value="<?= Url::to(['pra-rka-prov/ubah-rincian-sub',
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
                                                                  'No_Rinc' => $value->No_Rinc
                                                                  ]) ?>">
                                                                  <i class="fa fa-pencil"></i>
                              </a>
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
    'header' => '<h4>Tambah Rincian Sub</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"tambahRincianSubSave"]),
    "id"=>"tambahRincianSubModal",
]);
echo "<div id='tambahRincianSubContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Hapus Sub Kegiatan</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Hapus',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"hapusRincianSubSave"]),
    "id"=>"hapusRincianSubModel",
]);
echo "<div id='hapusRincianSubContent' class='isi-modal'>Anda Yakin Ingin Menghapus Rincian Sub Kegiatan ?</div>";
Modal::end();
?>