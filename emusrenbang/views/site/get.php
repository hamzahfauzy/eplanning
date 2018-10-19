<?php
use yii\helpers\Html;
use yii\helpers\Url;
 ?>
<?php if(strpos($model->contentType,'image')===false): //Not an image?>
        <iframe src="<?=Url::to(['asset/get', 'id'=>(string)$model->_id]);?>" width="100%" height="600px"></iframe>
    <?php else: ?>
        <?= Html::img(Url::to(['asset/get', 'id'=>(string)$model->_id]), ['alt'=>$model->description]);?>
    <?php endif; ?>