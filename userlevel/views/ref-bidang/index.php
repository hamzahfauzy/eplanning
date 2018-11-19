<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefBidangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidang/Sektor';
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
                    echo Html::a('Tambah Bidang', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-hover">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.'
                        ],
                        [
                            'format' => 'text',
                            'label' => 'Urusan',
                            'value' => function($model) {
                                return $model->Kd_Urusan . ":" . $model->Kd_Urusan;
                            }
                        ],
                        [
                            'attribute' => 'Nm_Bidang',
                            'format' => 'text',
                            'value' => function($model) {
                                return $model->Kd_Bidang . ":" . $model->Nm_Bidang;
                            }
                        ],
                        // 'Kd_Bidang',
                        // 'Nm_Bidang',
                        [
                            'format' => 'text',
                            'label' => 'Fungsi',
                            'value' => function($model) {
                                return $model->Kd_Fungsi . ":" . $model->fungsi->Nm_Fungsi;
                            }
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