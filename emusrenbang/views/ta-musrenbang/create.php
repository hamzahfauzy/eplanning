<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = 'Create Ta Musrenbang';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
