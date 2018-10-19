<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefUnit */

?>
<div class="ref-unit-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataUrusan' => $dataUrusan,
    ]) ?>
</div>
