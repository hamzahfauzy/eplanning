<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaBelanjaApbn */

$this->title = 'Create Ta Belanja Apbn';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanja Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-apbn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
