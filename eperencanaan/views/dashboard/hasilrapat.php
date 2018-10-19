<?php
	use yii\web\View;
    use yii\widgets\ListView;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use yii\grid\GridView;
    use kartik\select2\Select2;

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
      
        <!-- page content -->
        <div class="dev-page-content">
                  
            <!-- page content container -->
            <div class="container">

                <!-- page title -->
                <div class="page-title" id="tour-step-4">
                    <h1>E-Planning Kabupaten Asahan</h1>
                    <h5>E-Planning Kabupaten Asahan merupakan sebuah aplikasi yang dibangun untuk membuat rencana pembangunan daerah mulai dari tingkat dusun/lingkungan sampai Kabupaten.</h5>
                </div>
                <!-- ./page title -->
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Hasil Rapat E-Planning</h3>
                            </div>
                
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tentang</th>
                                            <th>Uraian</th>
                                            <th>File</th>
                                            <th>Foto</th>
                                            <th>Video</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Rapat koordinasi dengan tim Kotaku</td>
                                            <td>Menetapkan Panduan teknis rembug warga</td>
                                            <td><a href="#">hasilrapat.pdf</a></td></td>
                                            <td>Foto123</td>
                                            <td>video123</td>
                                        </tr>
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="copyright">
                    <div class="pull-left">
                        &copy; 2017 <strong>BAPPEDA Kabupaten Asahan</strong>. All rights reserved.
                    </div>
                </div>
                <!-- ./Copyright -->
                
            </div>
        </div>
    </div>

    <!-- page footer -->    
    <div class="dev-page-footer dev-page-footer-fixed"> <!-- dev-page-footer-closed dev-page-footer-fixed -->
    </div>
    <!-- ./page footer -->
</div>
<!-- ./page content container -->