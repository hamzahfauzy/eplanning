<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Tahapan".
 *
 * @property int $Kd_Tahapan
 * @property int $No_Urut
 * @property string $Uraian
 *
 * @property TaPeraturan[] $taPeraturans
 */
class RefTahapan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Tahapan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Tahapan', 'No_Urut', 'Uraian'], 'required'],
            [['Kd_Tahapan', 'No_Urut'], 'integer'],
            [['Uraian'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Tahapan' => 'Kd  Tahapan',
            'No_Urut' => 'No  Urut',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPeraturans()
    {
        return $this->hasMany(TaPeraturan::className(), ['Kd_Tahapan' => 'Kd_Tahapan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefTahapanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefTahapanQuery(get_called_class());
    }
}
