<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\BootstrapAsset;
use emusrenbang\assets\AppAssetDashboard;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAssetDashboard::register($this);

$this->title = 'Halaman Statis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Halaman Statis', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.'
                    ],
                    'title',
                    'content:ntext',
                    'title_seo',
                    'create_at',
                    // 'update_at',
                    // 'publish_at',
                    // 'username',
                    // 'view',
                    // 'hit',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Helper::filterActionColumn('{view}{update}{delete}')
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php
        $this->registerCssFile(Yii::getAlias('@web')."/assets/global/plugins/bootstrap-gtreetable/bootstrap-gtreetable.min.css", [
        'depends' => [BootstrapAsset::className()],], 'css-print-theme');

//$this->registerJsFile(Yii::getAlias('@web').'/assets/global/plugins/bootstrap-gtreetable/bootstrap-gtreetable.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//$this->registerJsFile(Yii::getAlias('@web').'/assets/admin/pages/scripts/table-tree.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

    ?>

</div>
