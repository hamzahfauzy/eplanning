<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefTahapan */
?>
<div class="ref-tahapan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Tahapan',
            'No_Urut',
            'Uraian',
        ],
    ]) ?>

</div>
