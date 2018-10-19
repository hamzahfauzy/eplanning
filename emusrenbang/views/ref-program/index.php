<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php
                    if (Helper::checkRoute('create')) {
                        //echo Html::a('Tambah Program Wajib', ['createwajib'], ['class' => 'btn btn-success pull-right']);
                        echo Html::a('Tambah Program', ['create'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-right: 5px;']);
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
                        //     'value' => function($model){ return $model->Kd_Bidang.":".$model->Nm_Bidang; }
                        // ],
						
                        [
                            'attribute' => 'Kd_Urusan',
                            'format' => 'text',
                            'value' => 'kdUrusan.Nm_Urusan',
                            'filter' => $data_urusan
                        ],
                        [
                            'attribute' => 'Kd_Bidang',
                            'format' => 'text',
                            'value' => 'kdBidang.Nm_Bidang',
                            //'filter' => 	$data_bidang1
                        ],
						
						
						[
                            'attribute' => 'Kd_Unit',
                            'format' => 'text',
                            'value' => 'kdUnit.Nm_Unit',
                            //'filter' => $data_unit
                        ], 
						
						
						[
                            'attribute' => 'Kd_Sub_Unit',
                            'format' => 'text',
                            'value' => 'kdSub.Nm_Sub_Unit',
                           // 'filter' => $data_sub
                        ], 
                        
						[
                            'attribute' => 'Kd_Prog',
                            'format' => 'text',
                            'value' => 'Kd_Prog'
                        ],
                        [
                            'attribute' => 'Ket_Program',
                            'format' => 'text',
                            'value' => function($model){ return $model->Kd_Prog.":".$model->Ket_Program; }
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
