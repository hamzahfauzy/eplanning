<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKategoriPekerjaanAsb */
?>
<div class="ref-kategori-pekerjaan-asb-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Pekerjaan',
            'Uraian:ntext',
        ],
    ]) ?>

</div>
