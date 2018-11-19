<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaSasaran */
?>
<div class="ta-sasaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Ur_Sasaran',
        ],
    ]) ?>

</div>
