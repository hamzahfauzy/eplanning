<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefMenu */
?>
<div class="ref-menu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'User_ID',
            'ID_Menu',
            'Otoritas',
        ],
    ]) ?>

</div>
