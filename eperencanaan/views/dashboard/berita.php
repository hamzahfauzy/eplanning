<?php
	use yii\web\View;
    use yii\widgets\ListView;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use kartik\grid\GridView;
    use kartik\select2\Select2;
	use yii\widgets\Pjax;
	use yii\helpers\Url;

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
	$this->registerJsFile(
    '@web/js/sistem/zulcustoms-depdrop.js',
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

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Berita Acara E-Perencanaan</h3>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                 <?= $form->field($ZULmodel, 'kecamatan')->dropDownList($dataKec,['id' => 'drop_kec','class'=>'form-control']) ?>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    
                                    <?= $form->field($ZULmodel, 'kelurahan')->dropDownList([],['id' => 'drop_kel','class'=>'form-control']) ?>

                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                	<label >&nbsp;</label>
                                    <?= Html::SubmitButton('Cari',['class' => 'btn btn-primary form-control',
                                	'onclick' => '$.pjax.reload({
                                		container: "#pjax-grid-view",
                                	});']) ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <?php if ($dataProvider->getCount() !== 0) : ?>
                                <?php Pjax::begin(['id'=>'pjax-grid-view']); ?>
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'pjax' => true,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            ['attribute'=>'Nm_Lingkungan',
                                            //'filter'=>array("1"=>"Active","2"=>"Inactive"),
                                            ],
                                            ['class' => 'yii\grid\ActionColumn',
                                            'template' => '{edit1}{edit2}',
                                            'header' => 'Aksi',
                                            'buttons' => [
                                            'edit1' => function ($url, $model) {
                                                return Html::a('Download', ['lingkungan/himpun-semua2', 
                                                    'Kd_Prov' => $model->provinsi->Kd_Prov,
                                                             'Kd_Kab' => $model->kabupaten->Kd_Kab,
                                                                 'Kd_Kec' => $model->kecamatan->Kd_Kec,
                                                             'Kd_Kel' => $model->kelurahan->Kd_Kel,
                                                             'Kd_Urut_Kel' => $model->kelurahan->Kd_Urut,
                                                             'Kd_Lingkungan' => $model->Kd_Lingkungan
                                                    ], ['class' => 'btn btn-info btn-sm']);
                                            },
                                            ],
                                            ],
                                        ]
                                    ]); ?>
                                <?php Pjax::end(); ?>
                            <?php endif; ?>
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

                <!-- page footer -->    
                <div class="dev-page-footer dev-page-footer-fixed"> <!-- dev-page-footer-closed dev-page-footer-fixed -->
                </div>
                <!-- ./page footer -->

            </div>
            <!-- ./page content container -->