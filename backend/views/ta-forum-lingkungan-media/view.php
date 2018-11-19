<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaForumLingkunganMedia */
?>
<div class="ta-forum-lingkungan-media-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Forum_Lingkungan',
            'Jenis_Media',
            'Type_Media',
            'Judul_Media',
            'Nm_Media',
            'Created_at',
        ],
    ]) ?>

</div>
