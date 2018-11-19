<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
?>
<div class="left-navigation">
    <!-- /.search form -->
    <?= Nav::widget(
        [
            'options' => ['class' => 'list-accordion'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '
                        Tanggal :   20-11-2016<br>
                        Waktu Login :   08:11:29<br>
                        IP User :   202.80.212.102
                    '],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Dashboard</span>', 'url' => ['/user/index']],
                  ['label' => '<span class="nav-icon"><i class="fa fa-calculator"></i></span><span class="nav-label">Satuan Standard Harga</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH</span>', 'url' => ['/ref-ssh/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH 1</span>', 'url' => ['/ref-ssh1/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH 2</span>', 'url' => ['/ref-ssh2/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH 3</span>', 'url' => ['/ref-ssh3/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH 4</span>', 'url' => ['/ref-ssh4/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">SSH 5</span>', 'url' => ['/ref-ssh5/index']],
                    ]
                ],

                ['label' => '<span class="nav-icon"><i class="fa fa-calculator"></i></span><span class="nav-label">Analisis Standard Biaya</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">ASB</span>', 'url' => ['/ref-asb/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">ASB 1</span>', 'url' => ['/ref-asb1/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">ASB 2</span>', 'url' => ['/ref-asb2/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">ASB 3</span>', 'url' => ['/ref-asb3/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">ASB 4</span>', 'url' => ['/ref-asb4/index']],
                    ]
                ],

                  ['label' => '<span class="nav-icon"><i class="fa fa-calculator"></i></span><span class="nav-label">Harga Satuan Pokok Kegiatan</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">HSPK</span>', 'url' => ['/ref-hspk/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">HSPK 1</span>', 'url' => ['/ref-hspk1/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">HSPK 2</span>', 'url' => ['/ref-hspk2/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">HSPK 3</span>', 'url' => ['/ref-hspk3/index']],
                    ]
                ],


                ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Harga Satuan Pokok Kegiatan</span>', 'url' => ['/ta-harga-satuan-pokok-kegiatan/index']],
                ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Klasifikasi Usulan</span>', 'url' => ['/ref-klasifikasi-usulan/index']],
                ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Standard Harga</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Standard Satuan</span>', 'url' => ['/ref-standard-satuan/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Standard Harga 1</span>', 'url' => ['/ref-standard-harga1/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Standard Harga 2</span>', 'url' => ['/ref-standard-harga2/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-money"></i></span><span class="nav-label">Standard Harga 3</span>', 'url' => ['/ref-standard-harga3/index']],
                    ]
                ],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset 1</span>', 'url' => ['/ref-rek-aset1/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset 2</span>', 'url' => ['/ref-rek-aset2/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset 3</span>', 'url' => ['/ref-rek-aset3/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset 4</span>', 'url' => ['/ref-rek-aset4/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Rekening Aset 5</span>', 'url' => ['/ref-rek-aset5/index']],
                    ]
                ],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Data Master</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Benua</span>', 'url' => ['/ref-benua/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Benua Sub</span>', 'url' => ['/ref-benua-sub/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Negara</span>', 'url' => ['/ref-country/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Provinsi</span>', 'url' => ['/ref-provinsi/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Kabupaten</span>', 'url' => ['/ref-kabupaten/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Kecamatan</span>', 'url' => ['/ref-kecamatan/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Kelurahan</span>', 'url' => ['/ref-kelurahan/index']],
                    ]
                ],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Transportasi</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Transportasi</span>', 'url' => ['/ref-transportasi/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Transportasi Kelas</span>', 'url' => ['/ref-transportasi-kelas/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Jarak</span>', 'url' => ['/ref-jarak/index']],
                    ]
                ],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Jenjang Kepangkatan</span>', 'url' => ['#'],
                    'items' => [
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Eselon</span>', 'url' => ['/ref-eselon/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Jabatan</span>', 'url' => ['/ref-jabatan/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Jabatan Struktural</span>', 'url' => ['/ref-jabatan-struktural/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Golongan</span>', 'url' => ['/ref-golongan/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Golongan Ruang</span>', 'url' => ['/ref-golongan-ruang/index']],
                        ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Pangkat</span>', 'url' => ['/ref-pangkat/index']],
                    ]
                ],
                ['label' => '<span class="nav-icon"><i class="fa fa-home"></i></span><span class="nav-label">Dashboard</span>', 'url' => ['/user/index']],
            ],
        ]
    ) ?>
</div>