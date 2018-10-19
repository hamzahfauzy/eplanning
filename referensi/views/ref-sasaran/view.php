<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSasaran */
?>
<div class="ref-sasaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Sasaran',
            'Nm_Sasaran',
        ],
    ]) ?>

</div>
