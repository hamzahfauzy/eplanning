<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdSasaran */
?>
<div class="ta-rpjmd-sasaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            [
                'attribute' => 'taRpjmdTujuan.taRpjmdMisi.Misi',
                'value' => function($model) { return '('.$model->taRpjmdTujuan->taRpjmdMisi->No_Misi.') '.$model->taRpjmdTujuan->taRpjmdMisi->Misi; }
            ],
            [
                'attribute' => 'taRpjmdTujuan.Tujuan',
                'value' => function($model) { return '('.$model->taRpjmdTujuan->No_Tujuan.') '.$model->taRpjmdTujuan->Tujuan; }
            ],
            'No_Sasaran',
            'Sasaran:ntext',
        ],
    ]) ?>

</div>
