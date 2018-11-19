<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaForumLingkungan */
?>
<div class="ta-forum-lingkungan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Forum_Lingkungan',
            'Kd_Unit',
            'Kd_Sub_Unit',
            'Kd_Lingkungan',
            'Kd_Jalan',
            'Kd_Program',
            'Kd_Kegiatan',
            'Kd_Klasifikasi',
            'Kd_Jenis_Usulan',
            'Nm_Permasalahan',
            'Volume',
            'Kd_Satuan',
        ],
    ]) ?>

</div>
