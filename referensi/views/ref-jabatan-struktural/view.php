<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJabatanStruktural */
?>
<div class="ref-jabatan-struktural-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Eselon',
            'Kd_Jabatan',
            'Nm_Jabatan',
        ],
    ]) ?>

</div>
