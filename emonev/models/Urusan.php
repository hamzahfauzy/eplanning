<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "urusan".
 *
 * @property integer $id
 * @property integer $idMisi
 * @property string $urusan
 */
class Urusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $namaMisi;

    public static function tableName()
    {
        return 'urusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMisi', 'urusan'], 'required'],
            [['idMisi'], 'integer'],
            [['urusan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'idMisi'   => 'Visi Misi Provinsi',
            'namaMisi' => 'Visi Misi Provinsi',
            'urusan'   => 'Urusan Provinsi',
        ];
    }
}
