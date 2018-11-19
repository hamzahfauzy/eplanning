<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdTujuan */
?>
<div class="ta-rpjmd-tujuan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            [
            	'attribute' => 'taRpjmdMisi.Misi',
            	'value' => function($model) { return '('.$model->taRpjmdMisi->No_Misi.') '.$model->taRpjmdMisi->Misi; }
            ],
            'No_Tujuan',
            'Tujuan:ntext',
        ],
    ]) ?>

</div>
