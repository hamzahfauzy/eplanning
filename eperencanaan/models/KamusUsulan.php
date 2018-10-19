<?php

namespace eperencanaan\models;

use yii\db\ActiveRecord;

class KamusUsulan extends ActiveRecord
{
	public static function tableName()
    {
        return 'kamususulan';
    }
}