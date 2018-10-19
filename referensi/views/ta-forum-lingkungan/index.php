<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaForumLingkunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Forum Lingkungans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Forum Lingkungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Kd_Prov',
            // 'Kd_Kab',
            // 'Kd_Kec',
            // 'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Kd_Lingkungan',
            // 'Kd_Jalan',
            // 'Kd_Urusan',
            // 'Kd_Bidang',
            // 'Kd_Prog',
            // 'Kd_Keg',
            // 'Kd_Klasifikasi',
            // 'Nm_Permasalahan',
            // 'Volume',
            // 'Kd_Satuan',
            // 'Kd_Sasaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
