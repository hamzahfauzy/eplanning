<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefUrusan */
?>
<div class="ref-urusan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Nm_Urusan',
        ],
    ]) ?>

</div>
