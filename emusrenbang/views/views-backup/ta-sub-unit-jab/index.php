<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaSubUnitJabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Jabatan Unit Organisasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-jab-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?php
    if(Yii::$app->user->identity->id_level!==1){
    ?>
    <p>
        <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            //'Kd_Urusan',
            //'Kd_Bidang',
            //'Kd_Unit',
            //'Kd_Sub',
             'Kd_Jab',
             'No_Urut',
             'Nama',
             'Nip',
             'Jabatan',

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
             'Kd_Jab',
             'No_Urut',
             'Nama',
             'Nip',
             'Jabatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    }
    ?>
</div>
