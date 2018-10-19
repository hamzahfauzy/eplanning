<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaMisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Strategis Misi';
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Rencana Strategis Misi', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
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
                    ],
                    'Tahun',
                    [
                        'attribute' =>'Ur_Misi',
                        'format' => 'text',
                        'value' => function($model){ return $model->No_Misi.":".$model->Ur_Misi; }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        'options' => ['class'=>'col-md-1']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>