<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Asb1".
 *
 * @property integer $Kd_Asb1
 * @property string $Nm_Asb1
 *
 * @property RefAsb2[] $refAsb2s
 */
class RefAsb1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Asb1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1'], 'required'],
            [['Kd_Asb1'], 'integer'],
            [['Nm_Asb1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Asb1' => 'Kode ASB 1',
            'Nm_Asb1' => 'Uraian ASB 1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAsb2s()
    {
        return $this->hasMany(RefAsb2::className(), ['Kd_Asb1' => 'Kd_Asb1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAsb1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAsb1Query(get_called_class());
    }
}
