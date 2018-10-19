<?php

use yii\web\View;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefJalan;
use eperencanaan\models\TaForumLingkungan;
use common\components\Helper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile(
        '@web/css/dev-plugins/fullcalendar/fullcalendar.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/calendar-style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/drepdrop-usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/musrenbang/lihat_usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->title = "". Yii::$app->pengaturan->Kolom('Nm_Pemda');

$Kd_Kec = array();
$Kd_Kel = array();
$Kd_Lingkungan = array();
$status = @$setting[0]->status;
?>
<!-- Modal -->
<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?r=dashboard/index">
				<img src="img/logo1.png" height="30" style="float:left;">
				&nbsp;
				E-Musrenbang Kabupaten Asahan
				</a>
				
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" style="z-index:1">		
				<li class="dropdown">
                    <a href="/../">
                        <i class="fa fa-user fa-fw"></i> 
						Home
                    </a>
                    <!-- /.dropdown-user -->
                </li>			
                <li class="dropdown">
                    <a href="#">
                        <i class="fa fa-user fa-fw"></i> 
						User Publik
                    </a>
                    <!-- /.dropdown-user -->
                </li>
				<li class="dropdown">
				  <a href="#" id="btnlogin" onclick="$('#loginform-username').focus()"><i class="fa fa-user"></i> Login</a>
				  <div id="form" class="panel panel-default" style="position:absolute;width:300px;right:10px;z-index:150000;">
					<div class="panel-heading">
						<i class="fa fa-sign-in"></i> Login E-Musrenbang
					</div>
					<div class="panel-body">
						<?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'action' => ['dashboard/login'],
                                ]); ?>

						<?= @$form->field($model, 'username')->textInput(['autofocus' => true]) ?>

						<?= @$form->field($model, 'password')->passwordInput() ?>

						<?php // $form->field($model, 'rememberMe')->checkbox()  ?>

						<div class="form-group">
							<?= Html::submitButton('<i class="fa fa-sign-in"></i> Login', ['class' => 'btn btn-success form-control', 'name' => 'login-button']) ?>
						</div>

						<?php ActiveForm::end(); ?>
					</div>
				  </div>
				</li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search" style="background:#3498db">
                            <div class="row">
								<div class="col-sm-4" style="color:#FFF">
								<i class="fa fa-users fa-5x" aria-hidden="true"></i>
								</div>
								<div class="col-sm-8">
								<br>
								<span style="color:#FFF;font-weight:bold;">Publik</span><br>
								&nbsp;
								<span style="color:#eaeaea;"><i class="fa fa-map-marker"></i> Kab. Asahan</span>
								</div>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php?r=dashboard/index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-search fa-fw"></i> Lihat Usulan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<!--
								<li>
									<a href="index.php?r=dashboard/usulan-lingkungan">Rembuk Warga</a>
								</li> -->
								<li>
									<a href="index.php?r=dashboard/usulan-kelurahan">Musrenbang Desa/Kelurahan</a>
								</li>
								<li>
									<a href="index.php?r=dashboard/usulan-kecamatan">Musrenbang Kecamatan</a>
								</li>
								<li>
									<a href="index.php?r=dashboard/usulan-pokir&Setuju=[]&kd1=[] &dewan=[] ">Usulan Pokir</a>
								</li>
								<li>
									
									<a href="index.php?r=dashboard/hasil-forum-opd&Setuju=[]&Urusan=[]&Bidang=[]&Unit=[]&Sub=[]">Forum Perangkat Daerah</a>
								</li>
								<li>
									<a href="index.php?r=dashboard/laporan-renja">Renja Perangkat Daerah</a>
								</li>
							</ul>
                        </li> 
                        <li>
                            <a href="index.php?r=dashboard/kamususulan"><i class="fa fa-book fa-fw"></i> Kamus Usulan</a>
                        </li>
						 
						 <li>
						
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Agenda Perencanaan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							
								<li>
								<a href="index.php?r=dashboard%2Ftampilagenda"><i class="fa fa-calendar fa-fw"></i> Agenda Musrenbang</a>
							</li>
							<li>
								<a href="index.php?r=dashboard%2Fpantaumusrenbang"><i class="fa fa-calendar fa-fw"></i> Pantau Musrenbang Desa</a>
							</li>
							<li>
								<a href="index.php?r=dashboard%2Fpantaukecamatan"><i class="fa fa-calendar fa-fw"></i> Pantau Musrenbang Kec</a>
							</li>
							<li>
								<a href="index.php?r=dashboard%2Fpantauforum"><i class="fa fa-calendar fa-fw"></i> Pantau Forum PD</a>
							</li>
							<li>
								<a href="index.php?r=dashboard%2Fpantaurenja"><i class="fa fa-calendar fa-fw"></i> Pantau RKPD</a>
							</li>
							</ul>
                        </li>
						
						
                        <li>
                            <a href="#">
							<i class="fa fa-download fa-fw"></i> Unduh Panduan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <!-- <li>
									<a href="../panduan/panduan-rembuk-warga.pdf" target="_blank">Rembuk Warga</a>
								</li> -->
								<li>
									<a href="../panduan/Musrenbang desa_kelurahan.pdf" target="_blank">Musrenbang Desa/Kelurahan</a>
								</li>
								<li>
									<a href="../panduan/Musrenbang Kecamatan.pdf" target="_blank">Musrenbang Kecamatan</a>
								</li>
								
								<li>
									<a href="../panduan/Pokir.pdf" target="_blank">Pokir</a>
								</li>
								<li>
									<a href="../panduan/Forum Perangkat Daerah.pdf" target="_blank">Forum Perangkat Daerah</a>
								</li>
								<li>
									<a href="../panduan/RKPD.pdf" target="_blank">RKPD</a>
								</li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						
						<li>
            <a href="#"><i class="fa fa-file-o"></i> <span>Petunjuk Teknis</span></a>
            <ul>
                <li>
                    <a href="../panduan/Juknis Pelaksanaan Musrenbang.pdf" target="_blank">Juknis Pelaksanaan Musrenbang</a>
                </li>
                <li>
                    <a href="../panduan/Arah Kebijakan Pembangunan Kabupaten Asahan Tahun 2019 Dalam Rangka Pelaksanaan Musrenbang.pdf" target="_blank">Arah Kebijakan Tahun 2019</a>
                </li>

            </ul>
        </li>
		
        
                        
                    </ul>
					<br>
					
				
				
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="overflow:auto;">