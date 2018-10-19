<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrual4 */
?>
<div class="ref-akrual4-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Akrual_1',
            'Kd_Akrual_2',
            'Kd_Akrual_3',
            'Kd_Akrual_4',
            'Nm_Akrual_4',
        ],
    ]) ?>

</div>
