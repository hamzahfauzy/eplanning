<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaAgendaPerencanaanLingkunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Agenda Perencanaan Lingkungans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-agenda-perencanaan-lingkungan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Agenda Perencanaan Lingkungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Kd_Lingkungan',
            // 'Tanggal',
            // 'Jam',
            // 'Keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
