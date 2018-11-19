<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaUserAplikasi */

$this->title = 'Aplikasi User';
$this->params['breadcrumbs'][] = ['label' => 'Aplikasi User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-user-aplikasi-create">


    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
        'DNDataAplikasi' => $DNDataAplikasi,
    ]) ?>

</div>
