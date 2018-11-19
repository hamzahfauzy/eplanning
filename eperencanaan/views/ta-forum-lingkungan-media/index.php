<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaForumLingkunganMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Forum Lingkungan Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Forum Lingkungan Media', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'Kd_Media',
            // 'Jenis_Dokumen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
