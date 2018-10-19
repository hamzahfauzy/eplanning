<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb1 */
?>
<div class="ref-asb1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Asb1',
            'Nm_Asb1',
        ],
    ]) ?>

</div>
