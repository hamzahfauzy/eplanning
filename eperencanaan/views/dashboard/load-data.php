<?php

$response = yii\helpers\Json::encode($response);
echo "[";
print_r($response);
echo "]";