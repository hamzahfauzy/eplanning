<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\TaLingkunganPaguIndikatifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Indikatif Lingkungan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-lingkungan-pagu-indikatif-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pagu Indikatif Lingkungan', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'Tahun',
        //    'Kd_Prov',
        //    'Kd_Kab',
        //    'Kd_Kec',
        //    'Kd_Kel',
        //    'Kd_Urut_Kel',
            'Kd_Lingkungan',
            'Pagu_Indikatif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
