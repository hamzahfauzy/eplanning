<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unit';
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
                        echo Html::a('Tambah Unit', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                        // [
                        //     'attribute' => 'Nm_Urusan',
                        //     'format' => 'text',
                        //     'value' => function($model){ return $model->Kd_Urusan.":".$model->Nm_Urusan; }
                        // ],
                        // [
                        //     'attribute' => 'Nm_Bidang',
                        //     'format' => 'text',
                        //     'value' => function($model){ return $model->Kd_Bidang.".".$model->Nm_Bidang; }
                        // ],
                        [
                            'attribute' => 'Nm_Unit',
                            'format' => 'text',
                            'value' => function($model){ return $model->Kd_Unit.".".$model->Nm_Unit; }
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