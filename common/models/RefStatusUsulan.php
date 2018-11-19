<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Status_Usulan".
 *
 * @property integer $Kd_Status
 * @property string $Nm_Status
 *
 * @property TaForumLingkungan[] $taForumLingkungans
 * @property TaMusrenbangKelurahan[] $taMusrenbangKelurahans
 */
class RefStatusUsulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Status_Usulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Status', 'Nm_Status'], 'required'],
            [['Kd_Status'], 'integer'],
            [['Nm_Status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Status' => 'Kd  Status',
            'Nm_Status' => 'Nm  Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaForumLingkungans()
    {
        return $this->hasMany(TaForumLingkungan::className(), ['status' => 'Kd_Status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKelurahans()
    {
        return $this->hasMany(TaMusrenbangKelurahan::className(), ['Kd_Status' => 'Kd_Status']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStatusUsulanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStatusUsulanQuery(get_called_class());
    }
}
