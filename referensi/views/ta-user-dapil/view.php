<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaUserDapil */
?>
<div class="ta-user-dapil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_User',
            'refDapil.Nm_Dapil',
        ],
    ]) ?>

</div>
