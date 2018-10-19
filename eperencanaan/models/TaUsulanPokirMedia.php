<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Usulan_Pokir_Media".
 *
 * @property integer $Kd_Media
 * @property integer $id
 * @property string $Jenis_Dokumen
 */
class TaUsulanPokirMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Usulan_Pokir_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Media', 'id', 'Jenis_Dokumen'], 'required'],
            [['Kd_Media', 'id'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Media' => 'Kd  Media',
            'id' => 'ID',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(\common\models\RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
