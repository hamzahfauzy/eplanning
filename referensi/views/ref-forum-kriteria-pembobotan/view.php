<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKecamatanKriteriaPembobotan */
?>
<div class="ref-forum-kriteria-pembobotan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Kriteria',
            'Kriteria',
            'Bobot',
            'Keterangan_Kriteria:ntext',
        ],
    ]) ?>

</div>
