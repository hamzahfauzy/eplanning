<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaBelanja */

$this->title = 'Create Ta Belanja';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
