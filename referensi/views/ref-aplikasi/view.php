<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAplikasi */
?>
<div class="ref-aplikasi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aplikasi',
            'Nm_Aplikasi',
        ],
    ]) ?>

</div>
