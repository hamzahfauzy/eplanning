<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefRek5Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Rekening Rincian Objek';
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rek5-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?= Html::a('Referensi Rekening Rincian Objek', ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No.'
                    ],/*
                    [
                        'attribute' =>'namaAkun',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_1.":".$model->namaAkun; }
                    ],
                    [
                        'attribute' =>'namaKelompok',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_2.":".$model->namaKelompok; }
                    ],
                    [
                        'attribute' =>'namaJenis',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_3.":".$model->namaJenis; }
                    ],
                    [
                        'attribute' =>'namaObjek',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_4.":".$model->namaObjek; }
                    ],*/

 		[
                        'attribute' =>'Kd_Rek_1',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_1; }
                    ],
                    [
                        'attribute' =>'Kd_Rek_2',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_2; }
                    ],
                    [
                        'attribute' =>'Kd_Rek_3',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_3; }
                    ],
                    [
                        'attribute' =>'Kd_Rek_4',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_4; }
                    ],

                    [
                        'attribute' =>'Nm_Rek_5',
                        'format' => 'text',
                        'value' => function($model){ return $model->Kd_Rek_5.":".$model->Nm_Rek_5; }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['class'=>'col-md-1']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>