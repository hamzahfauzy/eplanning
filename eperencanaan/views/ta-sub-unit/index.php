<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaSubUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Visi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'Tahun',
            // 'Kd_Urusan',
            // 'Kd_Bidang',
            // 'Kd_Unit',
            // 'Kd_Sub',
            // 'Nm_Pimpinan',
            // 'Nip_Pimpinan',
            // 'Jbt_Pimpinan',
            // 'Alamat',
            'Ur_Visi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
