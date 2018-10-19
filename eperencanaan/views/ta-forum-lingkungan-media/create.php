<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaForumLingkunganMedia */

$this->title = 'Create Ta Forum Lingkungan Media';
$this->params['breadcrumbs'][] = ['label' => 'Ta Forum Lingkungan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
