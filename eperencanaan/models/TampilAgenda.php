<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class TampilAgenda extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Agenda'; 
    }
}