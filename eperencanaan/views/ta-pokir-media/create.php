<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirMedia */

$this->title = 'Create Ta Pokir Media';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pokir Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pokir-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
