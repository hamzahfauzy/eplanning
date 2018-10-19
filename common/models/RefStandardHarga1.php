<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Standard_Harga_1".
 *
 * @property string $Tahun
 * @property integer $Kd_1
 * @property string $Uraian
 *
 * @property RefStandardHarga2[] $refStandardHarga2s
 */
class RefStandardHarga1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Standard_Harga_1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_1', 'Uraian'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_1'], 'integer'],
            [['Uraian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_1' => 'Kd 1',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStandardHarga2s()
    {
        return $this->hasMany(RefStandardHarga2::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStandardHarga1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStandardHarga1Query(get_called_class());
    }
}
