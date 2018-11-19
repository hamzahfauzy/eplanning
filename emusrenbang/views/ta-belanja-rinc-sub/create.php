<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaBelanjaRincSub */

$this->title = 'Create Ta Belanja Rinc Sub';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanja Rinc Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-rinc-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
