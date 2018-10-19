<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_User_Dapil".
 *
 * @property string $Tahun
 * @property integer $Kd_User
 * @property integer $Kd_Dapil
 *
 * @property User $kdUser
 * @property RefDapil $tahun
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
            [['Tahun', 'Kd_User', 'Kd_Dapil'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_User', 'Kd_Dapil'], 'integer'],
            [['Kd_User'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Kd_User' => 'id']],
            [['Tahun', 'Kd_Dapil'], 'exist', 'skipOnError' => true, 'targetClass' => RefDapil::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_User' => 'Kode  User',
            'Kd_Dapil' => 'Kode  Dapil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Kd_User']);
    }

    public function getRefDapil()
    {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }
	
	public function getRefFraksi()
    {
        return $this->hasOne(RefFraksiDprd::className(), ['Kd_Fraksi' => 'Kd_Fraksi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaUserDapilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaUserDapilQuery(get_called_class());
    }
}
