<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaUserAplikasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aplikasi User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-user-aplikasi-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Aplikasi', ['create', 'id'=>$id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Kd_User',
            'Kd_Aplikasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
