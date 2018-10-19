<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Fraksi_Dprd".
 *
 * @property string $Tahun
 * @property int $Kd_Fraksi
 * @property string $Nm_Fraksi
 *
 * @property TaUserDapil[] $taUserDapils
 * @property User[] $kdUsers
 */
class RefFraksiDprd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Fraksi_Dprd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Fraksi', 'Nm_Fraksi'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Fraksi'], 'integer'],
            [['Nm_Fraksi'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Fraksi' => 'Kd  Fraksi',
            'Nm_Fraksi' => 'Nm  Fraksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUserDapils()
    {
        return $this->hasMany(TaUserDapil::className(), ['Tahun' => 'Tahun', 'Kd_Fraksi' => 'Kd_Fraksi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'Kd_User'])->viaTable('Ta_User_Dapil', ['Tahun' => 'Tahun', 'Kd_Fraksi' => 'Kd_Fraksi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefFraksiDprdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefFraksiDprdQuery(get_called_class());
    }
}
