<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirMedia */

$this->title = 'Update Ta Pokir Media: ' . $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pokir Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_User, 'url' => ['view', 'id' => $model->Kd_User]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-pokir-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
