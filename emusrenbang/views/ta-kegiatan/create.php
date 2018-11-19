<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatan */

$this->title = 'Create Ta Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
