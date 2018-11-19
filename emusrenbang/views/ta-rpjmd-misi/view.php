<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdMisi */
?>
<div class="ta-rpjmd-misi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'No_Misi',
            'Misi:ntext',
        ],
    ]) ?>

</div>
