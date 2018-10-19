<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaProfile */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-profile-create">


    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
