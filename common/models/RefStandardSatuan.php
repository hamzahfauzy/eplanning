<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Standard_Satuan".
 *
 * @property integer $Kd_Satuan
 * @property string $Uraian
 *
 * @property RefStandardHarga3[] $refStandardHarga3s
 */
class RefStandardSatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Standard_Satuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Uraian'], 'required'],
            [['Uraian'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Satuan' => 'Kd  Satuan',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStandardHarga3s()
    {
        return $this->hasMany(RefStandardHarga3::className(), ['Satuan' => 'Uraian']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStandardSatuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStandardSatuanQuery(get_called_class());
    }
}
