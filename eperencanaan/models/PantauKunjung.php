<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class PantauKunjung extends ActiveRecord
{
	public static function tableName()
    {
        return 'log'; 
    }
}