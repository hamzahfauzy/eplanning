<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefStandardHarga3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Standard Harga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-standard-harga3-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <!-- <?= Html::a('Create Ref Standard Harga3', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            //'Kd_1',
            //'Kd_2',
            //'Kd_3',
            'Uraian',
             'Harga',
             'Satuan',
             'Keterangan',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
