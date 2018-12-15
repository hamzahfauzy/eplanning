<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $nama_lengkap
 * @property integer $id_jabatan
 * @property integer $id_urusan
 * @property integer $id_bidang
 * @property string $id_skpd
 * @property integer $id_subunit
 * @property integer $id_level
 * @property string $nip
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password_hash1;
    
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email', 'nama_lengkap', 'id_urusan',  'id_level', 'nip', 'created_at', 'updated_at'], 'required'],
            [['status', 'id_jabatan', 'id_urusan', 'id_level', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_hash1', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nama_lengkap'], 'string', 'max' => 100],
            [['id_skpd', 'id_subunit'], 'string', 'max' => 50],
            [['id_bidang'], 'string', 'max' => 50],
            [['nip'], 'string', 'max' => 30],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_hash1' => 'Password Old',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'nama_lengkap' => 'Nama Lengkap',
            'id_jabatan' => 'Id Jabatan',
            'id_urusan' => 'Id Urusan',
            'id_bidang' => 'Id Bidang',
            'id_skpd' => 'Id Skpd',
            'id_subunit' => 'Id Subunit',
            'id_level' => 'Id Level',
            'nip' => 'Nip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
