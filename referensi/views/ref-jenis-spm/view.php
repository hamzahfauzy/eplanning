<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJenisSPM */
?>
<div class="ref-jenis-spm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Jn_SPM',
            'Nm_Jn_SPM',
        ],
    ]) ?>

</div>
