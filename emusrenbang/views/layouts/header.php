<?php
    use yii\helpers\Html;

    if(isset(Yii::$app->user->identity)){
    	$meIdUrusan  = Yii::$app->user->identity->id_urusan;
    	$meIdBidang  = Yii::$app->user->identity->id_bidang;
    	$meIdSkpd    = Yii::$app->user->identity->id_skpd;
        $meIdSub     = Yii::$app->user->identity->id_subunit;
     //   $userskpd    = Yii::$app->user->getNamaSkpdByUrusanSektor();
        $userskpd = Yii::$app->levelcomponent->getKelompokUnit();
        $namalengkap = Yii::$app->user->identity->nama_lengkap;
    }else{
    	$userskpd="";
    	$namalengkap="";
    }
?>
<style type="text/css">
.form-cus form,.visible-xs-block form{
    margin: 0px;
}

.form-cus form button{
    border:0px;
    background:transparent;
    width: 100%;
    text-align: left;
    padding: 5px 15px;
    display: block;
    clear: both;
    font-weight: 400;
    line-height: 1.538462;
    color: #757575;
    white-space: nowrap;
}

.form-cus form button:focus,
.form-cus form button:hover {
    text-decoration: none;
    color: #fff;
    background-color: #0288d1;
}

.visible-xs-block form button{
    border:0px;
    background:transparent;
    width: 100%;
    text-align: left;
    padding: 10px 15px;
    color: #fff;
}

.visible-xs-block form button:focus,
.visible-xs-block form button:hover {
    background-color: #0294e3;
}

.navbar-brand-center {
    left: 15%;
    top: -10px;
}

.navbar-brand-logo {
    height: 55px;
}
.nav-text{
    position: absolute;
    top: 26px;
    left: 65px;
}

.tulisan{
    color: #fff;
    font-size: 16px;
    position: relative;
    top:13px;
}
</style>
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="#">
                <img class="navbar-brand-logo" src="<?= Yii::getAlias('@web'); ?>/image/logo2.png" alt="Bappeda Provinsi Sumatera Utara">
                <span class="nav-text">MUSRENBANG</span>
                <!-- MUSRENBANG PROVINSI SUMATERA UTARA -->
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
                    <span class="bar-line bar-line-1 out"></span>
                    <span class="bar-line bar-line-2 out"></span>
                    <span class="bar-line bar-line-3 out"></span>
                </span>
                <span class="bars bars-x">
                    <span class="bar-line bar-line-4"></span>
                    <span class="bar-line bar-line-5"></span>
                </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
                    <!-- <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson"> -->
                </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                        <span class="bar-line bar-line-1 out"></span>
                        <span class="bar-line bar-line-2 out"></span>
                        <span class="bar-line bar-line-3 out"></span>
                        <span class="bar-line bar-line-4 in"></span>
                        <span class="bar-line bar-line-5 in"></span>
                        <span class="bar-line bar-line-6 in"></span>
                    </span>
                </button>
                <span class='tulisan'>Bappeda Provinsi Sumatera Utara</span>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs-block">
                        <h4 class="navbar-text text-center">Perangkat Daerah : <?= $userskpd; ?></h4>
                    </li>
                    <li class="dropdown hidden-xs">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true" style="padding:15px 14px 15px 14px;">
                            <!-- <img class="rounded" width="36" height="36" src="<?= Yii::getAlias('@web'); ?>/image/logo.png" alt="Teddy Wilson"> -->
                            OPD : <?= $userskpd; ?> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <div class="form-cus">
                                    <?php
                                        $logout=Html::beginForm(['/site/logout'], 'post').Html::submitButton('Logout').Html::endForm();
                                        echo $logout;
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="visible-xs-block">
                        <?php
                            $logout=Html::beginForm(['/site/logout'], 'post').Html::submitButton("<span class='icon icon-power-off icon-lg icon-fw'></span>LogOut").Html::endForm();
                            echo $logout;
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>