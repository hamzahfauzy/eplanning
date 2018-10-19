<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMusrenbangKelurahan */

$this->title = 'Create Ta Musrenbang Kelurahan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
