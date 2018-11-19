<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJabatan */
?>
<div class="ref-jabatan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Jab',
            'Nm_Jab',
        ],
    ]) ?>

</div>
