<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaProgram */
?>
<div class="ta-program-update">

    <?= $this->render('_form', [
        'model' => $model,
		'dataUrusan' => $dataUrusan
    ]) ?>

</div>
