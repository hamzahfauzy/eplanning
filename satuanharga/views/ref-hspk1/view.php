<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk1 */
?>
<div class="ref-hspk1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Hspk1',
            'Nm_Hspk1',
        ],
    ]) ?>

</div>