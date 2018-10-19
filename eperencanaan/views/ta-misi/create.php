<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMisi */

?>
<div class="ta-misi-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataUrusan' => $dataUrusan,
        'dataBidang' => $dataBidang,
        'dataUnit' => $dataUnit,
        'dataSub' => $dataSub,
        
    ]) ?>
</div>
