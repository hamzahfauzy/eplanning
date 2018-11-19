<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaKelurahanPaguIndikatifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagu Indikatif Kelurahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kelurahan-pagu-indikatif-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pagu Indikatif Kelurahan', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'Tahun',
          //  'Kd_Prov',
           // 'Kd_Kab',
          //  'Kd_Kec',
            'kdKel.Nm_Kel',
           // 'Kd_Urut',
            'Pagu_Indikatif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
