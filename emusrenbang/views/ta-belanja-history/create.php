<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaBelanjaHistory */

$this->title = 'Create Ta Belanja History';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanja Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
