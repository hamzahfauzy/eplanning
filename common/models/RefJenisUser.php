<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jenis_User".
 *
 * @property integer $Kd_Jenis_User
 * @property string $Nm_Jenis_User
 */
class RefJenisUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jenis_User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nm_Jenis_User'], 'required'],
            [['Nm_Jenis_User'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Jenis_User' => 'Kd  Jenis  User',
            'Nm_Jenis_User' => 'Nm  Jenis  User',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJenisUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJenisUserQuery(get_called_class());
    }
}
