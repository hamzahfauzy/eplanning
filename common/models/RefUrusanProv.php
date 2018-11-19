<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Urusan_Prov".
 *
 * @property int $Kd_Urusan
 * @property string $Nm_Urusan
 * @property int $Flag
 * @property string $Token
 *
 * @property RefBidangProv[] $refBidangProvs
 */
class RefUrusanProv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Urusan_Prov';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Nm_Urusan'], 'required'],
            [['Kd_Urusan', 'Flag'], 'integer'],
            [['Nm_Urusan'], 'string', 'max' => 50],
            [['Token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Nm_Urusan' => 'Nm  Urusan',
            'Flag' => 'Flag',
            'Token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBidangProvs()
    {
        return $this->hasMany(RefBidangProv::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefUrusanProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefUrusanProvQuery(get_called_class());
    }
}
