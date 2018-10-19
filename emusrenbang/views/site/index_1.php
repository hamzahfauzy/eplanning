<?php

use yii\helpers\Html;

//use app\controllers\SiteController;

/* @var $this yii\web\View */


$this->title = 'Dashboard Emusrenbang';
$this->params['breadcrumbs'][] = $this->title;
$tahun = date('Y');
$kode_skpd = Yii::$app->user->skpd;
?>     
<h3>Selamat Datang <strong><?= Yii::$app->user->username; ?></strong> Anda login sebagai user SKPD 
    <strong><?= Yii::$app->user->namaskpd; ?> (<?= Yii::$app->user->skpd; ?>)</strong>
</h3>
<table class="table tree">
    <?php
    if (!empty($dataProgram)) {
        $i = 1;
        foreach ($dataProgram as $key => $program) {
            $detailProgram = $this->context->getDetailProgram($key, $tahun);
            $countData = $this->context->getCountKegiatan($key, $tahun);
            $countDraft = $this->context->getCountDraft($key, $tahun);
            $countUsul = $this->context->getCountUsul($key, $tahun);
            $countVerifikasi = $this->context->getCountVerifikasi($key, $tahun);
            ?>
            <tr class="treegrid-<?= $i ?>">
                <td><?= $program; ?> | (Rp. <?= $detailProgram['pagu']; ?>) | Keg <?= $countData ?> | Draft <?= $countDraft; ?>| Usul <?= $countUsul; ?>| ver <?= $countVerifikasi; ?></td><td class="hidden-xs">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">
                                        Action </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <?= Html::a('View Detail Program', ['detail-program/view', 'id' => $key]) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Input Kegiatan', ['kegiatans/create']) ?>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <?= Html::a('Input Detail Program', ['detail-program/create', 'kode_program' => $key]) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Update Detail Program', ['detail-program/update', 'kode_program' => $key, 'tahun' => $tahun]) ?>
                                    </li>						
                                </ul>
                            </li>
                        </ul>
                    </div>				
                </td>
            </tr>
            <?php
            $kegiatan = $this->context->getKegiatan($key);
            if (!empty($kegiatan)) {
                $p = $i;
                $i = $i + 1;
                foreach ($kegiatan as $keyKegiatan => $dataKegiatan) {
                    $detailKegiatan = $this->context->getDetailKegiatan($keyKegiatan, $tahun);
                    ?>
                    <tr class="treegrid-<?= $i ?> treegrid-parent-<?= $p ?>" >
                        <td><?= $dataKegiatan; ?> | (Rp. <?= $detailKegiatan['pagu']; ?>)</td><td class="hidden-xs"><div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="dropdown dropdown-user">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <span class="username username-hide-on-mobile">
                                                Action </span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            <li>
                                                <?= Html::a('View Detail Kegiatan', ['detail-kegiatan/view', 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('Input Kegiatan', ['kegiatans/create']) ?>
                                            </li>
                                            <li class="divider">
                                            </li>
                                            <li>
                                                <?= Html::a('Input Detail Kegiatan', ['detail-kegiatan/create', 'kode_kegiatan' => $keyKegiatan]) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('Update Detail Kegiatan', ['detail-kegiatan/update', 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                            </li>	
                                            <li class="divider">
                                            </li>
                                            <li>
                                                <?= Html::a('Verifikasi Detail Kegiatan', ['detail-kegiatan/view', 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                            </li>						
                                            <li class="divider">
                                            </li>
                                            <li>
                                                <?= Html::a('Input Uraian Kegiatan', ['uraian-kegiatan/create', 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                            </li>					
                                        </ul>
                                    </li>
                                </ul>
                            </div></td>
                    </tr>
                    <?php
                    $uraian = $this->context->getUraiankegiatan($keyKegiatan, $tahun);
                    if (!empty($kegiatan)) {
                        $p = $i;
                        $i = $i + 1;
                        foreach ($uraian as $dataUraian) {
                            $id = $dataUraian['id'];
                            ?>
                            <tr class="treegrid-<?= $i ?> treegrid-parent-<?= $p ?>" >
                                <td>Uraian = <?= $dataUraian['uraian']; ?> | Volume = <?= $dataUraian['volume']; ?> 
                                    | Satuan = <?= $dataUraian['satuan']; ?> | Harga = <?= $dataUraian['harga']; ?> 
                                    | Jumlah = <?= $dataUraian['jumlah']; ?></td><td class="hidden-xs"><div class="top-menu">
                                        <ul class="nav navbar-nav pull-right">
                                            <li class="dropdown dropdown-user">
                                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                    <span class="username username-hide-on-mobile">
                                                        Action </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-default">

                                                    <li>
                                                        <?= Html::a('Update Uraian Kegiatan', ['uraian-kegiatan/update', 'id' => $id, 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                                    </li>	
                                                    <li>
                                                        <?= Html::a('Verifikasi', ['uraian-kegiatan/view', 'id' => $id, 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun]) ?>
                                                    </li>
                                                    <li class="divider">
                                                    </li>
                                                    <li>
                                                        <?=
                                                        Html::a('Delet Detail Kegiatan', ['uraian-kegiatan/delete',
                                                            'id' => $id, 'kode_kegiatan' => $keyKegiatan, 'tahun' => $tahun], ['data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],])
                                                        ?>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div></td>
                            </tr>
                            <?php
                        }
                    }
                    $i = $i + 1;
                }
            }
        }
    }
    ?>
</table>