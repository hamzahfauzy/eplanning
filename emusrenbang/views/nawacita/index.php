<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NawacitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nawacita';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Nawacita', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- <table class="table table-bordered table-hover"> -->
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <table class="table-hover">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.'
                        ],
                        [
                            'attribute' => 'nawacita',
                            'format' => 'text',
                            'value' => function($model){ return $model->id.":".$model->nawacita; }
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
