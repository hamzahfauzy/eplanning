<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJarak */
?>
<div class="ref-jarak-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Jarak',
            'Nm_Jarak',
        ],
    ]) ?>

</div>
