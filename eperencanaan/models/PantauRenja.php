<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class PantauRenja extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Kegiatan'; 
    }
}