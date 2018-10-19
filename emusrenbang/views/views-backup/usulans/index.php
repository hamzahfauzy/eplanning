<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsulansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usulans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usulans-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usulans', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_program',
            'id_satuan',
            'id_skpd',
            'id_kegiatan',
            // 'indikator',
            // 'target',
            // 'jenis',
            // 'harga',
            // 'keterangan',
            // 'id_user',
            // 'date',
            // 'time',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
