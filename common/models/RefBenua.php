<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Benua".
 *
 * @property integer $Kd_Benua
 * @property string $Nm_Benua
 *
 * @property RefBenuaSub[] $refBenuaSubs
 */
class RefBenua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Benua';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua'], 'required'],
            [['Kd_Benua'], 'integer'],
            [['Nm_Benua'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Benua' => 'Kd  Benua',
            'Nm_Benua' => 'Nm  Benua',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBenuaSubs()
    {
        return $this->hasMany(RefBenuaSub::className(), ['Kd_Benua' => 'Kd_Benua']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefBenuaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefBenuaQuery(get_called_class());
    }
}
