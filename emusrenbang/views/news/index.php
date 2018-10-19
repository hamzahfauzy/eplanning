<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Berita';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Berita', ['create'], ['class' => 'btn btn-success pull-right']);
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
</div>