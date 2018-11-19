<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Standard_Harga_2".
 *
 * @property string $Tahun
 * @property integer $Kd_1
 * @property integer $Kd_2
 * @property string $Uraian
 *
 * @property RefStandardHarga1 $tahun
 * @property RefStandardHarga3[] $refStandardHarga3s
 */
class RefStandardHarga2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Standard_Harga_2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_1', 'Kd_2', 'Uraian'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_1', 'Kd_2'], 'integer'],
            [['Uraian'], 'string', 'max' => 255],
            [['Tahun', 'Kd_1'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardHarga1::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1']],
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
            'Kd_2' => 'Kd 2',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefStandardHarga1::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStandardHarga3s()
    {
        return $this->hasMany(RefStandardHarga3::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStandardHarga2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStandardHarga2Query(get_called_class());
    }
}
