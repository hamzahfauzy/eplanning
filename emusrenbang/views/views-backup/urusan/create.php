<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Urusan */

$this->title = 'Create Urusan';
$this->params['breadcrumbs'][] = ['label' => 'Urusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urusan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
