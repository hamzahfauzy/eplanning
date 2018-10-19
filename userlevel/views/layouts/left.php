<?php
/* use yii\helpers\Html;
  use yii\helpers\ArrayHelper; */

// use yii\widgets\ActiveForm;
/* use yii\bootstrap\Nav; */
use mdm\admin\components\MenuHelper;

//$user=Yii::$app->user;
//print_r($user);
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
            <div class="pull-left image" style="height: 45px;">
                <?= yii\helpers\Html::img('@web/img/user-icon.png', ['alt' => 'User Image', 'class' => 'img-circle']);  ?>
                <!--<img id="user-image"  class="img-circle" src='<?= "../../" . @userlevel . "/web/uploads/" . $PC_nama_lengkap['Foto'] ?>'>-->
            </div>
            <div class="pull-left info">
                <p><?= yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Kode User Kode</a>
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
        <?php
        /* dmstr\widgets\Menu::widget(
          [
          'options' => ['class' => 'sidebar-menu'],
          'items' => [
          ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/user/dashboard']],
          ['label' => 'DATA MASTER', 'options' => ['class' => 'header']],

          [
          'label' => 'Data User',
          'icon' => 'fa fa-share',
          'url' => '#',
          'items' => [
          ['label' => 'User Kelurahan', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-transportasi/index'],],
          ['label' => 'User Kecamatan', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-transportasi-kelas/index'],],
          ['label' => 'User SKPD Terkait', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-jarak/index'],],
          ['label' => 'Uset Kab/Kota', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
          ],
          ],
          [
          'label' => 'Satuan Kerja',
          'icon' => 'fa fa-share',
          'url' => '#',
          'items' => [
          ['label' => 'Kelurahan', 'icon' => 'fa fa-file-code-o', 'url' => ['/ref-analisa/index'],],
          ['label' => 'Kecamatan', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub/index'],],
          ['label' => 'SKPD', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub-a/index'],],
          ['label' => 'Bapeda', 'icon' => 'fa fa-dashboard', 'url' => ['/ref-analisa-sub-a/index'],],
          ],
          ],
          [
          'label' => 'Pengaturan RBAC USER',
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
          ['label' => 'Setting', 'options' => ['class' => 'header']],
          //   ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

          [
          'label' => 'Same tools',
          'icon' => 'fa fa-share',
          'url' => '#',
          'items' => [
          ['label' => 'Contoh Menu 1', 'icon' => 'fa fa-file-code-o', 'url' => ['#'],],
          ['label' => 'Contoh Menu 2', 'icon' => 'fa fa-dashboard', 'url' => ['#'],],
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
          ['label' => 'Logout (' . "username" . ')',
          'url' => ['/site/logout'],
          'linkOptions' => ['data-method' => 'post']
          ],
          ],
          ]
          ) */
        ?>
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => $items,
                ]
        )
        ?>

    </section>

</aside>
