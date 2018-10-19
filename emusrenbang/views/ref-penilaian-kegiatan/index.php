<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefPenilaianKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referensi Penilaian Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-kegiatan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Penilaian Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Program',
            'Kd_Kegiatan',
        	'ID_Penilaian',
            // 'created_at',
            // 'updated_at',
            // 'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
