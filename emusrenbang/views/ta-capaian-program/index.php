<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaCapaianProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Capaian Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-capaian-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ta Capaian Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            // 'Kd_Prog',
            // 'ID_Prog',
            // 'No_ID',
            // 'Tolak_Ukur',
            // 'Target_Angka',
            // 'Target_Uraian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
