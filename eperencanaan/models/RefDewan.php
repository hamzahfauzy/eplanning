<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefDapil;

/**
 * This is the model class for table "Ref_Dewan".
 *
 * @property string $Tahun
 * @property int $Kd_Dapil
 * @property int $Kd_Dewan
 * @property string $Nm_Dewan
 *
 * @property TaUserDapil[] $taUserDapils
 * @property User[] $kdUsers
 */
class RefDewan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Dewan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Dapil', 'Kd_Dewan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Dapil', 'Kd_Dewan'], 'integer'],
            [['Nm_Dewan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Dapil' => 'Kode Dapil',
            'Kd_Dewan' => 'Kode Dewan',
            'Nm_Dewan' => 'Dewan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUserDapils()
    {
        return $this->hasMany(TaUserDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil', 'Kd_Dewan' => 'Kd_Dewan']);
    }

    public function getRefDapil()
    {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'Kd_User'])->viaTable('Ta_User_Dapil', ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil', 'Kd_Dewan' => 'Kd_Dewan']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\RefDewanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\RefDewanQuery(get_called_class());
    }
}
