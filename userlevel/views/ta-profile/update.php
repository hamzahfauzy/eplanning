<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaProfile */

$this->title = 'Update Ta Profile: ' . $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_User, 'url' => ['view', 'id' => $model->Kd_User]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
