<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefEselon */
?>
<div class="ref-eselon-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Eselon',
            'Nm_Eselon',
        ],
    ]) ?>

</div>
