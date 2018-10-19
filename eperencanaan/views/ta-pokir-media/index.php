<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaPokirMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Pokir Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pokir-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Pokir Media', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_User',
            'Kd_Media',
            'Jenis_Dokumen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
