<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;

//$namalengkap = Yii::$app->user->identity->nama_lengkap;

$namalengkap = Yii::$app->user->identity->username;

$ipaddr = Yii::$app->getRequest()->getUserIP();

//print_r(Yii::$app->user->identity->username);

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= yii\helpers\Html::img('@web/img/user-icon.png', ['alt' => 'User Image', 'class' => 'img-circle']); ?>
            </div>
            <div class="pull-left info">
                <p><?= $namalengkap; ?></p>

                <a href="javascript(0);">
                    <i class="fa fa-circle text-danger"></i>IP: <?= $ipaddr; ?><br/>
                    <i class="fa fa-circle text-success"></i>Tanggal: <?= date('Y-m-d'); ?>
                </a>
                <!-- <p>User Identity </p> -->
            </div>
        </div><br/>

        <!-- search form -->
     <!--    <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/dashboard/index']],
                        [
                            'label' => 'Laporan Chart Akun',
                            'icon' => 'fa fa-coffee',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Chart Akun SSH', 'icon' => 'fa fa-list', 'url' => ['/laporan/ssh'],],
                                ['label' => 'Chart Akun HSPK', 'icon' => 'fa fa-list-alt', 'url' => ['/laporan/hspk'],],
                                ['label' => 'Chart Akun ASB', 'icon' => 'fa fa-list-ol', 'url' => ['/laporan/asb'],],
                                ['label' => 'Chart Akun Aset', 'icon' => 'fa fa-list-ul', 'url' => ['/laporan/asset'],],
                            ],
                        ],
                        [
                            'label' => 'Kode SSH',
                            'icon' => 'fa fa-database',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Kode SSH 1', 'icon' => 'fa fa-navicon', 'url' => ['/ref-ssh1/index'],],
                                ['label' => 'Kode SSH 2', 'icon' => 'fa fa-newspaper-o', 'url' => ['/ref-ssh2/index'],],
                                ['label' => 'Kode SSH 3', 'icon' => 'fa fa-object-group', 'url' => ['/ref-ssh3/index'],],
                                ['label' => 'Kode SSH 4', 'icon' => 'fa fa-object-ungroup', 'url' => ['/ref-ssh4/index'],],
                                ['label' => 'Kode SSH 5', 'icon' => 'fa fa-server', 'url' => ['/ref-ssh5/index'],],
                                ['label' => 'Kode SSH 6', 'icon' => 'fa fa-sliders', 'url' => ['/ref-ssh/index'],],
                            ],
                        ],
                        [
                            'label' => 'Kode HSPK',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Kode HSPK 1', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-hspk1/index'],],
                                ['label' => 'Kode HSPK 2', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-hspk2/index'],],
                                ['label' => 'Kode HSPK 3', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-hspk3/index'],],
                                ['label' => 'Kode HSPK 4', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-hspk/index'],],
                            ],
                        ],
                        [
                            'label' => 'Kode ASB',
                            'icon' => 'fa fa-sort-amount-asc',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Kode ASB 1', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-asb1/index'],],
                                ['label' => 'Kode ASB 2', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-asb2/index'],],
                                ['label' => 'Kode ASB 3', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-asb3/index'],],
                                ['label' => 'Kode ASB 4', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-asb4/index'],],
                                ['label' => 'Kode ASB 5', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-asb/index'],],
                                ['label' => 'Kategori Pekerjaan ASB', 'icon' => 'fa fa-sliders', 'url' => ['/ref-kategori-pekerjaan-asb/index'],],
                            ],
                        ],
                        /**
                        [
                            'label' => 'Kode Aset',
                            'icon' => 'fa fa-tasks',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Kode Aset 1', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-rek-aset1/index'],],
                                ['label' => 'Kode Aset 2', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-rek-aset2/index'],],
                                ['label' => 'Kode Aset 3', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-rek-aset3/index'],],
                                ['label' => 'Kode Aset 4', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-rek-aset4/index'],],
                                ['label' => 'Kode Aset 5', 'icon' => 'fa fa-sort-numeric-asc', 'url' => ['/ref-rek-aset5/index'],],
                            ],
                        ],
                         * 
                         */
                        
                    ],
                ]
        )
        ?>

    </section>

</aside>
