<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJenisUser */
?>
<div class="ref-jenis-user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Jenis_User',
            'Nm_Jenis_User',
        ],
    ]) ?>

</div>
