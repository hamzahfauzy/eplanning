<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-program-index">

       <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Detail Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_program',
            'tahun',
            'lokasi',
            'target',
            // 'pagu',
            // 'sumber',
            // 'catatan',
            // 'prakiraan_target',
            // 'prakiraan_pagu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
