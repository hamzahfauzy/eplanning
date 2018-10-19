<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class PantauMusrenbang extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Acara'; 
    }
}