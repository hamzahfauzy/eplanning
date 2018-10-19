<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefJalan */
?>
<div class="ref-jalan-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'dataKec' => $dataKec,
    ])
    ?>

</div>
