<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefProgram */

?>
<div class="ref-program-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataUrusan'=> $dataUrusan,
    ]) ?>
</div>
