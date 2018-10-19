<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaKecamatanPaguIndikatifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Indikatif Kecamatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kecamatan-pagu-indikatif-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pagu Indikatif Kecamatan', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'Kd_Kec',
                'value'=>'kdKec.Nm_Kec',
            ],

            'Tahun',
        //    'Kd_Prov',
        //    'Kd_Kab',
            
            'Pagu_Indikatif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
