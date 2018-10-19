<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visi Misi Kabupaten Asahan';
$this->params['breadcrumbs'][] = "Nasional/Kabupaten Asahan";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Visi Misi Kabupaten Asahan', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-hover">
            <!-- <table class="table table-bordered table-hover"> -->
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.'
                        ],
                        [
                            'attribute' => 'misi',
                            'format' => 'text',
                            'value' => function($model){ return $model->id.":".$model->misi; }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        ],
                    ],
                ]);
                ?>
                </table>
            </div>
        </div>            
    </div>
</div>
