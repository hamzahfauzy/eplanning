<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaPeraturan */

?>
<div class="ta-peraturan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'RefTahapan' => $RefTahapan,
        'RefPeraturan' => $RefPeraturan,
    ]) ?>
</div>
