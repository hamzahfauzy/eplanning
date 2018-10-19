
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use mdm\admin\components\MenuHelper;

if (!empty(Yii::$app->user->identity->id)) {
    $items = MenuHelper::getAssignedMenu(Yii::$app->user->identity->id);
} else {
    $items = array();
}
$PC_nama_lengkap = Yii::$app->levelcomponent->getProfile();

?>
<aside class="main-sidebar">

    <section class="sidebar">






        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
              <?= yii\helpers\Html::img('@web/img/user-icon.png', ['alt' => 'User Image', 'class' => 'img-circle']); ?> 
		            </div>
            <div class="pull-left info">
              		<p><?= yii::$app->user->identity->username ?></p>

              <!--  <a href="#"><i class="fa fa-circle text-success"></i> Kode User Kode</a> -->
                		 <p><?= $PC_nama_lengkap['Nm_Lengkap'] ?></p>
            </div>
        </div>




        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/dashboard/index']],
                        ['label' => 'DATA MASTER', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Lokasi',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Benua', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-benua/index'],],
                                ['label' => 'Benua Sub', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-benua-sub/index'],],
                                ['label' => 'Negara', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-country/index'],],
                                ['label' => 'Provinsi', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-provinsi/index'],],
                                ['label' => 'Kabupaten/Kota', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-kabupaten/index'],],
                                ['label' => 'Kecamatan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-kecamatan/index'],],
                                ['label' => 'Kelurahan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-kelurahan/index'],],
                                ['label' => 'Lingkungan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-lingkungan/index'],],
                                ['label' => 'Jalan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jalan/index'],],
                            ],
                        ],


                        [
                            'label' => 'SOTK',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Urusan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-urusan/index'],],
                                ['label' => 'Bidang', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-bidang/index'],],
                                ['label' => 'Fungsi', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-fungsi/index'],],

                                ['label' => 'Unit', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-unit/index'],],
                                ['label' => 'Sub Unit', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-sub-unit/index'],],

                                 // ['label' => 'Program', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-program/index'],],
                                 // ['label' => 'Kegiatan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-kegiatan/index'],],

                            ],
                        ], 
                        // [
                        //     'label' => 'RKPD & RPJMD',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'Ref Analisa', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-analisa/index'],],
                        //         ['label' => 'Ref Analisa Sub', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub/index'],],
                        //         ['label' => 'Ref Analisa Sub A', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub-a/index'],],
                        //     ],
                        // ],
                        // [
                        //     'label' => 'SKPD',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'SKPD', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-unit/index'],],
                        //         ['label' => 'Sub Unit & Visi', 'icon' => 'fa fa-file-code-o', 'url' => ['/ta-sub-unit/index'],],
                        //         ['label' => 'Misi', 'icon' => 'fa fa-dashboard', 'url' => ['/ta-misi/index'],],
                        //        ['label' => 'Tugas Pokok', 'icon' => 'fa fa-dashboard', 'url' => ['/ta-tupok/index'],],
                        //        ['label' => 'Tujuan', 'icon' => 'fa fa-dashboard', 'url' => ['/ta-tujuan/index'],],
                        //        ['label' => 'Sasaran', 'icon' => 'fa fa-dashboard', 'url' => ['/ta-sasaran/index'],],
                        //     ],
                        // ],
                        [
                            'label' => 'Pokir',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                               ['label' => 'Daerah Pemilihan', 'icon' => 'fa fa-file', 'url' => ['/ta-dapil/index'],],
                               ['label' => 'Ref Daerah Pemilihan', 'icon' => 'fa fa-file-o', 'url' => ['/ref-dapil/index'],],
                               ['label' => 'Ref Dewan', 'icon' => 'fa fa-file-o', 'url' => ['/ref-dewan/index'],],
                               ['label' => 'Ref Fraksi', 'icon' => 'fa fa-file-o', 'url' => ['/ref-fraksi-dprd/index'],],
                               ['label' => 'Ref Komisi', 'icon' => 'fa fa-file-o', 'url' => ['/ref-komisi-dprd/index'],],
                            ],
                        ],
                        
                        /**
                        [
                            'label' => 'Referensi ASB',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Ref Analisa', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-analisa/index'],],
                                ['label' => 'Ref Analisa Sub', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub/index'],],
                                ['label' => 'Ref Analisa Sub A', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub-a/index'],],
                            ],
                        ],
                         * 
                         */
                        // [
                        //     'label' => 'Jenjang Kepangkatan',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'Eselon', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-eselon/index'],],
                        //         ['label' => 'Jabatan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jabatan/index'],],
                        //         ['label' => 'Jabatan Struktural', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jabatan-struktural/index'],],
                        //         ['label' => 'Golongan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-golongan/index'],],
                        //         ['label' => 'Golongan Ruang', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-golongan-ruang/index'],],
                        //         ['label' => 'Pangkat', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-pangkat/index'],],
                        //     //      ['label' => 'Pangkat', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                        //     ],
                        // ],
                        // ['label' => 'Struktur Organisasi', 'icon' => 'fa fa-file-code-o', 'url' => ['/site/struktur-organisasi']],


                        [
                            'label' => 'Rekening',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Rekening 1', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-rek1/index'],],
                                ['label' => 'Rekening 2', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-rek2/index'],],
                                ['label' => 'Rekening 3', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-rek3/index'],],
                                ['label' => 'Rekening 4', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-rek4/index'],],
                                ['label' => 'Rekening 5', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-rek5/index'],],
                            ],
                        ],
                        // ['label' => 'Peraturan', 'icon' => 'fa fa-dashboard', 'url' => ['/site/peraturan']],

                        // ['label' => 'TRANSAKSI', 'options' => ['class' => 'header']],
                        // [
                        //     'label' => 'Honor',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'Honor', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-honor/index'],],
                        //         ['label' => 'Honor Sub', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub/index'],],
                        //         ['label' => 'Honor Sub A', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub-a/index'],],
                        //         ['label' => 'Honor Sub A Detail', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub-a-detail/index'],],
                        //         ['label' => 'Jabatan Honor', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                        //         ['label' => 'Honor Sub Jabatan', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                        //         ['label' => 'Standart Honor', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                        //     ],
                        // ],
                        // [
                        //     'label' => 'SSH, HSPK, ASB',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'SSH', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-satuan/index'],],
                        //         ['label' => 'HSPK', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-harga1/index'],],
                        //         ['label' => 'ASB', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-harga2/index'],],
                        //     ],
                        // ],

                        //  ['label' => 'Kalender Pelaksanaan', 'options' => ['class' => 'header']],
                        // [
                        //     'label' => 'Musrenbang',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'Rembuk Warga', 'icon' => 'fa fa-clock-o', 'url' => ['/ta-agenda-pelaksanaan-lingkungan/index'],],
                        //         ['label' => 'Musrenbang Kelurahan', 'icon' => 'fa fa-clock-o', 'url' => ['/ta-agenda-pelaksanaan-kelurahan/index'],],
                        //         ['label' => 'Musrenbang Kecamatan', 'icon' => 'fa fa-clock-o', 'url' => ['#'],],
                        //     ],
                        // ],

                        ['label' => 'Skoring', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Skoring',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Kriteria Kecamatan', 'icon' => 'fa fa-clock-o', 'url' => ['/ref-kecamatan-kriteria-pembobotan/index'],],
                                ['label' => 'Kriteria OPD', 'icon' => 'fa fa-clock-o', 'url' => ['/ref-forum-kriteria-pembobotan/index'],],
                            ],
                        ],

                        ['label' => 'Peraturan', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Tahapan & Peraturan',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Tahapan', 'icon' => 'fa fa-clock-o', 'url' => ['/ref-tahapan/index'],],
                                ['label' => 'Peraturan', 'icon' => 'fa fa-clock-o', 'url' => ['/ref-peraturan/index'],],
                                
                            ],
                        ],


                        // ['label' => 'Setting', 'options' => ['class' => 'header']],
                        // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        // [
                        //     'label' => 'Same tools',
                        //     'icon' => 'fa fa-share',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['#'],],
                        //         ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                        //         [
                        //             'label' => 'Level One',
                        //             'icon' => 'fa fa-circle-o',
                        //             'url' => '#',
                        //             'items' => [
                        //                 ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                        //                 [
                        //                     'label' => 'Level Two',
                        //                     'icon' => 'fa fa-circle-o',
                        //                     'url' => '#',
                        //                     'items' => [
                        //                         ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                        //                         ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                        //                     ],
                        //                 ],
                        //             ],
                        //         ],
                        //     ],
                        // ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
