<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaTujuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tujuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php
    if(Yii::$app->user->identity->id_level!==1){
        
        ?>
        <p>
        <?= Html::a('Tambah Tujuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
             'No_Misi',
             'No_Tujuan',
             'Ur_Tujuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    }else{
        ?>
        
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
             'No_Misi',
             'No_Tujuan',
             'Ur_Tujuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    }
    ?>
</div>
