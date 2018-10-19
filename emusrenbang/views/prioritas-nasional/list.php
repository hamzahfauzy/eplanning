<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Prioritas Nasional';
$this->params['breadcrumbs'][] = "Referensi";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="nawacita statis_page">
<ol>
    <?php foreach ($model as $key => $value) { ?>
        <li>
            <label><?= $value['prioritas_nasional'] ?></label>
            <p><?= $value['nawacita'] ?></p>
        </li>
    <?php } ?>
</ol>
</div>