<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefDapil;

/**
 * This is the model class for table "Ta_User_Dapil".
 *
 * @property string $Tahun
 * @property int $Kd_User
 * @property int $Kd_Dapil
 * @property string $Nm_User_Dapil
 *
 * @property RefDapil $tahun
 * @property User $kdUser
 */
class TaUserDapil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_User_Dapil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_User', 'Kd_Dapil', 'Nm_User_Dapil'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_User', 'Kd_Dapil'], 'integer'],
            [['Nm_User_Dapil'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Dapil'], 'exist', 'skipOnError' => true, 'targetClass' => RefDapil::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']],
            [['Kd_User'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Kd_User' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_User' => 'Kd  User',
            'Kd_Dapil' => 'Kd  Dapil',
            'Nm_User_Dapil' => 'Nm  User  Dapil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Kd_User']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaUserDapilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaUserDapilQuery(get_called_class());
    }


        public function getKdDapil()
    {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }

        public function getKdTaDapil()
    {
        return $this->hasMany(TaDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }

        public function getRefKecamatans()
    {

        return $this->hasMany(RefKecamantan::className(), ['Kd_Prov']);
    }
}
