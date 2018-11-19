<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Kritik_Saran".
 *
 * @property integer $id
 * @property string $nama
 * @property string $email
 * @property string $NoHandphone
 * @property string $judul
 * @property string $saran
 * @property string $status
 */
class TaKritikSaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kritik_Saran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email', 'NoHandphone', 'judul', 'saran', 'status'], 'required'],
            [['saran', 'status'], 'string'],
            [['nama', 'email', 'NoHandphone'], 'string', 'max' => 32],
            [['judul'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'email' => 'Email',
            'NoHandphone' => 'No Handphone',
            'judul' => 'Judul',
            'saran' => 'Saran',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaSasaranQuery(get_called_class());
    }
}
