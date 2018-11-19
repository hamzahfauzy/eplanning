<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kecamatan_Kriteria_Bobot".
 *
 * @property integer $Kd_Bobot
 * @property integer $Kd_Kriteria
 * @property integer $No_Urut
 * @property string $Range
 * @property string $Skor
 *
 * @property RefKecamatanKriteriaPembobotan $kdKriteria
 */
class RefForumKriteriaBobot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Forum_Kriteria_Bobot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Kriteria', 'No_Urut', 'Range', 'Skor'], 'required'],
            [['Kd_Kriteria', 'No_Urut'], 'integer'],
            [['Skor'], 'number'],
            [['Range'], 'string', 'max' => 128],
            [['Kd_Kriteria'], 'exist', 'skipOnError' => true, 'targetClass' => RefForumKriteriaPembobotan::className(), 'targetAttribute' => ['Kd_Kriteria' => 'Kd_Kriteria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Bobot' => 'Kd  Bobot',
            'Kd_Kriteria' => 'Kd  Kriteria',
            'No_Urut' => 'No  Urut',
            'Range' => 'Range',
            'Skor' => 'Skor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdKriteria()
    {
        return $this->hasOne(RefForumKriteriaPembobotan::className(), ['Kd_Kriteria' => 'Kd_Kriteria']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKecamatanKriteriaBobotQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefForumKriteriaBobotQuery(get_called_class());
    }
}
