<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaBelanjaLanjutan */

$this->title = 'Create Ta Belanja Lanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Belanja Lanjutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-lanjutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
