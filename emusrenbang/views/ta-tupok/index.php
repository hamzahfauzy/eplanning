<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaTupokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tugas Pokok';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tupok-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Tugas Pokok', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <table class="table table-bordered">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.',
                        'options' => [ 'class' => 'col-md-1' ]
                    ],
                    [
                        'attribute' => 'Tahun',
                        'format' => 'text',
                        'options' => ['class'=>'col-md-1'],
                        'value' => function($model){ return $model->Tahun; }
                    ],
                    [
                        'attribute' => 'Ur_Tupok',
                        'format' => 'text',
                        'options' => ['class'=>'col-md-10'],
                        'value' => function($model){ return $model->No_Tupok.":".$model->Ur_Tupok; }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        'options' => ['class'=>'col-md-1']
                    ],
                ],
            ]); ?>
        </div>
        </table>
    </div>
</div>