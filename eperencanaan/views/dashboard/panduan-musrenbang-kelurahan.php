<?php
	use yii\web\View;
    use yii\widgets\ListView;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use yii\grid\GridView;
    use kartik\select2\Select2;

	$this->title = "Pelaksanaan Rembuk Warga";

    $this->registerCssFile(
        '@web/css/sistem/dashboard_style.css',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );

    $this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
    );

    $this->registerJsFile(
        '@web/js/sistem/dashboard_skrip.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );

?>

            <!-- page wrapper -->
            <div class="dev-page">

                <!-- page header -->
                <div class="dev-page-header">

                    <div class="dph-logo">
                        <img src="img/logo.png" height="40">
                        <span class="judul-logo">E-Planning Kabupaten Asahan</span>
                        <a class="dev-page-sidebar-collapse">
                            <div class="dev-page-sidebar-collapse-icon">
                                <span class="line-one"></span>
                                <span class="line-two"></span>
                                <span class="line-three"></span>
                            </div>
                        </a>
                    </div>


                </div>
                <!-- ./page header -->

                <!-- page container -->
                <div class="dev-page-container">
                  <!--sidebar-->
                <?php include "leftpage.php"; ?>
                <!--sidebar-->
                <!-- page content -->
                <div class="dev-page-content">



            <!-- page content container -->
            <div class="container">


                <!-- page title -->
                <div class="page-title" id="tour-step-4">
                    <h1>E-Planning Kabupaten Asahan</h1>
                     <h5>Untuk Panduan Penggunaan Musrenbang Desa/Kelurahan silahkan klik tombol unduh dibawah</h5>
                   </div>
                <!-- ./page title -->

                <div class="page-title" id="tour-step-4">

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box-widget widget-module">
                            <div class="widget-container">
                                <div class=" widget-block">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-6">

                                    <a href="../panduan/panduan-musrenbang-kelurahan.pdf" class="btn btn-success" target="_blank"><span class="fa fa-download">
                                    Unduh Panduan</span> </a>

                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- summernote plugin -->



                <!-- Copyright -->
                <div class="copyright">
                    <div class="pull-left">
                        &copy; 2017 <strong>BAPPEDA Kabupaten Asahan</strong>. All rights reserved.
                    </div>
                </div>
                <!-- ./Copyright -->
            </div>
            <!-- ./page content container -->

            </div>
      </div>
  </div>
<!-- modal form -->

        </div>
    </div>
</div>
<!-- /.modal form -->
