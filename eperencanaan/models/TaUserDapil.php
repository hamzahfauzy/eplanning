<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefDapil;
use eperencanaan\models\RefFraksiDprd;

/**
 * This is the model class for table "Ta_User_Dapil".
 *
 * @property string $Tahun
 * @property int $Kd_User
 * @property int $Kd_Dapil
 * @property int $Kd_Dewan
 * @property int $Kd_Komisi
 * @property int $Kd_Fraksi
 *
 * @property RefKomisiDprd $tahun
 * @property RefDapil $tahun0
 * @property RefFraksiDprd $tahun1
 * @property RefDewan $tahun2
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
            [['Tahun', 'Kd_User', 'Kd_Dapil', 'Kd_Dewan', 'Kd_Komisi', 'Kd_Fraksi'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_User', 'Kd_Dapil', 'Kd_Dewan', 'Kd_Komisi', 'Kd_Fraksi'], 'integer'],
            [['Tahun', 'Kd_Komisi'], 'exist', 'skipOnError' => true, 'targetClass' => RefKomisiDprd::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Komisi' => 'Kd_Komisi']],
            [['Tahun', 'Kd_Dapil'], 'exist', 'skipOnError' => true, 'targetClass' => RefDapil::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']],
            [['Tahun', 'Kd_Fraksi'], 'exist', 'skipOnError' => true, 'targetClass' => RefFraksiDprd::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Fraksi' => 'Kd_Fraksi']],
            [['Tahun', 'Kd_Dapil', 'Kd_Dewan'], 'exist', 'skipOnError' => true, 'targetClass' => RefDewan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil', 'Kd_Dewan' => 'Kd_Dewan']],
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
            'Kd_Dewan' => 'Kd  Dewan',
            'Kd_Komisi' => 'Kd  Komisi',
            'Kd_Fraksi' => 'Kd  Fraksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefKomisiDprd::className(), ['Tahun' => 'Tahun', 'Kd_Komisi' => 'Kd_Komisi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun0()
    {
        return $this->hasOne(RefDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun1()
    {
        return $this->hasOne(RefFraksiDprd::className(), ['Tahun' => 'Tahun', 'Kd_Fraksi' => 'Kd_Fraksi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun2()
    {
        return $this->hasOne(RefDewan::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil', 'Kd_Dewan' => 'Kd_Dewan']);
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

    public function getDapil()
    {

        return $this->hasOne(RefDapil::className(), ['Kd_Dapil'=>'Kd_Dapil']);

    }

    public function getFraksi(){

        return $this->hasOne(RefFraksiDprd::className(), ['Kd_Fraksi'=>'Kd_Fraksi']);
    }
    
    public function getKdTaDapil()
    {
        return $this->hasMany(TaDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }
}
