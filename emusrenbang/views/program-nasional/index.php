<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramNasionalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Nasional';
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
                        echo Html::a('Tambah Program Nasional', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-hover">
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
                            'attribute' =>'namaPrioritas',
                            'format' => 'text',
                            'value' => function($model){ return $model->id_prioritas.":".$model->namaPrioritas; }
                        ],
                        [
                            'attribute' =>'namaNawacita',
                            'format' => 'text',
                            'value' => function($model){ return $model->id_nawacita.":".$model->namaNawacita; }
                        ],
                        [
                            'attribute' =>'namaMisi',
                            'format' => 'text',
                            'value' => function($model){ return $model->id_misi.":".$model->namaMisi; }
                        ],
                        [
                            'attribute' =>'namaUrusan',
                            'format' => 'text',
                            'value' => function($model){ return $model->id_urusan.":".$model->namaUrusan; }
                        ],
                        [
                            'attribute'=>'Program Nasional',
                            'value'=>function($model){
                                return $model->id_program.":".$this->context->getProgram($model->urusan, $model->bidang, $model->id_program);
                            }
                        ],
                        // 'created_at',
                        // 'updated_at',
                        // 'username',
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
