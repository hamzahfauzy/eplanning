<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Rek_Aset1".
 *
 * @property integer $Kd_Aset1
 * @property string $Nm_Aset1
 *
 * @property RefRekAset2[] $refRekAset2s
 */
class RefRekAset1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Rek_Aset1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aset1', 'Nm_Aset1'], 'required'],
            [['Kd_Aset1'], 'integer'],
            [['Nm_Aset1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Aset1' => 'Kd  Aset1',
            'Nm_Aset1' => 'Nm  Aset1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRekAset2s()
    {
        return $this->hasMany(RefRekAset2::className(), ['Kd_Aset1' => 'Kd_Aset1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefRekAset1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefRekAset1Query(get_called_class());
    }
}
