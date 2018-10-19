<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $Kd_Log
 * @property int $Kd_User
 * @property string $username
 * @property string $controller
 * @property string $action
 * @property string $created_at
 * @property string $pesan
 * @property string $ip
 * @property string $kegiatan
 * @property string $tabel
 * @property string $id_tabel
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User', 'username', 'controller', 'action', 'pesan', 'ip'], 'required'],
            [['Kd_User'], 'integer'],
            [['created_at'], 'safe'],
            [['pesan', 'id_tabel'], 'string'],
            [['username', 'controller', 'action', 'ip', 'kegiatan', 'tabel'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Log' => 'Kd  Log',
            'Kd_User' => 'Kd  User',
            'username' => 'Username',
            'controller' => 'Controller',
            'action' => 'Action',
            'created_at' => 'Created At',
            'pesan' => 'Pesan',
            'ip' => 'Ip',
            'kegiatan' => 'Kegiatan',
            'tabel' => 'Tabel',
            'id_tabel' => 'Id Tabel',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LogQuery(get_called_class());
    }
}
