<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use yii\grid\GridView;
    use eperencanaan\models\TaAgendaPerencanaanKelurahan;

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
                    <h5>E-Planning Kabupaten Asahan merupakan sebuah aplikasi yang dibangun untuk membuat rencana pembangunan daerah mulai dari tingkat dusun/lingkungan sampai kabupaten.</h5>
                </div>
                <!-- ./page title -->
                <hr>

                <div class="page-title" id="tour-step-4">
                    <h5>Agenda Perencanaan Rembuk Warga</h5>
                </div>

                <div class="row">
                    
                        <div class="wrapper wrapper-white">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'Tahun',
                        //'Kd_Prov',
                        //'Kd_Kab',
                        'Kd_Kec',
                        'Kd_Kel',
                        'Tanggal',
                        'Jam',
                        'Keterangan:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

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
