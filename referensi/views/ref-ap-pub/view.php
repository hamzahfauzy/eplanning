<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefApPub */
?>
<div class="ref-ap-pub-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Ap_Pub',
            'Nm_Ap_Pub',
        ],
    ]) ?>

</div>
