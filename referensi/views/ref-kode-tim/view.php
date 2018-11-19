<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKodeTim */
?>
<div class="ref-kode-tim-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Tim',
            'Nm_Tim',
        ],
    ]) ?>

</div>
