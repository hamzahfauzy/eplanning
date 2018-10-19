<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaProgram */

?>
<div class="ta-program-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataUrusan'=>$dataUrusan

    ]) ?>
</div>
