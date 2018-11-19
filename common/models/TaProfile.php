<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Profile".
 *
 * @property integer $Kd_User
 * @property string $Nm_Lengkap
 * @property string $Tgl_Lahir
 * @property string $Alamat
 * @property string $Telp
 * @property string $Mobile
 * @property string $Foto
 */
class TaProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Profile';
    }

    /**
     * @inheritdoc
     */
    public $fileFoto;
    public $Nip;
    public $NIP;
    
    public function rules()
    {
        return [
            [['Kd_User', 'Nm_Lengkap', 'Tgl_Lahir', 'Alamat', 'Telp', 'Mobile'], 'required'],
            [['fileFoto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['Kd_User'], 'integer'],
            [['Tgl_Lahir', 'Foto'], 'safe'],
            [['Nm_Lengkap', 'Alamat'], 'string', 'max' => 100],
            //[['Telp', 'Mobile'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd  User',
            'Nm_Lengkap' => 'Nm  Lengkap',
            'Tgl_Lahir' => 'Tgl  Lahir',
            'Alamat' => 'Alamat',
            'Telp' => 'Telp',
            'Mobile' => 'Mobile',
            'Foto' => 'Foto',
            'Nip' => 'Nip',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaProfileQuery(get_called_class());
    }
}
