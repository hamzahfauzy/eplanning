<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaSasaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Strategis Sasaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Sasaran', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <table class="table table-bordered">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
                if(Yii::$app->user->identity->id_level!==1) { ?>
                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No.'
                            ],
                            'Tahun',
                            [
                                'attribute' =>'taMisi.Ur_Misi',
                                'format' => 'text',
                                'value' => function($model){ return $model->No_Misi.":".$model->taMisi->Ur_Misi; }
                            ],
                            [
                                'attribute' =>'taTujuan.Ur_Tujuan',
                                'format' => 'text',
                                'value' => function($model){ return $model->No_Tujuan.":".$model->taTujuan->Ur_Tujuan; }
                            ],
                            [
                                'attribute' =>'Ur_Sasaran',
                                'format' => 'text',
                                'value' => function($model){ return $model->No_Sasaran.":".$model->Ur_Sasaran; }
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
                             'No_Sasaran',
                             'Ur_Sasaran',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                <?php }
            ?>
        </div>
        </table>
    </div> 
</div>