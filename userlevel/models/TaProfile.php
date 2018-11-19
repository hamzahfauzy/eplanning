<?php

namespace userlevel\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "ta_profile".
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
    public $NIP;
    public function rules()
    {
        return [
            [['Kd_User', 'Nm_Lengkap', 'Tgl_Lahir', 'Alamat', 'Telp', 'Mobile'], 'required'],
            [['Foto'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['Kd_User'], 'integer'],
            [['Tgl_Lahir'], 'safe'],
            [['Nm_Lengkap', 'Alamat', 'Foto'], 'string', 'max' => 100],
            [['Telp', 'Mobile', 'NIP'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd User',
            'Nm_Lengkap' => 'Nama  Lengkap',
            'Tgl_Lahir' => 'Tgl  Lahir',
            'Alamat' => 'Alamat',
            'Telp' => 'Telp',
            'Mobile' => 'Mobile',
            'Foto' => 'Foto',
            'Nip' => 'Nip',
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->Foto as $file) {
            	$name=$file->baseName .'_'.time().'.' . $file->extension;
                $file->saveAs('uploads/' . $name);
            }
            return true;
        } else {
            return false;
        }
    }
}
