<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Eselon".
 *
 * @property integer $Kd_Eselon
 * @property string $Nm_Eselon
 *
 * @property RefJabatanStruktural[] $refJabatanStrukturals
 */
class RefEselon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Eselon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Eselon'], 'required'],
            [['Kd_Eselon'], 'integer'],
            [['Nm_Eselon'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Eselon' => 'Kd  Eselon',
            'Nm_Eselon' => 'Nm  Eselon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJabatanStrukturals()
    {
        return $this->hasMany(RefJabatanStruktural::className(), ['Kd_Eselon' => 'Kd_Eselon']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefEselonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefEselonQuery(get_called_class());
    }
}
