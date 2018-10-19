<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaProgramApbn */

$this->title = 'Create Ta Program Apbn';
$this->params['breadcrumbs'][] = ['label' => 'Ta Program Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-program-apbn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
