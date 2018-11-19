<?php

namespace eperencanaan\models;

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
    public function rules()
    {
        return [
            [['Kd_User'], 'integer'],
            [['Tgl_Lahir'], 'safe'],
            [['Nm_Lengkap', 'Alamat', 'Foto'], 'string', 'max' => 100],
            [['Telp', 'Mobile'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd  User',
            'Nm_Lengkap' => 'Nama Lengkap',
            'Tgl_Lahir' => 'Tanggal Lahir',
            'Alamat' => 'Alamat',
            'Telp' => 'Telepon',
            'Mobile' => 'No HP',
            'Foto' => 'Foto',
        ];
    }
}
