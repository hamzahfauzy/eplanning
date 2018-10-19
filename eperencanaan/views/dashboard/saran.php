<?php
	use yii\web\View;
    use yii\widgets\ListView;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use yii\grid\GridView;
    use kartik\select2\Select2;
    use eperencanaan\models\TaKritikSaran;

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
                    <h5>E-Planning Kabupaten Asahan merupakan sebuah aplikasi yang dibangun untuk membuat rencana pembangunan daerah mulai dari tingkat desa/kelurahan sampai kabupaten.</h5>
                </div>
                <!-- ./page title -->
                <hr>

                <div class="page-title" id="tour-step-4">
                    <h5>KRITIK & SARAN</h5>
                </div>

                <div class="row">
                    <div class="wrapper wrapper-white">
                        <div class="col-md-6 col-mid-6">
                            <?php $form = ActiveForm::begin(); ?>

                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'NoHandphone')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'saran')->textarea(['rows' => 6]) ?>
                                <?= $form->field($model, 'status')
                                ->hiddenInput([ 'value' => 1 ]) 
                                ->label(false); 
                                ?>

                                <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Kirim' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>
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