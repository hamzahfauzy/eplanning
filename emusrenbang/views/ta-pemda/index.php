<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaPemdaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemda';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ta-pemda-index">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title"><?= $this->title ?></h3>
            <?php 
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah Pemda', ['create'], ['class' => 'btn btn-success pull-right']);
                }
            ?>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'Tahun',
                    'Nm_Pemda',
                    'Nm_PimpDaerah',
                    'Jab_PimpDaerah',
                    'Nm_Sekda',
                    // 'Nip_Sekda',
                    // 'Jbt_Sekda',
                    // 'Nm_Ka_Keu',
                    // 'Nip_Ka_Keu',
                    // 'Jbt_Ka_Keu',
                    // 'Nm_Ka_Anggaran',
                    // 'Nip_Ka_Anggaran',
                    // 'Jbt_Ka_Anggaran',
                    // 'Nm_Ka_Verifikasi',
                    // 'Nip_Ka_Verifikasi',
                    // 'Jbt_Ka_Verifikasi',
                    // 'Nm_Ka_Perbendaharaan',
                    // 'Nip_Ka_Perbendaharaan',
                    // 'Jbt_Ka_Perbendaharaan',
                    // 'Nm_Ka_BUD',
                    // 'Nip_Ka_BUD',
                    // 'Jbt_Ka_BUD',
                    // 'NPWP_BUD',
                    // 'K1',
                    // 'K2',
                    // 'K3',
                    // 'K4',
                    // 'Nm_Ka_Pembukuan',
                    // 'Nip_Ka_Pembukuan',
                    // 'Jbt_Ka_Pembukuan',
                    // 'Nm_Atasan_BUD',
                    // 'Nip_Atasan_BUD',
                    // 'Jbt_Atasan_BUD',
                    // 'Ibukota',
                    'Alamat',
                    // 'Logo',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>