<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\Lingkungan */

$this->title = 'Create Lingkungan';
$this->params['subtitle'] = 'Lingkungan';
$this->params['breadcrumbs'][] = ['label' => 'Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lingkungan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
