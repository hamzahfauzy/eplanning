<?php

/* @var $this \yii\web\View */
/* @var $content string */

use emusrenbang\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

$js="jQuery(document).ready(function() {
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });";

$this->registerJs($js, 4, 'my-options');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="refresh" content="<?php echo Yii::$app->params['sessionTimeoutSeconds']; ?>;" />
    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php $this->beginBody() ?>

<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
			<img src="image/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">

				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="assets/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile">
					Nick </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="profil.html">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="calendar.html">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>


						<li class="divider">
						</li>
						<li>
							<a href="extra_lock.html">
							<i class="icon-lock"></i> Lock Screen </a>
						</li>
						<li>
							<a href="login.html">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start ">
					<a href="javascript:;">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>

					</a>

				</li>
				<li>
					<a href="javascript:;">
					<i class="fa fa-info-circle"></i>
					<span class="title">Referensi</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="ecommerce_index.html">

							Dimensi Pembangunan <span class="arrow"></span></a>
                            			<ul class="sub-menu">

								<li>
											<a href="#">Dimensi Pembangunan Manusia</a>
										</li>
										<li>
											<a href="#"> Dimensi Pembangunan Sektor Unggul</a>
										</li>
										<li>
											<a href="#"> Dimensi Pemerataan dan Kewilayahan</a>
										</li>
							</ul>

						</li>
						<li>
							<a href="referensi_nawacita.html">Nawacita</a>
						</li>
						<li>
							<a href="referensi_prioritas_nasional.html">Prioritas Nasional</a>
						</li>
						<li>
							<a href="visimisi.html">Visi Misi</a>
						</li>
						<li>
							<a href="prioritas_pembangunan.html">Prioritas Pembangunan</a>
						</li>
                        <li>
							<a href="kebijakan_umum.html">Kebijakan Umum Pembangunan</a>
						</li>
                        <li>
							<a href="program_pembangunan.html">Program Pembangunan</a>
						</li>
                        <li>
							<a href="target.html">Target</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="icon-wallet"></i>
					<span class="title">Input Usulan Kamus Kegiatan</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="urusanwajibdanpilihan.html">
							Urusan Wajib dan Pilihan</a>
						</li>
						<li>
							<a href="urusanwajib.html">
							Urusan Wajib</a>
						</li>
						<li>
							<a href="urusanpilihan.html">
							Urusan Pilihan</a>
						</li>
					</ul>
				</li>
				<!-- BEGIN ANGULARJS LINK -->
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="AngularJS version demo">
					<a href="#" >
					<i class="icon-docs"></i>
					<span class="title">
					Kamus Usulan Kegiatan </span>
					</a>
				</li>
                <li>
					<a href="javascript:;">
					<i class="icon-bar-chart"></i>
					<span class="title">Rekapitulasi</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="rekapitulasi_nawacita.html">
							Nawacita</a>
						</li>
						<li>
							<a href="rekapitulasi_prioritas_nasional.html">
							Prioritas Nasional</a>
						</li>
					</ul>
				</li>
               <li>
					<a href="#">
					<i class="icon-briefcase"></i>
					<span class="title">Lihat Usulan</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="usulan_provinsi.html">
							Provinsi</a>
						</li>
						<li>
							<a href="usulan_kabkota.html">
							Kabupaten Kota</a>
						</li>
						<li>
							<a href="pokokpikiran.html">
							Pokok pokok Pikiran DPRD</a>
						</li>

					</ul>
				</li>
                        <li>
					<a href="#">
					<i class="fa fa-users"></i>
					<span class="title">Executive Summary</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="rekap_prog_pel_adm.html">
							Rekapitulasi Program Pelayanan Administrasi </a>
						</li>
						<li>
							<a href="rekap_prog_peningkatan.html">
							Rekapitulasi Program Peningkatan Disiplin Aparatur </a>
						</li>


					</ul>
				</li>


				<!-- END ANGULARJS LINK -->

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Beranda</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Beranda</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Page Layouts</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Blank Page</a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Download Buku Panduan Disini <i class="fa fa-download"></i>
						</button>
						</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->

                 	<div class="row">
									<div class="col-md-12">
										<form action="javascript:;" class="alert alert-warning alert-borderless">
											<div class="input-group">
												<div class="input-cont">
													<input type="text" placeholder="Search..." class="form-control"/>
												</div>
												<span class="input-group-btn">
												<button type="button" class="btn green-haze">
												Search &nbsp; <i class="m-icon-swapright m-icon-white"></i>
												</button>
												</span>
											</div>
										</form>
									</div>
								</div>

			<div class="row">
				<div class="col-md-12">

                    		<div class="timeline">
				<!-- TIMELINE ITEM -->
				<div class="timeline-item">
					<div class="timeline-badge">
						<img class="timeline-badge-userpic" src="assets/admin/pages/media/users/vena.jpg">
					</div>
					<div class="timeline-body">
						<div class="timeline-body-arrow">
						</div>
						<div class="timeline-body-head">
							<div class="timeline-body-head-caption">
								<a href="javascript:;" class="timeline-body-title font-blue-madison">Vena</a>
								<span class="timeline-body-time font-grey-cascade">Posted new post at 6 Juni 206, 5:10 WIB
</span>
							</div>

						</div>
						<div class="timeline-body-content">
							<span class="font-grey-cascade">
                            <h3>PERHATIAN ... Verifikasi Data UPPN  </h3>
							Mohon seluruh Bappeda Provinsi yang sedang melakukan Verifikasi Usulan Kab/Kota dan Provinsi Harap Memperhatikan Hasil Usulan. Usulan UPPN Mendukung Prioritas Nasional (Bukan Rutin) Hasil Identifikasi Data Sementara : Nama Aktifitas Banyak Mencerminkan Kegiatan Rutin, Target dan Satuan Kurang Tepat serta Dana diinput dalam Rupiah. Sehubungan akan dilakukan Multirateral Meeting II (14-18 April 2016) dan Bilateral Meeting II (19-20 April 2016) Bappenas - K/L, data Usulan Daerah terverifikasi yang akan digunakan dalam Forum Tersebut Hingga Tanggal 13 April 2016 Pukul 23.59 WIB Verifikasi Akhir Bappeda Provinsi 14 - 17 April 2016 masih dapat dilakukan hanya untuk di setujui dan data langsung digunakan dalam Forum Desk Musrenbangnas Forum Desk Musrenbangnas akan disampaikan melalui undangan resmi yang akan disampaikan kepada Kepala Bappeda Provinsi. Masih Ada Waktu, segera di cek keseluruhan data. Usulan UPPN yang sudah di VERIFIKASI menjadi tanggung jawab BAPPEDA PROVINSI </span>
						</div>
					</div>
				</div>
				<!-- END TIMELINE ITEM -->
			<!-- TIMELINE ITEM -->
                			<div class="timeline-item">
					<div class="timeline-badge">
						<img class="timeline-badge-userpic" src="assets/admin/pages/media/users/vena.jpg">
					</div>
					<div class="timeline-body">
						<div class="timeline-body-arrow">
						</div>
						<div class="timeline-body-head">
							<div class="timeline-body-head-caption">
								<a href="javascript:;" class="timeline-body-title font-blue-madison">Vena</a>
								<span class="timeline-body-time font-grey-cascade">Posted new post at 6 Juni 206, 5:10 WIB
</span>
							</div>

						</div>
						<div class="timeline-body-content">
							<span class="font-grey-cascade">
                            <h3>Aplikasi UPPN Telah Ditutup dan Undangan Desk Musrenbangnas </h3>
							Rekan - Rekan Bappeda Provinsi, Bappeda Kabupaten/Kota. Aplikasi UPPN telah di tutup untuk Input dan verifikasi. Pembukaan Musrenbangnas akan dilakukan pada Rabu 20 April 2016 di Bidakara (terlampir) Acara Desk Musyawarah Perencanaan Pembangunan Nasional (Musrenbangnas) Tahun 2016 akan rencana dilakukan pada 21 April - 4 Mei 2016 Di Hotel Bidakara Jakarta Masing - Masing Provinsi mengikuti acara selama 2 (dua) hari secara berurutan. berikut Undangan Resmi dari Humas Bappenas (terlampir) Keterangan lebih lanjut dapat hubungi Panitia Musrenbangnas oleh Dit.TRP Bappenas dengan No tlp (021) 3926601. Terimakasih atas perhatian dan kerjasamanya. </span>
						</div>
					</div>
				</div>

				<!-- END TIMELINE ITEM -->
				<!-- TIMELINE ITEM -->
			</div>
				</div>
			</div>

				<!-- END TIMELINE ITEM -->
				<!-- TIMELINE ITEM -->
			</div>

			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 Bappeda Provinsi Sumatera Utara 2016 © eplanning.sumutprov.go.id
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
