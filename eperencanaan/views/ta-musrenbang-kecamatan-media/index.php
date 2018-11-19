<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaMusrenbangKecamatanMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Musrenbang Kecamatan Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kecamatan-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Musrenbang Kecamatan Media', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_Musrenbang_Kecamatan',
            'Kd_Media',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
