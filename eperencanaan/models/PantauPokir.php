<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class PantauPokir extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Pokir_Acara'; 
    }
}