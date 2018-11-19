<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefPerubahan */
?>
<div class="ref-perubahan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Perubahan',
            'Uraian',
        ],
    ]) ?>

</div>
