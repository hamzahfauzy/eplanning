<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKamusProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Kamus Program';
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Referensi Kamus Program', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="" class="table table-bordered table-hover">
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
                            'attribute' => 'Nm_Program',
                            'format' => 'text',
                            'value' => function($model){ return $model->Kd_Program.":".$model->Nm_Program; }
                        ],
                        [
                            'attribute' => 'Status',
                            'format' => 'text',
                            'filter'=>array("1"=>"Wajib","2"=>"Pilihan"),
                            'value' => function($model){ return $model->Status == 1 ? 'Wajib':  'Pilihan' ;  }
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