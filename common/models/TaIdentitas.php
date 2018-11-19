<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Identitas".
 *
 * @property int $Id
 * @property string $Hostname
 * @property string $Ip_Public
 * @property string $Logo
 * @property string $Nm_Instansi
 * @property string $Created_At
 * @property int $Status
 * @property string $Email
 */
class TaIdentitas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Identitas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Hostname', 'Ip_Public', 'Logo', 'Nm_Instansi', 'Created_At', 'Status', 'Email'], 'required'],
            [['Id', 'Status'], 'integer'],
            [['Created_At'], 'safe'],
            [['Hostname', 'Ip_Public', 'Logo', 'Nm_Instansi', 'Email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Hostname' => 'Hostname',
            'Ip_Public' => 'Ip  Public',
            'Logo' => 'Logo',
            'Nm_Instansi' => 'Nm  Instansi',
            'Created_At' => 'Created  At',
            'Status' => 'Status',
            'Email' => 'Email',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaIdentitasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaIdentitasQuery(get_called_class());
    }
}
