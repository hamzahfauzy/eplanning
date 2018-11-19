<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Analisa".
 *
 * @property integer $Kd_Analisa
 * @property string $Nm_Analisa
 *
 * @property RefAnalisaSub[] $refAnalisaSubs
 */
class RefAnalisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Analisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa'], 'required'],
            [['Kd_Analisa'], 'integer'],
            [['Nm_Analisa'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Analisa' => 'Kode  Analisa',
            'Nm_Analisa' => 'Nama Analisa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAnalisaSubs()
    {
        return $this->hasMany(RefAnalisaSub::className(), ['Kd_Analisa' => 'Kd_Analisa']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAnalisaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAnalisaQuery(get_called_class());
    }
}
