<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaAgendaPerencanaanKelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Agenda Perencanaan Kelurahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-agenda-perencanaan-kelurahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Agenda Perencanaan Kelurahan', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'Tanggal',
            // 'Jam',
            // 'Keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
