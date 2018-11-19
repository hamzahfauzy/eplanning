<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaForumLingkungan */

$this->title = 'Create Ta Forum Lingkungan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Forum Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
