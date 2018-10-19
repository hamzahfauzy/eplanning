<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaBelanjaRinc */

$this->title = 'Create Ta Belanja Rinc';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanja Rincs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-rinc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
