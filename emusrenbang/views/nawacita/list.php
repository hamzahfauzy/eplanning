<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Nawacita';
$this->params['breadcrumbs'][] = "Referensi";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="nawacita statis_page">
<ol>
    <?php foreach ($model as $key => $value) { ?>
        <li><?= $value->nawacita ?></li>
    <?php } ?>
</ol>
</div>