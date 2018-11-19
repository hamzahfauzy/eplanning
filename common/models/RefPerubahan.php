<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Perubahan".
 *
 * @property integer $Kd_Perubahan
 * @property string $Uraian
 */
class RefPerubahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Perubahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Perubahan', 'Uraian'], 'required'],
            [['Kd_Perubahan'], 'integer'],
            [['Uraian'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Perubahan' => 'Kd  Perubahan',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefPerubahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefPerubahanQuery(get_called_class());
    }
}
