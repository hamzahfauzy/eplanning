<?php
use yii\helpers\Html;

$level   = Yii::$app->user->level;
//$level   = Yii::$app->user->level;
$level = 'admin';
//$level = 'admin';
$idlevel = Yii::$app->user->identity->id_level;

?>

</style>
<div class="layout-sidebar-backdrop"></div>
<div class="layout-sidebar-body">
    <div class="custom-scrollbar">
        <nav id="sidenav" class="sidenav-collapse collapse">
            <ul class="sidenav">

                <li class="sidenav-heading">Informasi User</li>
                <li class="sidenav-item justInfo">
                    <a href="#">
                        <span class="sidenav-text">Tanggal</span>
                        <span class="sidenav-label">&nbsp;:&nbsp;<?= Yii::$app->session['tglLogin'] ?></span>
                    </a>
                </li>
                <li class="sidenav-item justInfo">
                    <a href="#">
                        <span class="sidenav-text">Waktu</span>
                        <span class="sidenav-label">&nbsp;:&nbsp;<?= Yii::$app->session['waktuLogin'] ?></span>
                    </a>
                </li>
                <li class="sidenav-item justInfo">
                    <a href="#">
                        <span class="sidenav-text">IP</span>
                        <span class="sidenav-label">&nbsp;:&nbsp;<?= Yii::$app->session['ipAdd'] ?></span>
                    </a>
                </li>

                <li class="sidenav-heading">Navigation</li>
                <li class="sidenav-item">
                    <?= Html::a("<span class='sidenav-icon icon icon-home'></span><span class='sidenav-label'>Beranda</span>", ['site/index']) ?>
                </li>

                <li class="sidenav-heading">Menu</li>
                <li class="sidenav-item has-subnav">
                    <a href="#" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-files-o"></span>
                        <span class="sidenav-label">Referensi</span>
                    </a>
                    <ul class="sidenav-subnav collapse">
                        <li class="sidenav-subheading">Referensi</li>
                        <li><?= Html::a('Dimensi Pembangunan Manusia',['site/page','id'=>'dimensi-pembangunan-manusia']) ?></li>
                        <li><?= Html::a('Dimensi Pembangunan Sektor Unggul',['site/page','id'=>'dimensi-pembangunan-sektor-unggul']) ?></li>
                        <li><?= Html::a('Dimensi Pemerataan dan Kewilayahan',['site/page','id'=>'dimensi-pemerataan-dan-kewilayahan']) ?></li>
                        <li><?= Html::a('Nawacita',['nawacita/list']) ?></li>
                        <li><?= Html::a('Prioritas Nasional',['prioritas-nasional/list']) ?></li>
                        <li><?= Html::a('Visi Misi Provinsi',['misi/list']) ?></li>
                        <li><?= Html::a('Prioritas Pembangunan',['site/page','id'=>'prioritas-pembangunan-provinsi-sumatera-utara']) ?></li>
                        <li><?= Html::a('Kebijakan Umum Pembangunan',['site/page','id'=>'kebijakan-umum-pembangunan']) ?></li>
                        <li><?= Html::a('Program Pembangunan',['site/page','id'=>'program-pembangunan']) ?></li>
                        <li><?= Html::a('Parameter Usulan Kegiatan Verifikator',['site/page','id'=>'paremeter-usulan-kegiatan-verifikator']) ?></li>
                    </ul>
                </li>
                <?php if($level == "admin"){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Program Kegiatan</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Program Kegiatan</li>
                            <li><?= Html::a('Urusan',['ref-urusan/index']) ?></li>
                            <li><?= Html::a('Sektor',['ref-bidang/index']) ?></li>
                            <li><?= Html::a('Referensi Kamus Program',['ref-kamus-program/index']) ?></li>
                            <li><?= Html::a('Program',['ref-program/index']) ?></li>
                            <li><?= Html::a('Kegiatan',['ref-kegiatan/index']) ?></li>
                        </ul>
                    </li>
                <?php }else{ ?>
                    <li class="sidenav-item">
                        <?= Html::a("<span class='sidenav-icon icon icon-files-o'></span><span class='sidenav-label'>Input Usulan Kegiatan</span>", ['ref-kegiatan-skpd/index']) ?>
                    </li>
                <?php } ?>
                <?php if($level == "admin"){ ?>
                    <li class="sidenav-item">
                        <?= Html::a("<span class='sidenav-icon icon icon-star'></span><span class='sidenav-label'>Program Perangkat Daerah</span>", ['ref-kegiatan-skpd/programskpd']) ?>
                    </li>
                <?php } ?>
                <?php if($level == "admin" or $idlevel=='8'){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Pagu Indikatif</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Pagu Indikatif</li>
                            <?php if($level=="admin"){ ?>
                                <li><?= Html::a('Pagu Indikatif Perangkat Daerah',['ta-pagu-unit/list']) ?></li>
                                <li><?= Html::a('Pagu Indikatif Program',['ta-pagu-program/list']) ?></li>
                            <?php }else{ ?>
                                <li><?= Html::a('Pagu Indikatif Program',['ta-pagu-program/list']) ?></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if($level == "admin"){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Unit Organisasi</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Unit Organisasi</li>
                            <li><?= Html::a('Perangkat Daerah',['ref-unit/index']) ?></li>
                            <li><?= Html::a('UPT',['ref-sub-unit/index']) ?></li>
                        </ul>
                    </li>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Nasional / Provinsi</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Nasional / Provinsi</li>
                            <li><?= Html::a('Nawacita',['nawacita/index']) ?></li>
                            <li><?= Html::a('Prioritas Nasional',['prioritas-nasional/index']) ?></li>
                            <li><?= Html::a('Program Nasional',['program-nasional/index']) ?></li>
                            <li><?= Html::a('Visi Misi Provinsi',['misi/index']) ?></li>
                            <li><?= Html::a('Urusan Provinsi',['urusan/index']) ?></li>
                        </ul>
                    </li>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Referensi Rekening</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Referensi Rekening</li>
                            <li><?= Html::a('Akun',['ref-rek1/index']) ?></li>
                            <li><?= Html::a('Kelompok',['ref-rek2/index']) ?></li>
                            <li><?= Html::a('Jenis',['ref-rek3/index']) ?></li>
                            <li><?= Html::a('Objek',['ref-rek4/index']) ?></li>
                            <li><?= Html::a('Rincian Objek',['ref-rek5/index']) ?></li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="sidenav-item has-subnav">
                    <a href="#" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-files-o"></span>
                        <span class="sidenav-label">Data Umum</span>
                    </a>
                    <ul class="sidenav-subnav collapse">
                        <li class="sidenav-subheading">Data Umum</li>
                        <li><?= Html::a('Data Umum Unit Organisasi',['ta-sub-unit/index']) ?></li>
                        <li><?= Html::a('Data Jabatan Unit Organisasi',['ta-sub-unit-jab/index']) ?></li>
                    </ul>
                </li>

                <!--<?php if($level != "admin"){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Kegiatan Musrenbang</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Kegiatan Musrenbang</li>
                            <li><?= Html::a('Program Dan Kegiatan',['ta-belanja/list']) ?></li>
                            <?php if($level=="Penyelia (Bappeda)" or $level=="operator(penyelia)"){ ?>
                                <li><?= Html::a('Monitoring Kegiatan Perangkat Daerah',['kegiatan-skpd/monitor']) ?></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>-->

                <?php if($idlevel!='8'){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Rencana Strategis</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Rencana Strategis</li>
                            <li><?= Html::a('Misi',['ta-misi/index']) ?></li>
                            <li><?= Html::a('Tujuan',['ta-tujuan/index']) ?></li>
                            <li><?= Html::a('Sasaran',['ta-sasaran/index']) ?></li>
                            <li><?= Html::a('Tugas Pokok',['ta-tupok/index']) ?></li>
                            <li><?= Html::a('Fungsi',['ta-fungsi/index']) ?></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($level == "admin"){ ?>
                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">Sistem</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">Sistem</li>
                            <li><?= Html::a('Halaman Statis',['pages/index']) ?></li>
                            <li><?= Html::a('Berita',['news/index']) ?></li>
                            <li><?= Html::a('Fungsi',['ref-fungsi/index']) ?></li>
                            <li><?= Html::a('Satuan',['satuan/index']) ?></li>
                            <li><?= Html::a('Sumber',['sumber/index']) ?></li>
                            <li><?= Html::a('Jadwal',['countdown/']) ?></li>
                        </ul>
                    </li>

                    <li class="sidenav-item has-subnav">
                        <a href="#" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-files-o"></span>
                            <span class="sidenav-label">User Management</span>
                        </a>
                        <ul class="sidenav-subnav collapse">
                            <li class="sidenav-subheading">User Management</li>
                            <li><?= Html::a('Data User',['users/index']) ?></li>
                            <li><?= Html::a('Level User',['levels/index']) ?></li>
                            <li><?= Html::a('Level Unit',['level-unit/index']) ?></li>
                            <li><?= Html::a('Level User',['levels/index']) ?></li>
                            <li><?= Html::a('Level Aplikasi',['level-aplikasi/index']) ?></li>
                            <li><?= Html::a('Level Fungsi',['level-fungsi/index']) ?></li>
                            <li><?= Html::a('Level Assignment',['level-assignment/index']) ?></li>
                            <li><?= Html::a('Menu',['menu/index']) ?></li>
                            <li><?= Html::a('Menu Assignment',['menu-assignment/index']) ?></li>
                            <li><?= Html::a('Menu Assignment Level',['menu-assignment-level/index']) ?></li>
                            <li><?= Html::a('Data Jabatan',['jabatans/index']) ?></li>
                            <li><?= Html::a('Data Log',['log/index']) ?></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>