<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefPenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Referensi Penilaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Penilaian:ntext',
            //'created_at',
            //'update_at',
            //'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
