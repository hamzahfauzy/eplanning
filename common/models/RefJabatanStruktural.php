<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jabatan_Struktural".
 *
 * @property integer $Kd_Eselon
 * @property integer $Kd_Jabatan
 * @property string $Nm_Jabatan
 *
 * @property RefEselon $kdEselon
 */
class RefJabatanStruktural extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jabatan_Struktural';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Eselon', 'Kd_Jabatan'], 'required'],
            [['Kd_Eselon', 'Kd_Jabatan'], 'integer'],
            [['Nm_Jabatan'], 'string', 'max' => 50],
            [['Kd_Eselon'], 'exist', 'skipOnError' => true, 'targetClass' => RefEselon::className(), 'targetAttribute' => ['Kd_Eselon' => 'Kd_Eselon']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Eselon' => 'Kd  Eselon',
            'Kd_Jabatan' => 'Kd  Jabatan',
            'Nm_Jabatan' => 'Nm  Jabatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdEselon()
    {
        return $this->hasOne(RefEselon::className(), ['Kd_Eselon' => 'Kd_Eselon']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJabatanStrukturalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJabatanStrukturalQuery(get_called_class());
    }
}
