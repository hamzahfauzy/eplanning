<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaTujuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Strategis Tujuan';
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = "Data Tujuan";
?>

<div class="ta-tujuan-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Tujuan', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?php
                    if(Yii::$app->user->identity->id_level!==1){ ?>
                        
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                    'header' => 'No.'
                                ],
                                [
                                    'attribute' =>'Tahun',
                                    'format' => 'text',
                                    'options' => ['class'=>'col-md-1'],
                                    'value' => function($model){ return $model->Tahun; }
                                ],
                                // [
                                //     'attribute' =>'Kd_Urusan',
                                //     'format' => 'text',
                                //     'options' => ['class'=>'col-md-1'],
                                //     'value' => function($model){ return $model->Kd_Urusan; }
                                // ],
                                // [
                                //     'attribute' =>'Kd_Bidang',
                                //     'format' => 'text',
                                //     'options' => ['class'=>'col-md-1'],
                                //     'value' => function($model){ return $model->Kd_Bidang; }
                                // ],
                                // [
                                //     'attribute' =>'Kd_Unit',
                                //     'format' => 'text',
                                //     'options' => ['class'=>'col-md-1'],
                                //     'value' => function($model){ return $model->Kd_Unit; }
                                // ],
                                // [
                                //     'attribute' =>'Kd_Sub',
                                //     'format' => 'text',
                                //     'options' => ['class'=>'col-md-1'],
                                //     'value' => function($model){ return $model->Kd_Sub; }
                                // ],
                                [
                                    'attribute' =>'No_Misi',
                                    'format' => 'text',
                                    'value' => function($model){ return $model->misi->No_Misi.".:".$model->misi->Ur_Misi; }
                                ],
                                [
                                    'attribute' =>'Ur_Tujuan',
                                    'format' => 'text',
                                    'value' => function($model){ return $model->No_Tujuan.":".$model->Ur_Tujuan; }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                                    'options' => ['class'=>'col-md-1']
                                ],
                            ],
                        ]); ?>
                    <?php }
                    else { ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Tahun',
                                'Kd_Urusan',
                                'Kd_Bidang',
                                'Kd_Unit',
                                'Kd_Sub',
                                'No_Misi',
                                'No_Tujuan',
                                'Ur_Tujuan',

                                ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    <?php }
                ?>
            </table>
            
        </div>
    </div>
</div>