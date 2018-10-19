<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KegiatansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kegiatan-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Kegiatan', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>

        <div class="box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_kegiatan',
            /*[
            	'attribute'=>'program',
            	'value' => function($model){
            		$program=$this->context->getNamaProgram($model->kode_program);
            		return $program;
            	}
            ],*/
            'nama_program',
            'nama_kegiatan',
            'indikator',
            // 'status',
            // 'aktif',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                                'options' => ['class'=>'col-md-1']
                            ],
                        ],
                    ]); 
                ?>
        </div>
    </div>
</div>