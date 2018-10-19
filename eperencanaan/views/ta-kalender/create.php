<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaKalender */

$this->title = 'Create Ta Kalender';
$this->params['breadcrumbs'][] = ['label' => 'Ta Kalenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kalender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
