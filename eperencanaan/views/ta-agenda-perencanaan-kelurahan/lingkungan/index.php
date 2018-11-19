<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\LingkunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lingkungans';
$this->params['subtitle'] = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lingkungan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lingkungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Kd_Prov',
            'Kd_Kab',
            // 'Kd_Kec',
            // 'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Kd_Lingkungan',
            // 'Nm_Lingkungan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
