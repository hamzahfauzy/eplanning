<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaTupok */

?>
<div class="ta-tupok-create">
    <?= $this->render('_form', [
        'model' => $model,
         'dataUrusan' => $dataUrusan,
    ]) ?>
</div>
