    <?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use emusrenbang\models\Referensi;
    use common\components\Helper;
    use yii\bootstrap\Modal;
    use yii\helpers\Url;

    $this->title = 'Kegiatan Perangkat Daerah';
    $this->params['breadcrumbs'][] = ['label' => 'Program Perangkat Daerah', 'url' => ['program']];
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
                            <td><?= $data->refUnit->Nm_Unit; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-2">Sub Unit</td>
                            <td class="col-md-0 padding-edge">:</td>
                            <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub; ?></td>
                            <td><?= $data->refSubUnit->Nm_Sub_Unit; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-2">Program</td>
                            <td class="col-md-0 padding-edge">:</td>
                            <td><?= $data->Kd_Urusan . "." . $data->Kd_Bidang . "." . $data->Kd_Unit . "." . $data->Kd_Sub . "." . $data->Kd_Prog; ?></td>
                            <td><?= @$data->refProgram->Ket_Program; ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="clearfix"></div>
                <hr/>
                <?php
                if (Helper::checkRoute('pra-rka/tambah-kegiatan')) : ?>
            
                <button type="button" class="btn btn-success pull-right" id="btn_tambah_kegiatan" 
                    value="<?= Url::to(['pra-rka/tambah-kegiatan',
                            'Tahun' => $data->Tahun,
                            'Kd_Urusan' => $data->Kd_Urusan,
                            'Kd_Bidang' => $data->Kd_Bidang,
                            'Kd_Unit' => $data->Kd_Unit,
                            'Kd_Sub' => $data->Kd_Sub,
                            'Kd_Prog' => $data->Kd_Prog]) ?>" >
                    Tambah Kegiatan 
                </button>
                
                <?php endif; ?>

                <div class="clearfix"></div>

                <table class="table table-hover">
				<?php
				if($status){
				?>
				
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
                        // [
                        //     'format' => 'raw',
                        //     'label' => 'Status',
                        //     'value' => function($model) {
                        //         $btn = '';
                        //         $btn .= "<button class='btn btn-block btn-flat btn-danger'>";
                        //         $btn .= "tolak";
                        //         $btn .= "</button>";

                        //         return $btn;
                        //     }
                        // ],
                        [
                            'attribute' => 'Ket_Kegiatan',
                            'filterInputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'Cari Nama Kegiatan'
                            ],
                            'format' => 'raw',
                            'label' => 'Keterangan Kegiatan',
                            'value' => function($model) {
								
                                 $url = ['pra-rka/belanja', 
                                    'Tahun' => $model['Tahun'],
                                    'Kd_Urusan' => $model['Kd_Urusan'],
                                    'Kd_Bidang' => $model['Kd_Bidang'],
                                    'Kd_Unit' => $model['Kd_Unit'],
                                    'Kd_Sub' => $model['Kd_Sub'],
                                    'Kd_Prog' => $model['Kd_Prog'],
                                    'Kd_Keg' => $model['Kd_Keg'],
                                ];

                                $btn = Html::a( 
                                    $model->Kd_Urusan . "." . $model->Kd_Bidang . "." . $model->Kd_Unit . "." . $model->Kd_Sub . "." . $model->Kd_Prog . "." . $model->Kd_Keg ." : ". $model->Ket_Kegiatan, 
                                    $url, 
                                    $options = ['class' => 'btn btn-success'] 
                                );

 
                                return $btn;
                            },
                            'footer' => 'TOTAL'
                        ],
                        [
                            'contentOptions' => ['class' => 'text-right'],
                            'footerOptions' => ['class' => 'text-right'],
                            'label' => 'Pagu Terpakai',
                            'value' => function($model) {
                                $pagu_pakai = $model->getBelanjaRincSubs()->sum('Total');
                                return number_format($pagu_pakai,0,'.','.');
                            },
                            'footer' => number_format($jlh_pagu_terpakai,0,'.','.'),
                        ],
                        [
                            'contentOptions' => ['class' => 'text-right'],
                            'label' => 'Pagu Kegiatan N+1',
                            'value' => function($model) {
                                return number_format($model->Pagu_Anggaran_Nt1,0,'.','.');
                            }
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Aksi',
                            'value' => function($model) {
                                $url = Url::to(['pra-rka/hapus-kegiatan',
                                              'Tahun' => $model->Tahun,
                                              'Kd_Urusan' => $model->Kd_Urusan,
                                              'Kd_Bidang' => $model->Kd_Bidang,
                                              'Kd_Unit' => $model->Kd_Unit,
                                              'Kd_Sub' => $model->Kd_Sub,
                                              'Kd_Prog' => $model->Kd_Prog,
                                              'Kd_Keg' => $model->Kd_Keg
                                        ]);

                                $url2 = Url::to(['pra-rka/ubah-kegiatan',
                                              'Tahun' => $model->Tahun,
                                              'Kd_Urusan' => $model->Kd_Urusan,
                                              'Kd_Bidang' => $model->Kd_Bidang,
                                              'Kd_Unit' => $model->Kd_Unit,
                                              'Kd_Sub' => $model->Kd_Sub,
                                              'Kd_Prog' => $model->Kd_Prog,
                                              'Kd_Keg' => $model->Kd_Keg
                                        ]);

		if ($model->getTaBelanjas()->count()<=0)
								{
                                $btn1 = '<a href="#" title="Hapus" class="hapus_kegiatan" data-tujuan="'.$url.'"><i class="fa fa-trash"></i></a>';
								}else{
									$btn1 = '';
								}
                                
                                $btn2 = '<a href="#" title="Ubah" class="ubah_kegiatan" value="'.$url2.'"><i class="fa fa-pencil"></i></a>';

                                if (Helper::checkRoute('pra-rka/ubah-kegiatan')) : 
                                $btn = $btn1." ".$btn2;
                                return $btn;

                                endif;


                                // $btn = $btn1." ".$btn2;
                                // return $btn;

                            }
                        ],
                        // [
                        //     'class' => 'yii\grid\ActionColumn',
                        //     'buttons' => [
                        //         'belanja' => function ($url, $model) {
                        //             return Html::a('<span class="fa fa-bar-chart"></span>', $url, [
                        //                         'title' => Yii::t('app', 'belanja'),
                        //             ]);
                        //         },
                        //         'urlCreator' => function ($action, $model, $key, $index) {
                        //             if ($action === 'belanja') {
                        //                 $url ='index.php?r=client-login/lead-view&id='.$model->id;
                        //                 return $url;
                        //             }
                        //         }
                        //     ],
                        //     'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        // ]
                    ],
                ]);
                ?>
				<?php }else{ ?>
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
                        // [
                        //     'format' => 'raw',
                        //     'label' => 'Status',
                        //     'value' => function($model) {
                        //         $btn = '';
                        //         $btn .= "<button class='btn btn-block btn-flat btn-danger'>";
                        //         $btn .= "tolak";
                        //         $btn .= "</button>";

                        //         return $btn;
                        //     }
                        // ],
                        [
                            'attribute' => 'Ket_Kegiatan',
                            'filterInputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'Cari Nama Kegiatan'
                            ],
                            'format' => 'raw',
                            'label' => 'Keterangan Kegiatan',
                            'value' => function($model) {
								
                                 $url = ['pra-rka/kegiatan', 
									'Tahun' => $model['Tahun'],
									'Kd_Urusan' => $model['Kd_Urusan'],
									'Kd_Bidang' => $model['Kd_Bidang'],
									'Kd_Unit' => $model['Kd_Unit'],
									'Kd_Sub' => $model['Kd_Sub'],
									'Kd_Prog' => $model['Kd_Prog'],
								];

                                $btn = Html::a( 
                                    $model->Kd_Urusan . "." . $model->Kd_Bidang . "." . $model->Kd_Unit . "." . $model->Kd_Sub . "." . $model->Kd_Prog . "." . $model->Kd_Keg ." : ". $model->Ket_Kegiatan, 
                                    $url, 
                                    $options = ['class' => 'btn btn-success'] 
                                );

 
                                return $btn;
                            },
                            'footer' => 'TOTAL'
                        ],
                        [
                            'contentOptions' => ['class' => 'text-right'],
                            'footerOptions' => ['class' => 'text-right'],
                            'label' => 'Pagu Terpakai',
                            'value' => function($model) {
                                $pagu_pakai = $model->getBelanjaRincSubs()->sum('Total');
                                return number_format($pagu_pakai,0,'.','.');
                            },
                            'footer' => number_format($jlh_pagu_terpakai,0,'.','.'),
                        ],
						[
                            'contentOptions' => ['class' => 'text-right'],
                            'label' => 'Pagu Kegiatan',
                            'value' => function($model) {
                                return number_format($model->Pagu_Anggaran,0,'.','.');
                            }
                        ],
                        [
                            'contentOptions' => ['class' => 'text-right'],
                            'label' => 'Pagu Kegiatan N+1',
                            'value' => function($model) {
                                return number_format($model->Pagu_Anggaran_Nt1,0,'.','.');
                            }
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Aksi',
                            'value' => function($model) {
                                $url = Url::to(['pra-rka/hapus-kegiatan',
                                              'Tahun' => $model->Tahun,
                                              'Kd_Urusan' => $model->Kd_Urusan,
                                              'Kd_Bidang' => $model->Kd_Bidang,
                                              'Kd_Unit' => $model->Kd_Unit,
                                              'Kd_Sub' => $model->Kd_Sub,
                                              'Kd_Prog' => $model->Kd_Prog,
                                              'Kd_Keg' => $model->Kd_Keg
                                        ]);

                                $url2 = Url::to(['pra-rka/ubah-kegiatan',
                                              'Tahun' => $model->Tahun,
                                              'Kd_Urusan' => $model->Kd_Urusan,
                                              'Kd_Bidang' => $model->Kd_Bidang,
                                              'Kd_Unit' => $model->Kd_Unit,
                                              'Kd_Sub' => $model->Kd_Sub,
                                              'Kd_Prog' => $model->Kd_Prog,
                                              'Kd_Keg' => $model->Kd_Keg
                                        ]);

								if ($model->getTaBelanjas()->count()<=0)
								{
                                $btn1 = '<a href="#" title="Hapus" class="hapus_kegiatan" data-tujuan="'.$url.'"><i class="fa fa-trash"></i></a>';
								}else{
									$btn1 = '';
								}
                                
                                $btn2 = '<a href="#" title="Ubah" class="ubah_kegiatan" value="'.$url2.'"><i class="fa fa-pencil"></i></a>';

                                if (Helper::checkRoute('pra-rka/ubah-kegiatan')) : 
                                $btn = $btn1." ".$btn2;
                                return $btn;

                                endif;


                                // $btn = $btn1." ".$btn2;
                                // return $btn;

                            }
                        ],
                        // [
                        //     'class' => 'yii\grid\ActionColumn',
                        //     'buttons' => [
                        //         'belanja' => function ($url, $model) {
                        //             return Html::a('<span class="fa fa-bar-chart"></span>', $url, [
                        //                         'title' => Yii::t('app', 'belanja'),
                        //             ]);
                        //         },
                        //         'urlCreator' => function ($action, $model, $key, $index) {
                        //             if ($action === 'belanja') {
                        //                 $url ='index.php?r=client-login/lead-view&id='.$model->id;
                        //                 return $url;
                        //             }
                        //         }
                        //     ],
                        //     'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        // ]
                    ],
                ]);
				}
                ?>
                </table>
            </div>
        </div>
    </div>

<?php
Modal::begin([
    'header' => '<h4>Tambah Kegiatan</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"tambahKegiatanSave"]),
    "id"=>"tambahKegiatanModal",
]);
echo "<div id='tambahKegiatanContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Tambah Kamus Kegiatan</h4>',
    //"size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"tambahKamusSave"]),
    "id"=>"tambahKamusModal",
]);
echo "<div id='tambahKamusContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Edit Kegiatan</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Edit',['class'=>'btn btn-success btn-save','type'=>"button", 'id'=>"editKegiatanSave"]),
    "id"=>"editKegiatanModal",
]);
echo "<div id='editKegiatanContent' class='isi-modal'></div>";
Modal::end();
?>

<?php
    Modal::begin([
        'header' => '<h4>Hapus Kegiatan</h4>',
        //"size"=>"modal-lg",
        'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Hapus',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"hapusKegiatanSave"]),
        "id"=>"hapusKegiatanModel",
    ]);
    echo "<div id='hapusKegiatanContent' class='isi-modal'>Anda Yakin Ingin Menghapus Kegiatan ?</div>";
    Modal::end();
?>