<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan_Media".
 *
 * @property integer $Kd_Musrenbang_Kelurahan
 * @property integer $Kd_Media
 */
class TaMusrenbangKelurahanMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Musrenbang_Kelurahan', 'Kd_Media'], 'required'],
            [['Kd_Musrenbang_Kelurahan', 'Kd_Media'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Musrenbang_Kelurahan' => 'Kd  Musrenbang  Kelurahan',
            'Kd_Media' => 'Kd  Media',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaMusrenbangKelurahanMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaMusrenbangKelurahanMediaQuery(get_called_class());
    }
	
	public function getKdMedia(){
		return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
	}
}
