<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class PantauKecamatan extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Musrenbang_Kecamatan_Acara'; 
    }
}