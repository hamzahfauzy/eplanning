<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaSubUnitJabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Jabatan Unit Organisasi';
$this->params['breadcrumbs'][] = "Data Umum";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-jab-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
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
                                'attribute' =>'Kd_Jab',
                                'format' => 'text',
                                'value' => function($model){ $ref = new Referensi; return $ref->getJabatanByOne($model->Kd_Jab)->Nm_Jab; }
                            ],
                             // 'No_Urut',
                             'Nip',
                             'Nama',
                             'Jabatan',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'options' => ['class' => 'col-md-1']
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
                             'Kd_Jab',
                             'No_Urut',
                             'Nama',
                             'Nip',
                             'Jabatan',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                            ],
                        ],
                    ]); ?>
                <?php }
            ?>
        </div>
    </div>
</div>