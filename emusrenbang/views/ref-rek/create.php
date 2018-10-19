<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek3 */

$this->title = 'Tambah Ref Rek3';
$this->params['breadcrumbs'][] = ['label' => 'Ref Rek3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rek3-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
