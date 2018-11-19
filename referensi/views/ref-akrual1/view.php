<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrual1 */
?>
<div class="ref-akrual1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Akrual_1',
            'Nm_Akrual_1',
        ],
    ]) ?>

</div>
