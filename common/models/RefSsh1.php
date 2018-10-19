<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh1".
 *
 * @property integer $Kd_Ssh1
 * @property string $Nm_Ssh1
 *
 * @property RefSsh2[] $refSsh2s
 */
class RefSsh1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Nm_Ssh1'], 'required'],
            [['Kd_Ssh1'], 'integer'],
            [['Nm_Ssh1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Ssh1' => 'Kode SSH 1',
            'Nm_Ssh1' => 'Uraian SSH 1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSsh2s()
    {
        return $this->hasMany(RefSsh2::className(), ['Kd_Ssh1' => 'Kd_Ssh1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSsh1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSsh1Query(get_called_class());
    }
}
