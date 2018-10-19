<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrual2 */
?>
<div class="ref-akrual2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Akrual_1',
            'Kd_Akrual_2',
            'Nm_Akrual_2',
        ],
    ]) ?>

</div>
