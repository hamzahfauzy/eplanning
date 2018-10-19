<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;


?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?= yii\helpers\Html::img('@app/img/user-icon.png', ['alt' => 'User Image', 'class' => 'img-circle']); ?>
            </div>
            <div class="pull-left info">
                <p>User Identity </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Kode User</a>
                <p>User Identity </p>
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
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/user/dashboard']],
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
                        ],
                    ],
                    [
                        'label' => 'Transportasi',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Transportasi', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-transportasi/index'],],
                            ['label' => 'Transportasi Kelas', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-transportasi-kelas/index'],],
                            ['label' => 'Jarak', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jarak/index'],],
                         //   ['label' => 'Biaya', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                        ],
                    ],
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
                    [
                        'label' => 'Jenjang Kepangkatan',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Eselon', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-eselon/index'],],
                            ['label' => 'Jabatan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jabatan/index'],],
                            ['label' => 'Jabatan Struktural', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jabatan-struktural/index'],],
                            ['label' => 'Golongan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-golongan/index'],],
                            ['label' => 'Golongan Ruang', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-golongan-ruang/index'],],
                            ['label' => 'Pangkat', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-pangkat/index'],],
                      //      ['label' => 'Pangkat', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                    ['label' => 'Struktur Organisasi', 'icon' => 'fa fa-file-code-o', 'url' => ['/site/struktur-organisasi']],
                    ['label' => 'Peraturan', 'icon' => 'fa fa-dashboard', 'url' => ['/site/peraturan']],
                    
                    ['label' => 'TRANSAKSI', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Honor',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Honor', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-honor/index'],],
                            ['label' => 'Honor Sub', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub/index'],],
                            ['label' => 'Honor Sub A', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub-a/index'],],
                            ['label' => 'Honor Sub A Detail', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-honor-sub-a-detail/index'],],
                            ['label' => 'Jabatan Honor', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                            ['label' => 'Honor Sub Jabatan', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                            ['label' => 'Standart Honor', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                        ],
                    ],
                    [
                        'label' => 'SSH',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Standard Satuan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-satuan/index'],],
                            ['label' => 'Standard Harga 1', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-harga1/index'],],
                            ['label' => 'Standard Harga 2', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-harga2/index'],],
                            ['label' => 'Standard Harga 3', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-standard-harga3/index'],],
                        ],
                    ],
                    ['label' => 'Setting', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['#'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
