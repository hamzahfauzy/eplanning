<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefSubUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Unit';
$this->params['breadcrumbs'][] = "Unit Organisasi";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Sub Unit', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-hover">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.'
                        ],
                        // [
                        //     'attribute' =>'namaUrusan',
                        //     'format' => 'text',
                        //     'value' => function($model){ return $model->Kd_Urusan.":".$model->namaUrusan; }
                        // ],
                        // [
                        //     'attribute' =>'namaBidang',
                        //     'format' => 'text',
                        //     'value' => function($model){ return $model->Kd_Bidang.":".$model->namaBidang; }
                        // ],
                        // [
                        //     'attribute' =>'namaUnit',
                        //     'format' => 'text',
                        //     'value' => function($model){ return $model->Kd_Unit.":".$model->namaUnit; }
                        // ],
                        [
                            'attribute' =>'Nm_Sub_Unit',
                            'format' => 'text',
                            'value' => function($model){ return $model->Kd_Sub.":".$model->Nm_Sub_Unit; }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                            'options' => ['class'=> 'col-md-1']
                        ],
                    ],
                ]); ?>
                </table>
            </div>
        </div>
    </div>
</div>