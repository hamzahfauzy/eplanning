<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Hspk1".
 *
 * @property integer $Kd_Hspk1
 * @property string $Nm_Hspk1
 *
 * @property RefHspk2[] $refHspk2s
 */
class RefHspk1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Hspk1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1','Nm_Hspk1'], 'required'],
            [['Kd_Hspk1'], 'integer'],
            [['Nm_Hspk1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Hspk1' => 'Kode HSPK 1',
            'Nm_Hspk1' => 'Uraian HSPK 1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHspk2s()
    {
        return $this->hasMany(RefHspk2::className(), ['Kd_Hspk1' => 'Kd_Hspk1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHspk1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHspk1Query(get_called_class());
    }
}
