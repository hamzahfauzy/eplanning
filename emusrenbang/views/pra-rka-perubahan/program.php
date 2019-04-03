<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;

$this->title = 'Program Perangkat Daerah';
$this->params['breadcrumbs'][] = $this->title;
if(isset($data->paguSubUnit->pagu)){
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
                            <?php foreach ($modelUnit as $data) : ?> 
                            <td ><?= $data->Kd_Urusan; ?></td>
                            <td><?= $data->urusan->Nm_Urusan; ?></td>
                            <?php endforeach; ?>

                        </tr>
                        <tr>
                            <td class="col-md-2">Bidang</td>
                            <td class="col-md-0 padding-edge">:</td>
                            <?php foreach ($modelUnit as $data) : ?> 
                            <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang; ?></td>
                            <td><?= $data->kdBidang->Nm_Bidang; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="col-md-2">Unit</td>
                            <td class="col-md-0 padding-edge">:</td>
                            <?php foreach ($modelUnit as $data) : ?>
                            <td> <?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit; ?></td>
                            <td><?= $data->kdUrusan->Nm_Unit; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="col-md-2">Sub Unit</td>
                            <td class="col-md-0 padding-edge">:</td>
                            <?php foreach ($modelUnit as $data) : ?>
                            <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub; ?></td>
                            <td><?= $data->namaSub->Nm_Sub_Unit; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                    <table class="table table-bordered">
                        <tr>
                            <td>Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
                                    $pagu_skpd = $data->paguSubUnit->pagu;
                                    echo number_format($pagu_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pemakaian Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
									
                                    //$pemakaian_skpd = ($data->getBelanjaRincSubs()->sum('Total')) ? $data->getBelanjaRincSubs()->sum('Total') : $pagu_anggaran_kegiatan;
                                    $pemakaian_skpd = ($data->getBelanjaRincSubs()->sum('Total')) ? $data->getBelanjaRincSubs()->sum('Total') : 0; // script lama
								   echo number_format($pemakaian_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sisa Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
                                    $sisa_skpd = $pagu_skpd - $pemakaian_skpd;
                                    echo number_format($sisa_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                    </table>
            </div>
            
            <table class="table table-hover">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter'=>TRUE,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.'
                    ],
                    [
                        'attribute' => 'Ket_Prog',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'Cari Nama Program'
                        ],
                        'format' => 'raw',
                        'label' => 'Keterangan Program',
                        'value' => function($model) {
                           // $btn = "<a class='btn btn-success'>".$model->Kd_Prog." : ".$model->Ket_Prog."</a>";
                            $url = ['pra-rka/kegiatan', 
                                'Tahun' => $model['Tahun'],
                                'Kd_Urusan' => $model['Kd_Urusan'],
                                'Kd_Bidang' => $model['Kd_Bidang'],
                                'Kd_Unit' => $model['Kd_Unit'],
                                'Kd_Sub' => $model['Kd_Sub'],
                                'Kd_Prog' => $model['Kd_Prog'],
                            ];

                            $btn = Html::a( 
                                $model->Kd_Prog." : ".$model->Ket_Prog, 
                                $url, 
                                $options = ['class' => 'btn btn-success'] 
                            );

                            return $btn;
                        },
                        'footer' => 'TOTAL'
                    ],
                    [
                        'contentOptions' => ['class' => 'text-center'],
                        'label' => 'Kegiatan',
                        'value' => function($model) {
                            $jlh_kegiatan = $model->getKegiatans()->count();
                            return $jlh_kegiatan;
                        },
                        'footer' => '',
                    ],
                    [
                        'contentOptions' => ['class' => 'text-right'],
                        'footerOptions' => ['class' => 'text-right'],
                        'label' => 'Pagu Program',
                        'value' => function($model) {
                            $pagu_pakai = $model->getBelanjaRincSubs()->sum('Total');
                            return number_format($pagu_pakai,0,'.','.');
                        },
                        'footer' => number_format($tabelanjanrincsub,0,'.','.'),
                    ],
                    //[
                        // 'class' => 'yii\grid\ActionColumn',
                        // 'buttons' => [
                        //     'kegiatan' => function ($url, $model) {
                        //         return Html::a('<span class="fa fa-bar-chart"></span>', $url, [
                        //                     'title' => Yii::t('app', 'kegiatan'),
                        //         ]);
                        //     },
                        //     'urlCreator' => function ($action, $model, $key, $index) {
                        //         if ($action === 'kegiatan') {
                        //             $url ='index.php?r=client-login/lead-view&id='.$model->id;
                        //             return $url;
                        //         }
                        //     }
                        // ],
                        // 'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                    //]
                ],
            ]);
            ?>
            </table>
        </div>
    </div>
</div>
<?php }else{
     echo "<script>alert('Pagu Belum Ada');location='index.php?r=rancangan/awal';</script>";
} ?>