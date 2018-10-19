<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKamusProgram */
?>
<div class="ref-kamus-program-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Program',
            'Nm_Program',
            'Status',
        ],
    ]) ?>

</div>
