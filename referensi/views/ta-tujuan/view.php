<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaTujuan */
?>
<div class="ta-tujuan-view">
 
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
            'Ur_Tujuan',
        ],
    ]) ?>

</div>
