<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefPeraturan */
?>
<div class="ref-peraturan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Peraturan',
            'Nm_Peraturan',
        ],
    ]) ?>

</div>
