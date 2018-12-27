<?php
use yii\helpers\Html;
use mdm\admin\components\MenuHelper;

// if (!empty(Yii::$app->user->identity->id)) {
//     $items = MenuHelper::getAssignedMenu(Yii::$app->user->identity->id);
// } else {
//     $items = array();
// }

$items = [
    [
        "label" => "Beranda",
        "url" => ["/site/index"]
    ],
    [
        "label" => "Data Program Kegiatan",
        "url" => ["/m-program-kegiatan/index"]
    ],
    [
        "label" => "Data Monitoring",
        "url" => ["/m-monitoring/index"]
    ],
    [
        "label" => "Laporan",
        "url" => ["#"],
        "items" => [
            [
                "label" => "Laporan Sedang Berjalan",
                "url" => ["/m-monitoring/laporan"],
            ],[
                "label" => "Laporan Tahunan",
                "url" => ["/m-monitoring/laporan-tahunan"],
            ]
            
        ]
    ],
];

if(Yii::$app->user->identity->username == "operator1")
{
    $items = [
        [
            "label" => "Laporan",
            "url" => ["/m-monitoring/laporan-bappeda"]
        ]
    ];
}
// die();
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
                <?php echo Html::img('@web/images/logo.png', ['class'=>'img-circle', 'alt'=>'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p><?= \Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i>Tanggal : <?= Yii::$app->session['tglLogin'] ?></a>
                <br>
                <a href="#"><i class="fa fa-circle text-warning"></i>IP: <?= Yii::$app->session['ipAdd'] ?></a>

            </div>
        </div>
        <?=
        dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => $items])
        ?>
    </section>

</aside>
