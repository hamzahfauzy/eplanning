<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefMedia */
?>
<div class="ref-media-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Media',
            'Jenis_Media',
            'Type_Media',
            'Judul_Media',
            'Nm_Media',
            'Created_At',
        ],
    ]) ?>

</div>
