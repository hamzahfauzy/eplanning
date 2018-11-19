<?php

namespace eperencanaan\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "Ta_Profile".
 *
 * @property int $Kd_User
 * @property string $Nm_Lengkap
 * @property string $Tgl_Lahir
 * @property string $Alamat
 * @property string $Telp
 * @property string $Mobile
 * @property string $Foto
 * @property string $Nip
 *
 * @property User $kdUser
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
            [['Kd_User', 'Nm_Lengkap', 'Tgl_Lahir', 'Alamat', 'Telp', 'Mobile', 'Foto', 'Nip'], 'required'],
            [['Kd_User'], 'integer'],
            [['Tgl_Lahir'], 'safe'],
            [['Nm_Lengkap', 'Alamat', 'Foto'], 'string', 'max' => 100],
            [['Telp', 'Mobile'], 'string', 'max' => 12],
            [['Nip'], 'string', 'max' => 35],
            [['Kd_User'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Kd_User' => 'id']],
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
            'Nip' => 'Nip',
        ];
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
     * @return \eperencanaan\models\query\TaProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaProfileQuery(get_called_class());
    }
}
