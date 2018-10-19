<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrual5 */
?>
<div class="ref-akrual5-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Akrual_1',
            'Kd_Akrual_2',
            'Kd_Akrual_3',
            'Kd_Akrual_4',
            'Kd_Akrual_5',
            'Nm_Akrual_5',
            'Peraturan',
        ],
    ]) ?>

</div>
