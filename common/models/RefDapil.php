<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Dapil".
 *
 * @property string $Tahun
 * @property integer $Kd_Dapil
 * @property string $Nm_Dapil
 *
 * @property TaDapil[] $taDapils
 * @property RefKecamatan[] $kdProvs
 * @property TaUserDapil[] $taUserDapils
 * @property User[] $kdUsers
 */
class RefDapil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Dapil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Dapil', 'Nm_Dapil'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Dapil'], 'integer'],
            [['Nm_Dapil'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Dapil' => 'Kode  Dapil',
            'Nm_Dapil' => 'Dapil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaDapils()
    {
        return $this->hasMany(TaDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProvs()
    {
        return $this->hasMany(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec'])->viaTable('Ta_Dapil', ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUserDapils()
    {
        return $this->hasMany(TaUserDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'Kd_User'])->viaTable('Ta_User_Dapil', ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefDapilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefDapilQuery(get_called_class());
    }
}
