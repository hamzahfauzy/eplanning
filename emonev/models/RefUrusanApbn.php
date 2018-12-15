<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "Ref_Urusan_Apbn".
 *
 * @property int $Kd_Urusan
 * @property string $Nm_Urusan
 * @property int $Flag
 * @property string $Token
 */
class RefUrusanApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Urusan_Apbn';
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
     * @inheritdoc
     * @return \emusrenbang\models\query\RefUrusanApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\RefUrusanApbnQuery(get_called_class());
    }
}
